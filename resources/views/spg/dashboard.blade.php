@php
    // --- DATA DUMMY SPG DASHBOARD ---
    
    // Data Kinerja Anda (Asumsi user yang login adalah "Maya SPG" atau SPG mana pun)
    $spgData = [
        'name' => Auth::user()->name ?? 'Maya SPG', // Menggunakan nama pengguna yang sedang login
        'pencapaian_target' => 75, // dalam persen
        'total_laporan_bulan' => 72, 
        'unit_terjual' => 450,
        'insentif_potensial' => 1500000, // dalam Rupiah
        'foto_belum_verifikasi' => 1,
        'batas_waktu_laporan' => '15:00 WIB',
        'produk_prioritas' => 'Alpha',
        'stok_prioritas' => 85, // Stok produk prioritas saat ini
        'stok_level' => 'Aman', // Status stok
    ];

    // Data Leaderboard Dummy
    $leaderboard = [
        [
            'rank' => 1,
            'name' => 'Diana Sales',
            'role' => 'SPG',
            'laporan_count' => 85,
            'color' => 'indigo', 
        ],
        [
            'rank' => 2,
            'name' => $spgData['name'], 
            'role' => 'Anda',
            'laporan_count' => $spgData['total_laporan_bulan'],
            'color' => 'cyan', 
        ],
        [
            'rank' => 3,
            'name' => 'Sari Haris',
            'role' => 'SPG',
            'laporan_count' => 68,
            'color' => 'emerald', 
        ],
        [
            'rank' => 4,
            'name' => 'Doni Spg',
            'role' => 'SPG',
            'laporan_count' => 55,
            'color' => 'gray', 
        ],
    ];

    // Data Dummy untuk Chart Kinerja (30 hari terakhir) - Diubah menjadi 4 Minggu
    $chartLabels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
    $chartData = [15, 22, 18, 17]; // Jumlah Laporan Promosi per Minggu
    
    // Format Rupiah Helper
    $formatRupiah = fn ($amount) => 'Rp ' . number_format($amount, 0, ',', '.');
@endphp

