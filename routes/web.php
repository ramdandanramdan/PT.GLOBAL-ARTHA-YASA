<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureRole;

// --- Impor Controller ---
// Founder Controllers
use App\Http\Controllers\Founder\DashboardController as FounderDashboardController;
use App\Http\Controllers\Founder\TeamPerformanceController;
use App\Http\Controllers\Founder\CustomerAnalyticsController;
use App\Http\Controllers\Founder\ProductAnalyticsController; 

// Manager Controllers
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\StockController as ManagerStockController;
use App\Http\Controllers\Manager\MonitoringController;

// General/Shared Controllers (Sales/SPG/Umum)
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SpgController; 
use App\Http\Controllers\AbsensiController; 
use App\Http\Controllers\TeamStockController; 
use App\Http\Controllers\PerformanceController; 
use App\Http\Controllers\SupportController; 
use App\Http\Controllers\SpgActivityController; 
// *** IMPOR BARU: Tambahkan InboxController di sini ***
use App\Http\Controllers\InboxController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route web untuk aplikasi Anda didaftarkan di sini.
*/

// Redirect halaman utama langsung ke login
Route::get('/', fn() => redirect()->route('login'));

// Dashboard umum (Untuk user yang baru login dan belum diarahkan)
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth'])->name('dashboard');

// =========================================================================
// === GRUP ROUTE UMUM (Semua yang Terautentikasi) ===
// =========================================================================
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Pusat Bantuan / Support (Tautan Sidebar 6)
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
});

// =========================================================================
// === GRUP ROUTE UNTUK ROLE FOUNDER (Otorisasi Ketat) ===
// =========================================================================
Route::middleware(['auth', EnsureRole::class . ':founder'])
    ->prefix('founder')
    ->name('founder.')
    ->group(function () {

        // 1. Dashboard Founder
        Route::get('/dashboard', [FounderDashboardController::class, 'index'])->name('dashboard');

        // 2. GRUP ANALITIK & LAPORAN (/founder/analytics/...)
        Route::prefix('analytics')->name('analytics.')->group(function () {
            // Performa Tim (Team Performance)
            Route::get('/team-performance', [TeamPerformanceController::class, 'index'])->name('team.index');
            Route::get('/team-performance/{user}', [TeamPerformanceController::class, 'show'])->name('team.show');

            // Analitik Pelanggan (Customer Analytics)
            Route::get('/customer-analytics', [CustomerAnalyticsController::class, 'index'])->name('customer.index');

            // Analitik Produk (Product Analytics)
            Route::get('/product-analytics', [ProductAnalyticsController::class, 'index'])->name('product.index');
        });
    });


// =========================================================================
// === GRUP ROUTE UNTUK ROLE MANAGER (Otorisasi Ketat) ===
// =========================================================================
Route::middleware(['auth', EnsureRole::class . ':manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {

        // 1. Dashboard Manager
        Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

        // 2. Monitoring Tim dan Log 
        Route::prefix('monitoring')->name('monitoring.')->group(function () {
            // Performa Sales & SPG
            Route::get('/sales', [ManagerDashboardController::class, 'monitorSalesPerformance'])->name('sales');
            // Log Stock Keluar
            Route::get('/stock-log', [ManagerDashboardController::class, 'stockOutLog'])->name('stock.log');
        });

        // 3. Manajemen Stok (Stock In, Stock Out, Inventaris)
        Route::controller(ManagerStockController::class)->prefix('stock')->name('stock.')->group(function () {
            Route::get('/', 'index')->name('index'); // Inventaris Gudang / Manage Stock
            Route::match(['get', 'post'], '/in', 'stockIn')->name('in'); // Stock In dari Pabrik
            Route::match(['get', 'post'], '/out', 'stockOut')->name('out'); // Stock Out ke Sales
        });
    });


// =========================================================================
// === GRUP ROUTE UNTUK ROLE SALES & SPG ===
// =========================================================================

// --- 1. ROUTE KHUSUS SALES ---
Route::middleware(['auth', EnsureRole::class . ':sales'])
    ->prefix('sales')
    ->name('sales.')
    ->group(function () {
        // Dashboard Sales (Tautan Sidebar 1)
        Route::get('/dashboard', [SalesController::class, 'dashboard'])->name('dashboard');
        
        // Stok Pribadi (Tautan Sidebar 3)
        Route::get('/stock', [TeamStockController::class, 'showSalesStock'])->name('stock');
        
        // Input Transaksi Penjualan Real-time (Aksi Cepat)
        Route::get('/transaction/create', [SalesController::class, 'createTransaction'])->name('transaction.create');
        Route::post('/transaction/store', [SalesController::class, 'storeTransaction'])->name('transaction.store');
        
        // Target & Komisi (Tautan Sidebar 4)
        Route::get('/performance', [PerformanceController::class, 'showSalesPerformance'])->name('performance');

        // Riwayat Transaksi Sales (Tautan Sidebar 5)
        Route::get('/history', [SalesController::class, 'history'])->name('history');
        Route::get('/transaction/history', [SalesController::class, 'history'])->name('transaction.history'); 
    });

// --- 2. ROUTE KHUSUS SPG (TERMASUK ABSENSI & INBOX) ---
Route::middleware(['auth', EnsureRole::class . ':spg'])
    ->prefix('spg')
    ->name('spg.')
    ->group(function () {
        
        // Dashboard (Tautan Sidebar 1)
        Route::get('/dashboard', [SpgController::class, 'index'])->name('dashboard'); 
        
        // Stok Individu (Tautan Sidebar 3)
        Route::get('/stock', [TeamStockController::class, 'showSpgStock'])->name('stock');
        
        // Input Aktivitas Promosi (Aksi Cepat)
        Route::get('/activity/create', [SpgController::class, 'createActivity'])->name('activity.create');
        Route::post('/activity/store', [SpgController::class, 'storeActivity'])->name('activity.store');

        // Target & Komisi (Tautan Sidebar 4)
        Route::get('/performance', [PerformanceController::class, 'showSpgPerformance'])->name('performance');

        // Riwayat Aktivitas/Promosi (Tautan Sidebar 5)
        Route::get('/history', [SpgController::class, 'history'])->name('history');
        Route::get('/activity/history', [SpgController::class, 'history'])->name('activity.history'); 

        // *** ROUTE BARU: INBOX PESAN (Tautan Sidebar 6) ***
        Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index'); 

        // --- 3. ROUTE ABSENSI (SEKARANG KHUSUS SPG) ---
        // Route ini akan menjadi /spg/absensi
        Route::prefix('absensi')->name('absensi.')->group(function () {
            // Absensi Lokasi - Tautan Sidebar (Tautan Sidebar 2)
            Route::get('/', [AbsensiController::class, 'index'])->name('index');
            
            // Aksi Form
            Route::post('/check-in', [AbsensiController::class, 'checkIn'])->name('checkIn');
            Route::post('/check-out', [AbsensiController::class, 'checkOut'])->name('checkOut');
        });
    });


require __DIR__ . '/auth.php';