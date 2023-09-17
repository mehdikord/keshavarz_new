<?php
namespace App\Repository\Dashboard;


use App\Interfaces\Dashboard\DashboardInterface;
use App\Models\Invoice;
use App\Models\Search;
use App\Models\User;

class DashboardRepository implements DashboardInterface
{

    public function main_info()
    {
        $users = User::count();
        $customers = User::where('is_customer',true)->count();
        $providers = User::where('is_provider',true)->count();
        $requests = Search::count();

        return response_success([
            'users' => $users,
            'customers' => $customers,
            'providers' => $providers,
            'requests' => $requests
        ]);
    }

    public function last_invoices()
    {
        return response_success(
            Invoice::with('user')
                ->with('admin')
                ->with('provider_plan')
                ->with('customer_plan')
                ->orderByDesc('id')
                ->take(5)
                ->get()
        );

    }

    public function last_users()
    {
        return response_success(
            User::with('province')
                ->with('city')
                ->orderByDesc('id')
                ->take(5)
                ->get()
        );

    }

}
