@extends('layouts.app')

{{-- Menggunakan section untuk header --}}
@section('header', 'Inventaris Gudang & Manajemen Stok')

@section('content')
    <div class="container">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Daftar Stok Produk Gudang</h2>
        <p class="text-gray-600 mb-6">Halaman ini menampilkan stok keseluruhan produk yang tersedia di gudang utama.</p>

        {{-- Kartu Aksi Cepat --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <a href="{{ route('manager.stock.in') }}"
                class="bg-indigo-600 text-white p-4 rounded-xl shadow-md hover:bg-indigo-700 text-center font-medium">
                + Catat Stock In
            </a>
            <a href="{{ route('manager.stock.out') }}"
                class="bg-red-600 text-white p-4 rounded-xl shadow-md hover:bg-red-700 text-center font-medium">
                - Distribusi Stock Out
            </a>
            <a href="{{ route('manager.monitoring.stock.log') }}"
                class="bg-gray-200 text-gray-800 p-4 rounded-xl shadow-md hover:bg-gray-300 text-center font-medium">
                Lihat Riwayat Distribusi
            </a>
        </div>

        {{-- Tabel Inventaris --}}
        <div class="bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                            Stok Gudang (Pcs)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok di
                            Tangan Sales</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($inventory as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{-- Logika untuk menghitung stok gudang (Total Stock In - Total Stock Out) --}}
                                {{ number_format($product->current_stock ?? 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{-- Logika untuk menghitung stok yang dibawa sales --}}
                                {{ number_format($product->stock_on_hand_by_sales ?? 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ ($product->current_stock ?? 0) < 100 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ($product->current_stock ?? 0) < 100 ? 'Rendah' : 'Aman' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data produk yang
                                ditemukan di inventaris.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection