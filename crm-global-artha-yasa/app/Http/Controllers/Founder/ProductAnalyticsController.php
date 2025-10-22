<?php

namespace App\Http\Controllers\Founder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Product; // Nanti kita aktifkan jika model sudah ada

class ProductAnalyticsController extends Controller
{
    /**
     * Menampilkan halaman utama Analitik Produk.
     */
    public function index()
    {
        // TODO: Ambil data performa produk (top selling, product mix)
        // $productPerformance = Product::withSum('transactions', 'quantity')->orderBy('transactions_sum_quantity', 'desc')->get();

        $productPerformance = []; // Data dummy sementara

        return view('founder.analytics.product.index', [
            'productPerformance' => $productPerformance
        ]);
    }
}