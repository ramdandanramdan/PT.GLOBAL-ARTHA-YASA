@php
    // --- DATA DUMMY PERFORMANCE SPG ---
    $target = 2500;
    $currentSales = 1850;
    $commissionRate = 0.05; // 5% dari Nilai Penjualan
    $currentValue = 125500000; // Rp 125.500.000 Nilai Penjualan
    $commissionEstimate = $currentValue * $commissionRate;
    $achievedPercentage = ($currentSales / $target) * 100;

    $formatRupiah = fn ($amount) => 'Rp ' . number_format($amount, 0, ',', '.');
    $formatPercentage = fn ($percentage) => number_format($percentage, 1, ',', '.') . '%';

    // Data Dummy untuk Chart (Performa Harian 7 Hari Terakhir)
    $chartLabels = ['Day -6', 'Day -5', 'Day -4', 'Day -3', 'Day -2', 'Kemarin', 'Hari Ini'];
    $chartSalesData = [150, 200, 180, 220, 250, 300, 550]; // Totalnya 1850
    $chartTargetData = array_fill(0, 7, $target / 30); // Target Harian Rata-rata
    
    // Status visual mapping untuk progress bar
    $progressColor = ($achievedPercentage >= 100) ? 'bg-green-500' : 
                     (($achievedPercentage >= 70) ? 'bg-blue-500' : 'bg-red-500');
    
    // AOS Utility
    $aosDelay = 0;
    $incrementDelay = 100;
@endphp

