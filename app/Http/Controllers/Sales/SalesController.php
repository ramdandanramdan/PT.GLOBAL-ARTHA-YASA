<?php

namespace App\Http\Controllers\Sales; // <--- NAMESPACE WAJIB

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    // Dashboard (Tautan Sidebar 1)
    public function dashboard()
    {
        // ... Logika data Dashboard Sales ...
        $data = [
            'penjualan_hari_ini' => 'Rp 15.450.000',
            'stok_tersisa' => 42,
            'total_transaksi' => 18,
        ];
        return view('sales.dashboard', $data);
    }
    
    // Input Transaksi Baru (Aksi Cepat)
    public function createTransaction()
    {
        return view('sales.transaction-create');
    }
    
    // Simpan Transaksi Baru
    public function storeTransaction(Request $request)
    {
        // ... Logika penyimpanan data transaksi ...
        return redirect()->route('sales.transaction.history')->with('success', 'Transaksi berhasil dicatat!');
    }

    // Riwayat Transaksi Sales (Tautan Sidebar 5)
    public function history()
    {
        return view('sales.transaction-history');
    }

    // Metode untuk rute performance/stock/absensi TIDAK perlu di sini
    // karena Anda menggunakan TeamStockController dan PerformanceController.
}