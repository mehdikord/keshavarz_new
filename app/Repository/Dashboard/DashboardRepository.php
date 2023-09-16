<?php
namespace App\Repository\Dashboard;


use App\Interfaces\Dashboard\DashboardInterface;
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

}
