<x-app-layout>
    <x-slot name="header">
        Pesan & Koordinasi Tim
    </x-slot>

    <div class="py-0">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-2xl shadow-blue-200/50 sm:rounded-xl flex h-[80vh] min-h-[600px] border border-gray-100/50">

                {{-- Kolom Kiri: Daftar Pesan --}}
                <div class="w-full md:w-1/3 border-r border-gray-100 bg-gray-50 flex flex-col">
                    
                    <div class="p-4 border-b border-gray-200 bg-white shadow-inner">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-black text-gray-900">Kotak Masuk</h3>
                            <span class="px-3 py-1 text-xs font-extrabold text-white bg-red-600 rounded-full">3 Baru</span>
                        </div>
                    </div>

                    {{-- Daftar Threads --}}
                    <div class="overflow-y-auto flex-grow">
                        
                        {{-- Thread Aktif (Manager) --}}
                        <div class="flex items-center p-4 border-b border-gray-100 bg-blue-50 hover:bg-blue-100 transition cursor-pointer border-l-4 border-blue-600">
                            <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-600 text-lg font-bold text-white mr-4 shadow-md">D</span>
                            <div class="flex-grow">
                                <p class="text-sm font-extrabold text-gray-900 truncate">Manager Dwi</p>
                                <p class="text-xs text-blue-600 truncate font-semibold">Tugas Cepat: Laporan Foto Promosi!</p>
                            </div>
                            <span class="text-xs text-blue-600 font-bold">1h</span>
                        </div>

                        {{-- Thread Belum Dibaca (Founder) --}}
                        <div class="flex items-center p-4 border-b border-gray-100 hover:bg-gray-100 transition cursor-pointer bg-white">
                            <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-red-600 text-lg font-bold text-white mr-4 shadow-md">B</span>
                            <div class="flex-grow">
                                <p class="text-sm font-bold text-gray-900 truncate">Founder Bima</p>
                                <p class="text-xs text-gray-500 truncate">Perluasan Area: Market Baru...</p>
                            </div>
                            <span class="text-xs text-red-600 font-bold">Baru</span>
                        </div>
                        
                    </div>
                </div>

                {{-- Kolom Kanan: Detail Pesan Aktif --}}
                <div class="w-full md:w-2/3 flex flex-col">
                    
                    {{-- Header Chat --}}
                    <div class="p-4 border-b border-gray-200 flex items-center bg-white shadow-md z-10">
                        <i class="fa-solid fa-user-tie text-blue-600 mr-3 text-2xl"></i> 
                        <h3 class="text-xl font-extrabold text-gray-900 mr-3">Manager Dwi</h3>
                        <span class="text-xs font-semibold px-3 py-1 bg-green-100 text-green-700 rounded-full border border-green-300">Online</span>
                    </div>

                    {{-- Isi Chat --}}
                    <div class="flex-grow overflow-y-auto p-8 space-y-6 bg-gray-50/50">
                        
                        {{-- Divider Waktu --}}
                        <div class="flex justify-center">
                            <span class="text-xs text-gray-500 px-4 py-1 bg-white rounded-full shadow-lg border border-gray-200">Hari Ini, 10:30 WIB</span>
                        </div>
                        
                        {{-- Pesan Masuk (Manager) - Aksi Cepat --}}
                        <div class="flex justify-start">
                            <div class="bg-white max-w-lg p-5 rounded-t-xl rounded-br-xl shadow-2xl border-l-4 border-red-500">
                                <p class="text-sm text-gray-800 font-bold mb-3 flex items-center"><i class="fa-solid fa-triangle-exclamation text-red-500 mr-2"></i> PENTING: PERMINTAAN LAPORAN FOTO</p>
                                <p class="text-sm text-gray-700">Deadline adalah **pukul 15.00** hari ini. Segera kirimkan foto aktivitas promosi produk 'Alpha'.</p>
                                
                                {{-- Creative Element: Action Card --}}
                                <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg flex justify-between items-center shadow-inner">
                                    <p class="text-xs font-extrabold text-red-700">STATUS: Belum Selesai</p>
                                    <a href="{{ route('spg.activity.create') }}" 
                                       class="px-4 py-1 text-xs font-bold text-white bg-red-600 rounded-full hover:bg-red-700 shadow-md">
                                        LAPOR SEKARANG <i class="fa-solid fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Pesan Keluar (SPG) --}}
                        <div class="flex justify-end">
                            <div class="bg-blue-600 max-w-lg p-3 rounded-t-xl rounded-bl-xl shadow-xl shadow-blue-400/50">
                                <p class="text-sm text-white">Siap, Manager Dwi. Laporan foto Alpha akan saya kirimkan sebelum deadline.</p>
                                <span class="block text-right text-xs text-blue-200 mt-2">10:45 WIB <i class="fa-solid fa-check-double ml-1 text-blue-300"></i></span>
                            </div>
                        </div>
                        
                    </div>

                    {{-- Footer: Input Balasan --}}
                    <div class="p-4 border-t border-gray-200 bg-white shadow-2xl">
                        <div class="flex items-center space-x-3">
                            <input type="text" placeholder="Balas Manager Dwi..." 
                                   class="flex-grow py-3 px-5 border-2 border-gray-200 rounded-full text-sm focus:ring-blue-500 focus:border-blue-500 bg-white shadow-inner">
                            
                            <button class="p-3 bg-blue-600 hover:bg-blue-700 rounded-full text-white shadow-xl transform hover:scale-105" title="Kirim Pesan">
                                <i class="fa-solid fa-paper-plane text-lg"></i>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>