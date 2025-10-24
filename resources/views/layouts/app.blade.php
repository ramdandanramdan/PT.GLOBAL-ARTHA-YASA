<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Judul Halaman --}}
    <title>{{ $header ?? config('app.name', 'Global Artha Yasa') }}</title>

    {{-- Google Fonts: Menggunakan Figtree --}}
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- *** TAMBAHAN PENTING: FONT AWESOME (ICONS) *** --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMD/CDg0l/cIe3pT4jV48O6y8xK43/t8W2FwW9l4gI5I5fK5o5q5t5x5Z5p5Q==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- *** TAMBAHAN BARU: AOS (ANIMATE ON SCROLL) CSS *** --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f4f6f9;
            
        }

        [x-cloak] {
            display: none !important;
        }

        /* Styling tambahan untuk memuluskan transisi AOS di awal loading */
        body { opacity: 1; transition: opacity .5s; }
        .aos-animate { opacity: 1; }
    </style>
</head>

<body>
    {{-- Memuat navigasi berdasarkan peran pengguna --}}
    @auth
        @php
            // KOREKSI KRITIS: Ambil role langsung dari kolom 'role' sebagai string.
            $roleName = strtolower(Auth::user()->role ?? 'default'); 
            // Menggunakan 'default' sebagai fallback yang aman
        @endphp

        @if ($roleName === 'founder')
            {{-- Founder Navigation --}}
            @include('layouts.navigation', ['slot' => $slot ?? ''])
        @elseif ($roleName === 'manager' || $roleName === 'spv')
            {{-- Manager & SPV Navigation: Menggunakan manager-navigation --}}
            @include('layouts.manager-navigation', ['slot' => $slot ?? ''])
        @elseif ($roleName === 'sales' || $roleName === 'spg')
            {{-- BARU: Sales & SPG Navigation: Ini yang seharusnya dimuat untuk SPG --}}
            @include('layouts.sales-spg-navigation', ['slot' => $slot ?? ''])
        @else
            {{-- Fallback: Jika role tidak teridentifikasi, tampilkan dashboard umum atau pesan error --}}
            <main class="min-h-screen flex items-center justify-center bg-gray-50">
                <div class="text-center p-10 bg-white rounded-lg shadow">
                    <h1 class="text-2xl font-bold text-red-600">Akses Ditolak</h1>
                    <p class="text-gray-600 mt-2">Role pengguna tidak valid atau tidak dikenali.</p>
                </div>
            </main>
        @endif
    @else
        {{-- Tampilan untuk Guest/Unauthenticated User --}}
        <main class="min-h-screen flex items-center justify-center bg-gray-50">
            {{ $slot ?? '' }}
        </main>
    @endauth

    {{-- *** TAMBAHAN BARU: AOS (ANIMATE ON SCROLL) JS & INIT *** --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            // Konfigurasi AOS yang profesional dan mulus (sesuai yang kita pakai di dashboard)
            duration: 800, 
            once: true,   
            easing: 'ease-in-out',
        });
    </script>

    {{-- Direktif ini akan menarik semua konten dari @push('scripts') --}}
    @stack('scripts')
</body>

</html>