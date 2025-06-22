<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;

Route::get('/products', [ProductController::class, 'index']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);



// Optional: user route if using Sanctum
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/product-ratings', [ProductRatingController::class, 'index']);
Route::get('/product-ratings/{productRating}', [ProductRatingController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products/{productId}/ratings', [ProductRatingController::class, 'store']);
    Route::get('/products/{productId}/ratings', [ProductRatingController::class, 'index']);
});



// Products
Route::prefix('products')->group(function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::post('/', [ProductsController::class, 'store']);
    Route::put('/{product}', [ProductsController::class, 'update']); Route::get('/{product}', [ProductsController::class, 'show']);
    Route::put('/products/{productId}', [ProductsController::class, 'update']);
    Route::delete('/{product}', [ProductsController::class, 'destroy']);
});

// Categories
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{category}', [CategoryController::class, 'show']);
    Route::put('/{category}', [CategoryController::class, 'update']);
    Route::delete('/{category}', [CategoryController::class, 'destroy']);
    Route::get('/{category}/products', [CategoryController::class, 'products']); // optional
});

// Subcategories
Route::prefix('subcategories')->group(function () {
    Route::get('/', [SubcategoryController::class, 'index']);
    Route::post('/', [SubcategoryController::class, 'store']);
    Route::get('/{subcategory}', [SubcategoryController::class, 'show']);
    Route::put('/{subcategory}', [SubcategoryController::class, 'update']);
    Route::delete('/{subcategory}', [SubcategoryController::class, 'destroy']);
    Route::get('/{subcategory}/products', [SubcategoryController::class, 'products']); // optional
});

// routes/api.php
Route::prefix('reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::post('/', [ReviewController::class, 'store']);
    Route::put('/{review}', [ReviewController::class, 'update']);
    Route::delete('/{review}', [ReviewController::class, 'destroy']);
    Route::post('/{review}/reply', [ReviewController::class, 'reply']);
    Route::get('/stats', [ReviewController::class, 'stats']);
});

Route::post('/products/{product}/ratings', [ProductRatingController::class, 'store']);

// REMOVED: Route::get('/users/{user}', [UserController::class, 'show']);
// UserController doesn't exist - commented out to prevent 500 errors

// Wishlist routes
Route::middleware('auth:sanctum')->group(function () {
    // Get wishlist items
    Route::get('/wishlist', [WishlistController::class, 'index']);

    // Add to wishlist
    Route::post('/wishlist/{product}', [WishlistController::class, 'store']);

    // Remove from wishlist
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy']);
});

// Admin deliveries
    Route::get('/admin/deliveries', [AdminDeliveryController::class, 'index']);
    Route::patch('/admin/deliveries/{id}/status', [AdminDeliveryController::class, 'updateStatus']);

// Dashboard API routes
Route::get('/api/dashboard/stats', [DashboardController::class, 'getStats']);
Route::get('/api/dashboard/order-summary', [DashboardController::class, 'getOrderSummary']);
Route::get('/api/dashboard/top-food', [DashboardController::class, 'getTopFood']);
Route::get('/api/dashboard/top-drinks', [DashboardController::class, 'getTopDrinks']);
Route::get('/api/dashboard/debug', [DashboardController::class, 'debugData']);

//card
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'addToCart']);
    Route::get('/items', [CartController::class, 'getCartItems']);
    Route::delete('/remove/{cartId}', [CartController::class, 'removeFromCart']);
    Route::get('/test', [CartController::class, 'test']); // Test endpoint
    Route::put('/update/{cartId}', [CartController::class, 'updateCartItem']);

});
