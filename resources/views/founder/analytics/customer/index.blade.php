<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 1. KPI Cards Pelanggan --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- KPI Card 1: Total Pelanggan --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transform hover:scale-[1.01] transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-semibold text-indigo-600">Total Pelanggan Aktif</p>
                            <p class="text-4xl font-extrabold text-gray-900 mt-1">
                                {{ number_format($kpis['total_customers']) }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Sejak Awal Beroperasi</p>
                        </div>
                        <div class="bg-indigo-50 text-indigo-600 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.653-.26-1.29-.73-1.77M15 8a4 4 0 10-8 0 4 4 0 008 0zm-7 0a4 4 0 11-8 0 4 4 0 018 0zM12 17.5l-4.242 4.242A2 2 0 015 19.586V17h3l-4 4 4 4z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- KPI Card 2: Pelanggan Baru Bulan Ini --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transform hover:scale-[1.01] transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-semibold text-green-600">Pelanggan Baru (Bulan Ini)</p>
                            <p class="text-4xl font-extrabold text-gray-900 mt-1">
                                {{ number_format($kpis['new_customers_monthly']) }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Tingkat pertumbuhan sangat baik</p>
                        </div>
                        <div class="bg-green-50 text-green-600 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3M4 17V4a2 2 0 012-2h12a2 2 0 012 2v13M4 17H3a2 2 0 00-2 2v2a1 1 0 001 1h18a1 1 0 001-1v-2a2 2 0 00-2-2h-1M4 17l.001-.001M8 11h.01M12 11h.01M16 11h.01M8 15h.01M12 15h.01M16 15h.01" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- KPI Card 3: Nilai Rata-rata Pelanggan --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transform hover:scale-[1.01] transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-semibold text-yellow-600">Avg. Nilai Transaksi (Bulan Ini)</p>
                            <p class="text-3xl font-extrabold text-gray-900 mt-1">
                                {{ 'Rp ' . number_format($kpis['avg_transaction_value'], 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Perlu ditingkatkan</p>
                        </div>
                        <div class="bg-yellow-50 text-yellow-600 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 13h.01M9 9h.01M15 13h.01M15 9h.01M15 5h.01M9 5h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            {{-- 2. Area Tabel: Top Pelanggan --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-6 md:p-8 text-gray-900">
                    {{-- Header Tabel & Kontrol --}}
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 border-b border-gray-100 pb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">10 Pelanggan Terbaik (Top Spender)</h3>
                            <p class="text-sm text-gray-500 mt-1">Pelanggan dengan jumlah transaksi terbanyak dan total
                                pengeluaran tertinggi.</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <select
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm py-2.5">
                                <option>Total Transaksi</option>
                                <option>Total Pengeluaran</option>
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

                    {{-- Tabel Top Pelanggan (Desktop) --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 hidden md:table">
                            <thead class="bg-gray-50 rounded-t-xl">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider rounded-tl-xl">
                                        Pelanggan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Jml. Transaksi</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider rounded-tr-xl">
                                        Total Pembelian</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse ($topCustomers as $customer)
                                    <tr class="hover:bg-indigo-50/50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="https://ui-avatars.com/api/?name={{ urlencode($customer['name']) }}&background=EBF4FF&color=4299E1&bold=true"
                                                        alt="Avatar">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900">
                                                        {{ $customer['name'] }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">{{ $customer['email'] }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 font-bold">
                                            {{ number_format($customer['transaction_count']) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-green-600 font-bold">
                                            Rp {{ number_format($customer['total_spent']) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-12 text-gray-500 bg-gray-50 rounded-b-xl">
                                            <p class="font-medium">Data pelanggan terbaik belum tersedia.</p>
                                            <p class="text-sm mt-1">Lakukan lebih banyak transaksi untuk mengisi data
                                                ini.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Tampilan Kartu untuk Mobile (Top Pelanggan) --}}
                    <div class="grid grid-cols-1 gap-4 md:hidden">
                        @forelse ($topCustomers as $customer)
                            <div class="bg-white p-4 rounded-xl shadow-md border border-gray-100 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="https://ui-avatars.com/api/?name={{ urlencode($customer['name']) }}&background=EBF4FF&color=4299E1&bold=true"
                                            alt="Avatar">
                                        <div class="ml-3">
                                            <p class="text-sm font-bold text-gray-900 leading-none">
                                                {{ $customer['name'] }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $customer['email'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-sm pt-3 border-t border-gray-100">
                                    <div class="text-left">
                                        <p class="font-bold text-green-700">Rp {{ number_format($customer['total_spent']) }}
                                        </p>
                                        <p class="text-xs text-gray-500">Total Pembelian</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="font-bold text-gray-800">
                                            {{ number_format($customer['transaction_count']) }}
                                        </p>
                                        <p class="text-xs text-gray-500">Transaksi</p>
                                    </div>
                                    <a href="#"
                                        class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs bg-indigo-50 px-4 py-2 rounded-lg transition duration-150">
                                        Detail &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500">
                                <p class="font-medium">Data pelanggan terbaik tidak ditemukan.</p>
                                <p class="text-sm mt-1">Lakukan lebih banyak transaksi untuk mengisi data ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>