<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Provider_Plan extends Model
{
    use HasFactory;
    protected $table='user_provider_plans';
    protected $guarded=[];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
