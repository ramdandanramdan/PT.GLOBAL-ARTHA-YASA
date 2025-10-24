@php
    $userRole = strtolower(trim(Auth::user()->role ?? '')); 
    $userNameInitial = substr(Auth::user()->name, 0, 1);
    
    // Warna Sidebar: Midnight Blue (#050A30) - Ultra Premium
    $primaryColor = '#050A30'; 
    // Warna Aksen Aktif/Interaktif: Cyan (Cyan 400)
    $accentColor = 'cyan-400'; 
    
    // Logic Prefix & Route Khusus
    $routePrefix = $userRole . '.';
    // Route Tautan 3 (Stok)
    $routeStock = $routePrefix . 'stock'; 
    // Route Tautan 4 (Performance)
    $routePerformance = $routePrefix . 'performance';
    
    // Riwayat Link (Tautan 5)
    $routeHistory = ($userRole === 'sales') ? 'sales.transaction.history' : 'spg.activity.history';
    $historyLabel = ($userRole === 'sales') ? 'Riwayat Transaksi' : 'Riwayat Promosi';

    // Logika request()->routeIs() untuk Riwayat (Menangkap rute generik dan spesifik)
    $isHistoryActive = ($userRole === 'sales') 
        ? (request()->routeIs('sales.history') || request()->routeIs('sales.transaction.*'))
        : (request()->routeIs('spg.history') || request()->routeIs('spg.activity.*'));


    // Route Aksi Cepat (CTA di Footer)
    $routeQuickAction = ($userRole === 'sales') ? $routePrefix . 'transaction.create' : $routePrefix . 'activity.create';

    // *** DEFINISI CLASS TOMBOL LENGKAP UNTUK KEAMANAN TAILWIND SAFELIST ***
    $salesButtonClass = 'bg-emerald-500 hover:bg-emerald-600 shadow-lg shadow-emerald-600/30 transform hover:scale-[1.01] hover:ring-2 ring-emerald-400';
    
    // CTA SPG: Gradien Indigo, Font bold, Shadow Premium
    $spgButtonClass = 'bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 shadow-2xl shadow-indigo-600/60 transform hover:scale-[1.02] hover:ring-4 ring-indigo-500/50';

    // Class untuk link non-aktif
    $inactiveLinkClass = 'flex items-center px-6 py-3 mx-4 rounded-lg transition-all duration-300 ease-in-out text-gray-400 hover:text-white hover:bg-gray-800 hover:shadow-lg hover:shadow-gray-900/50 group font-medium tracking-wide transform hover:scale-[1.01]';
    // Class untuk link aktif
    $activeLinkClass = 'flex items-center px-6 py-3 mx-4 rounded-lg transition-colors duration-200 ease-in-out font-extrabold text-white shadow-md bg-gradient-to-r from-cyan-600/30 to-transparent border-l-4 border-cyan-400';

@endphp

