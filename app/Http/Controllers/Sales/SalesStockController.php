<?php

namespace App\Http\Controllers\Sales; // Namespace Sales

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesStockController extends Controller
{
    // Stok Individu - Tautan Sidebar 3
    public function index()
    {
        // Logika untuk menampilkan stok individu Sales
        return view('sales.stock');
    }
}