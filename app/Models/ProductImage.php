<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image'];

    public function getImageUrlAttribute(): string
    {
        return image_url($this->image, 'product');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
