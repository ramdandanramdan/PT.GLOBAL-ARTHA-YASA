@php
    // --- DATA DUMMY ABSENSI ---
    // Status absensi dinamis (Ubah nilai ini untuk simulasi)
    $hasCheckedIn = false; // Ubah ke true jika sudah clock-in
    $hasCheckedOut = false;
    
    // Data dummy
    $checkInTime = $hasCheckedIn ? '07:55 WIB' : '-';
    $checkOutTime = $hasCheckedOut ? '16:05 WIB' : '-';
    $currentLocation = 'Global Artha Yasa Store - Blok M'; // Nama Lokasi Target
    $currentTime = date('H:i:s'); // Waktu saat ini (untuk simulasi)

    // Logika Status Absensi
    if ($hasCheckedIn && !$hasCheckedOut) {
        $statusMessage = 'Anda sudah Clock-In pada pukul ' . $checkInTime . '. Selamat bekerja!';
        $statusColor = 'blue';
    } elseif ($hasCheckedIn && $hasCheckedOut) {
        $statusMessage = 'Absensi Selesai. Anda sudah Clock-Out pada pukul ' . $checkOutTime . '. Terima kasih.';
        $statusColor = 'green';
    } else {
        $statusMessage = 'Anda belum Clock-In hari ini. Segera Clock-In untuk memulai shift.';
        $statusColor = 'yellow';
    }

    // Tentukan class berdasarkan status
    $checkInButtonDisabled = $hasCheckedIn ? 'disabled' : '';
    $checkOutButtonDisabled = !$hasCheckedIn || $hasCheckedOut ? 'disabled' : '';
@endphp

