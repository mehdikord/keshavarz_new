<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product_Image extends Model
{
    use HasFactory;
    protected $table='product_images';
    protected $guarded=[];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class,'media_id');
    }
}
