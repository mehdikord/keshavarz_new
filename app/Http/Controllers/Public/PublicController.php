<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\Faqs\FaqsInterface;
use App\Interfaces\Plans\PlansInterface;
use App\Models\Province;
use App\Models\Slider;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected PlansInterface $plan_repository;
    protected FaqsInterface $faq_repository;

    public function __construct(PlansInterface $plans,FaqsInterface $faqs)
    {
        $this->plan_repository = $plans;
        $this->faq_repository = $faqs;
    }

    public function provinces()
    {
        return response_success(Province::with('cities')->get());
    }

    public function slider()
    {
        return response_success(Slider::where('is_active',true)->orderBy('num','ASC')->get());
    }

    public function plans_customer()
    {
        return $this->plan_repository->index_customer();
    }

    public function plans_provider()
    {
        return $this->plan_repository->index_provider();
    }

    public function faqs()
    {
        return $this->faq_repository->index();
    }


}
