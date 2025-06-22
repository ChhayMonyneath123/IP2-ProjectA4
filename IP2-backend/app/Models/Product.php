<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductRating;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Stocking;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory; // Keep or add HasFactory if you're using factories

    protected $primaryKey = 'product_id'; // Specifies the primary key column name

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'quantity',
        'category_id',
        'subcategory_id',
        'estimated_delivery_minutes',
        'status'
    ];

    /**
     * Get the category that owns the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the subcategory that owns the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    /**
     * Get the ratings for the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(ProductRating::class, 'product_id');
    }

    /**
     * Get the order items for the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    /**
     * Get the carts for the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    /**
     * Get the wishlists for the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    /**
     * Get the stocking record associated with the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stocking(): HasOne
    {
        return $this->hasOne(Stocking::class, 'product_id');
    }

    /**
     * Calculate estimated delivery time.
     * Accessor: $product->estimated_delivery_time
     *
     * @return string
     */
    public function getEstimatedDeliveryTimeAttribute()
    {
        return now()->addMinutes($this->estimated_delivery_minutes)->format('H:i');
    }


    /**
     * Calculate average rating for the product.
     * Accessor: $product->average_rating
     *
     * @return float
     */
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    /**
     * Get the count of ratings for the product.
     * Accessor: $product->rating_count
     *
     * @return int
     */
    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}
