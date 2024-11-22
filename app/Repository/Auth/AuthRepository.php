<?php
namespace App\Repository\Auth;

use App\Interfaces\Auth\AuthInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface
{
    public function manage_login($request)
    {

        $credentials = request(['email', 'password']);
        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function manage_logout()
    {

    }

    public function user_login($request)
    {
        if (helpers_check_auth_sms_time($request->phone)){
            return response_custom_error("پیام ارسال شده قبلی تا دو دقیقه معتبر است!");
        }
        $user = User::where('phone',$request->phone)->first();
        if (empty($user)){

            $referral_by = null;
            if ($request->filled('referral')){
                $referral = User::where('phone',$request->referral)->first();
                $referral_by = $referral->id;
            }
            $user = User::create([
                'name' => 'کاربر کشاورز',
                'phone' => $request->phone,
                'referral_by' => $referral_by
            ]);
            $now = Carbon::now();
            $end = $now->addMonths(12);
            $user->customer_plans()->create([
                'title' => 'اشتراک خوش آمد گویی یکسانه',
                'access' => 12,
                'is_active' => true,
                'start_at' => Carbon::now(),
                'end_at' => $end
            ]);
            $user->update(['is_customer' => 1]);
        }
        helpers_auth_make($request->phone);
        return response_success(['phone' => $request->phone],'پیام تائید هویت باموفقیت ارسال شد');
    }

    public function user_check($request)
    {
        if (helpers_check_auth_code($request->phone,$request->code)){
            if (!helpers_check_auth_sms_time($request->phone)){
                return response_custom_error("مدت زمان ارسال پیام به پایان رسیده است");
            }
            $user = User::where('phone',$request->phone)->select(['id','name','email','phone','profile','is_active'])->first();
            $token =  Auth::guard('users')->login($user);
            helper_remove_auth_code($request->phone);
            return response_success(
                [
                    'user' => $user,
                    'token' => $token,
                    'token_type'=> 'bearer'
                ]
            );

        }
        return response_custom_error("کد ارسال شده نادرست است");
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth('admin')->user(),
        ]);
    }

}
