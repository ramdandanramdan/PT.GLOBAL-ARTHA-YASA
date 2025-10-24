@php
    // Data Dummy Profil SPG
    $spgProfile = [
        'name' => 'Adelia Putri N',
        'spg_id' => 'SPG-00789',
        'email' => 'adelia.putri@example.com',
        'phone' => '+62 812-3456-7890',
        'store' => 'Toko Budi Sentosa (Jaksel)',
        'position' => 'Senior Promotor',
        'join_date' => '2023-05-15',
        'profile_image_url' => 'https://via.placeholder.com/150/007bff/ffffff?text=AP', // Placeholder Image
    ];

    // Data Dummy Pengaturan
    $settings = [
        'notifications_enabled' => true,
        'language' => 'Bahasa Indonesia',
        'two_factor_enabled' => false,
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Akun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    {{-- HEADER & DESCRIPTION --}}
                    <div class="mb-8 border-b pb-4">
                        <h1 class="text-4xl font-extrabold text-gray-900 flex items-center">
                            <i class="fa-solid fa-gear mr-4 text-indigo-700"></i> Pengaturan Akun
                        </h1>
                        <p class="text-gray-500 mt-2 text-lg">Kelola informasi Anda dan sesuaikan pengalaman aplikasi.</p>
                    </div>

                    {{-- MAIN CONTENT WITH TABS (Alpine Dummy) --}}
                    <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-10" x-data="{ activeTab: 'profile' }">

                        {{-- LEFT: SIDEBAR NAVIGASI (EXTRA CLEAN) --}}
                        <div class="lg:w-1/4">
                            <nav class="flex flex-col space-y-2 p-3 bg-white rounded-xl lg:shadow-xl lg:border border-gray-100">
                                <h4 class="text-xs font-bold uppercase text-gray-400 mb-2 px-3 pt-2">MENU</h4>
                                
                                @php
                                    $navItems = [
                                        ['id' => 'profile', 'icon' => 'fa-user-circle', 'label' => 'Profil & Kontak'],
                                        ['id' => 'employment', 'icon' => 'fa-id-card', 'label' => 'Data Kepegawaian'], // NEW TAB
                                        ['id' => 'security', 'icon' => 'fa-shield-halved', 'label' => 'Keamanan & Sandi'],
                                        ['id' => 'preferences', 'icon' => 'fa-cogs', 'label' => 'Aplikasi & Preferensi'],
                                    ];
                                @endphp

                                @foreach ($navItems as $item)
                                    <button @click="activeTab = '{{ $item['id'] }}'" 
                                            :class="{'bg-indigo-600 text-white shadow-lg transform translate-x-1': activeTab === '{{ $item['id'] }}', 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700': activeTab !== '{{ $item['id'] }}'}"
                                            class="flex items-center space-x-3 px-4 py-3 rounded-xl font-semibold transition-all duration-300 text-left">
                                        <i class="fa-solid {{ $item['icon'] }} w-5 text-center"></i>
                                        <span class="truncate">{{ $item['label'] }}</span>
                                    </button>
                                @endforeach

                                <hr class="my-3 border-gray-200">

                                {{-- Log Out Link --}}
                                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-semibold text-red-600 hover:bg-red-50 transition duration-300 text-left">
                                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                                    <span>Keluar Akun</span>
                                </a>
                            </nav>
                        </div>

                        {{-- RIGHT: KONTEN TAB --}}
                        <div class="lg:w-3/4">

                            {{-- TAB 1: PROFIL DASAR (Clean Form & Avatar) --}}
                            <div x-show="activeTab === 'profile'" class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-100">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Profil & Informasi Kontak</h3>
                                
                                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">

                                    {{-- Foto Profil Section --}}
                                    <div class="flex items-center space-x-6 pb-6 border-b border-gray-100">
                                        <div class="relative">
                                            <img class="h-24 w-24 rounded-full object-cover shadow-lg border-4 border-white ring-2 ring-indigo-400" src="{{ $spgProfile['profile_image_url'] }}" alt="Foto Profil">
                                            <button type="button" class="absolute bottom-0 right-0 p-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition duration-200 shadow-lg border-2 border-white">
                                                <i class="fa-solid fa-camera text-xs"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Unggah gambar baru. Maks. 2MB, format JPG/PNG.</p>
                                        </div>
                                    </div>
                                    
                                    {{-- Input Grup --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        
                                        {{-- Nama Lengkap (Editable) --}}
                                        <div>
                                            <label for="name" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                                            <input type="text" id="name" value="{{ $spgProfile['name'] }}" placeholder="Masukkan nama lengkap Anda" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5">
                                        </div>
                                        
                                        {{-- Email (Disabled & Professional) --}}
                                        <div>
                                            <label for="email" class="block text-sm font-semibold text-gray-700">Email (ID Login)</label>
                                            <input type="email" id="email" value="{{ $spgProfile['email'] }}" disabled class="mt-1 block w-full border-red-300 bg-red-50 rounded-lg shadow-inner cursor-not-allowed p-2.5">
                                            <p class="mt-1 text-xs text-red-600 flex items-center">
                                                <i class="fa-solid fa-info-circle mr-1"></i> Email tidak dapat diubah sendiri. Hubungi HR.
                                            </p>
                                        </div>
                                        
                                        {{-- Nomor Telepon (Editable) --}}
                                        <div>
                                            <label for="phone" class="block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                                            <input type="text" id="phone" value="{{ $spgProfile['phone'] }}" placeholder="Format: +62 8xx" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5">
                                        </div>

                                    </div>

                                    {{-- Tombol Simpan --}}
                                    <div class="pt-6 border-t border-gray-200 flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 transform hover:scale-[1.01]">
                                            <i class="fa-solid fa-cloud-arrow-up mr-2"></i> PERBARUI PROFIL
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- TAB 2: DATA KEPEGAWAIAN (NEW UI FRIENDLY READ-ONLY TAB) --}}
                            <div x-show="activeTab === 'employment'" class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-100">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Detail Kepegawaian (Read Only)</h3>
                                <p class="text-gray-500 mb-6">Informasi ini diambil dari data HR dan tidak dapat diubah oleh Anda.</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- SPG ID --}}
                                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-indigo-500 shadow-sm">
                                        <p class="text-sm font-medium text-gray-500">ID Promotor (SPG ID)</p>
                                        <p class="text-xl font-extrabold text-indigo-700 mt-1">{{ $spgProfile['spg_id'] }}</p>
                                    </div>
                                    {{-- Tanggal Bergabung --}}
                                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-indigo-500 shadow-sm">
                                        <p class="text-sm font-medium text-gray-500">Tanggal Bergabung</p>
                                        <p class="text-xl font-extrabold text-gray-700 mt-1">{{ \Carbon\Carbon::parse($spgProfile['join_date'])->format('d M Y') }}</p>
                                    </div>
                                    {{-- Posisi --}}
                                    <div class="md:col-span-1 bg-gray-50 p-4 rounded-lg border-l-4 border-indigo-500 shadow-sm">
                                        <p class="text-sm font-medium text-gray-500">Jabatan/Posisi</p>
                                        <p class="text-xl font-extrabold text-gray-700 mt-1">{{ $spgProfile['position'] }}</p>
                                    </div>
                                    {{-- Lokasi Tugas --}}
                                    <div class="md:col-span-1 bg-gray-50 p-4 rounded-lg border-l-4 border-indigo-500 shadow-sm">
                                        <p class="text-sm font-medium text-gray-500">Lokasi Penugasan</p>
                                        <p class="text-xl font-extrabold text-gray-700 mt-1">{{ $spgProfile['store'] }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- TAB 3: KEAMANAN --}}
                            <div x-show="activeTab === 'security'" class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-100">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Keamanan Akun</h3>
                                
                                <div class="space-y-8">
                                    
                                    {{-- Ganti Password Card --}}
                                    <div class="p-6 border border-gray-200 rounded-xl shadow-lg bg-red-50">
                                        <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                            <i class="fa-solid fa-key mr-2 text-red-600"></i> Ganti Kata Sandi
                                        </h4>
                                        <form class="space-y-4">
                                            <div>
                                                <label for="current_password" class="block text-sm font-medium text-gray-700">Kata Sandi Saat Ini</label>
                                                <input type="password" id="current_password" placeholder="Masukkan sandi lama" class="mt-1 block w-full md:w-3/4 border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-2.5">
                                            </div>
                                            <div>
                                                <label for="new_password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                                                <input type="password" id="new_password" placeholder="Masukkan sandi baru yang kuat" class="mt-1 block w-full md:w-3/4 border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-2.5">
                                                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter, mengandung huruf kapital, angka, dan simbol.</p>
                                            </div>
                                            <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-bold rounded-xl text-white bg-red-600 hover:bg-red-700 transition duration-200 shadow-md">
                                                <i class="fa-solid fa-lock mr-2"></i> Ubah Kata Sandi
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Two-Factor Card (Toggle Switch) --}}
                                    <div class="p-6 border border-gray-200 rounded-xl shadow-lg flex justify-between items-center bg-green-50">
                                        <div>
                                            <h4 class="text-xl font-bold text-gray-800 mb-1 flex items-center">
                                                <i class="fa-solid fa-fingerprint mr-2 text-green-600"></i> Autentikasi Dua Faktor (2FA)
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                Aktifkan lapisan keamanan ekstra untuk melindungi akun Anda dari akses tidak sah.
                                            </p>
                                        </div>
                                        <div>
                                            @if ($settings['two_factor_enabled'])
                                                <span class="px-4 py-2 text-sm font-bold rounded-xl bg-green-500 text-white shadow-md">Aktif</span>
                                            @else
                                                <button type="button" class="px-4 py-2 text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 transition duration-200 shadow-md">
                                                    Aktifkan Sekarang
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- TAB 4: PREFERENSI APLIKASI --}}
                            <div x-show="activeTab === 'preferences'" class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-100">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Pengaturan Aplikasi</h3>

                                <form class="space-y-6">
                                    
                                    {{-- Notifikasi (UI Friendly Toggle) --}}
                                    <div class="flex justify-between items-center p-4 border border-gray-200 rounded-xl bg-gray-50">
                                        <div>
                                            <h4 class="font-bold text-lg text-gray-800">Notifikasi Real-time (Push)</h4>
                                            <p class="text-sm text-gray-600">Terima pemberitahuan untuk persetujuan/penolakan laporan, dan pengumuman tim.</p>
                                        </div>
                                        {{-- Toggle Switch --}}
                                        <label for="toggle_notif_2" class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" id="toggle_notif_2" class="sr-only peer" @if ($settings['notifications_enabled']) checked @endif>
                                            <div class="w-14 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-indigo-600"></div>
                                        </label>
                                    </div>
                                    
                                    {{-- Bahasa --}}
                                    <div class="p-4 border border-gray-200 rounded-xl">
                                        <label for="language_select" class="block text-sm font-bold text-gray-700 mb-2">Pilih Bahasa</label>
                                        <select id="language_select" class="block w-full md:w-1/3 border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5">
                                            <option @if($settings['language'] == 'Bahasa Indonesia') selected @endif>Bahasa Indonesia (Default)</option>
                                            <option @if($settings['language'] == 'English (US)') selected @endif>English (US)</option>
                                        </select>
                                        <p class="mt-1 text-xs text-gray-500">Bahasa aplikasi akan diperbarui setelah menyimpan.</p>
                                    </div>
                                    
                                    {{-- Tombol Simpan --}}
                                    <div class="pt-6 border-t border-gray-200 flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 transform hover:scale-[1.01]">
                                            <i class="fa-solid fa-floppy-disk mr-2"></i> SIMPAN PREFERENSI
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>