<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProposalExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = [];

        if(!\Auth::guard('customer')->check())
        {
            $data = Proposal::where('created_by' , \Auth::user()->id)->get();
        }
        else{
            $data = Proposal::where('customer_id', \Auth::guard('customer')->check())->where('status', '!=', '0')->get();
        } 

        foreach ($data as $k => $Proposal) {
            $customer  = Proposal::customers($Proposal->customer_id);
            $category  = Proposal::ProposalCategory($Proposal->category_id);
            if($Proposal->status == 0)
            {
                $status = 'Draft';
            }
            elseif($Proposal->status == 1)
            {
                $status = 'Open';
            }
            elseif($Proposal->status == 2)
            {
                $status = 'Accepted';
            }
            elseif($Proposal->status == 3)
            {
                $status = 'Declined';
            }
            elseif($Proposal->status == 4)
            {
                $status = 'Close';
            }
            
            unset($Proposal->id,$Proposal->discount_apply, $Proposal->converted_invoice_id, $Proposal->is_convert,$Proposal->converted_retainer_id, $Proposal->created_by, $Proposal->updated_at, $Proposal->created_at);
            if(!\Auth::guard('customer')->check())
            {
                $data[$k]["proposal_id"] = \Auth::user()->proposalNumberFormat($Proposal->proposal_id);
            }
            else{
                $data[$k]["proposal_id"]   = Customer::proposalNumberFormat($Proposal->proposal_id);
            }            $data[$k]["customer_id"]        = $customer;
            $data[$k]["category_id"]   = $category;
            $data[$k]["status"]          = $status;
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            "Proposal_Id",
            "Customer_name",
            "issue Date",
            "Send Date",
            "Category Id",
            "status"
        ];
    }
}
