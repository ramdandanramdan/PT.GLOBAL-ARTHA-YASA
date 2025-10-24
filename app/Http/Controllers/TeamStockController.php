<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamStockController extends Controller
{
    /**
     * Menampilkan halaman Stok Individu untuk SPG.
     * Dipanggil oleh route spg.stock (URL: /spg/stock).
     */
    public function showSpgStock(): View
    {
        // Logika untuk mengambil data stok SPG
        
        // Pastikan Anda membuat file: resources/views/spg/stock/index.blade.php
        return view('spg.stock.index'); 
    }

    /**
     * Menampilkan halaman Stok Individu untuk Sales.
     * Dipanggil oleh route sales.stock (URL: /sales/stock).
     */
    public function showSalesStock(): View
    {
        // Logika untuk mengambil data stok Sales
        
        // Pastikan Anda membuat file: resources/views/sales/stock/index.blade.php
        return view('sales.stock.index');
    }
}