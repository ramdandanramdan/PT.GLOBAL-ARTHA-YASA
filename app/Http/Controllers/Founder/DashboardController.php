<?php

namespace App\Http\Controllers\Founder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama Founder dengan data kinerja penjualan dan absensi.
     * Menggunakan data simulasi dari spreadsheet (RECAP.csv dan ABSENSI.csv).
     */
    public function index()
    {
        // ---------------------------------------------------------------------
        // DATA SIMULASI UTAMA (Dari RECAP.csv dan ABSENSI.csv)
        // ---------------------------------------------------------------------

        // Data Penjualan Sales Motoris: [Nama, Total Sales, Target Bulanan, % Pencapaian (desimal)]
        $salesData = [
            ['Yohan Setiyawan', 737, 1820, 0.4049],
            ['Dedy Ainun Mutakkin', 560, 1820, 0.3077],
            ['Zaenal Fanani', 754, 1820, 0.4143],
            ['Fatkhul Khoiri', 698, 1820, 0.3835],
            ['Bayu Firmansyah A', 602, 1820, 0.3308],
            ['Suwanto', 482, 1820, 0.2648],
            ['Agus Sutopo', 698, 1820, 0.3835],
            ['M. Gilang Fajar S', 490, 1820, 0.2692],
        ];

        // Data Absensi Sales Motoris: [Nama, Total Hadir, Sakit, Izin, Alpha, Total Hari Kerja (WD)]
        $absensiData = [
            // H dihitung: WD - (S + I + A)
            ['Yohan Setiyawan', 24, 0, 0, 1, 25],
            ['Dedy Ainun Mutakkin', 25, 0, 0, 0, 25],
            ['Zaenal Fanani', 24, 1, 0, 0, 25],
            ['Fatkhul Khoiri', 24, 0, 1, 0, 25],
            ['Bayu Firmansyah A', 22, 0, 2, 1, 25],
            ['Suwanto', 25, 0, 0, 0, 25],
            ['Agus Sutopo', 25, 0, 0, 0, 25],
            ['M. Gilang Fajar S', 25, 0, 0, 0, 25],
        ];

        // Data Produk Mix (Total Kumulatif per SKU)
        $totalCR = 806;
        $totalJA = 0;
        $totalCC16 = 4157;
        $productMix = [
            ['name' => 'CR', 'value' => $totalCR],
            ['name' => 'JA', 'value' => $totalJA],
            ['name' => 'CC16', 'value' => $totalCC16],
        ];

        // Data Kinerja Mingguan (Untuk Line Chart)
        $weeklyPerformance = [
            'labels' => ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5'],
            'sales' => [452, 1691, 1909, 929, 0],
            'target_weekly' => [3640, 3640, 3640, 3640, 3640]
        ];


        // ---------------------------------------------------------------------
        // PENGHITUNGAN KPI UTAMA & PENGOLAHAN DATA
        // ---------------------------------------------------------------------

        // 1. KPI Pencapaian
        $totalSales = array_sum(array_column($salesData, 1));
        $totalTarget = array_sum(array_column($salesData, 2));
        $achievementPercentage = $totalTarget > 0 ? ($totalSales / $totalTarget) : 0;

        $statusPencapaian = $achievementPercentage >= 0.35 ? 'On-Track' : 'Perlu Perhatian';

        // Sorting dan Top 3 Sales berdasarkan % Pencapaian (Index 3)
        $sortedSales = collect($salesData)
            ->sortByDesc(3) // Sort by % Pencapaian (Index 3)
            ->map(fn($item) => [
                'name' => $item[0],
                'sales' => $item[1],
                'target' => $item[2],
                'achievement' => number_format($item[3] * 100, 1) . '%'
            ])
            ->take(3)
            ->values() // Re-index array
            ->toArray();

        // 2. KPI Presensi
        $totalHadir = array_sum(array_column($absensiData, 1));
        $totalWorkDays = array_sum(array_column($absensiData, 5));
        $avgAttendance = $totalWorkDays > 0 ? ($totalHadir / $totalWorkDays) : 0;

        // Peringatan Absensi (Alpha > 0 atau Izin/Sakit >= 2)
        $attendanceAlerts = collect($absensiData)->filter(function ($item) {
            // Index: 2 = S, 3 = I, 4 = A
            return ($item[2] >= 2) || ($item[3] >= 2) || ($item[4] > 0);
        })->pluck(0)->unique(); // Ambil hanya nama sales yang bermasalah


        // ---------------------------------------------------------------------
        // KIRIM DATA KE VIEW
        // ---------------------------------------------------------------------
        return view('founder.dashboard', [
            // KPI Utama
            'totalSales' => number_format($totalSales),
            'totalTarget' => number_format($totalTarget),
            'achievementPercentage' => number_format($achievementPercentage * 100, 1) . '%',
            'statusPencapaian' => $statusPencapaian,
            'avgAttendance' => number_format($avgAttendance * 100, 1) . '%',

            // Komponen Data
            'topSales' => $sortedSales,
            'attendanceAlerts' => $attendanceAlerts, // List nama sales yang bermasalah absensi
            'productMix' => $productMix,             // Data untuk Donut/Pie Chart
            'weeklyPerformance' => $weeklyPerformance, // Data untuk Line Chart
            'allSalesData' => $salesData,             // Data lengkap sales (jika diperlukan untuk tabel/detail)
        ]);
    }
}