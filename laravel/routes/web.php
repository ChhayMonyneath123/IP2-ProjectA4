<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// ✅ Root Route — Redirect based on auth status
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')  // if logged in
        : redirect()->route('login');     // if not logged in
});

// ✅ Dashboard Route (protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ✅ Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');

// ✅ Register Routes (optional)
Route::view('/register', 'register')->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.submit');

// ✅ Logout Route
Route::post('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect()->route('login');
})->name('logout');

Route::get('/welcome', function () {
    return view('welcome');  // if you ever use route('welcome')
})->name('welcome');


// ✅ Auth scaffolding (password reset, etc.)
require __DIR__.'/auth.php';
