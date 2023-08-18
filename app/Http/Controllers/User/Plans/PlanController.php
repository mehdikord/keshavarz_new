<?php

namespace App\Http\Controllers\User\Plans;

use App\Http\Controllers\Controller;
use App\Interfaces\Plans\PlansInterface;
use App\Models\Customer_Plan;
use App\Models\Provider_Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected PlansInterface $repository;
    public function __construct(PlansInterface $planRepository)
    {
        $this->repository = $planRepository;
    }

    //Customer Plans
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function customer_buy(Customer_Plan $plan)
    {
        if (!$plan->is_active){
            return response_custom_error('selected plan not active');
        }
        return $this->repository->customer_buy_plan($plan);

    }

    public function customer_by_verify()
    {
        return $this->repository->customer_by_plan_verify();
    }

    public function customer_active()
    {
        return response_success($this->repository->customer_active());
    }

    public function customer_all()
    {
        return response_success($this->repository->customer_all());
    }



    //Provider Plans
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function provider_buy(Provider_Plan $plan)
    {
        if (!$plan->is_active){
            return response_custom_error('selected plan not active');
        }
        return $this->repository->provider_buy_plan($plan);
    }

    public function provider_by_verify()
    {
        return $this->repository->provider_by_plan_verify();
    }

    public function provider_active()
    {
        return response_success($this->repository->provider_active());

    }

    public function provider_all()
    {
        return response_success($this->repository->provider_all());

    }

}
