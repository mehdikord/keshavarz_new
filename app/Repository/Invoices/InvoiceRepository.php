<?php
namespace App\Repository\Invoices;
use App\Interfaces\Invoices\InvoiceInterface;
use App\Models\Invoice;
use App\Models\Search;

class InvoiceRepository implements InvoiceInterface
{
    public function index()
    {
        return response_success(Invoice::with('user')->with('provider_plan')->with('customer_plan')->get());

    }

}
