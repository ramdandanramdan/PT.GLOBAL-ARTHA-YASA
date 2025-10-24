@php
    // Data Dummy Kategori Bantuan
    $helpCategories = [
        ['title' => 'Target & Komisi', 'icon' => 'fa-trophy', 'description' => 'Detail perhitungan, pencapaian target, dan tanggal pembayaran komisi.', 'color' => 'border-indigo-500 text-indigo-700'],
        ['title' => 'Absensi & Lokasi', 'icon' => 'fa-location-dot', 'description' => 'Panduan check-in/out, kendala GPS, dan prosedur izin/cuti.', 'color' => 'border-green-500 text-green-700'],
        ['title' => 'Laporan Aktivitas', 'icon' => 'fa-clipboard-list', 'description' => 'Cara upload bukti, format foto, dan proses review laporan harian.', 'color' => 'border-yellow-500 text-yellow-700'],
        ['title' => 'Stok & Produk', 'icon' => 'fa-boxes-stacked', 'description' => 'Manajemen stok, selisih inventaris, dan informasi produk terbaru.', 'color' => 'border-red-500 text-red-700'],
    ];

    // Data Dummy FAQ
    $faqs = [
        ['q' => 'Bagaimana cara mengajukan cuti mendadak?', 'a' => 'Ajukan permohonan melalui menu "Absensi" > "Izin Cuti" minimal 1 hari sebelumnya. Untuk cuti mendadak, segera hubungi supervisor Anda via WhatsApp dan ikuti dengan pengajuan di aplikasi.'],
        ['q' => 'Apa yang harus dilakukan jika aplikasi error saat check-in?', 'a' => 'Pertama, pastikan koneksi internet stabil. Jika masalah berlanjut, ambil tangkapan layar (screenshot) error dan kirimkan tiket bantuan dengan kategori "Masalah Teknis - Absensi". Lakukan absensi manual via Supervisor sebagai backup.'],
        ['q' => 'Bagaimana cara melihat detail perhitungan komisi per unit?', 'a' => 'Akses menu "Target & Komisi" lalu pilih tab "Detail Komisi". Di sana terdapat rincian perhitungan berdasarkan capaian unit dan nilai penjualan kotor Anda.'],
        ['q' => 'Berapa lama rata-rata waktu persetujuan laporan aktivitas harian?', 'a' => 'Standar waktu persetujuan adalah 1-5 jam kerja. Jika lebih dari 8 jam kerja, segera cek riwayat laporan Anda dan buat tiket jika status masih "Menunggu Review".'],
    ];
@endphp

<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pusat Bantuan & Dukungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            {{-- 1. HEADER PUSAT BANTUAN (Extra Professional & Clean) --}}
            <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-xl">
                <div class="flex items-center justify-center space-x-4 mb-4">
                    <i class="fa-solid fa-headset text-4xl text-indigo-600"></i>
                    <h1 class="text-3xl font-extrabold text-gray-900">Pusat Dukungan SPG</h1>
                </div>
                <p class="text-center text-gray-600 mb-6 max-w-2xl mx-auto">
                    Temukan jawaban cepat di basis pengetahuan kami untuk semua pertanyaan mengenai performa, laporan, dan sistem aplikasi.
                </p>
                
                {{-- Search Bar Prominent --}}
                <div class="max-w-xl mx-auto relative">
                    <input type="text" placeholder="Cari topik bantuan atau kata kunci..." class="w-full py-3 pl-12 pr-4 text-gray-800 border border-gray-300 rounded-xl shadow-lg focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-300">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            {{-- 2. KATEGORI UTAMA (Clean Card Grid) --}}
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 flex items-center">
                    <i class="fa-solid fa-layer-group mr-3 text-indigo-600"></i> Eksplorasi Topik
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($helpCategories as $category)
                        <a href="#" class="block p-6 bg-white rounded-xl shadow-lg border-l-4 {{ $category['color'] }} hover:shadow-xl hover:bg-gray-50 transition duration-300 transform">
                            <div class="flex items-center space-x-4">
                                <i class="fa-solid {{ $category['icon'] }} text-3xl {{ $category['color'] }} opacity-70"></i>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 mb-1">{{ $category['title'] }}</h4>
                                    <p class="text-xs text-gray-600">{{ $category['description'] }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- 3. FAQ KLASIK & PROFESIONAL (HTML Details Tag) --}}
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 flex items-center">
                    <i class="fa-solid fa-book-open mr-3 text-indigo-600"></i> Pertanyaan Yang Sering Diajukan (FAQ)
                </h3>
                
                <div class="space-y-4">
                    @foreach ($faqs as $key => $faq)
                        <details class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden group">
                            {{-- Pertanyaan --}}
                            <summary class="w-full text-left p-5 flex justify-between items-center text-lg font-semibold text-gray-800 cursor-pointer hover:bg-indigo-50 transition duration-200">
                                <span>{{ $faq['q'] }}</span>
                                <i class="fa-solid fa-chevron-down text-sm text-gray-500 transition-transform duration-300 group-open:rotate-180 group-open:text-indigo-600"></i>
                            </summary>

                            {{-- Jawaban --}}
                            <div class="p-5 pt-0 text-gray-700 border-t border-indigo-200">
                                <p class="pl-4 border-l-4 border-indigo-500 text-sm">
                                    {{ $faq['a'] }}
                                </p>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>

            {{-- 4. OPSI DUKUNGAN LANJUTAN (Grid Profesional) --}}
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 flex items-center">
                    <i class="fa-solid fa-life-ring mr-3 text-indigo-600"></i> Butuh Dukungan Langsung?
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Kartu 1: Tiket Bantuan (CTA Utama) --}}
                    <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-200 shadow-lg">
                        <i class="fa-solid fa-ticket-simple text-3xl text-indigo-600 mb-3"></i>
                        <h5 class="font-bold text-lg text-gray-800 mb-2">Buat Tiket Baru</h5>
                        <p class="text-sm text-gray-700 mb-4">Laporkan masalah teknis atau pertanyaan data yang membutuhkan verifikasi formal.</p>
                        <a href="#" class="w-full inline-block text-center bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition duration-300">
                            Mulai Buat Tiket
                        </a>
                    </div>

                    {{-- Kartu 2: Hotline (Emergency) --}}
                    <div class="bg-red-50 p-6 rounded-xl border border-red-200 shadow-lg">
                        <i class="fa-solid fa-phone-volume text-3xl text-red-600 mb-3"></i>
                        <h5 class="font-bold text-lg text-gray-800 mb-2">Hotline (Darurat)</h5>
                        <p class="text-sm text-gray-700 mb-4">Gunakan ini hanya untuk masalah sangat krusial di luar jam kerja (misal: Keamanan).</p>
                        <a href="tel:+62812xxxxxxx" class="w-full inline-block text-center bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition duration-300">
                            Hubungi Sekarang
                        </a>
                    </div>
                    
                    {{-- Kartu 3: Riwayat Tiket Anda --}}
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 shadow-lg">
                        <i class="fa-solid fa-clock-rotate-left text-3xl text-gray-600 mb-3"></i>
                        <h5 class="font-bold text-lg text-gray-800 mb-2">Riwayat Tiket</h5>
                        <p class="text-sm text-gray-700 mb-4">Lihat status dan respons dari semua tiket bantuan yang pernah Anda ajukan sebelumnya.</p>
                        <a href="#" class="w-full inline-block text-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-300 transition duration-300">
                            Cek Status Tiket
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>