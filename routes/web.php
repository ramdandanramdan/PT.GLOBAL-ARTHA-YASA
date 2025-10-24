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
// OLD: use App\Http\Controllers\SalesController; 
// OLD: use App\Http\Controllers\AbsensiController; // DIHAPUS DARI GLOBAL/SHARED
// OLD: use App\Http\Controllers\TeamStockController; // DIHAPUS DARI GLOBAL/SHARED
// OLD: use App\Http\Controllers\PerformanceController; // DIHAPUS DARI GLOBAL/SHARED

// START NEW: Impor Controller Sales dari folder Sales
use App\Http\Controllers\Sales\SalesController; // <-- INTI SALES
use App\Http\Controllers\Sales\SalesAbsensiController; // <-- ISOLASI 100% SALES
use App\Http\Controllers\Sales\SalesStockController; // <-- ISOLASI 100% SALES
use App\Http\Controllers\Sales\SalesPerformanceController; // <-- ISOLASI 100% SALES

// General/Shared Controllers yang tersisa
use App\Http\Controllers\SpgController; 
use App\Http\Controllers\AbsensiController; // Digunakan oleh SPG di bagian bawah
use App\Http\Controllers\TeamStockController; // Digunakan oleh SPG
use App\Http\Controllers\PerformanceController; // Digunakan oleh SPG
use App\Http\Controllers\SupportController; 
use App\Http\Controllers\SpgActivityController; 
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

// --- 1. ROUTE KHUSUS SALES (TERISOLASI TOTAL) ---
Route::middleware(['auth', EnsureRole::class . ':sales'])
    ->prefix('sales')
    ->name('sales.')
    ->group(function () {
        
        // Tautan 1: Dashboard Sales
        Route::get('/dashboard', [SalesController::class, 'dashboard'])->name('dashboard');
        
        // Tautan 2: Absensi Lokasi 
        // PENGGUNAAN CONTROLLER ISOLASI
        Route::get('/absensi', [SalesAbsensiController::class, 'index'])->name('absensi.index'); 
        
        // Tautan 3: Stok Pribadi 
        // PENGGUNAAN CONTROLLER ISOLASI
        Route::get('/stock', [SalesStockController::class, 'index'])->name('stock');
        
        // Input Transaksi Penjualan Real-time (Aksi Cepat)
        Route::get('/transaction/create', [SalesController::class, 'createTransaction'])->name('transaction.create');
        Route::post('/transaction/store', [SalesController::class, 'storeTransaction'])->name('transaction.store');
        
        // Tautan 4: Target & Komisi 
        // PENGGUNAAN CONTROLLER ISOLASI
        Route::get('/performance', [SalesPerformanceController::class, 'index'])->name('performance');

        // Tautan 5: Riwayat Transaksi Sales
        Route::get('/history', [SalesController::class, 'history'])->name('history');
        Route::get('/transaction/history', [SalesController::class, 'history'])->name('transaction.history'); 
    });

// --- 2. ROUTE KHUSUS SPG (TIDAK BERUBAH) ---
// Note: SPG masih menggunakan AbsensiController, TeamStockController, dan PerformanceController yang lama
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

        // ROUTE BARU: INBOX PESAN (Tautan Sidebar 6)
        Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index'); 

        // Absensi (Jika Anda tetap ingin SPG memiliki Absensi terpisah dari Sales)
        Route::prefix('absensi')->name('absensi.')->group(function () {
             Route::get('/', [AbsensiController::class, 'index'])->name('index');
             Route::post('/check-in', [AbsensiController::class, 'checkIn'])->name('checkIn');
             Route::post('/check-out', [AbsensiController::class, 'checkOut'])->name('checkOut');
        });
    });


require __DIR__ . '/auth.php';