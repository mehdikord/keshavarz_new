<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Implement_Form extends Model
{
    use HasFactory;
    protected $table='implement_forms';
    protected $guarded=[];

    public function form()
    {
        return $this->belongsTo(Form::class,'form_id');
    }

    public function implement()
    {
        return $this->belongsTo(Implement::class,'implement_id');
    }
}
