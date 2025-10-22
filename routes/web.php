<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// Asumsi EnsureRole adalah Middleware kustom Anda
use App\Http\Middleware\EnsureRole;

// --- Impor Controller ---

// Founder Controllers (Menggunakan alias untuk menghindari konflik)
use App\Http\Controllers\Founder\DashboardController as FounderDashboardController;
use App\Http\Controllers\Founder\TeamPerformanceController;
use App\Http\Controllers\Founder\CustomerAnalyticsController;
use App\Http\Controllers\Founder\ProductAnalyticsController;

// Manager Controllers (Menggunakan namespace Manager\ yang benar)
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\StockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect halaman utama langsung ke login
Route::get('/', fn() => redirect()->route('login'));

// Dashboard umum (Tanpa middleware 'verified' untuk mengizinkan akses langsung setelah login)
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth']) // 'verified' Dihapus di sini
    ->name('dashboard');

// Grup route untuk user yang sudah login (umum: Profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================================
// === GRUP ROUTE UNTUK ROLE FOUNDER (Otorisasi Ketat) ===
// =========================================================================
Route::middleware(['auth', EnsureRole::class . ':founder']) // 'verified' Dihapus di sini
    ->prefix('founder')
    ->name('founder.')
    ->group(function () {

        // 1. Dashboard Founder
        Route::get('/dashboard', [FounderDashboardController::class, 'index'])->name('dashboard');

        // 2. GRUP ANALITIK & LAPORAN (/founder/analytics/...)
        Route::prefix('analytics')->name('analytics.')->group(function () {
            // Performa Tim (Team Performance)
            Route::get('/team-performance', [TeamPerformanceController::class, 'index'])->name('team.index');
            // Route Model Binding: Mengambil detail performa user
            Route::get('/team-performance/{user}', [TeamPerformanceController::class, 'show'])->name('team.show');

            // Analitik Pelanggan (Customer Analytics)
            Route::get('/customer-analytics', [CustomerAnalyticsController::class, 'index'])->name('customer.index');

            // Analitik Produk (Product Analytics)
            Route::get('/product-analytics', [ProductAnalyticsController::class, 'index'])->name('product.index');
        });

        // Contoh: Route Pengaturan
        // Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    });


// =========================================================================
// === GRUP ROUTE UNTUK ROLE MANAGER (Otorisasi Ketat) ===
// =========================================================================
Route::middleware(['auth', EnsureRole::class . ':manager']) // 'verified' Dihapus di sini
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {

        // 1. Dashboard Manager
        Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

        // 2. Monitoring Tim dan Log (Menggunakan ManagerDashboardController)
        Route::prefix('monitoring')->name('monitoring.')->group(function () {
            // Performa Sales & SPG
            Route::get('/sales', [ManagerDashboardController::class, 'monitorSalesPerformance'])->name('sales');
            // Log Stock Keluar
            Route::get('/stock-log', [ManagerDashboardController::class, 'stockOutLog'])->name('stock.log');
        });

        // 3. Manajemen Stok (Stock In, Stock Out, Inventaris) (Menggunakan StockController)
        Route::controller(StockController::class)->prefix('stock')->name('stock.')->group(function () {
            Route::get('/', 'index')->name('index'); // Inventaris Gudang / Manage Stock
            Route::match(['get', 'post'], '/in', 'stockIn')->name('in'); // Stock In dari Pabrik
            Route::match(['get', 'post'], '/out', 'stockOut')->name('out'); // Stock Out ke Sales
        });
    });

// =========================================================================

require __DIR__ . '/auth.php';