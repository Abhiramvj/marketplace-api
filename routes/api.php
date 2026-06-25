<?php

use App\Http\Controllers\Api\Auth\AuthController;

use App\Http\Controllers\Api\Customer\CartController;
use App\Http\Controllers\Api\Customer\CheckoutController;
use App\Http\Controllers\Api\Customer\CustomerVendorApplyController;
use App\Http\Controllers\Api\Customer\OrderController;
use App\Http\Controllers\Api\Customer\ProductController;
use App\Http\Controllers\Api\Customer\StoreController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/{product}', [ProductController::class, 'show']);


Route::get('/stores', [StoreController::class, 'index']);
Route::get('/stores/{slug}', [StoreController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(CustomerVendorApplyController::class)->prefix('customer/vendor')->group(function () {
        Route::post('/apply', 'apply');
    });

    Route::middleware('role:customer')->controller(CartController::class)->prefix('customer/cart')->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::put('/update', 'update');
        Route::delete('/remove', 'destroy');
    });

    Route::middleware('role:customer')->controller(CheckoutController::class)->prefix('customer/checkout')->group(function () {
        Route::post('/', 'store');
    });

    Route::middleware('role:customer')->controller(OrderController::class)->prefix('customer/orders')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });
});
