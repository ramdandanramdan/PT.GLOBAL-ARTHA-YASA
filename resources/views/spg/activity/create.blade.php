<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <i class="fa-solid fa-list-check text-indigo-600 text-2xl"></i>
            <span class="text-xl font-extrabold text-gray-900 tracking-tight">Laporan Aktivitas Promosi Harian</span>
        </div>
    </x-slot>

    {{-- MEMUAT FONT AWESOME UNTUK Ikon --}}
    @push('styles')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    @endpush

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        
        {{-- Card Utama Kontainer dengan Shadow yang Lebih Dalam --}}
        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border-t-8 border-indigo-600/70 p-8 md:p-10">
            
            {{-- Header Form dengan Indikator Progress (Dummy) --}}
            <div class="mb-8 pb-4 border-b border-gray-200">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Buat Laporan Aktivitas</h2>
                <p class="text-gray-500">Isi setiap bagian dengan detail yang relevan dan pastikan foto promosi yang diunggah jelas.</p>
                
                <div class="mt-4 flex items-center space-x-2 text-sm text-gray-600">
                    <i class="fa-solid fa-gauge-high text-indigo-500"></i>
                    <span class="font-semibold">Status:</span>
                    <span class="text-indigo-700 font-bold">Langkah 1 dari 2 (Detail Aktivitas)</span>
                </div>
            </div>

            {{-- KRITIS: Ganti action="#" menjadi action="{{ route('spg.activity.store') }}" --}}
            <form action="{{ route('spg.activity.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- SECTION 1: Detail Utama Kegiatan --}}
                <div class="space-y-6 mb-8 p-6 bg-indigo-50/50 rounded-xl border border-indigo-100">
                    <h3 class="text-xl font-bold text-indigo-800 flex items-center">
                        <i class="fa-solid fa-clipboard-list mr-3 text-2xl"></i> Detail Aktivitas Dasar
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Field 1: Jenis Aktivitas (Select yang lebih tebal) --}}
                        <div class="space-y-1">
                            <label for="activity_type" class="block text-sm font-bold text-gray-700">Jenis Aktivitas <span class="text-red-500">*</span></label>
                            <select id="activity_type" name="activity_type" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                                <option value="" disabled selected>-- Pilih Jenis Aktivitas --</option>
                                <option value="banner_install">Pemasangan Banner / Materi Promosi</option>
                                <option value="product_demo">Demo Produk / Edukasi Konsumen</option>
                                <option value="stock_check">Pengecekan Stok & Display</option>
                                <option value="competition_analysis">Analisis Kompetitor</option>
                                <option value="other">Lain-lain</option>
                            </select>
                        </div>

                        {{-- Field 2: Tanggal dan Waktu (Menggunakan input date/time yang modern) --}}
                        <div class="space-y-1">
                            <label for="activity_time" class="block text-sm font-bold text-gray-700">Waktu Pelaksanaan <span class="text-red-500">*</span></label>
                            <input type="datetime-local" id="activity_time" name="activity_time" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                        </div>

                        {{-- Field 3: Lokasi (Full-width di bawah) --}}
                        <div class="md:col-span-2 space-y-1">
                            <label for="location" class="block text-sm font-bold text-gray-700">Lokasi / Nama Toko <span class="text-red-500">*</span></label>
                            <input type="text" id="location" name="location" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" 
                                placeholder="Contoh: Toko Maju Jaya, Area Display Elektronik">
                        </div>

                    </div>
                </div>

                {{-- SECTION 2: Deskripsi dan Hasil --}}
                <div class="space-y-6 mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fa-solid fa-marker mr-3 text-2xl"></i> Hasil dan Catatan
                    </h3>
                    
                    {{-- Field 4: Produk Promosi (Multi-select dummy/placeholder) --}}
                    <div class="space-y-1">
                        <label for="products_promoted" class="block text-sm font-bold text-gray-700">Produk yang Dipromosikan</label>
                        <select id="products_promoted" name="products_promoted[]" multiple
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-md focus:ring-green-500 focus:border-green-500 transition duration-150">
                            <option>Alpha Series (Prioritas)</option>
                            <option>Beta Series</option>
                            <option>Gamma Series (Baru)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih semua produk yang terlibat dalam kegiatan ini.</p>
                    </div>

                    {{-- Field 5: Deskripsi --}}
                    <div class="space-y-1">
                        <label for="description" class="block text-sm font-bold text-gray-700">Deskripsi Detail Kegiatan & Hasil <span class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="5" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" 
                            placeholder="Jelaskan langkah-langkah, tantangan yang dihadapi, hasil kuantitatif (jika ada), atau detail penting lainnya."></textarea>
                    </div>

                </div>

                {{-- SECTION 3: Upload Bukti Foto --}}
                <div class="space-y-6 p-6 bg-red-50/50 rounded-xl border border-red-200">
                    <h3 class="text-xl font-bold text-red-800 flex items-center">
                        <i class="fa-solid fa-camera-retro mr-3 text-2xl"></i> Bukti Foto (Wajib)
                    </h3>

                    {{-- Petunjuk Penting --}}
                    <div class="p-3 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-md shadow-sm">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i> **Penting:** Upload minimal **2 foto** (sebelum dan sesudah/bukti kegiatan) untuk verifikasi cepat.
                    </div>

                    {{-- Field 6: Upload Foto --}}
                    <div class="space-y-1">
                        <label for="photos" class="block text-sm font-bold text-gray-700">Unggah Foto Dokumentasi <span class="text-red-500">*</span></label>
                        
                        {{-- File Upload Area yang lebih modern --}}
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition duration-300 cursor-pointer">
                            <div class="space-y-1 text-center">
                                <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-400"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Unggah file</span>
                                        <input id="file-upload" name="photos[]" type="file" class="sr-only" multiple accept="image/*" required>
                                    </label>
                                    <p class="pl-1">atau tarik dan lepas</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG hingga 10MB per foto</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="mt-8 flex justify-end">
                    <button type="submit" 
                        class="inline-flex items-center px-8 py-3 border border-transparent text-lg font-extrabold rounded-full shadow-2xl text-white 
                                bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-white 
                                transition duration-300 transform hover:scale-[1.02] active:scale-95">
                        <i class="fa-solid fa-paper-plane mr-3 text-xl"></i> Kirim Laporan Profesional
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>