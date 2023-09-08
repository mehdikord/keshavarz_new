<?php

namespace App\Http\Controllers\Manage\Invoices;

use App\Http\Controllers\Controller;
use App\Interfaces\Invoices\InvoiceInterface;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected InvoiceInterface $repository;
    public function __construct(InvoiceInterface $invoice)
    {
        $this->repository = $invoice;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function change_pay(Invoice $invoice)
    {
        return $this->repository->change_pay($invoice);
    }
}
