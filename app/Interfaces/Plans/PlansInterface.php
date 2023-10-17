<?php
namespace App\Interfaces\Plans;

interface PlansInterface
{
    //Management
    public function index_customer();
    public function create_customer($request);
    public function update_customer($request,$item);
    public function update_image_customer($request,$item);
    public function delete_customer($item);
    public function activation_customer($item);

    //Management
    public function index_provider();
    public function create_provider($request);
    public function update_provider($request,$item);
    public function update_image_provider($request,$item);
    public function delete_provider($item);
    public function activation_provider($item);

    //Users(Members)
    public function customer_buy_plan($plan);
    public function customer_by_plan_verify();
    public function customer_active();
    public function customer_all();
    public function customer_reserved();
    public function customer_check();
    public function provider_buy_plan($plan);
    public function provider_by_plan_verify();
    public function provider_active();
    public function provider_all();
    public function provider_reserved();
    public function provider_check();

}
