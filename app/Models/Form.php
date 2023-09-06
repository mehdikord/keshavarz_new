<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    use HasFactory;
    protected $table='forms';
    protected $guarded=[];

    public function implements(): HasMany
    {
        return $this->hasMany(Implement_Form::class,'form_id');
    }
}
