<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User_Land extends Model
{
    use HasFactory;
    protected $table='user_lands';
    protected $guarded=[];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class,'user_land_id');
    }
}
