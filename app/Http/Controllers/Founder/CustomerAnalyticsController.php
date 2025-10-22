<?php

namespace App\Http\Controllers\Founder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon; // Digunakan untuk simulasi tanggal

class CustomerAnalyticsController extends Controller
{
    /**
     * Menampilkan halaman utama Analitik Pelanggan.
     */
    public function index()
    {
        // Simulasi data KPI (Berdasarkan seeder dummy)
        $kpis = [
            // Simulasikan total 5 pelanggan dari seeder
            'total_customers' => 5,
            // Simulasikan 2 pelanggan baru bulan ini (Budi & Dewi dari seeder)
            'new_customers_monthly' => 2,
            'avg_transaction_value' => 1250000, // Rp 1.25 Juta
        ];

        // Simulasi data Top Customers (Berdasarkan TransactionSeeder)
        // Kita akan menggunakan data dummy yang sudah memiliki total transaksi dan total pengeluaran
        $topCustomers = [
            [
                'name' => 'PT Surya Kencana',
                'email' => 'surya@test.com',
                'transaction_count' => 3,
                'total_spent' => 18500000 // 5jt + 7.5jt + 6jt
            ],
            [
                'name' => 'Toko Makmur Jaya',
                'email' => 'makmur@jaya.co.id',
                'transaction_count' => 2,
                'total_spent' => 4500000 // 2jt + 2.5jt
            ],
            [
                'name' => 'Budi Hartono',
                'email' => 'budi.h@mail.com',
                'transaction_count' => 2,
                'total_spent' => 2250000 // 1jt + 1.25jt
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.l@email.com',
                'transaction_count' => 1,
                'total_spent' => 3000000
            ],
            [
                'name' => 'Ahmad R',
                'email' => 'ahmad.r@gmail.com',
                'transaction_count' => 1,
                'total_spent' => 1500000
            ],
        ];

        // Mengurutkan berdasarkan total_spent untuk simulasi Top Spender
        usort($topCustomers, function ($a, $b) {
            return $b['total_spent'] <=> $a['total_spent'];
        });

        return view('founder.analytics.customer.index', [
            'kpis' => $kpis,
            'topCustomers' => $topCustomers
        ]);
    }
}