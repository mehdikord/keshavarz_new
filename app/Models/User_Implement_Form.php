<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Implement_Form extends Model
{
    use HasFactory;
    protected $table='user_implement_forms';
    protected $guarded=[];
    protected $appends=['form_title'];

    public function user_implement()
    {
        return $this->belongsTo(User_Implement::class,'user_implement_id');
    }

    public function form()
    {
        return $this->belongsTo(Form::class,'form_id');
    }

    public function getFormTitleAttribute()
    {
        if ($this->form){
            return $this->form->name;
        }
    }
}
