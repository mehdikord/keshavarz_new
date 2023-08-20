<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\Plans\PlansInterface;
use App\Models\Province;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected PlansInterface $plan_repository;

    public function __construct(PlansInterface $plans)
    {
        $this->plan_repository = $plans;
    }

    public function provinces()
    {
        return response_success(Province::with('cities')->get());
    }


    public function plans_customer()
    {
        return response_success($this->plan_repository->index_customer());
    }

    public function plans_provider()
    {
        return response_success($this->plan_repository->index_provider());
    }


}
