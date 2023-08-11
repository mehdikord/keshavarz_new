<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table='news';
    protected $guarded=[];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');

    }
}
