<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\CustomerController;
use App\Http\Controllers\V1\ProductController;

Route::prefix('v1')->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::middleware('auth:sanctum')->group(function() {
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('products', ProductController::class);
    });

});
