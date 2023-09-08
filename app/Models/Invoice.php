<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;
    protected $table='invoices';
    protected $guarded=[];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'invoice_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function provider_plan(): HasOne
    {
        return $this->hasOne(User_Provider_Plan::class,'invoice_id');
    }

    public function customer_plan(): HasOne
    {
        return $this->hasOne(User_Customer_Plan::class,'invoice_id');
    }
}
