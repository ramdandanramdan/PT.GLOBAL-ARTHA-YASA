<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\SaleOrder;
use App\Models\Attendance;
use App\Models\StockLog;

class DashboardController extends Controller
{
    /**
     * Menampilkan Dashboard utama Manager.
     * Route: manager.dashboard
     * Fungsi: Monitoring secara real-time.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Logika untuk mengambil data ringkasan real-time:
        // Total Penjualan Hari Ini, Jumlah User Aktif, dll.

        return view('manager.dashboard');
    }

    /**
     * Menampilkan status, penjualan, dan progres target Sales dan SPG.
     * Route: manager.monitoring.sales
     * Fungsi: Monitoring Sales & SPG.
     *
     * @return \Illuminate\View\View
     */
    public function monitorSalesPerformance(): View
    {
        // Ambil data User Sales, SPG, dan SPG Motoris
        $salesPerformance = User::whereHas('role', function ($query) {
            // Memastikan nama role dicari dalam huruf kecil untuk konsistensi
            $query->whereIn('name', ['sales', 'spg', 'spg motoris']);
        })->with(['target', 'attendances'])->get();

        return view('manager.monitoring.sales_performance', compact('salesPerformance'));
    }

    /**
     * Menampilkan daftar dan detail semua Stock Out yang telah dilakukan oleh Sales.
     * Route: manager.monitoring.stock.log
     * Fungsi: Monitoring log distribusi stok.
     *
     * @return \Illuminate\View\View
     */
    public function stockOutLog(): View
    {
        // Logika untuk mengambil riwayat Stock Out (distribusi ke Sales/SPG)
        $stockOutHistory = StockLog::where('type', 'out')->orderBy('created_at', 'desc')->get();

        return view('manager.monitoring.stock_out_log', compact('stockOutHistory'));
    }
}