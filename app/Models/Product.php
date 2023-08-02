<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $guarded=[];

    public function images(): HasMany
    {
        return $this->hasMany(Product_Image::class,'product_id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Product_Comment::class,'product_id');
    }
    public function rates(): HasMany
    {
        return $this->hasMany(Product_Rate::class,'product_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'product_id');
    }
}
