<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Day extends Model
{
    use HasFactory;
    protected $table='user_days';
    protected $guarded=[];
}
