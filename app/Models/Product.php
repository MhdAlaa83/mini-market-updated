<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','description','category','price','stock','is_active','image_url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (!$product->slug) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(5);
            }
        });

        static::updating(function (Product $product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(5);
            }
        });
    }

    /** Public web URL (real image or placeholder) */
    public function getImageWebUrlAttribute(): string
    {
        return $this->image_url
            ? Storage::url($this->image_url)
            : asset('img/product-placeholder.png');
    }

    /** Bootstrap badge class per category */
    public function getCategoryColorClassAttribute(): string
    {
        return match (strtolower((string)$this->category)) {
            'snacks'        => 'bg-warning text-dark',
            'beverages'     => 'bg-info text-dark',
            'groceries'     => 'bg-success',
            'household'     => 'bg-primary',
            'personal care' => 'bg-danger',
            default         => 'bg-secondary',
        };
    }
}
