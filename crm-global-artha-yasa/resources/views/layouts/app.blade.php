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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Mengatur font default ke Figtree */
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f4f6f9;
            /* Latar belakang abu-abu sangat terang */
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    {{-- Memuat navigasi berdasarkan peran pengguna --}}
    @auth
        @php
            // Mengambil nama role user yang sedang login dan mengkonversi ke lowercase
            $roleName = strtolower(Auth::user()->role->name ?? '');
        @endphp

        @if ($roleName === 'founder')
            {{-- Founder Navigation: Melewatkan variabel $slot --}}
            @include('layouts.navigation', ['slot' => $slot ?? ''])
        @elseif ($roleName === 'manager')
            {{-- Manager Navigation: Melewatkan variabel $slot (Fix Undefined $slot) --}}
            @include('layouts.manager-navigation', ['slot' => $slot ?? ''])
        @else
            {{-- Fallback untuk role lain (e.g., SPV, Sales, SPG).
            Menggunakan navigasi Manager sebagai default sementara. --}}
            @include('layouts.manager-navigation', ['slot' => $slot ?? ''])
        @endif
    @else
        {{-- Tampilan untuk Guest/Unauthenticated User --}}
        <main class="min-h-screen flex items-center justify-center bg-gray-50">
            {{ $slot ?? '' }}
        </main>
    @endauth

    {{-- Direktif ini akan menarik semua konten dari @push('scripts') --}}
    @stack('scripts')
</body>

</html>