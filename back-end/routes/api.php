<?php

use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DepartmentController;
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
    Route::resource('dashboard', DashboardController::class);

    // FOR ASSETS
    Route::resource('assets', AssetController::class);
    // FOR CATEGORIES
    Route::resource('categories', CategoryController::class);
    // FOR DEPARTMENTS
    Route::resource('departments', DepartmentController::class);
});
