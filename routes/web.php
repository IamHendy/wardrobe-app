<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClothesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authenticated routes (Require user to be logged in)
Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Clothes routes (protected by auth middleware)
    Route::get('/clothes', [ClothesController::class, 'index'])->name('clothes.index');
    Route::post('/clothes', [ClothesController::class, 'store'])->name('clothes.store');
    Route::put('/clothes/{id}', [ClothesController::class, 'update'])->name('clothes.update');
    Route::delete('/clothes/{id}', [ClothesController::class, 'destroy'])->name('clothes.destroy');
});

// Guest-only routes (Only accessible if not logged in)
Route::middleware('guest')->group(function () {
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Ensure authentication status is available in Inertia.js frontend
Route::get('/user', function () {
    return auth()->user();
})->middleware('auth')->name('user');
