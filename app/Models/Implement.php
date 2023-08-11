<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Implement extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $appends=['form_ids'];

    public function category()
    {
        return $this->belongsTo(Implement_Category::class,'implement_category_id');

    }

    public function forms()
    {
        return $this->hasMany(Implement_Form::class,'implement_id');
    }

    public function users()
    {
        return $this->hasMany(User_Implement::class,'implement_id');
    }

    public function getFormIdsAttribute()
    {
        return $this->forms()->pluck('id')->toArray();
    }

    public function search()
    {
        return $this->hasMany(Search::class,'implement_id');
    }
}
