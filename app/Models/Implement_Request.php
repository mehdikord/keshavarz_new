<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Implement_Request extends Model
{
    use HasFactory;
    protected $table='implement_requests';
    protected $guarded=[];

    public function user()
    {
        $this->belongsTo(User::class,'user_id');
    }
}
