<?php

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Exports\InventorySummaryCsvExport;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ReportEmailSettingController;

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//  FOR ASSETS PAGE
Route::resource('assets', AssetController::class);

//  FOR REPORTS PAGE

Route::get('/reporting', [ReportsController::class, 'index'])->name('reporting.index');
Route::get('/reporting/inventory', [ReportsController::class, 'inventory'])->name('reporting.inventory');
Route::get('/reporting/lifecycle', [ReportsController::class, 'lifecycle'])->name('reporting.lifecycle');


// EXPORT CSV FUNCTIONS

Route::get('/export-inventory-summary-csv', function () {
    return Excel::download(new InventorySummaryCsvExport, 'inventory-summary.csv');
});

/* =================================== ADMIN SETTINGS =================================== */

// CATEGORY MAINTENANCE

Route::resource('/admin/category', CategoryController::class);
Route::resource('/admin/department', DepartmentController::class);


Route::get('/admin/report-email-setting', [ReportEmailSettingController::class, 'index'])->name('admin.report-email-setting.index');
Route::post('/admin/report-email-setting/update', [ReportEmailSettingController::class, 'update'])->name('admin.report-email-setting.update');

require __DIR__ . '/auth.php';
