<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product_Attribute extends Model
{
    use HasFactory;
    protected $table='product_attributes';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class,'attribute_id');
    }
}
