<?php
use App\Http\Controllers\ClothesController;
use Illuminate\Support\Facades\Route;

Route::post('/clothes', [ClothesController::class, 'store']);
