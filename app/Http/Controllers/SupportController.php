<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SupportController extends Controller
{
    /**
     * Menampilkan halaman Pusat Bantuan/Support.
     */
    public function index(): View
    {
        // PERBAIKAN: Mengganti nama view agar sesuai dengan lokasi file Anda:
        // resources/views/spg/support/dashboard.blade.php
        return view('spg.support.index');
    }
}