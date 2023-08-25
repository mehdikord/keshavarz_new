<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class,'province_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class,'user_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'user_id');
    }

    public function address(): HasMany
    {
        return $this->hasMany(User_Address::class,'user_id');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(User_Favorite::class,'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Product_Comment::class,'user_id');
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Product_Rate::class,'user_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(User_Notification::class,'user_id');
    }


    public function gallery()
    {
        return $this->hasMany(User_Gallery::class,'user_id');
    }


    public function customer_plans()
    {
        return $this->hasMany(User_Customer_Plan::class,'user_id');
    }

    public function provider_plans()
    {
        return $this->hasMany(User_Provider_Plan::class,'user_id');
    }
    public function customer_plan_active_check()
    {
        return $this->customer_plans()->where('is_active',true)->exists();
    }
    public function customer_plan_active()
    {
        return $this->customer_plans()->where('is_active',true)->first();
    }

    public function customer_plan_active_info()
    {
        $total='';
        $left='';


        return array('total' => $total,'left' => $left);
    }

    public function provider_plan_active_check()
    {
        return $this->provider_plans()->where('is_active',true)->exists();
    }

    public function provider_plan_active()
    {
        return $this->provider_plans()->where('is_active',true)->first();
    }

    public function implements()
    {
        return $this->hasMany(User_Implement::class,'user_id');
    }

    public function days()
    {
        return $this->hasMany(User_Day::class,'user_id');
    }

    public function referrals()
    {
        return $this->hasMany(__CLASS__,'referral_by');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
