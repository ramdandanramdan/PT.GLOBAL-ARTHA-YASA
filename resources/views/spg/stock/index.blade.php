@php
    // --- DATA DUMMY STOK INDIVIDU ---
    $stockData = [
        [
            'id' => 'PRD-A001',
            'name' => 'DJARUM SUPER (Prioritas)',
            'quantity' => 85,
            'max_capacity' => 100,
            'value' => 4250000, 
            'status' => 'Aman', 
        ],
        [
            'id' => 'PRD-B005',
            'name' => 'ESSE CHANGE DOUBLE ( Extra Promotion )',
            'quantity' => 12,
            'max_capacity' => 50,
            'value' => 960000, 
            'status' => 'Rendah',
        ],
        [
            'id' => 'PRD-C010',
            'name' => 'MARLBORO ICE BURSH (Reguler)',
            'quantity' => 50,
            'max_capacity' => 50,
            'value' => 1500000, 
            'status' => 'Berlebih',
        ],
        [
            'id' => 'PRD-D015',
            'name' => 'L Baik (Musiman)',
            'quantity' => 35,
            'max_capacity' => 40,
            'value' => 2100000, 
            'status' => 'Aman', 
        ],
    ];

    $totalUnits = array_sum(array_column($stockData, 'quantity'));
    $totalValue = array_sum(array_column($stockData, 'value'));
    $formatRupiah = fn ($amount) => 'Rp ' . number_format($amount, 0, ',', '.');
    
    // Status visual mapping
    $statusMap = [
        'Rendah' => ['icon' => 'fa-triangle-exclamation', 'class' => 'text-red-600 bg-red-100', 'bar' => 'bg-red-500'],
        'Aman' => ['icon' => 'fa-check-circle', 'class' => 'text-green-600 bg-green-100', 'bar' => 'bg-green-500'],
        'Berlebih' => ['icon' => 'fa-boxes-packing', 'class' => 'text-indigo-600 bg-indigo-100', 'bar' => 'bg-indigo-500'],
    ];
    
    // Data untuk Visualisasi Status Global
    $statusCounts = array_count_values(array_column($stockData, 'status'));
    $countRendah = $statusCounts['Rendah'] ?? 0;
    $countAman = $statusCounts['Aman'] ?? 0;
    $countBerlebih = $statusCounts['Berlebih'] ?? 0;
    $totalProducts = count($stockData);

    // Rasio Kapasitas Global (Total Unit / Total Max Capacity)
    $totalMaxCapacity = array_sum(array_column($stockData, 'max_capacity'));
    $globalCapacityRatio = ($totalMaxCapacity > 0) ? ($totalUnits / $totalMaxCapacity) * 100 : 0;
    
    // AOS Utility
    $aosDelay = 0;
    $incrementDelay = 150;
    
    // Data Dummy untuk Terakhir Diperbarui
    $lastUpdated = '10 menit lalu (24 Okt 2025, 17:55)';
@endphp

