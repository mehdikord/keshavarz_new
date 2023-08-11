<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;
    protected $table='search';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function implement()
    {
        return $this->belongsTo(Implement::class,'implement_id');
    }
}
