<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'sale_price', 'stock',
        'category_id', 'brand_id', 'image', 'status', 'is_featured', 'is_best_seller',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_best_seller' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getEffectivePriceAttribute(): int
    {
        return $this->sale_price ?? $this->price;
    }

    public function getImageUrlAttribute(): string
    {
        return image_url($this->image, 'product');
    }

    /**
     * @return array<int, array{url: string, alt: string}>
     */
    public function getGalleryItemsAttribute(): array
    {
        $items = [];
        $seen = [];

        if ($this->image) {
            $url = $this->image_url;
            $items[] = ['url' => $url, 'alt' => $this->name];
            $seen[$url] = true;
        }

        foreach ($this->images as $galleryImage) {
            $url = $galleryImage->image_url;

            if (isset($seen[$url])) {
                continue;
            }

            $items[] = ['url' => $url, 'alt' => $this->name];
            $seen[$url] = true;
        }

        if ($items === []) {
            $items[] = [
                'url' => image_url(null, 'product'),
                'alt' => $this->name,
            ];
        }

        return $items;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBestSeller($query)
    {
        return $query->where('is_best_seller', true);
    }
}
