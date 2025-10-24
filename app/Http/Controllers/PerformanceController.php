<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Import untuk return type View
// use App\Models\Performance; // Uncomment baris ini jika Anda memiliki model Performance

class PerformanceController extends Controller
{
    /**
     * Menampilkan halaman Target & Komisi untuk SPG.
     */
    public function showSpgPerformance(): View
    {
        // Logika untuk mengambil data target, komisi, dan performa SPG.
        // Data ini akan dikirim ke view spg/performance/index.blade.php
        $performanceData = [
            'target' => 100, 
            'current_sales' => 55,
            'achieved_percentage' => '55%',
            'commission_estimate' => 'Rp 550.000',
            // ... data lain
        ];

        // Pastikan Anda memiliki view ini di resources/views/spg/performance/index.blade.php
        return view('spg.performance.index', compact('performanceData'));
    }

    /**
     * Menampilkan halaman Target & Komisi untuk Sales.
     */
    public function showSalesPerformance(): View
    {
        // Logika untuk Sales
        // Pastikan Anda memiliki view ini di resources/views/sales/performance/index.blade.php
        return view('sales.performance.index');
    }
}