{{-- Root Container --}}
{{-- INI MODIFIKASI KUNCI 1: Inisialisasi 'open' agar selalu true di Desktop (lg) dan false di Mobile secara default --}}
<div x-data="{ open: window.innerWidth >= 1024 ? true : false }" 
     @resize.window="open = window.innerWidth >= 1024 ? true : open" 
     class="min-h-screen bg-gray-50 font-sans">
    
    {{-- INI MODIFIKASI KUNCI 2: Overlay untuk Mobile/Tablet --}}
    <div x-show="open && window.innerWidth < 1024" 
         @click="open = false" 
         class="fixed inset-0 bg-black bg-opacity-50 z-20 transition-opacity duration-300"></div>

    {{-- SIDEBAR: Fixed, W-64 --}}
    <style>
        .sidebar-hide-scrollbar::-webkit-scrollbar { display: none; }
        .sidebar-hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <nav class="fixed inset-y-0 left-0 w-64 text-white overflow-y-auto z-30 
              transition-transform duration-500 ease-in-out shadow-2xl shadow-gray-900/50 sidebar-hide-scrollbar 
              transform -translate-x-full lg:translate-x-0"
              style="background-color: {{ $primaryColor }};"
              {{-- INI MODIFIKASI KUNCI 3: Kontrol visibility di Mobile/Tablet. Di Desktop, 'open' selalu true, jadi lg:translate-x-0 tetap berfungsi --}}
              x-bind:class="{ 'translate-x-0': open, '-translate-x-full': !open }">
        
        {{-- Header Logo/Title - Ultra Professional --}}
        <div class="p-6 text-xl font-extrabold border-b border-gray-800 transition duration-300 hover:opacity-90 cursor-default flex items-center" style="border-color: rgba(255, 255, 255, 0.08);">
            
            {{-- 🔥 UPDATE LOGO PATH: Menggunakan logo-2.jpg dari public/images --}}
            <img src="{{ asset('images/logo-2.jpg') }}" alt="Global Artha Yasa Logo" class="h-8 w-auto mr-3 filter drop-shadow-md rounded-full">
            
            <span class="text-white tracking-wide font-black text-lg">GLOBAL ARTHA YASA</span>
            
            {{-- Tombol Close (Hanya di Mobile) --}}
            <button @click="open = false" class="lg:hidden ml-auto p-1 rounded-full text-gray-400 hover:text-white hover:bg-gray-800 transition duration-300">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        
        {{-- Navigation Links Container --}}
        <div class="flex flex-col h-[calc(100%-6rem)]">
            
            <div class="py-6 flex-grow space-y-1">
                
                {{-- Tautan 1: Dashboard Real-time (Route: sales.dashboard atau spg.dashboard) --}}
                <a href="{{ route($routePrefix . 'dashboard') }}" 
                    @click="if(window.innerWidth < 1024) open = false" {{-- Tutup saat diklik di Mobile --}}
                    class="{{ request()->routeIs($routePrefix . 'dashboard') ? $activeLinkClass : $inactiveLinkClass }}">
                    <i class="fa-solid fa-gauge-high w-5 mr-3 text-lg"></i> 
                    Dashboard
                </a>

                {{-- Tautan 2: Absensi Lokasi (Route: spg.absensi.index) --}}
                <a href="{{ route($routePrefix . 'absensi.index') }}" 
                    @click="if(window.innerWidth < 1024) open = false" {{-- Tutup saat diklik di Mobile --}}
                    class="{{ request()->routeIs($routePrefix . 'absensi.*') ? $activeLinkClass : $inactiveLinkClass }}">
                    <i class="fa-solid fa-location-dot w-5 mr-3 text-lg"></i> 
                    Absensi Lokasi
                </a>
                
                {{-- Tautan 3: Stok Individu (Route: sales.stock atau spg.stock) --}}
                <a href="{{ route($routeStock) }}" 
                    @click="if(window.innerWidth < 1024) open = false" {{-- Tutup saat diklik di Mobile --}}
                    class="{{ request()->routeIs($routeStock) ? $activeLinkClass : $inactiveLinkClass }}">
                    <i class="fa-solid fa-boxes-stacked w-5 mr-3 text-lg"></i> 
                    Stok Individu
                </a>

                {{-- --- PEMBATAS (Soft Line) --- --}}
                <div class="mx-6 my-4">
                    <hr class="border-t border-gray-800 transition duration-300 hover:border-cyan-600/30" style="border-color: rgba(255, 255, 255, 0.1);">
                </div>

                {{-- *** BAGIAN LAPORAN & PERFORMANCE *** --}}
                
                {{-- Tautan 4: Target & Komisi (Route: sales.performance atau spg.performance) --}}
                <a href="{{ route($routePerformance) }}" 
                    @click="if(window.innerWidth < 1024) open = false" {{-- Tutup saat diklik di Mobile --}}
                    class="{{ request()->routeIs($routePerformance) ? $activeLinkClass : $inactiveLinkClass }}">
                    <i class="fa-solid fa-bullseye w-5 mr-3 text-lg"></i> 
                    Target & Komisi
                </a>

                {{-- Tautan 5: Riwayat (Route: sales.transaction.history atau spg.activity.history) --}}
                <a href="{{ route($routeHistory) }}" 
                    @click="if(window.innerWidth < 1024) open = false" {{-- Tutup saat diklik di Mobile --}}
                    class="{{ $isHistoryActive ? $activeLinkClass : $inactiveLinkClass }}">
                    <i class="fa-solid fa-timeline w-5 mr-3 text-lg"></i> 
                    {{ $historyLabel }}
                </a>
                
                {{-- --- PEMBATAS (Soft Line) --- --}}
                <div class="mx-6 my-4">
                    <hr class="border-t border-gray-800 transition duration-300 hover:border-cyan-600/30" style="border-color: rgba(255, 255, 255, 0.1);">
                </div>

                {{-- *** BAGIAN DUKUNGAN & AKUN *** --}}

                {{-- Tautan 6: Pusat Bantuan (Route: support.index) --}}
                <a href="{{ route('support.index') }}" 
                    @click="if(window.innerWidth < 1024) open = false" {{-- Tutup saat diklik di Mobile --}}
                    class="{{ request()->routeIs('support.*') ? $activeLinkClass : $inactiveLinkClass }}">
                    <i class="fa-solid fa-life-ring w-5 mr-3 text-lg"></i> 
                    Pusat Bantuan
                </a>

                {{-- Tautan 7: Pengaturan Akun (Route: profile.edit) --}}
                <a href="{{ route('profile.edit') }}" 
                    @click="if(window.innerWidth < 1024) open = false" {{-- Tutup saat diklik di Mobile --}}
                    class="{{ request()->routeIs('profile.edit') ? $activeLinkClass : $inactiveLinkClass }}">
                    <i class="fa-solid fa-user-gear w-5 mr-3 text-lg"></i> 
                    Pengaturan
                </a>
            </div>

            {{-- FOOTER SIDEBAR: User Info, CTA, dan Logout --}}
            <div class="p-5 border-t border-gray-800 bg-gray-900/30" style="border-color: rgba(255, 255, 255, 0.1);">
                
                {{-- 🎁 PEMBUNGKUS MODERN (CTA SPG/Sales) --}}
                <div class="p-3 mb-4 rounded-lg bg-cyan-900/40 shadow-xl shadow-cyan-950/50">
                    <p class="text-xs text-cyan-200 uppercase tracking-widest font-extrabold pb-2 px-1">Aksi Cepat</p>
                    @if ($userRole === 'sales')
                        <a href="{{ route($routeQuickAction) }}" 
                            @click="if(window.innerWidth < 1024) open = false" 
                            class="flex items-center p-3 rounded-lg w-full text-center transition duration-300 font-extrabold text-white {{ $salesButtonClass }}">
                            <i class="fa-solid fa-cart-shopping w-5 mr-3"></i> 
                            INPUT TRANSAKSI BARU
                        </a>
                    @elseif ($userRole === 'spg')
                        <a href="{{ route($routeQuickAction) }}" 
                            @click="if(window.innerWidth < 1024) open = false" 
                            class="flex items-center p-3 rounded-lg w-full text-center transition duration-300 font-bold text-white {{ $spgButtonClass }}"> 
                            <i class="fa-solid fa-camera w-5 mr-3"></i> 
                            LAPOR PROMOSI HARI INI
                        </a>
                    @endif
                </div>
                
                {{-- 💎 PEMBUNGKUS PREMIUM SIMPLE (User Info/Akun) --}}
                <div class="p-3 rounded-lg bg-gray-900/50 shadow-inner shadow-black/30 mb-4">
                    <div class="flex items-center group transition duration-300 cursor-pointer">
                        <span class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-cyan-400 text-sm font-extrabold text-gray-900 shadow-md ring-1 ring-cyan-500/50 group-hover:ring-2 transition duration-300">
                            {{ $userNameInitial }}
                        </span>
                        <div class="ml-3 leading-tight">
                            <p class="font-extrabold text-white tracking-wide text-sm group-hover:text-cyan-400 transition duration-300">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 capitalize font-medium">{{ $userRole }}</p> 
                        </div>
                    </div>
                </div>

                {{-- LOGOUT BUTTON --}}
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center justify-center py-2 text-red-500 hover:text-red-400 
                                  rounded-lg transition-colors duration-300 font-semibold text-sm hover:bg-red-900/30 transform hover:scale-[1.01]">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> KELUAR AKUN
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Main Content Area (Header Bar - Centralized) --}}
    <div class="relative min-h-screen transition-all duration-300 pl-0 lg:pl-64"
         x-bind:class="{ 'pl-0': !open && window.innerWidth < 1024, 'lg:pl-64': open || window.innerWidth >= 1024 }">
        
        {{-- Header Bar (Navbar) --}}
        <header class="bg-white shadow-md fixed top-0 w-full z-20"
            {{-- Mengontrol lebar header. Di mobile selalu w-full. Di desktop w-[calc(100%-16rem)] HANYA jika sidebar terbuka --}}
            x-bind:class="{ 'lg:w-[calc(100%-16rem)] lg:left-64': open, 'lg:w-full lg:left-0': !open }"
        >
            <div class="max-w-full mx-auto py-4 px-4 sm:px-6 flex items-center justify-between border-b border-gray-100">
                
                {{-- KONTEN KIRI: Tombol Hamburger --}}
                <div class="flex items-center space-x-3">
                    <button @click="open = ! open" class="text-gray-600 hover:text-cyan-400 transition duration-150 transform hover:scale-110">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
                
                {{-- KONTEN TENGAH: Judul Dashboard (Tengah) --}}
                {{-- Menggunakan flex-1 dan text-center untuk memusatkan judul secara efektif di mobile --}}
                <h2 class="font-black text-lg sm:text-xl text-gray-800 leading-tight flex-1 text-center tracking-wide uppercase transition duration-300 hover:text-gray-900/80 mx-2">
                    {{ $header ?? 'Dashboard' }} 
                </h2>

                {{-- KONTEN KANAN: Notifikasi dan Profile --}}
                <div class="flex-shrink-0 flex justify-end items-center space-x-2 sm:space-x-4">
                    
                    {{-- Search Bar (Disembunyikan di Mobile) --}}
                    <div class="relative hidden sm:block">
                        <input type="text" placeholder="Cari data, laporan..." 
                                class="pl-10 pr-4 py-2.5 border border-gray-300 rounded-full text-sm w-48 md:w-64 focus:ring-cyan-500 focus:border-cyan-500 bg-gray-50 transition duration-300 hover:border-gray-400 placeholder-gray-400 shadow-sm hover:shadow-md">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    {{-- Tombol Notifikasi (Tampil di semua ukuran) --}}
                    <button class="text-gray-600 hover:text-red-500 transition duration-150 relative transform hover:scale-110">
                        <i class="fa-solid fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center h-4 w-4 text-xs font-bold leading-none text-white bg-red-600 rounded-full transform translate-x-1 -translate-y-1 ring-1 ring-white">3</span>
                    </button>

                    {{-- Tombol Profile/Initial (Disembunyikan di Mobile) --}}
                    <div class="hidden sm:block">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-cyan-400 text-sm font-extrabold text-gray-900 shadow-md ring-1 ring-cyan-500/50 hover:ring-2 transition duration-300">
                            {{ $userNameInitial }}
                        </a>
                    </div>
                </div>
            </div>
        </header>

        {{-- Main Content Slot --}}
        <main class="pt-24 px-6 md:px-8 bg-gray-50">
            {{ $slot ?? '' }}
        </main>
    </div>
</div>