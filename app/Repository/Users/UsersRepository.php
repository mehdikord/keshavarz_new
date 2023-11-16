<?php
namespace App\Repository\Users;



use App\Interfaces\Users\UsersInterface;
use App\Models\Admin;
use App\Models\Customer_Plan;
use App\Models\Provider_Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersRepository implements UsersInterface
{
    //Managers
    public function managers_index()
    {
        return response_success(Admin::OrderbyDesc('id')->get());
    }

    public function managers_store($request)
    {
        $item = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => 1,
            'password' => Hash::make($request->password),
        ]);
        return response_success($item);
    }

    public function managers_update($request,$item)
    {
        $item->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return response_success($item);
    }

    public function managers_delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    //Members
    public function members_index()
    {
        return response_success(User::OrderbyDesc('id')->withCount('referrals')->with('lands')->get());
    }

    public function members_store($request)
    {
        $item = User::create([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'national_code' => $request->national_code,
            'phone' => $request->phone,
            'is_active' => true,

        ]);
        $item->withCount('referrals');
        return response_success($item);
    }

    public function members_update($request,$item)
    {
        $item->update([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'national_code' => $request->national_code,
            'phone' => $request->phone,
        ]);
        return response_success($item);
    }

    public function members_delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    public function members_activation($item)
    {
        $item->update(['is_active' => !$item->is_active]);
        return response_success(true);

    }

    public function members_show($item)
    {
        $item->load('province');
        $item->load('city');
        $item->loadCount('referrals');
        return response_success($item);
    }

    public function members_invoices($item)
    {
        return response_success($item->invoices()->with('admin')->with('provider_plan')->with('customer_plan')->get());
    }

    public function members_invoices_create($request,$item)
    {
        $is_pay = $request->pay;
        if ($request->plan_type === 'customer') {
            $plan = Customer_Plan::find($request->plan_id);
            if ($plan){
                $paid_at=null;
                if ($plan->is_free){
                    $is_pay = 1;
                    $paid_at=Carbon::now();

                }
                $invoice = $item->invoices()->create([
                    'admin_id' => auth('admin')->id(),
                    'title' => "اشتراک خدمات گیرنده : ".$plan->title,
                    'price' => $plan->price,
                    'is_free' => $plan->is_free,
                    'is_pay' => $is_pay,
                    'paid_at' => $paid_at,
                    'method' => 'offline',
                    'plan' => $plan->id,
                    'plan_type' => 'customer'
                ]);
                $invoice->update(['code' => core_random_code($invoice->id)]);
                if ($is_pay){
                    $this->members_new_customer_plan($plan,$invoice);
                }
                return response_success([],"اشتراک مورد نظر باموفقیت اضافه شد");
            }

            return response_custom_error('اشتراک انتخاب شده یافت نشد');
        }

        if ($request->plan_type === 'provider') {
            $plan = Provider_Plan::find($request->plan_id);
            if ($plan){
                $paid_at=null;
                if ($plan->is_free){
                    $is_pay = 1;
                    $paid_at=Carbon::now();
                }
                $invoice = $item->invoices()->create([
                    'admin_id' => auth('admin')->id(),
                    'title' => "اشتراک خدمات دهنده : ".$plan->title,
                    'price' => $plan->price,
                    'is_free' => $plan->is_free,
                    'is_pay' => $is_pay,
                    'paid_at' => $paid_at,
                    'method' => 'offline',
                    'plan' => $plan->id,
                    'plan_type' => 'provider'
                ]);
                $invoice->update(['code' => core_random_code($invoice->id)]);
                if ($is_pay){
                    $this->members_new_provider_plan($plan,$invoice);
                }
                return response_success([],"اشتراک مورد نظر باموفقیت اضافه شد");
            }

            return response_custom_error('اشتراک انتخاب شده یافت نشد');
        }

        return response_custom_error('اشتراک انتخاب شده یافت نشد');

    }

    public function members_active_provider($item)
    {
        $data = $item->provider_plan_active();
        if ($data){
            $data->load('invoice');

        }
        return response_success($data);
    }

    public function members_active_customer($item)
    {
        $data = $item->customer_plan_active();
        if ($data){
            $data->load('invoice');
        }
        return response_success($data);

    }

    private function members_new_customer_plan($plan,$invoice){
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

    private function members_new_provider_plan($plan,$invoice){
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
