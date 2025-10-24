<?php

namespace App\Http\Controllers\Sales; // Namespace Sales

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesPerformanceController extends Controller
{
    // Target & Komisi - Tautan Sidebar 4
    public function index()
    {
        // Logika untuk menampilkan target dan komisi Sales
        return view('sales.performance');
    }
}