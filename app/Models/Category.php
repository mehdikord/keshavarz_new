<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $guarded=[];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__,'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__,'parent_id');
    }
}
