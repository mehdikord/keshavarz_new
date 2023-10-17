<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    use HasFactory;
    protected $table='requests';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function implement(): BelongsTo
    {
        return $this->belongsTo(Implement::class,'implement_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class,'provider');
    }

    public function users(): HasMany
    {
        return $this->hasMany(Request_User::class,'request_id');
    }
}
