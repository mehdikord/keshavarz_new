<?php

namespace App\Http\Controllers\Manage\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\DashboardInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected DashboardInterface $repository;
    public function __construct(DashboardInterface $dashboard)
    {
        $this->repository = $dashboard;
    }

    public function main_info()
    {
        return $this->repository->main_info();
    }
}
