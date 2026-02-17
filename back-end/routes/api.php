<?php

use App\Http\Controllers\Api\AssetsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);





Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    // FOR DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);


    // FOR ASSETS
    Route::get('/assets', [AssetsController::class, 'index']);
});
