@extends('layouts.sales-navigation') 

{{-- Section 'header' untuk mengisi judul di Navbar --}}
@section('header')
    DASHBOARD KINERJA PENJUALAN
@endsection

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8">

        {{-- RINGKASAN KINERJA HARI INI (Top Kicker Metrics) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            
            {{-- Card 1: Total Penjualan Hari Ini --}}
            <div class="bg-white p-6 rounded-xl shadow-2xl border-l-4 border-blue-600 transition duration-300 hover:shadow-blue-300/50"
                 data-aos="fade-up" data-aos-delay="100"> 
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Penjualan Hari Ini</p>
                    <i class="fa-solid fa-rupiah-sign text-blue-500 text-xl"></i>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 mt-2">{{ $penjualan_hari_ini ?? 'Rp 0' }}</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-arrow-up text-emerald-500 mr-1"></i>
                    <span>+2.1% dari rata-rata kemarin</span>
                </div>
            </div>

            {{-- Card 2: Jumlah Transaksi --}}
            <div class="bg-white p-6 rounded-xl shadow-2xl border-l-4 border-indigo-600 transition duration-300 hover:shadow-indigo-300/50"
                 data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Transaksi (Count)</p>
                    <i class="fa-solid fa-receipt text-indigo-500 text-xl"></i>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 mt-2">{{ $total_transaksi ?? 0 }}</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-chart-line text-slate-500 mr-1"></i>
                    <span>Target Harian: 25 Transaksi</span>
                </div>
            </div>

            {{-- Card 3: Stok Tersisa --}}
            <div class="bg-white p-6 rounded-xl shadow-2xl border-l-4 border-amber-500 transition duration-300 hover:shadow-amber-300/50"
                 data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Stok Tersedia (Unit)</p>
                    <i class="fa-solid fa-boxes-stacked text-amber-500 text-xl"></i>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 mt-2">{{ $stok_tersisa ?? 0 }}</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 mr-1"></i>
                    <span class="{{ ($stok_tersisa ?? 0) < 15 ? 'text-red-600 font-bold' : '' }}">Stok 7% di bawah batas aman (15 Unit)</span>
                </div>
            </div>

            {{-- Card 4: Potensi Komisi Bulan Ini --}}
            <div class="bg-white p-6 rounded-xl shadow-2xl border-l-4 border-emerald-600 transition duration-300 hover:shadow-emerald-300/50"
                 data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Komisi Bulan Ini</p>
                    <i class="fa-solid fa-hand-holding-dollar text-emerald-500 text-xl"></i>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 mt-2">{{ $potensi_komisi ?? 'Rp 0' }}</p>
                <div class="text-xs mt-3 text-gray-500 flex items-center">
                    <i class="fa-solid fa-fire text-orange-500 mr-1"></i>
                    <span>Proyeksi pencapaian 78% target</span>
                </div>
            </div>
        </div>

        {{-- VISUALISASI PERFORMA & MAPS (Row Utama) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Column Kiri (Chart Penjualan Mingguan & Progres Target) --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Chart: Performa Penjualan Mingguan (Modern Smooth Line Chart) --}}
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100"
                     data-aos="fade-right" data-aos-delay="500">
                    <h2 class="text-xl font-bold mb-4 text-slate-800 border-b pb-2">Penjualan 7 Hari Terakhir</h2>
                    <div class="h-80">
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                </div>

                {{-- Progres Target Bulan Ini (Gauge/Progress Bar) --}}
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100"
                     data-aos="fade-right" data-aos-delay="600">
                    <h2 class="text-xl font-bold mb-4 text-slate-800 border-b pb-2">Progres Target Volume (MTD)</h2>
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 flex items-center justify-center rounded-full border-4 border-blue-200">
                             <span class="text-2xl font-extrabold text-blue-600">{{ $progres_target_persen ?? '0%' }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-lg font-bold text-gray-800">Target Tercapai: {{ $target_tercapai_unit ?? 0 }} Unit</p>
                            <p class="text-sm text-gray-500">Kebutuhan untuk mencapai 100%: {{ $kekurangan_target_unit ?? 0 }} Unit</p>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progres_target_persen ?? 0 }}"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Column Kanan (Peta Kunjungan & Notifikasi) --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Peta Kunjungan Outlet (Memastikan Absensi Aktif) --}}
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100"
                     data-aos="fade-left" data-aos-delay="700">
                    <h2 class="text-xl font-bold mb-4 text-slate-800 border-b pb-2">Peta Kunjungan Outlet</h2>
                    <div class="h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 font-semibold border border-dashed">
                        [AREA MAPS: Peta Real-time Outlet yang dikunjungi/terdekat]
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Lokasi terakhir dicatat: {{ $last_checkin_time ?? 'Belum Check-In' }}</p>
                </div>

                {{-- Notifikasi & Peringatan Stok --}}
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100"
                     data-aos="fade-left" data-aos-delay="800">
                    <h2 class="text-xl font-bold mb-4 text-slate-800 border-b pb-2">Notifikasi Penting</h2>
                    <ul class="space-y-3">
                        <li class="p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm flex items-center">
                            <i class="fa-solid fa-box-open mr-2"></i> Peringatan! Stok produk **X** tersisa <span class="font-bold ml-1">5 Unit</span>.
                        </li>
                        <li class="p-3 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg text-sm flex items-center">
                            <i class="fa-solid fa-bell mr-2"></i> Anda menerima pesan baru dari Manager.
                        </li>
                        <li class="p-3 bg-amber-50 border border-amber-200 text-amber-700 rounded-lg text-sm flex items-center">
                            <i class="fa-solid fa-calendar-check mr-2"></i> Jadwal kunjungan baru untuk Outlet **Y** ditambahkan.
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- Script untuk Chart.js (Dipindahkan ke sini untuk memastikan Library dimuat) --}}
    @push('scripts')
    {{-- Memuat Library Chart.js CDN (PENTING: Pindahkan ini ke <head> atau sebelum @stack('scripts') di layout utama jika memungkinkannya) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Pastikan elemen canvas ada sebelum menginisialisasi chart
            const ctx = document.getElementById('salesTrendChart');
            if (!ctx) return; 

            // Data dummy untuk demonstrasi chart modern smooth
            const salesData = {
                labels: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                datasets: [{
                    label: 'Penjualan (Rp Juta)',
                    data: [1.2, 1.8, 2.5, 3.1, 2.7, 4.0, 3.5], // Data dummy: Penjualan dalam jutaan Rupiah
                    fill: true, // Mengaktifkan Area Chart
                    backgroundColor: 'rgba(59, 130, 246, 0.2)', // Warna area (Tailwind blue-500)
                    borderColor: 'rgb(59, 130, 246)', // Warna garis
                    borderWidth: 2,
                    tension: 0.4, // Membuat garis menjadi smooth/melengkung
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            };

            new Chart(ctx, {
                type: 'line',
                data: salesData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legenda
                        },
                        title: {
                            display: false
                        },
                        tooltip: {
                            // Tampilan tooltip yang lebih bersih
                            backgroundColor: 'rgba(30, 41, 59, 0.9)', // Warna gelap
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 10,
                            // Callback untuk format tooltip (jika diperlukan)
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += 'Rp ' + context.parsed.y.toFixed(1) + ' Jt';
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false // Hilangkan garis grid X
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(203, 213, 225, 0.5)' // Warna grid Y lebih lembut
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    return 'Rp ' + value + ' Jt'; // Format sumbu Y
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
@endsection