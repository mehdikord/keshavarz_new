<?php
namespace App\Interfaces\Invoices;

interface InvoiceInterface
{

    public function index();

    public function change_pay($item);


}
