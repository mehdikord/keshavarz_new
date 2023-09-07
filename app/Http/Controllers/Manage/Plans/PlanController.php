<?php

namespace App\Http\Controllers\Manage\Plans;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plans\PlansCreateRequest;
use App\Http\Requests\Plans\PlansUpdateRequest;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Interfaces\Plans\PlansInterface;
use App\Models\Customer_Plan;
use App\Models\Provider_Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected PlansInterface $repository;

    public function __construct(PlansInterface $plans)
    {
        $this->repository = $plans;
    }

    public function provider_index()
    {
        return $this->repository->index_provider();
    }

    public function provider_store(PlansCreateRequest $request)
    {
        return $this->repository->create_provider($request);
    }

    public function provider_update(Provider_Plan $plan,PlansUpdateRequest $request)
    {
        return $this->repository->update_provider($request,$plan);
    }

    public function provider_delete(Provider_Plan $plan)
    {
        return $this->repository->delete_provider($plan);
    }

    public function provider_activation(Provider_Plan $plan)
    {
        return $this->repository->activation_provider($plan);

    }

    public function provider_update_image(Provider_Plan $plan,SingleImageUpdateRequest $request)
    {
        return $this->repository->update_image_provider($request,$plan);
    }



    public function customer_index()
    {
        return $this->repository->index_customer();
    }

    public function customer_store(PlansCreateRequest $request)
    {
        return $this->repository->create_customer($request);
    }

    public function customer_update(Customer_Plan $plan,PlansUpdateRequest $request)
    {
        return $this->repository->update_customer($request,$plan);
    }

    public function customer_delete(Customer_Plan $plan)
    {
        return $this->repository->delete_customer($plan);
    }

    public function customer_activation(Customer_Plan $plan)
    {
        return $this->repository->activation_customer($plan);

    }

    public function customer_update_image(Customer_Plan $plan,SingleImageUpdateRequest $request)
    {
        return $this->repository->update_image_customer($request,$plan);
    }



}
