<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\SalesTargetController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('companies', CompanyController::class);
    Route::resource('leads', LeadController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('deals', DealController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('sales-targets', SalesTargetController::class);
    Route::resource('revenues', RevenueController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('activities', ActivityController::class)->only(['index', 'store']);
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/revenue', [ReportController::class, 'revenueReport'])->name('reports.revenue');
    Route::get('/reports/revenue/export', [ReportController::class, 'exportRevenue'])->name('reports.revenue.export');
});

require __DIR__.'/auth.php';
