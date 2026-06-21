<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::prefix('v1')->group(function () {

    // Admin
    Route::post('/create-admin', [AuthController::class, 'createAdmin']);

    // OTP
    Route::post('/send-otp', [AuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

    // Protected route
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('auths', AuthController::class)->names('auth');
    });
});
    

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
