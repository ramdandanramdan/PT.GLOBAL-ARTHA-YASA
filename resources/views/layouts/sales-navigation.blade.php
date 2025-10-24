@php
    $userRole = 'sales'; 
    $userNameInitial = substr(Auth::user()->name, 0, 1);
    
    // Warna Sidebar: Midnight Blue (#050A30) - Ultra Premium
    $primaryColor = '#050A30'; 
    // Warna Aksen Aktif/Interaktif: Cyan (Cyan 400)
    $accentColor = 'cyan-400'; 
    
    // Logic Prefix & Route Khusus
    $routePrefix = 'sales.';
    $routeStock = 'sales.stock'; 
    $routePerformance = 'sales.performance';
    
    // Riwayat Link (Tautan 5) - KHUSUS SALES
    $routeHistory = 'sales.transaction.history';
    $historyLabel = 'Riwayat Transaksi';

    // Logika request()->routeIs()
    $isHistoryActive = request()->routeIs('sales.history') || request()->routeIs('sales.transaction.*');

    // Route Aksi Cepat (CTA di Footer)
    $routeQuickAction = 'sales.transaction.create';

    // *** DEFINISI CLASS TOMBOL LENGKAP ***
    // Tombol CTA (diubah menjadi lebih tebal dan elegan)
    $salesButtonClass = 'bg-cyan-600 hover:bg-cyan-700 shadow-xl shadow-cyan-600/50 transform hover:scale-[1.01] hover:ring-2 ring-cyan-400';
    
    // Kelas Navigasi Inaktif (Teks lebih tebal tanpa ikon)
    $inactiveLinkClass = 'flex items-center px-6 py-3 mx-4 rounded-lg transition-all duration-300 ease-in-out text-gray-400 hover:text-white hover:bg-gray-800 hover:shadow-lg hover:shadow-gray-900/50 group font-extrabold tracking-wide transform hover:scale-[1.01] text-base';
    
    // Kelas Navigasi Aktif (Teks lebih tebal, tanpa ikon)
    $activeLinkClass = 'flex items-center px-6 py-3 mx-4 rounded-lg transition-colors duration-200 ease-in-out font-extrabold text-white shadow-md bg-gradient-to-r from-cyan-600/30 to-transparent border-l-4 border-cyan-400 text-base';

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Sales</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    {{-- AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

{{-- Root Container --}}
<div x-data="{ open: window.innerWidth >= 1024 ? true : false }" 
     @resize.window="open = window.innerWidth >= 1024 ? true : open" 
     class="min-h-screen bg-gray-50">
    
    {{-- Overlay untuk Mobile/Tablet --}}
    <div x-show="open && window.innerWidth < 1024" 
         @click="open = false" 
         class="fixed inset-0 bg-black bg-opacity-50 z-20 transition-opacity duration-300"></div>

    {{-- SIDEBAR: Navigasi lengkap --}}
    <style>
        /* Modern Scrollbar Hide */
        .sidebar-hide-scrollbar::-webkit-scrollbar { display: none; }
        .sidebar-hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <nav class="fixed inset-y-0 left-0 w-64 text-white overflow-y-auto z-30 
             transition-transform duration-500 ease-in-out shadow-2xl shadow-gray-900/50 sidebar-hide-scrollbar 
             transform -translate-x-full lg:translate-x-0"
             style="background-color: {{ $primaryColor }};"
             x-bind:class="{ 'translate-x-0': open, '-translate-x-full': !open }">
        
        {{-- Header Logo/Title --}}
        <div class="p-6 text-xl font-extrabold border-b border-gray-800 transition duration-300 hover:opacity-90 cursor-default flex items-center" style="border-color: rgba(255, 255, 255, 0.08);">
            <img src="{{ asset('images/logo-2.jpg') }}" alt="Global Artha Yasa Logo" class="h-8 w-auto mr-3 filter drop-shadow-md rounded-full">
            <span class="text-white tracking-wide font-black text-lg">GLOBAL ARTHA YASA</span> {{-- Nama Penuh --}}
            <button @click="open = false" class="lg:hidden ml-auto p-1 rounded-full text-gray-400 hover:text-white hover:bg-gray-800 transition duration-300">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        
        {{-- Navigation Links Container (Konten Sidebar) --}}
        <div class="flex flex-col h-[calc(100%-6rem)]">
            
            <div class="py-6 flex-grow space-y-1">
                
                {{-- Tautan 1: Dashboard --}}
                <a href="{{ route($routePrefix . 'dashboard') }}" @click="if(window.innerWidth < 1024) open = false" 
                    class="{{ request()->routeIs($routePrefix . 'dashboard') ? $activeLinkClass : $inactiveLinkClass }}">
                    DASHBOARD
                </a>

                {{-- Tautan 2: Absensi Lokasi --}}
                <a href="{{ route($routePrefix . 'absensi.index') }}" @click="if(window.innerWidth < 1024) open = false" 
                    class="{{ request()->routeIs($routePrefix . 'absensi.*') ? $activeLinkClass : $inactiveLinkClass }}">
                    ABSENSI LOKASI
                </a>
                
                {{-- Tautan 3: Stok Individu --}}
                <a href="{{ route($routeStock) }}" @click="if(window.innerWidth < 1024) open = false" 
                    class="{{ request()->routeIs($routeStock) ? $activeLinkClass : $inactiveLinkClass }}">
                    STOK INDIVIDU
                </a>

                {{-- --- PEMBATAS --- --}}
                <div class="mx-6 my-4"><hr class="border-t border-gray-800 transition duration-300 hover:border-cyan-600/30" style="border-color: rgba(255, 255, 255, 0.1);"></div>

                {{-- Tautan 4: Target & Komisi --}}
                <a href="{{ route($routePerformance) }}" @click="if(window.innerWidth < 1024) open = false" 
                    class="{{ request()->routeIs($routePerformance) ? $activeLinkClass : $inactiveLinkClass }}">
                    TARGET & KOMISI
                </a>

                {{-- Tautan 5: Riwayat Transaksi --}}
                <a href="{{ route($routeHistory) }}" @click="if(window.innerWidth < 1024) open = false" 
                    class="{{ $isHistoryActive ? $activeLinkClass : $inactiveLinkClass }}">
                    {{ strtoupper($historyLabel) }}
                </a>
                
                {{-- --- PEMBATAS --- --}}
                <div class="mx-6 my-4"><hr class="border-t border-gray-800 transition duration-300 hover:border-cyan-600/30" style="border-color: rgba(255, 255, 255, 0.1);"></div>

                {{-- Tautan 6: Pusat Bantuan --}}
                <a href="{{ route('support.index') }}" @click="if(window.innerWidth < 1024) open = false" 
                    class="{{ request()->routeIs('support.*') ? $activeLinkClass : $inactiveLinkClass }}">
                    PUSAT BANTUAN
                </a>

                {{-- Tautan 7: Pengaturan Akun --}}
                <a href="{{ route('profile.edit') }}" @click="if(window.innerWidth < 1024) open = false" 
                    class="{{ request()->routeIs('profile.edit') ? $activeLinkClass : $inactiveLinkClass }}">
                    PENGATURAN AKUN
                </a>
            </div>

            {{-- FOOTER SIDEBAR: User Info, CTA, dan Logout (Desain Modern) --}}
            <div class="p-5 border-t border-gray-800 bg-gray-900/30" style="border-color: rgba(255, 255, 255, 0.1);">
                
                {{-- 🎁 PEMBUNGKUS MODERN (CTA SALES) --}}
                <div class="p-3 mb-4 rounded-xl bg-cyan-900/50 shadow-2xl shadow-cyan-950/70 border border-cyan-800/50">
                    <p class="text-xs text-cyan-200 uppercase tracking-widest font-extrabold pb-2 px-1">TUGAS UTAMA</p>
                    <a href="{{ route($routeQuickAction) }}" @click="if(window.innerWidth < 1024) open = false" 
                        class="flex items-center p-3 rounded-xl w-full text-center transition duration-300 font-extrabold text-white text-base justify-center {{ $salesButtonClass }}">
                        <i class="fa-solid fa-cart-shopping w-5 mr-2"></i> INPUT TRANSAKSI
                    </a>
                </div>
                
                {{-- 💎 PEMBUNGKUS PREMIUM SIMPLE (User Info/Akun) --}}
                <div class="p-3 rounded-xl bg-gray-900/50 shadow-inner shadow-black/30 mb-4">
                    <div class="flex items-center group transition duration-300 cursor-pointer">
                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-cyan-400 text-base font-extrabold text-gray-900 shadow-md ring-1 ring-cyan-500/50 group-hover:ring-2 transition duration-300">
                            {{ $userNameInitial }}
                        </span>
                        <div class="ml-3 leading-tight">
                            <p class="font-extrabold text-white tracking-wide text-sm group-hover:text-cyan-400 transition duration-300">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 capitalize font-medium">{{ $userRole }} | ID: {{ Auth::id() }}</p> 
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
        <header class="bg-white shadow-lg fixed top-0 w-full z-20 transition-all duration-300"
            x-bind:class="{ 'lg:w-[calc(100%-16rem)] lg:left-64': open, 'lg:w-full lg:left-0': !open }"
        >
            {{-- MODIFIKASI: Ketinggian dan tata letak header dirapikan --}}
            <div class="max-w-full mx-auto py-3 px-4 sm:px-6 flex items-center justify-between border-b border-gray-100 h-16">
                
                {{-- KONTEN KIRI: Tombol Hamburger --}}
                <div class="flex items-center flex-shrink-0">
                    <button @click="open = ! open" class="text-gray-600 hover:text-cyan-400 transition duration-150 transform hover:scale-110 lg:hidden p-2 rounded-full hover:bg-gray-100">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    {{-- Spacer di desktop Dihilangkan karena Judul menggunakan flex-1 --}}
                </div>
                
                {{-- KONTEN TENGAH: Judul Dashboard --}}
                {{-- Menggunakan flex-1 dan text-center untuk penempatan yang rapi di tengah --}}
                <h2 class="font-black text-lg sm:text-xl text-gray-800 leading-tight flex-1 text-center tracking-wider uppercase transition duration-300 hover:text-gray-900/80 mx-2">
                    @yield('header', 'DASHBOARD UTAMA') 
                </h2>

                {{-- KONTEN KANAN: Search, Notifikasi, dan Profile --}}
                <div class="flex-shrink-0 flex items-center space-x-2 sm:space-x-4">
                    
                    {{-- Search Bar (Dibuat lebih kompak) --}}
                    <div class="relative hidden sm:block">
                        <input type="text" placeholder="Cari data, laporan..." 
                                class="pl-10 pr-4 py-2 border border-gray-200 rounded-full text-sm w-48 md:w-64 focus:ring-cyan-500 focus:border-cyan-500 bg-gray-50 transition duration-300 hover:border-gray-300 placeholder-gray-400 shadow-sm">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>
                    
                    {{-- Tombol Notifikasi --}}
                    <button class="text-gray-600 hover:text-red-500 transition duration-150 relative transform hover:scale-110 p-2 rounded-full hover:bg-gray-100">
                        <i class="fa-solid fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center h-4 w-4 text-xs font-bold leading-none text-white bg-red-600 rounded-full transform translate-x-1 -translate-y-1 ring-1 ring-white">3</span>
                    </button>

                    {{-- Tombol Profile/Initial --}}
                    <div class="hidden sm:block">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-cyan-400 text-base font-extrabold text-gray-900 shadow-xl ring-2 ring-cyan-500/50 hover:ring-4 transition duration-300">
                            {{ $userNameInitial }}
                        </a>
                    </div>
                </div>
            </div>
        </header>

        {{-- Main Content Slot (Gunakan @yield untuk konten utama) --}}
        <main class="pt-24 px-6 md:px-8 bg-gray-50">
            @yield('content')
        </main>
    </div>
</div>

{{-- AOS Script Initialization --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        // once: true, // Only animate once
        duration: 800, // Durasi animasi
        delay: 50,    // Delay awal
    });
</script>
</body>
</html>