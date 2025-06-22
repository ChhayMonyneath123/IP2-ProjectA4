<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;;
use App\Http\Controllers\LoginController;
use Monolog\Registry;

Route::get('/', function () {
    return view('welcome');
});

Route::get('wishlist', [app\Http\Controllers\WishlistController::class, 'index']); 
// Route::get('/product', [ProductController::class, 'index']));
