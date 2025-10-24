@extends('layouts.sales-navigation') 

@section('header')
    TARGET & KOMISI
@endsection

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2" data-aos="fade-down">
            KINERJA & PENGHITUNGAN KOMISI BULAN INI
        </h1>
        <p class="text-lg text-gray-500 mb-8" data-aos="fade-down" data-aos-delay="50">
            Fokus pada metrik yang paling penting untuk pertumbuhan penghasilan Anda.
        </p>

        {{-- ROW UTAMA: PROGRES VS POTENSI KOMISI --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            
            {{-- KOLOM KIRI (2/3): TARGET UTAMA & PROGRESS --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-2xl border border-gray-100"
                 data-aos="fade-right" data-aos-delay="100">

                <div class="flex items-start justify-between border-b pb-4 mb-4">
                    <h2 class="text-xl font-bold text-blue-700">Pencapaian Volume Penjualan (MTD)</h2>
                    <span class="text-sm font-semibold text-gray-500">Target: Rp 150.000.000</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    
                    {{-- 1. Donut Chart Placeholder (Visualisasi Utama) --}}
                    <div class="col-span-1 flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg">
                        {{-- Placeholder Donut Chart (untuk memberikan visual focus) --}}
                        <div class="w-32 h-32 rounded-full border-[10px] border-gray-200 relative">
                            <div class="absolute inset-0 rounded-full border-[10px] border-blue-600" style="clip-path: polygon(0% 0%, 50% 0%, 50% 100%, 0% 100%); transform: rotate(147.6deg);"></div> 
                            <div class="absolute inset-0 flex items-center justify-center text-4xl font-extrabold text-blue-700">82%</div>
                        </div>
                        <p class="mt-3 text-center text-sm font-semibold text-blue-700">Pencapaian Saat Ini</p>
                    </div>

                    {{-- 2. Metrik Kuantitatif & Gap --}}
                    <div class="col-span-2 space-y-3">
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-lg font-bold text-slate-800">Rp 123.050.000</p>
                            <p class="text-sm text-gray-500">Total Penjualan Kotor Bulan Ini</p>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                            <p class="text-lg font-bold text-red-600">Rp 26.950.000</p>
                            <p class="text-sm text-gray-500">Sisa Target menuju 100%</p>
                        </div>
                        <p class="text-xs text-blue-600 flex items-center pt-2">
                             <i class="fa-solid fa-chart-line mr-1"></i> Perkiraan mencapai 100% dalam 7 hari ke depan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN (1/3): KOMISI & PERINGKAT --}}
            <div class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="200">
                
                {{-- Card Komisi --}}
                <div class="bg-emerald-50 p-6 rounded-xl shadow-lg border-l-4 border-emerald-500">
                    <p class="text-sm font-semibold text-gray-700 uppercase">Potensi Komisi Bruto</p>
                    <p class="text-4xl font-extrabold text-emerald-700 mt-2">Rp 5.250.000</p>
                    <div class="text-xs mt-3 text-gray-500 flex items-center">
                        <i class="fa-solid fa-sack-dollar text-emerald-500 mr-1"></i> Sudah memenuhi Tier 1 (2%).
                    </div>
                </div>

                {{-- Card Peringkat --}}
                <div class="bg-yellow-50 p-6 rounded-xl shadow-lg border-l-4 border-yellow-500">
                    <p class="text-sm font-semibold text-gray-700 uppercase">Peringkat Tim</p>
                    <p class="text-4xl font-extrabold text-yellow-700 mt-2">#3</p>
                    <div class="text-xs mt-3 text-gray-500 flex items-center">
                        <i class="fa-solid fa-trophy text-yellow-500 mr-1"></i> Kompetitor #2 berjarak 5% dari volume Anda.
                    </div>
                </div>

            </div>
        </div>

        {{-- BAGIAN BAWAH: RINCIAN INSENTIF & KUNJUNGAN --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Kolom Kiri: Detil Kriteria Komisi --}}
            <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                <h2 class="text-xl font-bold text-slate-800 border-b pb-3 mb-4">Progres Produk Fokus (High Margin)</h2>
                
                <ul class="divide-y divide-gray-200">
                    {{-- Produk 1 --}}
                    <li class="py-3">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-900">Ultra Milk Powder (1kg)</span>
                            <span class="text-sm font-semibold text-blue-600">280 / 300 Unit</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 93%;"></div>
                        </div>
                        <p class="text-xs text-amber-600 mt-1">Hampir Mencapai Target Bonus Produk!</p>
                    </li>
                    
                    {{-- Produk 2 --}}
                    <li class="py-3">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-900">Vanilla Essence Premium (500ml)</span>
                            <span class="text-sm font-semibold text-red-600">95 / 150 Unit</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 63%;"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Perlu didorong. Target minimal Komisi: 120 unit.</p>
                    </li>
                </ul>
            </div>

            {{-- Kolom Kanan: Kunjungan & Riwayat Payout --}}
            <div class="space-y-6">
                
                {{-- Card Kunjungan --}}
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-3 mb-4">Target Kunjungan Outlet</h2>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-3xl font-extrabold text-slate-900">17 <span class="text-gray-500 text-base font-normal">/ 20</span></span>
                        <span class="text-xs font-medium text-gray-600">Progress Kunjungan Efektif</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-amber-500 h-3 rounded-full" style="width: 85%"></div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2"><i class="fa-solid fa-bolt mr-1 text-amber-500"></i> Segera selesaikan 3 kunjungan lagi untuk insentif kehadiran.</p>
                </div>
                
                {{-- Riwayat Payout --}}
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100" data-aos="fade-up" data-aos-delay="500">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-3 mb-4">Riwayat Pembayaran Komisi</h2>
                    <ul class="space-y-3">
                        <li class="flex justify-between items-center border-l-4 border-emerald-500 pl-3 py-1">
                            <span class="font-bold text-gray-900">Rp 4.500.000</span>
                            <span class="text-xs text-gray-500">05 Jan 2025</span>
                        </li>
                        <li class="flex justify-between items-center border-l-4 border-emerald-500 pl-3 py-1">
                            <span class="font-bold text-gray-900">Rp 3.900.000</span>
                            <span class="text-xs text-gray-500">05 Des 2024</span>
                        </li>
                        <li class="flex justify-between items-center border-l-4 border-blue-500 pl-3 py-1">
                            <span class="font-bold text-blue-600">Rp 5.250.000</span>
                            <span class="text-xs text-blue-600">Status: Menunggu</span>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
        
    </div>
@endsection