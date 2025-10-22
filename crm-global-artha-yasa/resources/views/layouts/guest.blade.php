<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Tambahkan ini untuk x-cloak --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- Google Fonts: Figtree --}}
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 min-h-screen flex flex-col items-center justify-center p-4 font-sans">
    {{ $slot }}
</body>

</html>