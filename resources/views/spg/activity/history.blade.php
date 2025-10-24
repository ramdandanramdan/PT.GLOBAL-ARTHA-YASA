@php
    // --- DATA DUMMY RIWAYAT AKTIVITAS (Menggunakan format array asosiatif) ---
    $activityHistory = [
        [
            'date' => now()->subHours(2)->format('d M Y'),
            'time' => now()->subHours(2)->format('H:i'),
            'type' => 'Pemasangan Materi Promosi',
            'location' => 'Toko Budi Sentosa, Sektor 5',
            'status' => 'Disetujui',
            'status_color' => 'green',
            'details' => 'Memasang 3 unit banner produk terbaru di area kasir dan rak display utama.',
        ],
        [
            'date' => now()->subDays(1)->format('d M Y'),
            'time' => now()->subDays(1)->format('H:i'),
            'type' => 'Demo Produk Konsumen',
            'location' => 'Giant Hypermarket, Lantai 2',
            'status' => 'Menunggu Review',
            'status_color' => 'yellow',
            'details' => 'Melakukan demonstrasi produk X kepada 15 konsumen potensial. Ada 5 unit terjual di tempat.',
        ],
        [
            'date' => now()->subDays(3)->format('d M Y'),
            'time' => now()->subDays(3)->format('H:i'),
            'type' => 'Audit Display Stok',
            'location' => 'Minimarket Sejahtera',
            'status' => 'Ditolak',
            'status_color' => 'red',
            'details' => 'Laporan ditolak. Foto tidak sesuai dengan standar *planogram* yang ditetapkan.',
        ],
        [
            'date' => now()->subDays(7)->format('d M Y'),
            'time' => now()->subDays(7)->format('H:i'),
            'type' => 'Event Sampling',
            'location' => 'Pusat Perbelanjaan C',
            'status' => 'Disetujui',
            'status_color' => 'green',
            'details' => 'Berpartisipasi dalam event mingguan. Berhasil mendistribusikan 200 sampel.',
        ],
    ];

    // AOS Utility
    $aosDelay = 0;
    $incrementDelay = 150;
@endphp

