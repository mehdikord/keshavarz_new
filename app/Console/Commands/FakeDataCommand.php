<?php

namespace App\Console\Commands;

use App\Models\Implement_Category;
use App\Models\Invoice;
use App\Models\Provider_Plan;
use App\Models\User;
use App\Models\User_Provider_Plan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FakeDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:data';

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
       //Create users
        for ($i=1;$i<50;$i++){
            $user = User::create([
                'name' => 'کاربر کشاورز '.$i,
                'phone' => rand(10000000000,999999999999),
                'province_id' => 1,
                'city_id' => 1,
                'search_location' => json_encode(location_random(), JSON_THROW_ON_ERROR),
                'search_range' => rand(25,80),
                'bio' => 'شما میتوانید ادوات و خدمات مورد نیاز خود را به سادگی جستجو و دریافت کنید ',
                'is_provider' => true,
            ]);

            //add implements
            foreach (Implement_Category::inRandomOrder()->take(3)->get() as $cat){
                foreach ($cat->implements()->inRandomOrder()->take(3)->get() as $implement){
                    $user->implements()->create([
                        'implement_id' => $implement->id,
                        'price' => 100 * rand(1,8),
                    ]);
                }
            }
            $plan = Provider_Plan::inRandomOrder()->first();
           $invoice =  $user->invoices()->create([
                'price' => $plan->price,
                'is_pay' => true,
                'paid_at' => Carbon::now(),
                'title' => $plan->title,
                'plan_type' => 'provider',
                'plan' => $plan->id,
                'code' => core_random_code(),
            ]);
            $now = Carbon::now();
            $end = $now->addMonths($plan->access);
            User_Provider_Plan::create([
                'user_id' => $user->id,
                'provider_plan_id' => $plan->id,
                'invoice_id' => $invoice->id,
                'title' => $plan->title,
                'access' => $plan->access,
                'start_at' => $now,
                'end_at' => $end,
            ]);
        }
    }
}
