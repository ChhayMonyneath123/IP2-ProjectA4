<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'title', 'description', 'price', 'image', 'quantity',
        'category_id', 'cuisine_id', 'beverage_type_id', 
        'subcategory_id', 'delivery_time', 'rating'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cuisine(): BelongsTo
    {
        return $this->belongsTo(Cuisine::class, 'cuisine_id');
    }

    public function beverageType(): BelongsTo
    {
        return $this->belongsTo(Beverage::class, 'beverage_type_id');
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
}