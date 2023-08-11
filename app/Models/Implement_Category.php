<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Implement_Category extends Model
{
    use HasFactory;
    protected $table='implement_categories';
    protected $guarded=[];

    public function implements()
    {
        return $this->hasMany(Implement::class,'implement_category_id');
    }
}
