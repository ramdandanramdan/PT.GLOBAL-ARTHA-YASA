{{-- resources/views/sales/absensi.blade.php --}}

@extends('layouts.sales-navigation')

@section('header')
    ABSENSI LOKASI & JADWAL
@endsection

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Kolom Kiri: Peta dan Form Check-In/Check-Out (Dibuat Statis) --}}
            <div class="lg:col-span-2 space-y-6" data-aos="fade-right" data-aos-delay="100">
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-2 mb-4">Lokasi Saat Ini & Absensi</h2>
                    
                    {{-- Placeholder Peta (Gunakan Leaflet/Google Maps API) --}}
                    <div class="h-80 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 font-semibold border border-dashed mb-4">
                        [AREA MAPS: Tampilkan Peta Interaktif & Pin Lokasi Sales]
                    </div>
                    
                    <div class="mb-6 text-sm font-medium p-3 bg-indigo-50 rounded-lg border border-indigo-200">
                        <p class="text-slate-600">Status GPS: <span class="text-emerald-600 font-bold">Aktif & Akurat</span></p>
                        <p class="text-slate-600">Koordinat Anda: <span class="text-indigo-600">Lat: -6.212, Lon: 106.822 (radius 15m)</span></p>
                    </div>

                    {{-- TOMBOL STATIS (Tidak menggunakan action route apapun) --}}
                    <div class="space-y-3">
                        <button 
                            class="w-full py-3 px-4 text-lg font-semibold rounded-lg text-white bg-blue-600 transition flex justify-center items-center gap-2 shadow-lg opacity-50 cursor-not-allowed"
                            disabled>
                            <i class="fa-solid fa-clock-rotate-left"></i> CHECK-IN HARI INI
                        </button>
                        
                        <button 
                            class="w-full py-3 px-4 text-lg font-semibold rounded-lg text-white bg-red-500 transition flex justify-center items-center gap-2 shadow-lg opacity-50 cursor-not-allowed"
                            disabled>
                            <i class="fa-solid fa-clock"></i> CHECK-OUT (Tersedia setelah Check-In)
                        </button>
                    </div>
                    <p class="mt-3 text-center text-xs text-gray-500">Aksi Absensi dinonaktifkan sementara di mode statis ini.</p>
                </div>
            </div>

            {{-- Kolom Kanan: Riwayat dan Jadwal Kunjungan --}}
            <div class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="200">
                
                {{-- Riwayat Absensi Hari Ini --}}
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-2 mb-4">Riwayat Hari Ini</h2>
                    <ul class="space-y-3">
                        <li class="p-3 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg text-sm">
                            <span class="font-bold">Check-In:</span> 08:00 AM 
                            <p class="text-xs text-gray-600">Lokasi: Kantor Cabang Duren Sawit</p>
                        </li>
                        <li class="p-3 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg text-sm">
                            <span class="font-bold">Status:</span> Sedang Bekerja
                            <p class="text-xs text-gray-600">Waktu Kerja: 3 Jam 30 Menit</p>
                        </li>
                        <li class="p-3 bg-gray-50 border-l-4 border-gray-500 rounded-lg text-sm">
                            <span class="font-bold">Check-Out:</span> Belum Absen
                        </li>
                    </ul>
                </div>

                {{-- Jadwal Kunjungan Hari Ini --}}
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-2 mb-4">Jadwal Kunjungan</h2>
                    <ul class="space-y-3">
                        <li class="p-3 bg-blue-50 border-l-4 border-blue-500 rounded-lg text-sm">
                            <span class="font-bold">09:30 AM:</span> Toko Jaya Abadi
                        </li>
                        <li class="p-3 bg-blue-50 border-l-4 border-blue-500 rounded-lg text-sm">
                            <span class="font-bold">13:00 PM:</span> Warung Makmur
                        </li>
                        <li class="p-3 bg-blue-50 border-l-4 border-blue-500 rounded-lg text-sm">
                            <span class="font-bold">15:00 PM:</span> Mini Market Sehat
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
        
    </div>
@endsection