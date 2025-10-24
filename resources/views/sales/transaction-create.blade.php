@extends('layouts.sales-navigation') 

@section('header')
    INPUT TRANSAKSI BARU
@endsection

@section('content')
    <div class="py-6 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Formulir Penjualan Real-time</h1>
        <div class="bg-white p-8 rounded-xl shadow-2xl">
            <form method="POST" action="{{ route('sales.transaction.store') }}">
                @csrf
                <p>Formulir lengkap untuk mencatat penjualan (Outlet, SKU, Quantity, Harga, Bukti Foto).</p>
                <button type="submit" class="mt-6 px-6 py-3 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 transition">Simpan Transaksi</button>
            </form>
        </div>
    </div>
@endsection