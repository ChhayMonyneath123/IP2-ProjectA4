<?php

// app/Http/Controllers/WishlistController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return auth()->user()->wishlistProducts()
            ->select('id', 'name', 'price', 'image_url')
            ->get();
    }

    public function store(Product $product)
    {
        auth()->user()->wishlistProducts()->syncWithoutDetaching([$product->id]);
        return response()->json(['success' => true]);
    }

    public function destroy(Product $product)
    {
        auth()->user()->wishlistProducts()->detach($product->id);
        return response()->json(['success' => true]);
    }
}