<x-app-layout>
    <x-slot name="header">
        Inventaris Stok Individu Anda
    </x-slot>

    {{-- SCRIPTS: AOS & ALPINEJS --}}
    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({ duration: 800, once: true });
        </script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- 1. RINGKASAN STOK & AKSI CEPAT (7 CARDS) --}}
            {{-- Mengubah layout menjadi 7 kolom di desktop: 4 Card Info + 3 Card Aksi --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-6">
                
                {{-- CARD INFO 1: Total Unit Stok --}}
                <div class="lg:col-span-2 p-6 bg-white shadow-xl rounded-2xl border-l-4 border-indigo-500" data-aos="fade-down" data-aos-delay="0">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Unit Stok</p>
                    <p class="text-3xl font-extrabold text-gray-900 mt-2">{{ $totalUnits }} <span class="text-lg text-indigo-600">UNIT</span></p>
                </div>
                
                {{-- CARD INFO 2: Perkiraan Nilai --}}
                <div class="lg:col-span-2 p-6 bg-white shadow-xl rounded-2xl border-l-4 border-emerald-500" data-aos="fade-down" data-aos-delay="150">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Nilai Inventaris</p>
                    <p class="text-xl font-extrabold text-gray-900 mt-2">{{ $formatRupiah($totalValue) }}</p>
                </div>

                {{-- CARD INFO 3 (BARU): Produk Kritis (Rendah) --}}
                <div class="lg:col-span-1 p-4 bg-white shadow-xl rounded-2xl border-l-4 border-red-500 flex items-center" data-aos="fade-down" data-aos-delay="300">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-triangle-exclamation text-2xl text-red-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Produk Kritis</p>
                        <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $countRendah }} <span class="text-sm text-red-600">ITEM</span></p>
                    </div>
                </div>

                {{-- CARD INFO 4 (BARU): Rasio Kapasitas Global --}}
                <div class="lg:col-span-2 p-4 bg-white shadow-xl rounded-2xl border-l-4 border-yellow-500" data-aos="fade-down" data-aos-delay="450">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Rasio Kapasitas Global</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-2">{{ number_format($globalCapacityRatio, 0) }}%</p>
                    {{-- Progress Bar Mini --}}
                    <div class="w-full bg-gray-200 rounded-full h-1 mt-1">
                        <div class="h-1 rounded-full bg-yellow-500" style="width: {{ $globalCapacityRatio }}%"></div>
                    </div>
                </div>

                {{-- Kartu Aksi Cepat (Diatur untuk menempati sisa 3 kolom) --}}
                <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 lg:pt-0">
                    
                    {{-- Card Aksi 5: Lapor Stok Baru --}}
                    <div class="p-4 bg-white shadow-xl rounded-2xl border border-gray-100 flex flex-col justify-center items-center text-center" data-aos="fade-up" data-aos-delay="600">
                        <i class="fa-solid fa-square-plus text-indigo-500 text-xl mb-2"></i>
                        <p class="text-xs font-semibold text-gray-700 mb-2">Lapor Penerimaan</p>
                        <a href="#" class="w-full text-center py-1 text-xs font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md">
                            LAPOR STOK
                        </a>
                    </div>

                    {{-- Card Aksi 6: Permintaan Stok --}}
                    <div class="p-4 bg-white shadow-xl rounded-2xl border border-gray-100 flex flex-col justify-center items-center text-center" data-aos="fade-up" data-aos-delay="750">
                        <i class="fa-solid fa-truck-ramp-box text-blue-500 text-xl mb-2"></i>
                        <p class="text-xs font-semibold text-gray-700 mb-2">Isi Ulang</p>
                        <a href="#" class="w-full text-center py-1 text-xs font-bold text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200 transition duration-300 shadow-md">
                            MINTA STOK
                        </a>
                    </div>
                    
                    {{-- CARD INFO 7 (BARU): Terakhir Diperbarui (Penting untuk audit) --}}
                    <div class="p-4 bg-white shadow-xl rounded-2xl border border-gray-100 flex flex-col justify-center items-center text-center" data-aos="fade-up" data-aos-delay="900">
                        <i class="fa-solid fa-clock-rotate-left text-gray-500 text-xl mb-2"></i>
                        <p class="text-xs font-semibold text-gray-700">Terakhir Diperbarui</p>
                        <p class="text-xs font-bold text-indigo-600 mt-1">{{ $lastUpdated }}</p>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">
            
            {{-- 2. DAFTAR STOK DETAIL (MODERN CARD VIEW) + FILTER --}}
            <div class="bg-white overflow-hidden shadow-2xl rounded-2xl p-8 border-t-4 border-indigo-200" x-data="{ filter: 'all', sort: 'name_asc' }">
                
                {{-- Header & Filter Area --}}
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b pb-4">
                    <h2 class="text-2xl font-extrabold text-gray-900 flex items-center mb-4 md:mb-0">
                        <i class="fa-solid fa-boxes-stacked mr-3 text-indigo-600"></i> Detail Produk
                    </h2>
                    
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        {{-- Filter Status Dropdown (Dummy Alpine Model) --}}
                        <div class="w-full sm:w-auto">
                            <label for="filter-status" class="block text-xs font-medium text-gray-500 mb-1">Filter Status</label>
                            <select x-model="filter" id="filter-status" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm py-2">
                                <option value="all">Semua Produk</option>
                                <option value="Rendah">🚨 Stok Rendah</option>
                                <option value="Aman">✅ Stok Aman</option>
                                <option value="Berlebih">📦 Stok Berlebih</option>
                            </select>
                        </div>
                        
                        {{-- Sort Dropdown (Dummy Alpine Model) --}}
                        <div class="w-full sm:w-auto">
                            <label for="sort-by" class="block text-xs font-medium text-gray-500 mb-1">Urutkan Berdasarkan</label>
                            <select x-model="sort" id="sort-by" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm py-2">
                                <option value="name_asc">Nama Produk (A-Z)</option>
                                <option value="quantity_desc">Kuantitas (Tertinggi)</option>
                                <option value="quantity_asc">Kuantitas (Terendah)</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                {{-- Daftar Produk Detail --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php $aosDelay = 0; @endphp
                    @foreach ($stockData as $item)
                        @php
                            $map = $statusMap[$item['status']];
                            $percentage = ($item['quantity'] / $item['max_capacity']) * 100;
                            $aosDelay += $incrementDelay;
                        @endphp
                        
                        {{-- CARD PRODUK --}}
                        <div class="p-6 border border-gray-100 rounded-xl shadow-lg transition duration-300 transform hover:shadow-xl hover:scale-[1.01]" data-aos="fade-up" data-aos-delay="{{ $aosDelay }}">
                            
                            {{-- Header & Status --}}
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">{{ $item['id'] }}</p>
                                    <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $item['name'] }}</h3>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full {{ $map['class'] }}">
                                    <i class="fa-solid {{ $map['icon'] }} mr-2"></i> {{ $item['status'] }}
                                </span>
                            </div>

                            {{-- Kuantitas & Nilai --}}
                            <div class="flex justify-between items-end mb-4">
                                <div>
                                    <p class="text-sm text-gray-500">Kuantitas Saat Ini:</p>
                                    <p class="text-3xl font-extrabold text-gray-800">{{ $item['quantity'] }} <span class="text-xl font-semibold text-indigo-500">UNIT</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Nilai Perkiraan:</p>
                                    <p class="text-lg font-bold text-gray-800">{{ $formatRupiah($item['value']) }}</p>
                                </div>
                            </div>
                            
                            {{-- PROGRESS BAR STOK (MODERN) --}}
                            <div class="mt-4">
                                <p class="text-xs font-semibold text-gray-600 mb-1 flex justify-between">
                                    <span>Kapasitas: {{ $item['quantity'] }} / {{ $item['max_capacity'] }}</span>
                                    <span class="font-bold text-gray-800">{{ number_format($percentage, 0) }}%</span>
                                </p>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="h-2.5 rounded-full transition-all duration-1000 ease-out {{ $map['bar'] }}" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>

                            {{-- Aksi (Menggunakan # sebagai dummy rute) --}}
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between">
                                <a href="#" class="text-sm font-semibold text-indigo-500 hover:text-indigo-700 transition duration-200">
                                    Lihat Riwayat <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                                </a>
                                @if ($item['status'] === 'Rendah')
                                    <button class="text-xs font-bold text-white bg-red-500 px-3 py-1 rounded-full shadow-md hover:bg-red-600 transition duration-200">
                                        <i class="fa-solid fa-bell mr-1"></i> ALERT!
                                    </button>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
                
                <div class="mt-10 pt-6 border-t border-gray-100 text-center" data-aos="fade-up" data-aos-delay="{{ $aosDelay + $incrementDelay }}">
                    <p class="text-md font-semibold text-gray-700">Perlu Penyesuaian? Hubungi Tim Logistik atau <a href="#" class="text-indigo-600 hover:text-indigo-800 underline">Laporkan Discrepancy (Dummy)</a>.</p>
                </div>
                
            </div>
            
        </div>
    </div>
</x-app-layout>