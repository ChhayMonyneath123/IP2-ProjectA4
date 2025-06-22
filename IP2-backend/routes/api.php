<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;

Route::get('/products', [ProductController::class, 'index']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/password/email', [UserController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [UserController::class, 'resetPassword']);
Route::get('/users', [UserController::class, 'index']); // Get all users
Route::get('/users/{id}', [UserController::class, 'show']); // Get user by ID
Route::put('/users/{id}', [UserController::class, 'update']);   // Update user info
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete user
Route::get('/user', [UserController::class, 'profile']);
Route::put('/user/profile', [UserController::class, 'updateProfile']);



// Optional: user route if using Sanctum
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


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
Route::get('/users/{user}', [UserController::class, 'show']);


//wishlist
//  Route::middleware(['auth:sanctum'])->group(function () {
//     // Get all wishlist items for the authenticated user
//     Route::get('wishlist', [WishlistController::class, 'index']);

//     // Add a product to the wishlist
//     Route::post('wishlist', [WishlistController::class, 'store']); // Added a store route

//     // Update a wishlist item (e.g., quantity).
//     // IMPORTANT: This route assumes your WishlistController has an `update` method
//     // and your `wishlists` table has a `quantity` column.
//     Route::put('wishlist/{id}', [WishlistController::class, 'update']);

//     // Remove an item from the wishlist
//     Route::delete('wishlist/{id}', [WishlistController::class, 'destroy']);
// });

Route::middleware('auth:sanctum')->group(function () {
    // Get wishlist items
    Route::get('/wishlist', [WishlistController::class, 'index']);

    // Add to wishlist
    Route::post('/wishlist/{product}', [WishlistController::class, 'store']);

    // Remove from wishlist
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy']);
});
