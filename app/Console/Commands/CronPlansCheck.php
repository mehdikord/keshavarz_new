<?php

namespace App\Console\Commands;

use App\Models\User_Customer_Plan;
use App\Models\User_Provider_Plan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CronPlansCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \DB::beginTransaction();

        //Customer plans
        $customers = User_Customer_Plan::where('is_active',true)->whereDate('end_at','<=',Carbon::now())->get();
        foreach ($customers as $customer){
            $user = $customer->user;
            //inactive this plan
            $customer->update(['is_active' => false,'is_end' => true]);
            $reserve_plan = $user->customer_plans()->where('reserved',true)->first();
            if ($reserve_plan){
                $reserve_plan->update([
                    'is_active' => true,
                    'reserved' => false,
                    'is_end' => false,
                    'start_at' => Carbon::now(),
                    'end_at' => Carbon::now()->addMonths($reserve_plan->access)
                ]);
            }else{
                $user->update(['is_customer' => false]);
            }

        }

        //Provider plans
        $providers = User_Provider_Plan::where('is_active',true)->whereDate('end_at','<=',Carbon::now())->get();
        foreach ($providers as $provider){
            $user = $provider->user;
            //inactive this plan
            $provider->update(['is_active' => false,'is_end' => true]);
            $reserve_plan = $user->provider_plans()->where('reserved',true)->first();
            if ($reserve_plan){
                $reserve_plan->update([
                    'is_active' => true,
                    'reserved' => false,
                    'is_end' => false,
                    'start_at' => Carbon::now(),
                    'end_at' => Carbon::now()->addMonths($reserve_plan->access)
                ]);
            }else{
                $user->update(['is_provider' => false]);
            }

        }

        \DB::commit();


    }
}
