<?php


use App\Exports\LifeCycleSummaryExcelExport;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ReportEmailSettingController;
use App\Http\Controllers\Api\Reports\DepreciationController;
use App\Http\Controllers\Api\Reports\ExportReportController;
use App\Http\Controllers\Api\Reports\InventorySummaryController;
use App\Http\Controllers\Api\Reports\LifeCycleSummaryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return response()->json([
        'message' => 'Asset Manager API is working'
    ]);
});

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
    // EXPORT DEPRECIATION SUMMARY EXCEL 
    Route::get('export-depreciation-summary-xlsx', [ExportReportController::class, 'exportDepreciation']);

    //FOR INVENTORY SUMMARY REPORT
    Route::get('inventory', [InventorySummaryController::class, 'index']);
    // EXPORT INVENTORY SUMMARY EXCEL 
    Route::get('export-inventory-summary-xlsx', [ExportReportController::class, 'exportInventory']);


    //FOR LIFECYCLE SUMMARY REPORT
    Route::get('lifecycle', [LifeCycleSummaryController::class, 'index']);
    // EXPORT LIFECYCLE SUMMARY EXCEL 
    Route::get('export-lifecycle-summary-xlsx', [ExportReportController::class, 'exportLifeCycle']);

    // FOR CATEGORIES
    Route::resource('categories', CategoryController::class);
    // FOR DEPARTMENTS
    Route::resource('departments', DepartmentController::class);
    // FOR REPORT EMAIL SETTINGS
    Route::resource('report-email-setting', ReportEmailSettingController::class);
    // FOR USERS
    Route::resource('users', UserController::class);
});
