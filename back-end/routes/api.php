<?php

use App\Exports\DepreciationSummaryCsvExport;
use App\Exports\InventorySummaryCsvExport;
use App\Exports\LifeCycleSummaryCsvExport;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ReportEmailSettingController;
use App\Http\Controllers\Api\Reports\DepreciationController;
use App\Http\Controllers\Api\Reports\InventorySummaryController;
use App\Http\Controllers\Api\Reports\LifeCycleSummaryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;


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
    //FOR DEPRECIATION REPORT
    Route::get('depreciation', [DepreciationController::class, 'index']);
    // EXPORT DEPRECIATION SUMMARY CSV 
    Route::get('export-depreciation-summary-csv', function () {
        return Excel::download(new DepreciationSummaryCsvExport, 'depreciation-summary.csv');
    });
    //FOR INVENTORY SUMMARY REPORT
    Route::get('inventory', [InventorySummaryController::class, 'index']);
    // EXPORT INVENTORY SUMMARY CSV 
    Route::get('export-inventory-summary-csv', function () {
        return Excel::download(new InventorySummaryCsvExport, 'inventory-summary.csv');
    });
    //FOR LIFECYCLE SUMMARY REPORT
    Route::get('lifecycle', [LifeCycleSummaryController::class, 'index']);
    // EXPORT LIFECYCLE SUMMARY CSV 
    Route::get('export-lifecycle-summary-csv', function () {
        return Excel::download(new LifeCycleSummaryCsvExport, 'lifecycle-summary.csv');
    });

    // FOR CATEGORIES
    Route::resource('categories', CategoryController::class);
    // FOR DEPARTMENTS
    Route::resource('departments', DepartmentController::class);
    // FOR REPORT EMAIL SETTINGS
    Route::resource('report-email-setting', ReportEmailSettingController::class);
    // FOR USERS
    Route::resource('users', UserController::class);
});
