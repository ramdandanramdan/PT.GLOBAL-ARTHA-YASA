{{--
File: resources/views/founder/analytics/team/show.blade.php
Versi: Desain Ulang (Modern, Profesional, Responsif)
Perubahan:
- MENAMBAHKAN TOMBOL KEMBALI di luar x-slot header.
- Layout diubah menjadi 2 kolom (Profil di kiri, Data di kanan).
- Kartu profil yang lebih menonjol dengan avatar dan status.
- Kartu Kinerja dengan progress bar yang lebih besar dan visual.
- Menambahkan tabel placeholder untuk Riwayat Absensi dan Transaksi Terakhir.
--}}
<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- FITUR KEMBALI (Di luar x-slot header) --}}
            <div class="mb-6 px-4 sm:px-0">
                {{-- Tombol Kembali yang Rapi --}}
                <a href="{{ route('founder.analytics.team.index') }}"
                    class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Tim
                </a>
            </div>
            {{-- AKHIR FITUR KEMBALI --}}

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- KOLOM KIRI: KARTU PROFIL --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 text-center">
                        <img class="h-24 w-24 rounded-full mx-auto shadow-md"
                            src="https://ui-avatars.com/api/?name={{ urlencode($salesPerson->name) }}&background=EBF4FF&color=4299E1&size=128"
                            alt="Avatar">

                        <h3 class="text-2xl font-bold text-gray-900 mt-4">{{ $salesPerson->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $salesPerson->email }}</p>

                        <div class="mt-4">
                            @if ($salesPerson->is_active)
                                <span
                                    class="px-4 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <svg class="-ml-0.5 mr-1.5 h-4 w-4 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Aktif
                                </span>
                            @else
                                <span
                                    class="px-4 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <svg class="-ml-0.5 mr-1.5 h-4 w-4 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Nonaktif
                                </span>
                            @endif
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200 text-left space-y-3">
                            <p class="text-sm text-gray-500 flex justify-between">
                                <span class="font-medium text-gray-600">Telepon:</span>
                                <span>{{ $salesPerson->phone ?? 'N/A' }}</span>
                            </p>
                            <p class="text-sm text-gray-500 flex justify-between">
                                <span class="font-medium text-gray-600">Role:</span>
                                <span>{{ $salesPerson->role->name ?? 'Sales' }}</span>
                            </p>
                            <p class="text-sm text-gray-500 flex justify-between">
                                <span class="font-medium text-gray-600">Bergabung:</span>
                                <span>{{ $salesPerson->created_at ? $salesPerson->created_at->format('d M Y') : 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: KARTU DATA --}}
                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Kinerja (Bulan Ini)</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                                <p class="text-4xl font-bold text-indigo-600 mt-1">
                                    {{ number_format($salesPerson->total_sales ?? 0) }} <span
                                        class="text-lg font-medium text-gray-400">Unit</span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Target</p>
                                <p class="text-4xl font-bold text-gray-900 mt-1">
                                    {{ number_format($salesPerson->target ?? 0) }} <span
                                        class="text-lg font-medium text-gray-400">Unit</span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-sm font-medium text-gray-500">Pencapaian</p>
                            @php
                                $target = $salesPerson->target ?? 0;
                                $salesValue = $salesPerson->total_sales ?? 0;
                                $percentage = ($target > 0) ? ($salesValue / $target) * 100 : 0;
                                $progressBarColor = $percentage >= 80 ? 'bg-green-500' : ($percentage >= 40 ?
                                    'bg-yellow-500' : 'bg-red-500');
                            @endphp
                            <div class="flex items-center mt-2">
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="{{ $progressBarColor }} h-4 rounded-full text-xs font-bold text-white text-center flex items-center justify-center"
                                        style="width: {{ min($percentage, 100) }}%">
                                        @if($percentage > 10)
                                            {{ number_format($percentage, 1) }}%
                                        @endif
                                    </div>
                                </div>
                                @if($percentage <= 10) <span class="text-sm font-semibold text-gray-700 ml-3">
                                    {{ number_format($percentage, 1) }}%</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Riwayat Absensi</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($salesPerson->attendance_log as $log)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $log->date->format('d M Y') }}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <span
                                                    class="px-3 py-1 text-xs font-semibold rounded-full 
                                                            {{ $log->status == 'H' ? 'bg-green-100 text-green-800' : ($log->status == 'A' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ $log->status }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-500">{{ $log->notes ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-6 text-gray-500">Belum ada data absensi
                                                bulan ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Riwayat Transaksi Terakhir</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            ID Order</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Pelanggan</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($salesPerson->recent_transactions as $tx)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm font-medium text-indigo-600">#{{ $tx->id }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $tx->customer->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-500">
                                                {{ $tx->order_date->format('d M Y') }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 text-right font-semibold">Rp
                                                {{ number_format($tx->total_amount) }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-6 text-gray-500">Belum ada transaksi bulan
                                                ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>