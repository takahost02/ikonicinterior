<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'proposal_id',
        'customer_id',
        'issue_date',
        'status',
        'category_id',
        'is_convert',
        'converted_invoice_id',
        'created_by',
    ];

    public static $statues = [
        'Draft',
        //0
        'Open',
        //1
        'Accepted',
        //2
        'Declined',
        //3
        'Close',
        //4
    ];


    public function tax()
    {
        return $this->hasOne('App\Models\Tax', 'id', 'tax_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\ProposalProduct', 'proposal_id', 'id');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }

    public function getSubTotal()
    {
        $subTotal = 0;
        foreach ($this->items as $product) {
            $subTotal += ($product->price * $product->quantity);
        }

        return $subTotal;
    }

    
    // public function getTotalTax()
    // {
    //     $totalTax = 0;
    //     foreach ($this->items as $product) {
    //         $taxes = Utility::totalTaxRate($product->tax);

    //         $totalTax += ($taxes / 100) * ($product->price * $product->quantity);
    //     }

    //     return $totalTax;
    // }
    public function getTotalTax()
    {
        $totalTax = 0;
        foreach($this->items as $product)
        {
            $taxes = Utility::totalTaxRate($product->tax);


            $totalTax += ($taxes / 100) * ($product->price * $product->quantity - $product->discount) ;
        }

        return $totalTax;
    }
    public function getTotalDiscount()
    {
        $totalDiscount = 0;
        foreach ($this->items as $product) {
            $totalDiscount += $product->discount;
        }

        return $totalDiscount;
    }

    // public function getTotal()
    // {
    //     return ($this->getSubTotal() + $this->getTotalTax()) - $this->getTotalDiscount();
    // }

    public function getTotal()
    {
        // dd($this->getSubTotal() -$this->getTotalDiscount()) + $this->getTotalTax();
        return ($this->getSubTotal() -$this->getTotalDiscount()) + $this->getTotalTax();
        //        return ($this->getSubTotal() + $this->getTotalTax()) - $this->getTotalDiscount();
    }

    public function getDue()
    {
        $due = 0;
        foreach ($this->payments as $payment) {
            $due += $payment->amount;
        }

        return ($this->getTotal() - $due) - $this->invoiceTotalCreditNote();
    }

    public static function change_status($proposal_id, $status)
    {

        $proposal         = Proposal::find($proposal_id);
        $proposal->status = $status;
        $proposal->update();
    }

    public function category()
    {
        return $this->hasOne('App\Models\ProductServiceCategory', 'id', 'category_id');
    }

    public function taxes()
    {
        return $this->hasOne('App\Models\Tax', 'id', 'tax');
    }
    public static function customers($customer)
    {

        $categoryArr  = explode(',', $customer);
        $unitRate = 0;
        foreach ($categoryArr as $customer) {
            if ($customer == 0) {
                $unitRate = '';
            } else {
                $customer        = Customer::find($customer);
                $unitRate        = $customer->name ?? '-';
            }
        }

        return $unitRate;
    }
    public static function ProposalCategory($category)
    {
        $categoryArr  = explode(',', $category);
        $categoryRate = 0;
        foreach ($categoryArr as $category) {
            $category    = ProductServiceCategory::find($category);
            $categoryRate        = $category->name ?? '-';
        }

        return $categoryRate;
    }
}
