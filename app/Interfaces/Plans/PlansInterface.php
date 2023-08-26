<?php
namespace App\Interfaces\Plans;

interface PlansInterface
{
    public function index_customer();
    public function index_provider();


    public function customer_buy_plan($plan);

    public function customer_by_plan_verify();

    public function customer_active();
    public function customer_all();
    public function customer_reserved();

    public function provider_buy_plan($plan);

    public function provider_by_plan_verify();
    public function provider_active();
    public function provider_all();
    public function provider_reserved();

}
