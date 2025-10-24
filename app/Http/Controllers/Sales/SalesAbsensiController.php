<?php

namespace App\Http\Controllers\Sales; // Namespace Sales

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesAbsensiController extends Controller
{
    // Absensi Lokasi - Tautan Sidebar 2
    public function index()
    {
        // Logika untuk menampilkan halaman absensi khusus Sales
        return view('sales.absensi');
    }
    
    // Anda mungkin perlu menambahkan checkIn dan checkOut jika rutenya membutuhkannya
}