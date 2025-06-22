<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;

Route::get("/", function () {
    return view("welcome");
});

Route::get('wishlist', [app\Http\Controllers\WishlistController::class, 'index']);
// Route::get('/product', [ProductController::class, 'index']));
