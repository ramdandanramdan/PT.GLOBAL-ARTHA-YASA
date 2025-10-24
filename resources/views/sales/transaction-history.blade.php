@extends('layouts.sales-navigation') 

@section('header')
    RIWAYAT TRANSAKSI
@endsection

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2" data-aos="fade-down">
            RIWAYAT TRANSAKSI PENJUALAN
        </h1>
        <p class="text-lg text-gray-500 mb-8" data-aos="fade-down" data-aos-delay="50">
            Semua catatan penjualan yang telah Anda masukkan dan disetujui.
        </p>

        {{-- RINGKASAN METRICS (MTD: Month-to-Date) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            {{-- Card 1: Total Transaksi --}}
            <div class="bg-white p-6 rounded-xl shadow-xl border-l-4 border-indigo-600 transition duration-300 hover:shadow-indigo-300/50"
                 data-aos="fade-up" data-aos-delay="100"> 
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Transaksi (MTD)</p>
                <p class="text-4xl font-extrabold text-slate-900 mt-2">124</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-receipt text-indigo-500 mr-1"></i>
                    <span>Dibandingkan 110 bulan lalu.</span>
                </div>
            </div>

            {{-- Card 2: Total Nilai Penjualan --}}
            <div class="bg-white p-6 rounded-xl shadow-xl border-l-4 border-emerald-600 transition duration-300 hover:shadow-emerald-300/50"
                 data-aos="fade-up" data-aos-delay="200">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Volume (MTD)</p>
                <p class="text-4xl font-extrabold text-slate-900 mt-2">Rp 123.0 Jt</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-money-bill-wave text-emerald-500 mr-1"></i>
                    <span>Rata-rata Rp 992rb/transaksi.</span>
                </div>
            </div>

            {{-- Card 3: Outlet Baru --}}
            <div class="bg-white p-6 rounded-xl shadow-xl border-l-4 border-amber-500 transition duration-300 hover:shadow-amber-300/50"
                 data-aos="fade-up" data-aos-delay="300">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Outlet Baru Dikunjungi (MTD)</p>
                <p class="text-4xl font-extrabold text-amber-600 mt-2">15</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-store text-amber-500 mr-1"></i>
                    <span>Tingkat konversi 65% dari kunjungan.</span>
                </div>
            </div>
        </div>

        {{-- FILTER DAN TABEL RIWAYAT --}}
        <div class="bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden"
             data-aos="fade-up" data-aos-delay="400">
            
            {{-- Filter dan Pencarian --}}
            <div class="p-6 border-b flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0">
                <h2 class="text-xl font-bold text-slate-800">Daftar Transaksi Terbaru</h2>
                <div class="flex space-x-3 w-full md:w-auto">
                    <input type="text" placeholder="Cari ID Transaksi/Outlet..." 
                           class="form-input rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64">
                    <select class="form-select rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        <option>Filter Bulan Ini</option>
                        <option>Filter Bulan Lalu</option>
                        <option>Filter Tahun Ini</option>
                    </select>
                </div>
            </div>

            {{-- Tabel Riwayat Transaksi --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Outlet
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal & Waktu
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Nilai
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Detil
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        {{-- Dummy Data Row 1 (Approved) --}}
                        <tr class="hover:bg-emerald-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">TRX-20250112-005</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Toko Ritel Makmur</div>
                                <div class="text-xs text-gray-500">Klien Lama</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                22 Okt 2025, 14:30
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-slate-900">
                                Rp 2.500.000
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                    Disetujui
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-800 transition">Lihat Faktur</a>
                            </td>
                        </tr>

                        {{-- Dummy Data Row 2 (Pending) --}}
                        <tr class="hover:bg-amber-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">TRX-20250112-006</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Kedai Kopi Hits (Baru)</div>
                                <div class="text-xs text-amber-600">Klien Baru</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                23 Okt 2025, 09:15
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-slate-900">
                                Rp 850.000
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                    Menunggu
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-800 transition">Lihat Faktur</a>
                            </td>
                        </tr>

                        {{-- Dummy Data Row 3 (Approved Small) --}}
                        <tr class="hover:bg-indigo-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">TRX-20250112-004</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Warung Kelontong Maju</div>
                                <div class="text-xs text-gray-500">Klien Lama</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                22 Okt 2025, 10:00
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-slate-900">
                                Rp 350.000
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                    Disetujui
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-800 transition">Lihat Faktur</a>
                            </td>
                        </tr>
                        
                        {{-- Baris footer untuk ringkasan --}}
                        <tr class="bg-gray-100 font-bold border-t-2 border-gray-300">
                            <td class="px-6 py-4 text-sm text-gray-900" colspan="3">Total Transaksi Bulan Ini</td>
                            <td class="px-6 py-4 text-xl text-slate-900" colspan="3">Rp 123.050.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            {{-- Paginasi Placeholder --}}
            <div class="p-4 border-t flex justify-end">
                <div class="flex space-x-1">
                    <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">Sebelumnya</button>
                    <button class="px-3 py-1 text-sm rounded-lg bg-indigo-600 text-white">1</button>
                    <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">2</button>
                    <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">Selanjutnya</button>
                </div>
            </div>
            
        </div>
    </div>
@endsection