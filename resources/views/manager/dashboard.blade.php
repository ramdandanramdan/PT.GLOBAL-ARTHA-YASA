@extends('layouts.app')

{{-- Mendefinisikan Judul Halaman yang akan masuk ke slot 'header' di layout utama --}}
@section('header', 'Dashboard Manager')

@section('content')

    <div class="container-fluid">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Monitoring Real-Time</h1>
        <p class="text-gray-600 mb-6">Pantau kinerja tim dan status stok secara langsung untuk koordinasi yang efisien.</p>

        {{-- KARTU RINGKASAN KINERJA UTAMA --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            {{-- Total Sales Tim Hari Ini --}}
            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-indigo-600">
                <p class="text-sm text-gray-500 uppercase font-semibold">Total Sales Hari Ini</p>
                <h3 class="text-3xl font-extrabold text-gray-900 mt-1">Rp XX,XXX,XXX</h3>
            </div>

            {{-- Progres Target Tim (Total) --}}
            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-green-600">
                <p class="text-sm text-gray-500 uppercase font-semibold">Progres Target Bulan Ini</p>
                <h3 class="text-3xl font-extrabold text-gray-900 mt-1">XX%</h3>
            </div>

            {{-- Stok Produk Utama Tersedia --}}
            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-yellow-600">
                <p class="text-sm text-gray-500 uppercase font-semibold">Peringatan Stok Rendah</p>
                <h3 class="text-3xl font-extrabold text-gray-900 mt-1">3 Produk</h3>
            </div>

            {{-- Sales Aktif Hari Ini --}}
            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-blue-600">
                <p class="text-sm text-gray-500 uppercase font-semibold">User Aktif (Presensi)</p>
                <h3 class="text-3xl font-extrabold text-gray-900 mt-1">X / Y</h3>
            </div>
        </div>

        {{-- QUICK LINKS/GRAFIK --}}
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Aktivitas dan Kinerja Terbaru</h3>
            {{-- Di sini bisa ditambahkan grafik, misalnya grafik penjualan mingguan --}}
            <a href="{{ route('manager.monitoring.sales') }}"
                class="text-indigo-600 hover:text-indigo-800 font-medium">Lihat Detail Performa Tim &rarr;</a>
        </div>
    </div>

@endsection