<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Aktivitas & Promosi SPG') }}
        </h2>
    </x-slot>

    {{-- SCRIPTS: AOS & ALPINEJS --}}
    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({ duration: 900, once: true });
        </script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- HEADER DAN AKSI CEPAT --}}
            <div class="p-6 bg-white shadow-2xl rounded-2xl border-t-4 border-indigo-600" data-aos="fade-down">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-1">Riwayat Aktivitas</h3>
                        <p class="text-md text-gray-500">
                            {{ count($activityHistory) }} Laporan Tercatat. Transparansi dan akuntabilitas performa Anda.
                        </p>
                    </div>
                    <a href="#" class="mt-4 md:mt-0 px-6 py-2 text-sm font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition duration-300 transform hover:scale-[1.02] shadow-md">
                        <i class="fa-solid fa-plus-circle mr-2"></i> INPUT AKTIVITAS BARU
                    </a>
                </div>
            </div>

            {{-- FILTER DAN SEARCH BAR MODERN (Dummy Alpine) --}}
            <div x-data="{ filter: 'semua' }" data-aos="fade-up" data-aos-delay="150">
                <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                    
                    {{-- Tombol Filter Status --}}
                    <div class="flex space-x-2 text-sm font-semibold">
                        <button @click="filter = 'semua'" :class="{'bg-indigo-600 text-white shadow-md': filter === 'semua', 'text-gray-600 hover:bg-gray-100': filter !== 'semua'}" class="px-4 py-2 rounded-full transition duration-300">Semua</button>
                        <button @click="filter = 'Disetujui'" :class="{'bg-green-600 text-white shadow-md': filter === 'Disetujui', 'text-gray-600 hover:bg-gray-100': filter !== 'Disetujui'}" class="px-4 py-2 rounded-full transition duration-300">Disetujui</button>
                        <button @click="filter = 'Menunggu Review'" :class="{'bg-yellow-500 text-white shadow-md': filter === 'Menunggu Review', 'text-gray-600 hover:bg-gray-100': filter !== 'Menunggu Review'}" class="px-4 py-2 rounded-full transition duration-300">Menunggu</button>
                        <button @click="filter = 'Ditolak'" :class="{'bg-red-600 text-white shadow-md': filter === 'Ditolak', 'text-gray-600 hover:bg-gray-100': filter !== 'Ditolak'}" class="px-4 py-2 rounded-full transition duration-300">Ditolak</button>
                    </div>

                    {{-- Search dan Date Filter --}}
                    <div class="flex items-center space-x-3 w-full sm:w-auto">
                        <input type="date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm py-2">
                        <div class="relative">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Cari Lokasi/Tipe" class="pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm py-2 w-full sm:w-48">
                        </div>
                    </div>
                </div>
            </div>

            {{-- BAGIAN 3: TIMELINE / LIST AKTIVITAS (Card View) --}}
            <div class="relative p-6 lg:p-10 bg-white rounded-2xl shadow-2xl border border-gray-100">
                
                {{-- Garis Timeline Vertikal --}}
                <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 w-0.5 bg-gray-200 h-full top-0"></div>

                <h4 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3 lg:hidden">Daftar Laporan</h4>

                <div class="space-y-8 lg:space-y-12">
                    @php $aosDelay = 0; @endphp
                    @foreach ($activityHistory as $key => $activity)
                        @php
                            $aosDelay += $incrementDelay;
                            $isEven = $key % 2 == 0;
                            
                            $statusClasses = [
                                'green' => 'bg-green-500 text-white border-green-700',
                                'yellow' => 'bg-yellow-500 text-white border-yellow-700',
                                'red' => 'bg-red-500 text-white border-red-700',
                            ];
                            $statusCardClass = $statusClasses[$activity['status_color']] ?? 'bg-gray-500 text-white border-gray-700';
                            
                            $aosDirection = $isEven ? 'fade-right' : 'fade-left';
                        @endphp

                        {{-- ITEM TIMELINE / CARD AKTIVITAS --}}
                        <div class="relative lg:w-1/2 {{ $isEven ? 'lg:mr-auto' : 'lg:ml-auto' }}" data-aos="{{ $aosDirection }}" data-aos-delay="{{ $aosDelay }}">
                            
                            {{-- Titik Timeline (Hanya terlihat di desktop) --}}
                            <div class="hidden lg:block absolute {{ $isEven ? 'right-0' : 'left-0' }} top-3 transform {{ $isEven ? 'translate-x-[21rem]' : '-translate-x-[22rem]' }} w-4 h-4 rounded-full {{ $statusCardClass }} ring-4 ring-white shadow-lg z-10"></div>
                            
                            <div class="p-6 bg-white rounded-xl shadow-2xl border-t-4 border-{{ $activity['status_color'] }}-500 transition duration-300 transform hover:shadow-3xl hover:scale-[1.01]">
                                
                                {{-- Header & Waktu --}}
                                <div class="flex justify-between items-start border-b pb-3 mb-3">
                                    <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full {{ $statusCardClass }}">
                                        {{ $activity['status'] }}
                                    </span>
                                    <p class="text-sm font-medium text-gray-500 flex items-center">
                                        <i class="fa-solid fa-clock mr-2 text-indigo-400"></i> {{ $activity['time'] }}
                                    </p>
                                </div>
                                
                                {{-- Isi Detail --}}
                                <h5 class="text-xl font-extrabold text-gray-900 mb-2 flex items-center">
                                    <i class="fa-solid fa-tags mr-2 text-indigo-600"></i> {{ $activity['type'] }}
                                </h5>
                                
                                <p class="text-sm text-gray-700 mb-3 italic">
                                    {{ $activity['details'] }}
                                </p>
                                
                                {{-- Footer --}}
                                <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                    <p class="text-sm font-semibold text-gray-600 flex items-center">
                                        <i class="fa-solid fa-location-dot mr-2 text-red-500"></i> {{ $activity['location'] }}
                                    </p>
                                    <a href="#" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition duration-200 flex items-center">
                                        Lihat Bukti <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- FOOTER / NAVIGASI --}}
            <div class="pt-6 border-t border-gray-200 text-center" data-aos="fade-up" data-aos-delay="{{ $aosDelay + $incrementDelay }}">
                <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    <a href="#" class="bg-indigo-600 text-white relative inline-flex items-center px-4 py-2 border border-indigo-600 text-sm font-medium">1</a>
                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
            
        </div>
    </div>
</x-app-layout>