<x-app-layout>
    <x-slot name="header">
        Dashboard Kinerja SPG
    </x-slot>

    {{-- MEMUAT LIBRARY AOS & CHART.JS --}}
    @push('styles')
        {{-- AOS CSS --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        {{-- AOS JS --}}
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        
        {{-- SCRIPT INLINE UNTUK CHART KINERJA - GAYA AREA LINE CHART MODERN --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Inisialisasi AOS
                AOS.init({
                    // pengaturan global
                    duration: 800, // durasi standar
                    once: true // Animasi hanya terjadi sekali saat di-scroll ke bawah
                });

                var ctx = document.getElementById('performanceChart').getContext('2d');
                var performanceChart = new Chart(ctx, {
                    type: 'line', // Diubah menjadi Line Chart
                    data: {
                        labels: @json($chartLabels),
                        datasets: [{
                            label: 'Total Laporan Promosi',
                            data: @json($chartData),
                            fill: true, // Mengisi area di bawah garis
                            backgroundColor: 'rgba(99, 102, 241, 0.2)', // Indigo 500 dengan transparansi
                            borderColor: 'rgb(99, 102, 241)', // Indigo 500
                            borderWidth: 3,
                            tension: 0.4, // Membuat garis menjadi smooth/melengkung (Kekinian & Animasi)
                            pointBackgroundColor: 'rgb(99, 102, 241)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgb(99, 102, 241)',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        // ANIMASI EFEK SMOOTH (Chart.js default animation pada tipe line dengan tension)
                        animation: {
                            duration: 1000, // Durasi animasi dalam milidetik
                            easing: 'easeInOutQuad' // Tipe easing untuk smooth animation
                        },
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                backgroundColor: 'rgba(0,0,0,0.8)', // Warna gelap modern
                                titleFont: { size: 14, weight: 'bold' },
                                bodyFont: { size: 12 },
                                padding: 10,
                                cornerRadius: 8,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(200, 200, 200, 0.2)', // Garis grid sangat tipis
                                    drawBorder: false,
                                },
                                ticks: {
                                    color: '#6b7280', // Warna teks abu-abu
                                },
                                title: {
                                    display: true,
                                    text: 'Jumlah Laporan',
                                    color: '#4b5563',
                                    font: { size: 14, weight: 'bold' }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#6b7280',
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-6 md:p-10 border-t-4 border-indigo-600/50" data-aos="fade-up" data-aos-duration="600">

                {{-- Greeting dan Notifikasi Penting --}}
                <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        Selamat Datang, {{ $spgData['name'] }}!
                    </h1>
                    <span class="text-sm font-medium text-indigo-500 bg-indigo-50 p-2 rounded-full px-4 shadow-sm">
                        Role: SPG Aktif
                    </span>
                </div>

                {{-- 1. KARTU METRIK UTAMA (Performance Indicators) - TEKS NON-PUTIH --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    
                    {{-- Card 1: Target Harian (Gradient Hijau) --}}
                    <div class="p-5 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.02] bg-emerald-100/70 border border-emerald-200" data-aos="fade-right" data-aos-delay="200" data-aos-duration="600">
                        <div class="flex items-center justify-between">
                            <i class="fa-solid fa-bullseye text-3xl opacity-70 text-emerald-700"></i>
                            <span class="text-4xl font-black tracking-tighter text-gray-900">{{ $spgData['pencapaian_target'] }}%</span>
                        </div>
                        <p class="text-sm font-light mt-3 uppercase tracking-wider text-gray-600">Pencapaian Target Q4</p>
                        <p class="text-xs mt-1 font-medium text-gray-500">Progress Bulan Ini</p>
                    </div>

                    {{-- Card 2: Promosi Dilaporkan (Gradient Biru) --}}
                    <div class="p-5 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.02] bg-cyan-100/70 border border-cyan-200" data-aos="fade-right" data-aos-delay="300" data-aos-duration="600">
                        <div class="flex items-center justify-between">
                            <i class="fa-solid fa-camera-retro text-3xl opacity-70 text-cyan-700"></i>
                            <span class="text-4xl font-black tracking-tighter text-gray-900">{{ $spgData['total_laporan_bulan'] }}</span>
                        </div>
                        <p class="text-sm font-light mt-3 uppercase tracking-wider text-gray-600">Total Laporan Promosi</p>
                        <p class="text-xs mt-1 font-medium text-gray-500">Bulan Berjalan</p>
                    </div>

                    {{-- Card 3: Produk Terjual (Gradient Ungu) --}}
                    <div class="p-5 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.02] bg-indigo-100/70 border border-indigo-200" data-aos="fade-left" data-aos-delay="400" data-aos-duration="600">
                        <div class="flex items-center justify-between">
                            <i class="fa-solid fa-box-open text-3xl opacity-70 text-indigo-700"></i>
                            <span class="text-4xl font-black tracking-tighter text-gray-900">{{ $spgData['unit_terjual'] }}</span>
                        </div>
                        <p class="text-sm font-light mt-3 uppercase tracking-wider text-gray-600">Unit Produk Terjual</p>
                        <p class="text-xs mt-1 font-medium text-gray-500">Berkontribusi dari Promosi</p>
                    </div>

                    {{-- Card 4: Insentif Potensial (Gradient Kuning/Orange) --}}
                    <div class="p-5 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.02] bg-amber-100/70 border border-amber-200" data-aos="fade-left" data-aos-delay="500" data-aos-duration="600">
                        <div class="flex items-center justify-between">
                            <i class="fa-solid fa-hand-holding-dollar text-3xl opacity-70 text-amber-700"></i>
                            <span class="text-3xl font-black tracking-tighter text-gray-900">{{ $formatRupiah($spgData['insentif_potensial']) }}</span>
                        </div>
                        <p class="text-sm font-light mt-3 uppercase tracking-wider text-gray-600">Insentif Potensial</p>
                        <p class="text-xs mt-1 font-medium text-gray-500">Berdasarkan Aktivitas Promosi</p>
                    </div>
                </div>

                {{-- 2. TATA LETAK UTAMA (Aksi Cepat & Fitur Tambahan) --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    {{-- Kolom Kiri: Aksi Cepat, Stok & Notifikasi (1/3 Lebar) --}}
                    <div class="lg:col-span-1 space-y-8">
                        
                        {{-- Card Aksi Cepat (Modern Highlight) --}}
                        <div class="p-6 rounded-xl shadow-2xl bg-gray-50 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 border-indigo-100">Aksi Cepat SPG</h3>
                            
                            {{-- Tombol Lapor Promosi (Primary CTA) --}}
                            <a href="{{ route('spg.activity.create') }}" 
                                data-aos="zoom-in" data-aos-delay="300" data-aos-duration="500"
                                class="w-full flex items-center justify-center py-3 px-4 mb-3 rounded-xl 
                                        text-white font-extrabold tracking-wide text-sm
                                        bg-indigo-600 hover:bg-indigo-700 
                                        shadow-lg shadow-indigo-500/50 transform hover:scale-[1.01] transition duration-300">
                                <i class="fa-solid fa-camera mr-3"></i> LAPOR PROMOSI SEKARANG
                            </a>
                            
                            {{-- Tombol Cek Absensi --}}
                            <a href="{{ route('spg.absensi.index') }}" 
                                data-aos="zoom-in" data-aos-delay="400" data-aos-duration="500"
                                class="w-full flex items-center justify-center py-3 px-4 rounded-xl 
                                        text-gray-700 bg-white hover:bg-gray-100 
                                        border border-gray-300 font-semibold text-sm transition duration-300">
                                <i class="fa-solid fa-location-crosshairs mr-3"></i> CEK ABSENSI HARI INI
                            </a>
                        </div>
                        
                        {{-- Card Stok Produk Prioritas --}}
                        <div class="p-6 rounded-xl shadow-lg bg-white border border-blue-200" data-aos="fade-up" data-aos-delay="500">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 border-blue-200 flex items-center justify-between">
                                Stok {{ $spgData['produk_prioritas'] }}
                                <span class="text-xs px-2 py-1 rounded-full font-bold bg-blue-100 text-blue-600 uppercase">{{ $spgData['stok_level'] }}</span>
                            </h3>
                            <div class="text-4xl font-black text-blue-600">{{ $spgData['stok_prioritas'] }} Unit</div>
                            <p class="text-sm text-gray-600 mt-2">Stok yang tersedia di lokasi Anda saat ini. Selalu pantau!</p>
                            <a href="{{ route('spg.stock') }}" class="text-sm font-semibold text-indigo-500 hover:text-indigo-700 mt-3 inline-block transition duration-200">
                                Lihat Detail Stok <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                        
                        {{-- Card Notifikasi Penting (Menggunakan Data Dummy) --}}
                        <div class="p-6 rounded-xl shadow-lg bg-white border border-yellow-100" data-aos="fade-up" data-aos-delay="600">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 border-yellow-200">Notifikasi & Informasi</h3>
                            <ul class="space-y-3">
                                <li class="text-sm text-gray-700 flex items-start">
                                    <i class="fa-solid fa-circle-exclamation text-yellow-500 mt-1 mr-3 flex-shrink-0"></i>
                                    Anda memiliki **{{ $spgData['foto_belum_verifikasi'] }} foto** Promosi yang belum diverifikasi oleh Manager.
                                </li>
                                <li class="text-sm text-gray-700 flex items-start">
                                    <i class="fa-solid fa-clock text-blue-500 mt-1 mr-3 flex-shrink-0"></i>
                                    Batas waktu laporan promosi produk '**{{ $spgData['produk_prioritas'] }}**' hari ini pukul **{{ $spgData['batas_waktu_laporan'] }}**.
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Visualisasi Kinerja (2/3 Lebar) --}}
                    <div class="lg:col-span-2 space-y-8">

                        {{-- Card Visualisasi (Grafik Performance) - AREA LINE CHART MODERN --}}
                        <div class="p-6 rounded-xl shadow-2xl bg-white border border-indigo-100" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">Visualisasi Kinerja Promosi (4 Minggu Terakhir)</h3>
                            <div class="h-80 w-full">
                                {{-- CANVAS CHART.JS AKTIF --}}
                                <canvas id="performanceChart"></canvas>
                            </div>
                        </div>
                        
                        {{-- Card Leaderboard (Menggunakan Data Dummy) --}}
                        <div class="p-6 rounded-xl shadow-xl bg-white border border-gray-200" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">🔥 Top Promotor Bulan Ini (Leaderboard)</h3>
                            
                            <div class="space-y-3">
                                @foreach ($leaderboard as $entry)
                                    @php
                                        // Menentukan class berdasarkan rank dan role
                                        $isCurrentUser = ($entry['role'] === 'Anda');
                                        $bgColor = $isCurrentUser ? 'bg-cyan-50' : 'bg-gray-50';
                                        $borderColor = $isCurrentUser ? 'border-l-4 border-cyan-600' : 'border-l-4 border-gray-300';
                                        $rankColor = $entry['color'];
                                        $rankTextColor = $rankColor . '-700';
                                        $countTextColor = $rankColor . '-600';

                                        // Override warna untuk Top 3
                                        if ($entry['rank'] === 1) {
                                            $rankColor = 'indigo';
                                            $rankTextColor = 'indigo-700';
                                            $countTextColor = 'indigo-600';
                                            $bgColor = 'bg-indigo-50';
                                            $borderColor = 'border-l-4 border-indigo-600';
                                        } elseif ($entry['rank'] === 3) {
                                            $rankColor = 'emerald';
                                            $rankTextColor = 'emerald-700';
                                            $countTextColor = 'emerald-600';
                                            $bgColor = 'bg-emerald-50';
                                            $borderColor = 'border-l-4 border-emerald-600';
                                        }
                                    @endphp
                                    
                                    {{-- Tambahkan AOS di setiap entri leaderboard --}}
                                    <div class="flex items-center justify-between p-3 rounded-lg {{ $bgColor }} {{ $borderColor }} shadow-sm transition duration-200 hover:shadow-md" data-aos="fade-up" data-aos-delay="{{ 400 + ($loop->index * 100) }}">
                                        <span class="font-extrabold text-{{ $rankTextColor }} w-8">#{{ $entry['rank'] }}</span>
                                        <span class="flex-grow font-semibold text-gray-800">{{ $entry['name'] }} @if($isCurrentUser) <span class="text-xs text-indigo-500">(Anda)</span> @endif</span>
                                        <span class="text-lg font-black text-{{ $countTextColor }}">{{ $entry['laporan_count'] }} Laporan</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>