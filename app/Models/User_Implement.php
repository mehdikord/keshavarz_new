<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Implement extends Model
{
    use HasFactory;
    protected $table='user_implements';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function implement()
    {
       return $this->belongsTo(Implement::class,'implement_id');
    }

    public function forms()
    {
        return $this->hasMany(User_Implement_Form::class,'user_implement_id');
    }
}
