<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\InvoicePayment;
use App\Models\ProductServiceCategory;
use App\Models\Revenue;
use App\Models\Transaction;
use App\Models\Utility;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use App\Exports\RevenueExport;
use App\Models\TransactionLines;
use Maatwebsite\Excel\Facades\Excel;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        if (\Auth::user()->can('manage revenue')) {
            $customer = Customer::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $customer->prepend('Select Customer', '');
            $account = BankAccount::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('holder_name', 'id');
            $account->prepend('Select Account', '');

            $category = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'income')->get()->pluck('name', 'id');
            $category->prepend('Select Category', '');


            $query = Revenue::where('created_by', '=', \Auth::user()->creatorId());

            if (str_contains($request->date, ' to ')) {
                $date_range = explode(' to ', $request->date);
                $query->whereBetween('date', $date_range);
            } elseif (!empty($request->date)) {

                $query->where('date', $request->date);
            }

            if (!empty($request->customer)) {
                $query->where('customer_id', '=', $request->customer);
            }
            if (!empty($request->account)) {
                $query->where('account_id', '=', $request->account);
            }

            if (!empty($request->category)) {
                $query->where('category_id', '=', $request->category);
            }

            if (!empty($request->payment)) {
                $query->where('payment_method', '=', $request->payment);
            }
            $revenues = $query->get();

            return view('revenue.index', compact('revenues', 'customer', 'account', 'category'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('create revenue')) {
            $customers = Customer::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $customers->prepend('--', 0);
            $categories = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'income')->get()->pluck('name', 'id');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('revenue.create', compact('customers', 'categories', 'accounts'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('create revenue')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'date' => 'required',
                    'amount' => 'required',
                    'account_id' => 'required',
                    'category_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $revenue                 = new Revenue();
            $revenue->date           = $request->date;
            $revenue->amount         = $request->amount;
            $revenue->account_id     = $request->account_id;
            $revenue->customer_id    = $request->customer_id;
            $revenue->category_id    = $request->category_id;
            $revenue->payment_method = 0;
            $revenue->reference      = $request->reference;
            $revenue->description    = $request->description ?? '-';

            if (!empty($request->add_receipt)) {

                $image_size = $request->file('add_receipt')->getSize();

                $fileName = time() . "_" . $request->add_receipt->getClientOriginalName();
                $revenue->add_receipt = $fileName;


                $dir        = 'uploads/revenue';

                $path = Utility::upload_file($request, 'add_receipt', $fileName, $dir, []);

                if ($path['flag'] == 0) {
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }
            $revenue->created_by     = \Auth::user()->creatorId();
            $revenue->save();

            $category            = ProductServiceCategory::where('id', $request->category_id)->first();
            $revenue->payment_id = $revenue->id;
            $revenue->type       = 'Revenue';
            $revenue->category   = $category->name;
            $revenue->user_id    = $revenue->customer_id;
            $revenue->user_type  = 'Customer';
            $revenue->account    = $request->account_id;
            Transaction::addTransaction($revenue);

            $customer         = Customer::where('id', $request->customer_id)->first();
            $payment          = new InvoicePayment();
            $payment->name    = !empty($customer) ? $customer['name'] : '';
            $payment->date    = \Auth::user()->dateFormat($request->date);
            $payment->amount  = \Auth::user()->priceFormat($request->amount);
            $payment->invoice = '';

            if (!empty($customer)) {
                Utility::userBalance('customer', $customer->id, $revenue->amount, 'debit');
            }

            Utility::bankAccountBalance($request->account_id, $revenue->amount, 'credit');

            $accountId = BankAccount::find($revenue->account_id);
            $data = [
                'account_id' => $accountId->chart_account_id,
                    'transaction_type' => 'Credit',
                    'transaction_amount' => $revenue->amount,
                    'reference' => 'Revenue',
                    'reference_id' => $revenue->id,
                    'reference_sub_id' => 0,
                    'date' => $revenue->date,
                ];
                Utility::addTransactionLines($data);

            $uArr = [
                'payment_name' => $payment->name,
                'payment_amount' => $payment->amount,
                'invoice_number' => $revenue->type,
                'payment_date' => $payment->date,
                'payment_dueAmount' => '-',

            ];
            try {
                $resp = Utility::sendEmailTemplate('new_invoice_payment', [$customer->id => $customer->email], $uArr);
            } catch (\Exception $e) {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }

            // Twilio Notification
            $setting  = Utility::settings(\Auth::user()->creatorId());
            $customer = Customer::find($request->customer_id);
            if (isset($setting['revenue_notification']) && $setting['revenue_notification'] == 1) {
                $uArr = [
                    'payment_name' => $payment->name,
                    'payment_amount' => $payment->amount,
                    'payment_date' => $payment->date,
                    'user_name' => \Auth::user()->name,

                ];
                Utility::send_twilio_msg($customer->contact, 'new_revenue', $uArr);
            }

            // webhook
            $module = 'New Revenue';
            $webhook =  Utility::webhookSetting($module);
            if ($webhook) {
                $parameter = json_encode($revenue);
                // 1 parameter is  URL , 2 parameter is data , 3 parameter is method
                $status = Utility::WebhookCall($webhook['url'], $parameter, $webhook['method']);
                if ($status == true) {
                    return redirect()->route('revenue.index')->with('success', __('Revenue successfully created.'));
                } else {
                    return redirect()->back()->with('error', __('Webhook call failed.'));
                }
            }

            return redirect()->route('revenue.index')->with('success', __('Revenue successfully created.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit(Revenue $revenue)
    {
        if (\Auth::user()->can('edit revenue')) {
            $customers = Customer::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $customers->prepend('--', 0);
            $categories = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'income')->get()->pluck('name', 'id');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('revenue.edit', compact('customers', 'categories', 'accounts', 'revenue'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Revenue $revenue)
    {
        if (\Auth::user()->can('edit revenue')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'date' => 'required',
                    'amount' => 'required',
                    'account_id' => 'required',
                    'category_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $customer = Customer::where('id', $request->customer_id)->first();
            if(!empty($customer))
            {
                Utility::userBalance('customer', $revenue->customer_id, $revenue->amount, 'credit');
            }

            Utility::bankAccountBalance($revenue->account_id, $revenue->amount, 'debit');

            if(!empty($customer))
            {
                Utility::userBalance('customer', $customer->id, $request->amount, 'debit');
            }

            Utility::bankAccountBalance($request->account_id, $request->amount, 'credit');

            $revenue->date           = $request->date;
            $revenue->amount         = $request->amount;
            $revenue->account_id     = $request->account_id;
            $revenue->customer_id    = $request->customer_id;
            $revenue->category_id    = $request->category_id;
            $revenue->payment_method = 0;
            $revenue->reference      = $request->reference;
            $revenue->description    = $request->description;


            if (!empty($request->add_receipt)) {
                if ($revenue->add_receipt) {

                    $file_path = 'uploads/revenue/' . $revenue->add_receipt;
                    $image_size = $request->file('add_receipt')->getSize();
                    $fileName = time() . "_" . $request->add_receipt->getClientOriginalName();
                    $revenue->add_receipt = $fileName;
                    $path = storage_path('uploads/revenue/' . $revenue->add_receipt);
                    if (file_exists($path)) {
                        \File::delete($path);
                    }

                    $dir        = 'uploads/revenue';
                    $path = Utility::upload_file($request, 'add_receipt', $fileName, $dir, []);
                    if ($path['flag'] == 0) {
                        return redirect()->back()->with('error', __($path['msg']));
                    }
                }
            }

            $revenue->save();

            $category            = ProductServiceCategory::where('id', $request->category_id)->first();
            $revenue->category   = $category->name;
            $revenue->payment_id = $revenue->id;
            $revenue->type       = 'Revenue';
            $revenue->account    = $request->account_id;
            Transaction::editTransaction($revenue);

            $accountId = BankAccount::find($revenue->account_id);
            $data = [
                'account_id' => $accountId->chart_account_id,
                'transaction_type' => 'Credit',
                'transaction_amount' => $revenue->amount,
                'reference' => 'Revenue',
                'reference_id' => $revenue->id,
                'reference_sub_id' => 0,
                'date' => $revenue->date,
            ];
            Utility::addTransactionLines($data);


            return redirect()->route('revenue.index')->with('success', __('Revenue successfully updated.') . ((isset($result) && $result != 1) ? '<br> <span class="text-danger">' . $result . '</span>' : ''));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Revenue $revenue)
    {
        if (\Auth::user()->can('delete revenue')) {
            if (!empty($revenue->add_receipt)) {
                $file_path = 'uploads/revenue/' . $revenue->add_receipt;

                if (file_exists($file_path)) {
                    \File::delete($file_path);
                }
            }

            if ($revenue->created_by == \Auth::user()->creatorId()) {
                TransactionLines::where('reference_id',$revenue->id)->where('reference','Revenue')->delete();
                $revenue->delete();
                $type = 'Revenue';
                $user = 'Customer';
                Transaction::destroyTransaction($revenue->id, $type, $user);

                if ($revenue->customer_id != 0) {
                    Utility::userBalance('customer', $revenue->customer_id, $revenue->amount, 'credit');
                }

                Utility::bankAccountBalance($revenue->account_id, $revenue->amount, 'debit');

                return redirect()->route('revenue.index')->with('success', __('Revenue successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function export($date = null)
    {
        $name = 'revenue_' . date('Y-m-d i:h:s');
        $data = Excel::download(new RevenueExport($date), $name . '.xlsx');

        return $data;
    }
}