<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Target & Komisi SPG') }}
        </h2>
    </x-slot>

    {{-- SCRIPTS: AOS, CHART.JS, & ALPINEJS (Penting untuk modernitas) --}}
    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({ duration: 800, once: true });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            {{-- BAGIAN 1: RINGKASAN CAPAIAN UTAMA (6 CARDS EKSTRA PROFESIONAL) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">
                
                {{-- Card 1: Target Bulanan --}}
                <div class="lg:col-span-2 p-6 bg-white rounded-2xl shadow-xl border-t-4 border-blue-600 hover:shadow-2xl transition duration-300" data-aos="fade-right" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <p class="text-sm font-medium text-blue-600 flex items-center"><i class="fa-solid fa-bullseye mr-2"></i> TARGET BULANAN</p>
                    <p class="text-4xl font-extrabold text-gray-900 mt-2">
                        {{ number_format($target) }} <span class="text-xl font-semibold text-blue-500">UNIT</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Target harian rata-rata: {{ number_format($target / 30, 0) }} unit</p>
                </div>
                
                {{-- Card 2: Unit Tercapai --}}
                <div class="lg:col-span-2 p-6 bg-white rounded-2xl shadow-xl border-t-4 border-green-600 hover:shadow-2xl transition duration-300" data-aos="fade-right" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <p class="text-sm font-medium text-green-600 flex items-center"><i class="fa-solid fa-trophy mr-2"></i> UNIT TERCAPAI</p>
                    <p class="text-4xl font-extrabold text-gray-900 mt-2">
                        {{ number_format($currentSales) }} <span class="text-xl font-semibold text-green-500">UNIT</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Masih butuh {{ number_format($target - $currentSales) }} unit lagi!</p>
                </div>
                
                {{-- Card 3: Persentase Capaian & Progress Bar --}}
                <div class="lg:col-span-2 p-6 bg-white rounded-2xl shadow-xl border-t-4 border-yellow-600 hover:shadow-2xl transition duration-300" data-aos="fade-left" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <p class="text-sm font-medium text-yellow-600 flex items-center"><i class="fa-solid fa-chart-line mr-2"></i> PERSENTASE CAPAIAN</p>
                    <p class="text-4xl font-extrabold text-gray-900 mt-2">
                        {{ $formatPercentage($achievedPercentage) }}
                    </p>
                    {{-- Progress Bar Modern --}}
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-3">
                        <div class="h-2.5 rounded-full {{ $progressColor }} transition-all duration-1000 ease-out" style="width: {{ min(100, $achievedPercentage) }}%"></div>
                    </div>
                </div>

                {{-- Card 4: Nilai Penjualan --}}
                <div class="p-6 bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 border-l-4 border-purple-500" data-aos="fade-up" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <p class="text-sm font-medium text-purple-600">Nilai Penjualan</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $formatRupiah($currentValue) }}</p>
                </div>
                
                {{-- Card 5: Estimasi Komisi --}}
                <div class="p-6 bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 border-l-4 border-pink-500" data-aos="fade-up" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <p class="text-sm font-medium text-pink-600">Estimasi Komisi</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $formatRupiah($commissionEstimate) }}</p>
                </div>
                
                {{-- Card 6: Komisi Per Unit --}}
                <div class="p-6 bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 border-l-4 border-orange-500" data-aos="fade-up" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <p class="text-sm font-medium text-orange-600">Rasio Komisi</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $formatPercentage($commissionRate * 100) }}</p>
                </div>

                {{-- Tombol Aksi Cepat --}}
                <div class="lg:col-span-3 p-6 bg-indigo-50 rounded-2xl shadow-inner flex flex-col justify-center" data-aos="fade-up" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <p class="text-sm font-bold text-indigo-700 mb-3">AKSI PERFORMA</p>
                    <div class="flex space-x-4">
                        <a href="#" class="flex-1 text-center py-2 text-sm font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md transform hover:scale-[1.02]">
                            LAPOR AKTIVITAS HARI INI
                        </a>
                        <a href="#" class="flex-1 text-center py-2 text-sm font-bold text-indigo-600 bg-white border border-indigo-600 rounded-lg hover:bg-indigo-100 transition duration-300 shadow-md transform hover:scale-[1.02]">
                            LIHAT RIWAYAT KOMISI
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            {{-- BAGIAN 2: VISUALISASI CHART MODERN (Performa Harian) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Chart (2/3 Lebar) --}}
                <div class="lg:col-span-2 p-6 bg-white rounded-2xl shadow-2xl" data-aos="zoom-in-up" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center"><i class="fa-solid fa-chart-area mr-2 text-indigo-600"></i> Tren Capaian Unit (7 Hari Terakhir)</h3>
                    <div class="h-80"> {{-- Wrapper untuk menjaga rasio aspek Chart --}}
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>

                {{-- Keterangan Chart & Target Harian (1/3 Lebar) --}}
                <div class="lg:col-span-1 p-6 bg-indigo-50 rounded-2xl shadow-xl border border-indigo-200 flex flex-col justify-between" data-aos="fade-left" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                    <div>
                        <h3 class="text-xl font-bold text-indigo-700 mb-4">Fokus Harian</h3>
                        <p class="text-gray-700 mb-4">Grafik di samping menunjukkan bagaimana Anda mencapai target unit harian. Tetap konsisten!</p>
                        
                        <div class="p-4 bg-white rounded-xl shadow-md border-b-4 border-indigo-400">
                            <p class="text-sm font-medium text-indigo-600">Target Harian Ideal</p>
                            <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ number_format($target / 30, 0) }} Unit</p>
                            <p class="text-xs text-gray-500 mt-1">Pastikan garis biru selalu berada di atas garis putus-putus.</p>
                        </div>
                    </div>
                    <a href="#" class="mt-4 text-center text-sm font-bold text-indigo-600 hover:text-indigo-800 transition duration-200">
                        Lihat Data Harian Detail <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

            </div>

            <hr class="border-gray-200">

            {{-- BAGIAN 3: DETAIL KOMISI DAN RIWAYAT (MODERN TABLE & UTILITY) --}}
            <div class="p-8 bg-white rounded-2xl shadow-2xl border-t-4 border-gray-200" data-aos="fade-up" data-aos-delay="{{ $aosDelay += $incrementDelay }}">
                <h4 class="text-xl font-bold text-gray-900 mb-5 flex items-center"><i class="fa-solid fa-table-list mr-2 text-gray-600"></i> Riwayat Komisi Bulan Lalu</h4>
                
                {{-- Dummy Table Riwayat --}}
                <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target (Unit)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capaian (%)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komisi Final</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Baris Dummy 1 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Sep 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">115.0%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $formatRupiah(8500000) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tercapai</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                </td>
                            </tr>
                            {{-- Baris Dummy 2 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Agu 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2.200</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-bold">78.5%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $formatRupiah(4200000) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Belum Capai</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

<script>
    // Inisialisasi Chart.js
    const ctx = document.getElementById('performanceChart').getContext('2d');
    
    // Gradient Fill (Untuk efek modern)
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(79, 70, 229, 0.7)'); // indigo-600
    gradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

    const performanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [
                {
                    label: 'Unit Tercapai',
                    data: @json($chartSalesData),
                    backgroundColor: gradient,
                    borderColor: 'rgb(79, 70, 229)', // indigo-600
                    borderWidth: 3,
                    tension: 0.4, // Untuk garis yang sangat smooth
                    fill: true,
                    pointBackgroundColor: 'rgb(255, 255, 255)',
                    pointBorderColor: 'rgb(79, 70, 229)',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                },
                {
                    label: 'Target Harian Ideal',
                    data: @json($chartTargetData),
                    borderColor: 'rgb(249, 115, 22)', // orange-500
                    borderWidth: 2,
                    borderDash: [5, 5], // Garis putus-putus
                    tension: 0.4,
                    fill: false,
                    pointRadius: 0,
                    pointHoverRadius: 0,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 10,
                        padding: 20
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('id-ID').format(context.parsed.y) + ' Unit';
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>