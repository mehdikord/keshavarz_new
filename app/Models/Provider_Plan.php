<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider_Plan extends Model
{
    use HasFactory;
    protected $table='provider_plans';
    protected $guarded=[];

    public function invoices()
    {
        return $this->hasMany(Invoice::class,'plan')->where('plan_type','provider');
    }

}
