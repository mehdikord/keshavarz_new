<?php
namespace App\Interfaces\Dashboard;

interface DashboardInterface
{

    public function main_info();
    public function last_invoices();
    public function last_users();

    public function payments();
}
