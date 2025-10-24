<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    /**
     * Menampilkan halaman Absensi Lokasi.
     */
    public function index(): View
    {
        // View Absensi Lokasi berada di resources/views/absensi/index.blade.php
        return view('spg.absensi.index');
    }

    /**
     * Memproses Check-In Lokasi.
     */
    public function checkIn(Request $request)
    {
        // Tambahkan logika validasi dan penyimpanan Check-In di sini
        // Misalnya: Absensi::create(['user_id' => auth()->id(), 'type' => 'in', 'location' => $request->location]);
        
        return back()->with('success', 'Check-In berhasil dicatat!');
    }

    /**
     * Memproses Check-Out Lokasi.
     */
    public function checkOut(Request $request)
    {
        // Tambahkan logika validasi dan penyimpanan Check-Out di sini
        // Misalnya: Absensi::updateLatest(['user_id' => auth()->id(), 'type' => 'out']);

        return back()->with('success', 'Check-Out berhasil dicatat!');
    }
}