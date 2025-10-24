@extends('layouts.sales-navigation') 

@section('header')
    STOK INDIVIDU
@endsection

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-8" data-aos="fade-down">INVENTARIS STOK PRODUK PRIBADI</h1>

        {{-- RINGKASAN STOK GLOBAL (Top Metrics Cards) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            {{-- Card 1: Total Unit Stok --}}
            <div class="bg-white p-6 rounded-xl shadow-2xl border-l-4 border-indigo-600 transition duration-300 hover:shadow-indigo-300/50"
                 data-aos="fade-up" data-aos-delay="100"> 
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Unit Tersedia</p>
                <p class="text-4xl font-extrabold text-slate-900 mt-2">1,245</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-layer-group text-indigo-500 mr-1"></i>
                    <span>Dari 4 SKU unik</span>
                </div>
            </div>

            {{-- Card 2: Nilai Total Stok (Est.) --}}
            <div class="bg-white p-6 rounded-xl shadow-2xl border-l-4 border-emerald-600 transition duration-300 hover:shadow-emerald-300/50"
                 data-aos="fade-up" data-aos-delay="200">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Nilai Stok (Est. Jual)</p>
                <p class="text-4xl font-extrabold text-slate-900 mt-2">Rp 45.3 Juta</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-sack-dollar text-emerald-500 mr-1"></i>
                    <span>Potensi pendapatan kotor</span>
                </div>
            </div>

            {{-- Card 3: Peringatan Stok Rendah --}}
            <div class="bg-white p-6 rounded-xl shadow-2xl border-l-4 border-amber-500 transition duration-300 hover:shadow-amber-300/50"
                 data-aos="fade-up" data-aos-delay="300">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Status Penting</p>
                <p class="text-4xl font-extrabold text-red-600 mt-2">2 Produk</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 mr-1"></i>
                    <span>Di bawah batas pemesanan ulang (Re-order Level)</span>
                </div>
            </div>
        </div>

        {{-- TABEL DETIL STOK (Interaktif & Modern) --}}
        <div class="bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden"
             data-aos="fade-up" data-aos-delay="400">
            
            <div class="p-6 border-b flex justify-between items-center">
                <h2 class="text-xl font-bold text-slate-800">Detil Setiap Produk (SKU)</h2>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    <i class="fa-solid fa-arrows-rotate mr-1"></i> Sinkronisasi Stok
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Produk
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stok Saat Ini
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nilai Jual/Unit
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Stok
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi Cepat
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        {{-- Dummy Data Row 1 --}}
                        <tr class="hover:bg-indigo-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Premium Coffee Blend (250g)</div>
                                        <div class="text-xs text-gray-500">SKU: PCMB250</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-bold text-slate-900">450 Unit</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp 55.000
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                    Aman
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 transition">Input Penjualan</a>
                            </td>
                        </tr>

                        {{-- Dummy Data Row 2 (Stok Rendah) --}}
                        <tr class="hover:bg-red-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Vanilla Syrup - Bulk (1L)</div>
                                        <div class="text-xs text-gray-500">SKU: VNSYP001</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-bold text-red-600">35 Unit</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp 120.000
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Kritis!
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-amber-600 hover:text-amber-900 transition">Ajukan Restok</a>
                            </td>
                        </tr>

                        {{-- Dummy Data Row 3 --}}
                        <tr class="hover:bg-indigo-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Milk Powder Full Cream (1kg)</div>
                                        <div class="text-xs text-gray-500">SKU: MPFC100</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-bold text-slate-900">600 Unit</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp 85.000
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                    Aman
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 transition">Input Penjualan</a>
                            </td>
                        </tr>

                        {{-- Dummy Data Row 4 (Warning) --}}
                        <tr class="hover:bg-yellow-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Chocolate Sauce Topping (500ml)</div>
                                        <div class="text-xs text-gray-500">SKU: CHCS500</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-bold text-amber-600">160 Unit</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp 65.000
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                    Perlu Perhatian
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 transition">Input Penjualan</a>
                            </td>
                        </tr>

                        {{-- Baris footer untuk total --}}
                        <tr class="bg-gray-100 font-bold border-t-2 border-gray-300">
                            <td class="px-6 py-4 text-sm text-gray-900" colspan="1">TOTAL INVENTARIS</td>
                            <td class="px-6 py-4 text-lg text-slate-900">1,245 Unit</td>
                            <td class="px-6 py-4 text-lg text-slate-900" colspan="3">Rp 45.3 Juta (Est. Nilai Jual)</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 text-xs text-gray-500 border-t">
                <i class="fa-solid fa-circle-info mr-1"></i> Data diupdate real-time. Hubungi Gudang untuk pengajuan *restock* produk Kritis.
            </div>

        </div>
    </div>
@endsection