<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\StockLog;
use App\Models\User;

class StockController extends Controller
{
    /**
     * Menampilkan halaman manajemen inventaris stok keseluruhan (Gudang).
     * Route: manager.stock.index
     * Fungsi: MEMANAGE Stock.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $inventory = Product::with('stockLogs')->get();
        return view('manager.stock.manage', compact('inventory'));
    }

    /**
     * Menampilkan dan memproses Stock In (Barang Masuk dari Pabrik).
     * Route: manager.stock.in
     * Fungsi: System STOCK - IN.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function stockIn(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            // Logika menyimpan Stock In (Validasi, buat StockLog, update Product stock)

            return redirect()->route('manager.stock.index')->with('success', 'Data Stock In berhasil dicatat.');
        }

        // Asumsi: Anda melewatkan daftar produk ke view
        // $products = Product::all();
        // return view('manager.stock.in', compact('products'));

        return view('manager.stock.in');
    }

    /**
     * Menampilkan dan memproses Stock Out (Distribusi ke Sales/SPG).
     * Route: manager.stock.out
     * Fungsi: System STOCK - OUT.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function stockOut(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            // Logika menyimpan Stock Out (Validasi, buat StockLog, kurangi Product stock, update stok user)

            return redirect()->route('manager.stock.index')->with('success', 'Data Stock Out berhasil didistribusikan.');
        }

        // Asumsi: Anda melewatkan daftar produk dan sales ke view
        // $products = Product::all();
        // $salesUsers = User::whereHas('role', fn($q) => $q->whereIn('name', ['sales', 'spg', 'spg motoris']))->get();
        // return view('manager.stock.out', compact('products', 'salesUsers'));

        return view('manager.stock.out');
    }
}