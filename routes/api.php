<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Vendor\CustomerVendorApplyController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(CustomerVendorApplyController::class)->prefix('customer')->group(function () {
        Route::post('/vendor/apply', 'apply')->middleware('role:customer');
    });
});
