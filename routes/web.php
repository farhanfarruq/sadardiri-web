<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- PASTIKAN SEMUA CONTROLLER DI-IMPORT DI SINI ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController; // <-- Kemungkinan baris ini yang hilang
use App\Http\Controllers\SavingsTargetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;


Auth::routes();

Route::middleware('auth')->group(function () {
    // Redirect root ke dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Habits
    Route::resource('habits', HabitController::class);
    Route::post('habits/{habit}/toggle', [HabitController::class, 'toggle'])->name('habits.toggle');

    // Transactions
    Route::resource('transactions', TransactionController::class)->except(['transactions.index']);

    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Savings Targets
    Route::resource('savings-targets', SavingsTargetController::class);

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
});
