<?php

namespace App\Http\Controllers\Founder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TeamPerformanceController extends Controller
{
    /**
     * Menampilkan halaman utama Performa Tim.
     * Menggunakan data dummy sementara untuk memfasilitasi layouting (Total Sales, Top Performer).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // =========================================================================
        // PENTING: MENGGUNAKAN DUMMY DATA SEMENTARA
        // Hapus blok ini dan uncomment logika database asli ketika siap.
        // =========================================================================

        $allSalesData = new Collection([
            (object) [
                'id' => 1,
                'name' => 'Yohan Setiyawan',
                'email' => 'yohan@gay.id',
                'total_sales' => 737,
                'target' => 1820,
                'is_active' => true,
            ],
            (object) [
                'id' => 2,
                'name' => 'Dedy Amun',
                'email' => 'dedy@gay.id',
                'total_sales' => 0,
                'target' => 1820,
                'is_active' => true,
            ],
            (object) [
                'id' => 3,
                'name' => 'Rina Sari',
                'email' => 'rina@gay.id',
                'total_sales' => 900,
                'target' => 1800,
                'is_active' => false,
            ],
        ]);
        // =========================================================================

        return view('founder.analytics.team.index', [
            'allSalesData' => $allSalesData
        ]);
    }


    /**
     * Menampilkan halaman detail untuk satu sales person.
     * Menerapkan validasi role yang lebih aman.
     *
     * @param  \App\Models\User  $user 
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        // 1. Validasi role: Menggunakan kolom 'role' (string) di tabel users.
        // Ini memperbaiki BadMethodCallException.
        $allowedSalesRoles = ['sales', 'spg motoris'];
        $allowedAdminRole = 'founder';

        // Cek apakah user yang akan dilihat adalah sales yang diizinkan ATAU founder (jika founder mencoba melihat data sales).
        $isAllowedSales = in_array(strtolower($user->role), $allowedSalesRoles);
        $isCurrentUserFounder = strtolower(auth()->user()->role) === $allowedAdminRole;

        // Asumsi: Jika user yang sedang dilihat BUKAN sales, dan user yang login BUKAN founder, maka blokir.
        // ATAU, jika user yang dilihat adalah FOUNDER, dan founder mencoba melihat detail ID 1 (dirinya sendiri), biarkan.
        if (!$isAllowedSales && strtolower($user->role) !== $allowedAdminRole) {
            abort(404, 'Data Sales tidak ditemukan atau tidak diizinkan.');
        }


        // 2. Siapkan variabel waktu
        $salesPerson = $user;
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // 3. Muat data yang DIBUTUHKAN OLEH VIEW (Menggunakan relasi database ASLI)

        // 3a. Ambil Target (properti: $salesPerson->target)
        // Gunakan null coalescing operator (??) untuk nilai default jika target tidak ditemukan.
        $salesPerson->target = $salesPerson->targets()
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first()->target_units ?? 0;

        // 3b. Hitung Total Penjualan (properti: $salesPerson->total_sales)
        $salesPerson->total_sales = $salesPerson->saleOrders()
            ->whereMonth('order_date', $currentMonth)
            ->whereYear('order_date', $currentYear)
            ->with('products')
            ->get()
            ->reduce(fn($carry, $order) => $carry + $order->products->sum('pivot.quantity'), 0);

        // 3c. Ambil Riwayat Absensi (properti: $salesPerson->attendance_log)
        $salesPerson->attendance_log = $salesPerson->attendances()
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->orderBy('date', 'desc')
            ->get();

        // 3d. Ambil Transaksi Terakhir (properti: $salesPerson->recent_transactions)
        $salesPerson->recent_transactions = $salesPerson->saleOrders()
            ->whereMonth('order_date', $currentMonth)
            ->whereYear('order_date', $currentYear)
            ->with('customer')
            ->orderBy('order_date', 'desc')
            ->take(5)
            ->get();

        // 4. Kirim data ke view. 
        return view('founder.analytics.team.show', [
            'salesPerson' => $salesPerson
        ]);
    }
}