<x-app-layout>
    <x-slot name="header">
        Absensi Lokasi Kerja SPG
    </x-slot>

    {{-- SCRIPTS: AOS dan MAP (Simulasi) --}}
    @push('styles')
        {{-- AOS CSS --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @endpush

    @push('scripts')
        {{-- AOS JS --}}
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800, // Durasi animasi
                once: true,    // Hanya animasi sekali saat scroll
            });
            
            // Script untuk mengambil waktu saat ini
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
                document.getElementById('current-time').innerText = timeString + ' WIB';
                setTimeout(updateTime, 1000);
            }
            updateTime();

            // Script Lokasi Nyata (Perlu implementasi API Geolocation)
            // function getCurrentLocation() {
            //     // Implementasi browser geolocation API di sini
            // }
        </script>
    @endpush

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: Form Absensi (2/3 Lebar) --}}
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- KARTU UTAMA: Status & Form Clock-In/Out --}}
                    <div class="bg-white overflow-hidden shadow-2xl rounded-2xl p-8 border-t-4 border-indigo-500" data-aos="fade-up">
                        
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center">
                            <i class="fa-solid fa-clock-rotate-left mr-3 text-indigo-600"></i> Absensi Lokasi Aktif
                        </h3>
                        
                        {{-- Visual Status Absensi --}}
                        <div class="mb-8 p-6 rounded-xl border border-{{ $statusColor }}-300 bg-{{ $statusColor }}-50/70 text-{{ $statusColor }}-800 shadow-md transition duration-500">
                            <div class="flex items-center justify-between">
                                <p class="text-lg font-bold flex items-center">
                                    <i class="fa-solid fa-circle-info mr-3 text-{{ $statusColor }}-600"></i>
                                    Status Hari Ini
                                </p>
                                <span id="current-time" class="text-xl font-extrabold text-gray-800">{{ $currentTime }} WIB</span>
                            </div>
                            <p class="text-sm mt-3">{{ $statusMessage }}</p>
                        </div>

                        {{-- Form Clock-In/Out --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Form Clock-In (AOS: Fade-Up Delay 200) --}}
                            <form action="{{ route('spg.absensi.checkIn') }}" method="POST" class="p-6 rounded-xl shadow-xl border border-green-200 bg-green-50/50 transition duration-300 hover:shadow-2xl hover:bg-green-100" data-aos="fade-up" data-aos-delay="200">
                                @csrf
                                <h4 class="text-2xl font-bold mb-3 text-green-700 flex items-center">
                                    <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Clock-In
                                </h4>
                                <p class="text-sm text-gray-600 mb-4">Mulai shift Anda. Mencatat waktu dan lokasi kedatangan.</p>

                                {{-- Input Lokasi & Waktu (Readonly) --}}
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Lokasi Anda</label>
                                    <input type="text" name="location" value="Koordinat GPS Saat Ini (Simulasi)" class="w-full border-green-300/50 rounded-lg shadow-sm bg-white" readonly>
                                </div>

                                <button type="submit" class="w-full text-white px-4 py-3 rounded-xl font-extrabold transition duration-300 transform hover:scale-[1.01] 
                                    {{ $hasCheckedIn ? 'bg-gray-400 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700 shadow-md shadow-green-500/50' }}" {{ $checkInButtonDisabled }}>
                                    <i class="fa-solid fa-play mr-2"></i> {{ $hasCheckedIn ? 'SUDAH Clock-IN' : 'Clock-IN SEKARANG' }}
                                </button>
                            </form>

                            {{-- Form Clock-Out (AOS: Fade-Up Delay 400) --}}
                            <form action="{{ route('spg.absensi.checkOut') }}" method="POST" class="p-6 rounded-xl shadow-xl border border-red-200 bg-red-50/50 transition duration-300 hover:shadow-2xl hover:bg-red-100 {{ $checkOutButtonDisabled ? 'opacity-70' : '' }}" data-aos="fade-up" data-aos-delay="400">
                                @csrf
                                <h4 class="text-2xl font-bold mb-3 text-red-700 flex items-center">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Clock-Out
                                </h4>
                                <p class="text-sm text-gray-600 mb-4">Akhiri shift Anda. Mencatat waktu dan lokasi kepulangan.</p>

                                {{-- Input Lokasi & Waktu (Readonly) --}}
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Lokasi Anda</label>
                                    <input type="text" name="location_out" value="Koordinat GPS Saat Ini (Simulasi)" class="w-full border-red-300/50 rounded-lg shadow-sm bg-white" readonly disabled>
                                </div>

                                <button type="submit" class="w-full text-white px-4 py-3 rounded-xl font-extrabold transition duration-300 transform hover:scale-[1.01]
                                    {{ $checkOutButtonDisabled ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-600 hover:bg-red-700 shadow-md shadow-red-500/50' }}" {{ $checkOutButtonDisabled }}>
                                    <i class="fa-solid fa-stop mr-2"></i> {{ $hasCheckedOut ? 'ABSENSI SELESAI' : 'CLOCK-OUT SEKARANG' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: Ringkasan & Peta (1/3 Lebar) --}}
                <div class="lg:col-span-1 space-y-8">

                    {{-- KARTU RINGKASAN ABSENSI HARI INI (AOS: Fade-Left) --}}
                    <div class="p-6 bg-white shadow-xl rounded-2xl border border-gray-100" data-aos="fade-left">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 border-indigo-100 flex items-center">
                            <i class="fa-solid fa-calendar-day mr-2 text-indigo-500"></i> Ringkasan Hari Ini
                        </h4>
                        <ul class="space-y-3">
                            <li class="flex justify-between items-center text-sm font-medium">
                                <span class="text-gray-500">Target Lokasi:</span>
                                <span class="font-semibold text-gray-800">{{ $currentLocation }}</span>
                            </li>
                            <li class="flex justify-between items-center text-sm font-medium">
                                <span class="text-gray-500">Waktu Clock-In:</span>
                                <span class="font-extrabold text-green-600">{{ $checkInTime }}</span>
                            </li>
                            <li class="flex justify-between items-center text-sm font-medium">
                                <span class="text-gray-500">Waktu Clock-Out:</span>
                                <span class="font-extrabold text-red-600">{{ $checkOutTime }}</span>
                            </li>
                        </ul>
                    </div>
                    
                    {{-- KARTU PETA LOKASI (Simulasi) (AOS: Fade-Left Delay 200) --}}
                    <div class="p-6 bg-white shadow-xl rounded-2xl border border-gray-100" data-aos="fade-left" data-aos-delay="200">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 border-indigo-100 flex items-center">
                            <i class="fa-solid fa-map-location-dot mr-2 text-indigo-500"></i> Area Kerja
                        </h4>
                        <p class="text-xs text-gray-500 mb-3">Radius absensi yang diperbolehkan telah diatur.</p>
                        {{-- Placeholder Peta Simulasi --}}
                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-sm border border-dashed border-gray-400">
                            Peta Lokasi Toko (Simulasi Google Maps/Leaflet)
                        </div>
                        <p class="text-xs text-center text-gray-400 mt-2">Pastikan GPS Anda Aktif</p>
                    </div>

                    {{-- KARTU INFO JARINGAN (AOS: Fade-Left Delay 400) --}}
                    <div class="p-6 bg-white shadow-xl rounded-2xl border border-gray-100" data-aos="fade-left" data-aos-delay="400">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 border-indigo-100 flex items-center">
                            <i class="fa-solid fa-wifi mr-2 text-indigo-500"></i> Koneksi & GPS
                        </h4>
                        <div class="flex justify-between items-center text-sm font-medium">
                            <span class="text-gray-500">Status Jaringan:</span>
                            <span class="font-semibold text-green-600 flex items-center"><i class="fa-solid fa-check-circle mr-1"></i> Terhubung</span>
                        </div>
                        <div class="flex justify-between items-center text-sm font-medium mt-2">
                            <span class="text-gray-500">Akurasi GPS:</span>
                            <span class="font-semibold text-red-600 flex items-center"><i class="fa-solid fa-circle-xmark mr-1"></i> Low Akurasi (Simulasi)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>