@extends('layouts.app')

@section('content')
    <x-slot name="header">Log Distribusi Stok (Stock Out)</x-slot>

    <div class="container">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Riwayat Stock Out ke Sales/SPG</h2>
        <p class="text-gray-600 mb-6">Mencatat total barang yang keluar dari gudang dan dibawa oleh Sales untuk
            didistribusikan[cite: 5].</p>

        <div class="bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                            Keluar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuantitas
                            (Pcs)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diterima
                            Oleh Sales</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dicatat
                            Oleh (Manager/PIC)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($stockOutHistory as $log)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $log->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $log->product->name ?? 'Produk Dihapus' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">
                                {{ number_format($log->quantity) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $log->user->name ?? 'User Dihapus' }}
                            </td>
                            {{-- Asumsi ada kolom recorder_id --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $log->recorder->name ?? 'Manager' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->notes }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada riwayat distribusi
                                (Stock Out) yang dicatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection