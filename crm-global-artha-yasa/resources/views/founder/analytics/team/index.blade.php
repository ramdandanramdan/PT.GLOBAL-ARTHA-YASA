<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Kalkulasi data untuk KPI cards --}}
            @php
                $totalSalesUnits = $allSalesData->sum('total_sales');
                $totalTargetUnits = $allSalesData->sum('target');
                $averageAchievement = $totalTargetUnits > 0 ? ($totalSalesUnits / $totalTargetUnits) * 100 : 0;

                // Mencari Top Performer (Menerapkan null-safe check di Controller lebih baik, tapi ini untuk view-fix)
                $topPerformer = $allSalesData->sortByDesc(function ($sales) {
                    return ($sales->target > 0) ? ($sales->total_sales / $sales->target) : 0;
                })->first();

                // Teks status rata-rata pencapaian
                $status_text = $averageAchievement >= 80 ? 'Di jalur yang benar' : ($averageAchievement >= 40 ? 'Perlu
                            Dorongan' : 'Perlu Perhatian Mendesak');
            @endphp

            {{-- 1. KPI Cards Tim --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- KPI Card 1: Total Penjualan --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transform hover:scale-[1.01] transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-semibold text-indigo-600">Total Penjualan Tim</p>
                            <p class="text-4xl font-extrabold text-gray-900 mt-1">
                                {{ number_format($totalSalesUnits) }}
                                <span class="text-xl font-medium text-gray-400">Unit</span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Target Total: {{ number_format($totalTargetUnits) }}
                                Unit</p>
                        </div>
                        <div class="bg-indigo-50 text-indigo-600 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- KPI Card 2: Rata-rata Pencapaian --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transform hover:scale-[1.01] transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-semibold text-green-600">Rata-rata Pencapaian</p>
                            <p class="text-4xl font-extrabold text-gray-900 mt-1">
                                {{ number_format($averageAchievement, 1) }}
                                <span class="text-xl font-medium text-gray-400">%</span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">{{ $status_text }}</p>
                        </div>
                        <div class="bg-green-50 text-green-600 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7.014A8.003 8.003 0 0117.657 18.657z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 16.121A3 3 0 1014.12 11.88l-4.242 4.242z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- KPI Card 3: Top Performer (Dengan Null Check) --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transform hover:scale-[1.01] transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-semibold text-yellow-600">Top Performer</p>

                            @if ($topPerformer)
                                @php
                                    $topPerformerAchievement = ($topPerformer->target > 0) ? ($topPerformer->total_sales /
                                        $topPerformer->target) * 100 : 0;
                                @endphp
                                {{-- PERBAIKAN 1: Menerapkan ?? 'N/A' pada properti jika $topPerformer bukan null (Walaupun
                                sudah dicek di @if) --}}
                                <p class="text-2xl font-extrabold text-gray-900 mt-1 truncate">
                                    {{ $topPerformer->name ?? 'N/A' }}
                                </p>
                                {{-- PERBAIKAN 2: Mencetak hasil kalkulasi yang sudah dihitung sebelumnya --}}
                                <p class="text-xs text-gray-500 mt-1">Pencapaian:
                                    <span class="font-bold text-green-600">
                                        {{ number_format($topPerformerAchievement, 1) }}%
                                    </span>
                                </p>
                            @else
                                {{-- Fallback jika $topPerformer null --}}
                                <p class="text-2xl font-extrabold text-gray-900 mt-1">N/A</p>
                                <p class="text-xs text-gray-500 mt-1">Pencapaian: 0.0%</p>
                            @endif
                        </div>
                        <div class="bg-yellow-50 text-yellow-600 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-12v4m-2-2h4m5 4v4m-2-2h4M5 3a2 2 0 00-2 2v1h16V5a2 2 0 00-2-2H5zM3 19a2 2 0 002 2h14a2 2 0 002-2v-1H3v1z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Area Tabel --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-6 md:p-8 text-gray-900">
                    {{-- Header Tabel & Kontrol --}}
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 border-b border-gray-100 pb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Ringkasan Kinerja Sales</h3>
                            <p class="text-sm text-gray-500 mt-1">Daftar semua sales beserta pencapaian penjualan bulan
                                ini.</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <select
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm py-2.5">
                                <option>Bulan Ini</option>
                                <option>Bulan Lalu</option>
                                <option>Tahun Ini</option>
                            </select>
                            <button class="p-2.5 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Tabel Performa (Desktop) --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 hidden md:table">
                            <thead class="bg-gray-50 rounded-t-xl">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider rounded-tl-xl">
                                        Nama Sales</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Penjualan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Target</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-1/4">
                                        Pencapaian</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider rounded-tr-xl">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse ($allSalesData as $sales)
                                    <tr class="hover:bg-indigo-50/50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="https://ui-avatars.com/api/?name={{ urlencode($sales->name) }}&background=EBF4FF&color=4299E1&bold=true"
                                                        alt="Avatar">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900">
                                                        {{ $sales->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">{{ $sales->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 font-bold">
                                            {{ number_format($sales->total_sales) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 font-medium">
                                            {{ number_format($sales->target) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $percentage = ($sales->target > 0) ? ($sales->total_sales / $sales->target) *
                                                    100 : 0;
                                                $progressBarColor = $percentage >= 80 ? 'bg-green-500' : ($percentage >= 40 ?
                                                    'bg-yellow-500' : 'bg-red-500');
                                                $textColor = $percentage >= 80 ? 'text-green-600' : ($percentage >= 40 ?
                                                    'text-yellow-600' : 'text-red-600');
                                            @endphp
                                            <div class="flex items-center">
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="{{ $progressBarColor }} h-2 rounded-full transition-all duration-500 ease-out"
                                                        style="width: {{ min($percentage, 100) }}%"></div>
                                                </div>
                                                <span
                                                    class="text-sm font-semibold {{ $textColor }} ml-3 w-12 text-right">{{ number_format($percentage, 1) }}%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if ($sales->is_active)
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-50 text-green-700 border border-green-200">Aktif</span>
                                            @else
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-50 text-red-700 border border-red-200">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('founder.analytics.team.show', $sales->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 font-semibold hover:underline">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-12 text-gray-500 bg-gray-50 rounded-b-xl">
                                            <p class="font-medium">Data tim sales tidak ditemukan.</p>
                                            <p class="text-sm mt-1">Silakan tambahkan sales baru melalui tombol di atas.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Tampilan Kartu untuk Mobile --}}
                    <div class="grid grid-cols-1 gap-4 md:hidden">
                        @forelse ($allSalesData as $sales)
                            @php
                                $percentage = ($sales->target > 0) ? ($sales->total_sales / $sales->target) * 100 : 0;
                                $progressBarColor = $percentage >= 80 ? 'bg-green-500' : ($percentage >= 40 ? 'bg-yellow-500' :
                                    'bg-red-500');
                                $textColor = $percentage >= 80 ? 'text-green-600' : ($percentage >= 40 ? 'text-yellow-600' :
                                    'text-red-600');
                            @endphp
                            <div class="bg-white p-4 rounded-xl shadow-md border border-gray-100 space-y-3">
                                {{-- Info Utama --}}
                                <div class="flex items-start justify-between border-b border-gray-100 pb-3">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="https://ui-avatars.com/api/?name={{ urlencode($sales->name) }}&background=EBF4FF&color=4299E1&bold=true"
                                            alt="Avatar">
                                        <div class="ml-3">
                                            <p class="text-base font-bold text-gray-900 leading-none">
                                                {{ $sales->name }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $sales->email }}</p>
                                        </div>
                                    </div>
                                    @if ($sales->is_active)
                                        <span
                                            class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-50 text-green-700">Aktif</span>
                                    @else
                                        <span
                                            class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-50 text-red-700">Nonaktif</span>
                                    @endif
                                </div>

                                {{-- Detail Penjualan --}}
                                <div class="flex justify-between items-center text-sm">
                                    <div class="flex-1">
                                        <p class="text-xs font-medium text-gray-500 mb-1">Pencapaian: <span
                                                class="font-bold {{ $textColor }}">{{ number_format($percentage, 1) }}%</span>
                                        </p>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="{{ $progressBarColor }} h-2 rounded-full transition-all duration-500 ease-out"
                                                style="width: {{ min($percentage, 100) }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Penjualan vs Target --}}
                                <div class="flex justify-between items-center text-sm pt-3 border-t border-gray-100">
                                    <div class="text-left">
                                        <p class="font-bold text-gray-800">{{ number_format($sales->total_sales) }}
                                        </p>
                                        <p class="text-xs text-gray-500">Penjualan</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="font-bold text-gray-800">{{ number_format($sales->target) }}</p>
                                        <p class="text-xs text-gray-500">Target</p>
                                    </div>
                                    <a href="{{ route('founder.analytics.team.show', $sales->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs bg-indigo-50 px-4 py-2 rounded-lg transition duration-150">
                                        Lihat Detail &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500 col-span-2">
                                <p class="font-medium">Data tim sales tidak ditemukan.</p>
                                <p class="text-sm mt-1">Silakan tambahkan sales baru melalui tombol di header.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>