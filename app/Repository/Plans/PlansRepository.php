<?php
namespace App\Repository\Plans;


use App\Interfaces\Plans\PlansInterface;
use App\Models\Customer_Plan;
use App\Models\Invoice;
use App\Models\Provider_Plan;
use App\Services\Zarinpal\ZarinpalService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlansRepository implements PlansInterface
{

    public ZarinpalService $zarinpal_service;

    public function __construct()
    {
        $this->zarinpal_service = new ZarinpalService();
    }

    public function index_customer()
    {
        return Customer_Plan::OrderByDesc('id')->withCount('invoices')->get();
    }

    public function index_provider()
    {
        return Provider_Plan::OrderByDesc('id')->withCount('invoices')->get();

    }


    public function customer_buy_plan($plan)
    {
        DB::beginTransaction();
        //create invoice
        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'title' => "اشتراک خدمات گیرنده: ".$plan->title,
            'method' => 'online',
            'plan' =>$plan->id,
            'gateway'=>"Zarinpal",
            'plan_type' => 'customer'
        ]);

        $invoice->update(['code' => core_random_code($invoice->id,13)]);
        if ($plan->is_free){
            //check exists
            if (auth()->user()->customer_plans()->where('customer_plan_id',$plan->id)->exists()){
                return response_custom_error('این اشتراک قبلا برای شما فعال شده');
            }
            //Selected plan is Free
            $invoice->update(['is_pay' => true,'is_free' => true,'paid_at' => Carbon::now()]);
            $this->new_customer_plan($plan,$invoice);
            DB::commit();
            return response_success('','اشتراک مورد نظر باموفقیت برای شما فعال شد',201);

        }else{
            //start payment request
            if (!empty($plan->sale)){
                $amount = $plan->sale;
            }else{
                $amount = $plan->price;
            }
            $callback = url('api/users/callbacks/plans/payments/customer');
            $invoice->update(['price' => $amount]);
            $pay = $this->zarinpal_service->
            request(
                $amount,
                $invoice->code,
                $callback,
                auth('users')->user()->phone,
                auth('users')->user()->email,
                $invoice->title,
            );

            if ($pay && $pay['Status'] == 100){
                $invoice->update(['gateway_id' => $pay['Authority'] ]);
                DB::commit();
                return response_success($pay['StartPay'],'لینک انتقال به درگاه پرداخت ');
            }
            DB::rollBack();
            return response_custom_error('مشکلی در فراید خرید بوجود آمده است. لطفا با مدیریت تماس بگیرید ');
        }

    }
    public function customer_by_plan_verify()
    {
        //get token from url params
        $authority = request('Authority');
        //get invoice
        $invoice = Invoice::where('gateway_id',$authority)->first();
        if (!$invoice){
            DB::rollBack();
            return redirect("plans/pay/result?type=failed");
        }

        $result = $this->zarinpal_service->verify($invoice->price,$authority);

        DB::beginTransaction();
        if(isset($result['Status']) && $result['Status']==100){
            //check ref_id
            if ($result['Node'] != 'sandbox' && Invoice::where('ref_id',$result['RefID'])->exists()){
                DB::rollBack();
                return redirect('plans/pay/result?type=failed');
            }
            $invoice->update([
                'is_pay' =>true,
                'paid_at'=>Carbon::now(),
                'ref_id' => $result['RefID'],
            ]);
            $plan = Customer_Plan::find($invoice->plan);
            if ($plan){
                $this->new_customer_plan($plan,$invoice);
            }
            DB::commit();
            return redirect("plans/pay/result?type=success");
        }
        return redirect("plans/pay/result?type=failed");

    }

    public function customer_active()
    {

        return auth()->user()->customer_plan_active();
    }
    public function customer_all()
    {

        return auth()->user()->customer_plans()->with('invoice')->get();
    }
    public function customer_reserved()
    {

        return auth()->user()->customer_plans()->where('reserved',true)->with('invoice')->get();
    }
    public function provider_buy_plan($plan)
    {
        DB::beginTransaction();
        //create invoice
        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'title' => "اشتراک خدمات دهنده: ".$plan->title,
            'method' => 'online',
            'plan' =>$plan->id,
            'gateway'=>"Zarinpal",
            'plan_type' => 'provider'
        ]);

        $invoice->update(['code' => core_random_code($invoice->id)]);
        if ($plan->is_free){
            //Selected plan is Free
            if (auth()->user()->provider_plans()->where('provider_plan_id',$plan->id)->exists()){
                return response_custom_error('این اشتراک قبلا برای شما فعال شده');
            }

            $invoice->update(['is_pay' => true,'is_free' => true,'paid_at' => Carbon::now()]);
            $this->new_provider_plan($plan,$invoice);
            DB::commit();
            return response_success('','اشتراک مورد نظر باموفقیت برای شما فعال شد',201);

        }else{

            //start payment request
            if (!empty($plan->sale)){
                $amount = $plan->sale;
            }else{
                $amount = $plan->price;
            }
            $callback = url('api/users/callbacks/plans/payments/provider');
            $invoice->update(['price' => $amount]);
            $pay = $this->zarinpal_service->
            request(
                $amount,
                $invoice->code,
                $callback,
                auth('users')->user()->phone,
                auth('users')->user()->email,
                $invoice->title,
            );
            if ($pay && $pay['Status'] == 100){
                $invoice->update(['gateway_id' => $pay['Authority'] ]);
                DB::commit();
                return response_success($pay['StartPay'],'لینک انتقال به درگاه پرداخت ');
            }else{
                DB::rollBack();
                response_custom_error('مشکلی در فراید خرید بوجود آمده است. لطفا با مدیریت تماس بگیرید ');
            }
        }

    }
    public function provider_by_plan_verify()
    {
        //get token from url params
        $authority = request('Authority');
        //get invoice
        $invoice = Invoice::where('gateway_id',$authority)->first();
        if (!$invoice){
            DB::rollBack();
            return redirect("plans/pay/result?type=failed");
        }

        $result = $this->zarinpal_service->verify($invoice->price,$authority);

        DB::beginTransaction();
        if(isset($result['Status']) && $result['Status']==100){
            //check ref_id
            if ($result['Node'] != 'sandbox' && Invoice::where('ref_id',$result['RefID'])->exists()){
                DB::rollBack();
                return redirect("plans/pay/result?type=failed");
            }
            $invoice->update([
                'is_pay' =>true,
                'paid_at'=>Carbon::now(),
                'ref_id' => $result['RefID'],
            ]);
            $plan = Provider_Plan::find($invoice->plan);
            if ($plan){
                $this->new_provider_plan($plan,$invoice);
            }
            DB::commit();
            return redirect("plans/pay/result?type=success");
        }
        return redirect("plans/pay/result?type=failed");

    }

    public function provider_active()
    {

        return auth()->user()->provider_plan_active();
    }

    public function provider_all()
    {

        return auth()->user()->provider_plans()->with('invoice')->get();
    }
    public function provider_reserved()
    {

        return auth()->user()->provider_plans()->where('reserved',true)->with('invoice')->get();
    }

    private function new_customer_plan($plan,$invoice){
        //create base data for user plan access

        $new_plan = $invoice->user->customer_plans()->create([
            'invoice_id' => $invoice->id,
            'customer_plan_id'=>$plan->id,
            'title'=>$plan->title,
            'access' => $plan->access,
        ]);

        //check old active plan
        if ($invoice->user->customer_plan_active_check()){
            //reserve the plan
            $update = ['reserved' => true];
        }else{
            $now = Carbon::now();
            $end = $now->addMonths($plan->access);
            $update=['is_active' => true,'start_at' => Carbon::now(),'end_at' => $end];
            $invoice->user->update(['is_customer' => 1]);
        }
        $new_plan->update($update);
    }
    private function new_provider_plan($plan,$invoice){
        //create base data for user plan access

        $new_plan = $invoice->user->provider_plans()->create([
            'invoice_id' => $invoice->id,
            'provider_plan_id'=>$plan->id,
            'title'=>$plan->title,
            'access' => $plan->access,
        ]);

        //check old active plan
        if ($invoice->user->provider_plan_active_check()){
            //reserve the plan
            $update = ['reserved' => true];
        }else{
            $now = Carbon::now();
            $end = $now->addMonths($plan->access);
            $update=['is_active' => true,'start_at' => Carbon::now(),'end_at' => $end];
            $invoice->user->update(['is_provider' => 1]);

        }
        $new_plan->update($update);
    }

}
