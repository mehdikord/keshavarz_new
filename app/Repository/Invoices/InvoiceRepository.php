<?php
namespace App\Repository\Invoices;
use App\Interfaces\Invoices\InvoiceInterface;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceRepository implements InvoiceInterface
{
    public function index()
    {
        return response_success(Invoice::with('user')->with('admin')->with('provider_plan')->with('customer_plan')->get());

    }

    public function change_pay($item)
    {
        if ($item->is_pay){
            $item->update([
                'is_pay' => false,
                'paid_at' => null,
            ]);
            $message="فاکتور مورد نظر در وضعیت پرداخت نشده قرار گرفت";
        }else{
            $item->update([
                'is_pay' => true,
                'paid_at' => Carbon::now(),
            ]);
            $message="فاکتور مورد نظر در وضعیت پرداخت شده قرار گرفت";
        }
        return response_success($item,$message);
    }

}
