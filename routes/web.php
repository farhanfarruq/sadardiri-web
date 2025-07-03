<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SavingsTargetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;

Auth::routes();

Route::middleware('auth')->group(function () {
    // Redirect root ke dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // Dashboard pakai HomeController
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Habits
    Route::resource('habits', HabitController::class);
    Route::post('habits/{habit}/toggle', [HabitController::class, 'toggle'])->name('habits.toggle');

    // Transactions
    Route::resource('transactions', TransactionController::class);
    Route::get('transactions/filter/{type}', [TransactionController::class, 'filter'])->name('transactions.filter');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Savings Targets
    Route::resource('savings-targets', SavingsTargetController::class);

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
});
