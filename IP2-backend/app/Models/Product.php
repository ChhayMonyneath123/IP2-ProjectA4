<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'title', 
        'description', 
        'price', 
        'image', 
        'quantity',
        'category_id', 
        'subcategory_id', 
        'estimated_delivery_minutes'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ProductRating::class, 'product_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function stocking(): HasOne
    {
        return $this->hasOne(Stocking::class, 'product_id');
    }

    /**
     * Calculate estimated delivery time
     */
    public function getEstimatedDeliveryTimeAttribute()
{
    return now()->addMinutes($this->estimated_delivery_minutes)->format('H:i');
}


    /**
     * Calculate average rating
     */
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    /**
     * Get rating count
     */
    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
}