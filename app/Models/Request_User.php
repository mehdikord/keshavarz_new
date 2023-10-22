<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request_User extends Model
{
    use HasFactory;
    protected $table='request_users';
    protected $guarded=[];
    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPT = 'accept';
    public const STATUS_REJECT = 'reject';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function user_implement(): BelongsTo
    {
        return $this->belongsTo(User_Implement::class,'user_implement_id');
    }
}
