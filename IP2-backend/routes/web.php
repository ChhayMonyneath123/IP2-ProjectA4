<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;

Route::get("/", function () {
    return view("welcome");
});

Route::get("wishlist", [WishlistController::class, "index"]);

Route::get("/simple-test", function() {
    return response()->json(["message" => "Laravel is working!"]);
});

Route::get("/api/dashboard/stats", [DashboardController::class, "getStats"]);
Route::get("/api/dashboard/order-summary", [DashboardController::class, "getOrderSummary"]);
Route::get("/api/dashboard/top-food", [DashboardController::class, "getTopFood"]);
Route::get("/api/dashboard/top-drinks", [DashboardController::class, "getTopDrinks"]);
Route::get("/api/dashboard/debug", [DashboardController::class, "debugData"]);
