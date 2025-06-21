<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Review;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    // Relationships

    /**
     * Orders placed by the user
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Items in user's shopping cart
     */
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * User's wishlist items
     */
    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wishlists')
                   ->withTimestamps();
    }

    /**
     * Payments made by the user
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * User's favorite products
     */
    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')
                   ->withTimestamps();
    }

    /**
     * User's shipping addresses (if multiple)
     */
    public function addresses()
    {
        return $this->hasMany(User::class);
    }
    public function reviews()
{
    return $this->hasMany(Review::class);
}
}