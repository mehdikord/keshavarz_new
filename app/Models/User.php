<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
