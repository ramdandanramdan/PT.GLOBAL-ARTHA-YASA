{{--
File ini adalah layout utama (App Layout) untuk Founder.
Perubahan:
1. Menambahkan state 'analyticsOpen' pada x-data untuk dropdown.
2. Mengganti link 'Laporan' statis dengan dropdown 'Analitik & Laporan'.
3. Menambahkan link ke 'founder.analytics.team.index', 'founder.analytics.customer.index',
dan 'founder.analytics.product.index'.
4. Mempertahankan semua fungsionalitas: modal logout, header, dan slot konten.
--}}
<nav x-data="{
    sidebarOpen: false,
    logoutModalOpen: false,
    analyticsOpen: {{ Str::startsWith(Route::currentRouteName(), 'founder.analytics.') ? 'true' : 'false' }}
}" class="flex min-h-screen bg-gray-50 antialiased">

    <div x-show="sidebarOpen" x-cloak
        class="fixed inset-0 z-40 bg-gray-900 bg-opacity-75 transition-opacity duration-300 md:hidden"
        @click="sidebarOpen = false" aria-hidden="true"></div>

    <div :class="{ 'transform -translate-x-full': !sidebarOpen, 'transform translate-x-0': sidebarOpen }" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 text-white shadow-xl
                transition duration-300 ease-in-out md:static md:translate-x-0 md:flex md:flex-col">

        <div class="flex items-center justify-center h-16 border-b border-gray-700 bg-gray-900">
            <a href="{{ route('founder.dashboard') }}"
                class="text-2xl font-extrabold tracking-wider text-indigo-400 uppercase">
                GAY.ID
            </a>
        </div>

        <div class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            @php
                // Tentukan rute aktif untuk pewarnaan
                $currentRoute = Route::currentRouteName();

                // Fungsi untuk kelas link dinamis
                $linkClass = function ($isActive) {
                    return $isActive
                        ? 'flex items-center px-4 py-3 text-sm rounded-xl font-semibold bg-indigo-600 shadow-md text-white
                            transition transform hover:scale-[1.01] duration-150'
                        : 'flex items-center px-4 py-3 text-sm rounded-xl font-medium text-gray-300 hover:bg-gray-700
                            hover:text-white transition duration-150';
                };
            @endphp

            {{-- Dashboard --}}
            <a href="{{ route('founder.dashboard') }}" class="{{ $linkClass($currentRoute === 'founder.dashboard') }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6m-6 0h-2M9 12h6m-3-4v8" />
                </svg>
                Dashboard
            </a>

            {{-- BARU: Menu Dropdown Analitik & Laporan --}}
            <div class="space-y-2">
                {{-- Tombol Dropdown --}}
                <button @click="analyticsOpen = !analyticsOpen"
                    class="{{ $linkClass(Str::startsWith($currentRoute, 'founder.analytics.')) }} w-full justify-between">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        Analitik & Laporan
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-90': analyticsOpen}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                {{-- Sub-menu --}}
                <div x-show="analyticsOpen" x-transition class="space-y-2 mt-2">
                    {{-- 1. Performa Tim --}}
                    <a href="{{ route('founder.analytics.team.index') }}"
                        class="{{ $linkClass(Str::startsWith($currentRoute, 'founder.analytics.team.')) }} pl-11">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197">
                            </path>
                        </svg>
                        Performa Tim
                    </a>
                    {{-- 2. Analitik Pelanggan --}}
                    <a href="{{ route('founder.analytics.customer.index') }}"
                        class="{{ $linkClass(Str::startsWith($currentRoute, 'founder.analytics.customer.')) }} pl-11">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        Pelanggan
                    </a>
                    {{-- 3. Analitik Produk --}}
                    <a href="{{ route('founder.analytics.product.index') }}"
                        class="{{ $linkClass(Str::startsWith($currentRoute, 'founder.analytics.product.')) }} pl-11">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Produk
                    </a>
                </div>
            </div>

            {{-- Pengaturan --}}
            <a href="#" class="{{ $linkClass($currentRoute === 'founder.pengaturan') }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.82 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.82 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.82-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.82-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan
            </a>
        </div>

        {{-- Footer Sidebar: User Info & Logout --}}
        @auth
            <div class="px-4 py-5 border-t border-gray-700 bg-gray-900">
                <div class="flex items-center mb-4">
                    <img class="h-10 w-10 rounded-full object-cover mr-3 border-2 border-indigo-400"
                        src="https://placehold.co/40x40/4F46E5/FFFFFF?text={{ substr(Auth::user()->name, 0, 1) }}"
                        alt="Avatar">
                    <div>
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">Founder</p>
                    </div>
                </div>

                {{-- Form Logout (Disembunyikan) --}}
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>

                {{-- Tombol Logout yang memicu modal --}}
                <button type="button" @click="logoutModalOpen = true"
                    class="w-full flex items-center justify-center bg-red-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-red-700 transition transform hover:shadow-lg">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>

            </div>
        @endauth
    </div>

    <div class="flex-1 flex flex-col overflow-x-hidden">
        <header class="flex items-center justify-between px-4 py-3 bg-white border-b border-gray-200 shadow md:hidden">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <a href="{{ route('founder.dashboard') }}"
                class="text-xl font-extrabold tracking-wider text-indigo-600 uppercase">
                GAY.ID
            </a>
            <div class="flex items-center space-x-3">
                <button class="relative text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span
                        class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full ring-2 ring-white"></span>
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-8">
            <div class="max-w-7xl mx-auto">

                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-3xl font-extrabold text-gray-900">
                        {{-- Judul Halaman dinamis --}}
                        {{ $header ?? 'Dashboard' }}
                    </h1>

                    <div class="flex items-center space-x-4">
                        <div class="relative hidden sm:block">
                            <input type="text" placeholder="Cari data, laporan..."
                                class="pl-10 pr-4 py-2 w-64 border border-gray-300 rounded-xl text-sm focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-150">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                                </svg>
                            </div>
                        </div>

                        <button
                            class="relative p-2 text-gray-500 bg-gray-100 rounded-full hover:bg-indigo-50 hover:text-indigo-600 transition hidden md:block">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span
                                class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full ring-2 ring-white"></span>
                        </button>
                    </div>
                </div>

                {{ $slot }}

            </div>
        </main>
    </div>

    <div x-show="logoutModalOpen" x-cloak
        class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-80 transition-opacity duration-300"
        aria-labelledby="modal-title" role="dialog" aria-modal="true" @click.away="logoutModalOpen = false">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div x-show="logoutModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full w-full">

                <div class="p-6">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.398 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Konfirmasi Keluar (Logout)
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin keluar dari akun Anda? Anda harus masuk lagi untuk mengakses
                                    dashboard.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    {{-- Tombol konfirmasi yang akan men-submit form logout --}}
                    <button type="button" @click="document.getElementById('logout-form').submit()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition duration-150">
                        Ya, Keluar
                    </button>
                    {{-- Tombol Batal yang akan menutup modal --}}
                    <button type="button" @click="logoutModalOpen = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition duration-150">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>