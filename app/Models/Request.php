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

    public const STATUS_PENDING = 'pending';
    public const STATUS_WORKING = 'working';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_DONE = 'done';

    protected $appends=[
        'search_result_decode','dates_decode'
    ];

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
        return $this->belongsTo(User::class,'provider_id');
    }

    public function land()
    {
        return $this->belongsTo(User_Land::class,'user_land_id');
    }
    public function users(): HasMany
    {
        return $this->hasMany(Request_User::class,'request_id');
    }

    public function getSearchResultDecodeAttribute()
    {
        $data=[];
        if ($this->search_result){
            $data = json_decode($this->search_result, false, 512, JSON_THROW_ON_ERROR);
        }
        return $data;
    }

    public function getDatesDecodeAttribute()
    {
        $data=[];
        if ($this->dates){
            $data = json_decode($this->dates, false, 512, JSON_THROW_ON_ERROR);
        }
        return $data;
    }
}
