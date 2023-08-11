<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Customer_Plan extends Model
{
    use HasFactory;
    protected $table='user_customer_plans';
    protected $guarded=[];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
