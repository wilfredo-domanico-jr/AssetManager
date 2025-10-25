<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//  FOR ASSETS PAGE
Route::get('/assets', [AssetsController::class, 'index'])->name('assets.index');
Route::get('/assets/create', [AssetsController::class, 'create'])->name('assets.create');
Route::get('/assets/{id?}/edit', [AssetsController::class, 'edit'])->name('assets.edit');
// Route::put('/assets/{id}', [AssetsController::class, 'update'])->name('assets.update');

//  FOR REPORTS PAGE

Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
Route::get('/reports/inventory', [ReportsController::class, 'inventory'])->name('reports.inventory');
Route::get('/reports/lifecycle', [ReportsController::class, 'lifecycle'])->name('reports.lifecycle');



require __DIR__.'/auth.php';
