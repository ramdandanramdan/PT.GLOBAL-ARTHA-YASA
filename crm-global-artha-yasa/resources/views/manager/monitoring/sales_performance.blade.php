@extends('layouts.app')

@section('content')
    <x-slot name="header">Performa Sales & SPG</x-slot>

    <div class="container">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Detail Kinerja Tim Penjualan</h2>
        <p class="text-gray-600 mb-6">Pantau total penjualan, progres target, dan status keaktifan Sales, SPG Motoris, dan
            SPG secara real-time[cite: 3].</p>

        <div class="bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama User
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Presensi
                            Hari Ini</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                            Sales (Pcs)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target
                            (Pcs)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progres
                            (%)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($salesPerformance as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                {{ $user->role->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- Logika status presensi (misal: Cek attendance hari ini) --}}
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_present_today ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->is_present_today ? 'Hadir' : 'Tidak Hadir' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($user->total_sales ?? 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($user->target->monthly_target ?? 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{-- Logika perhitungan progres --}}
                                {{ $user->target ? round(($user->total_sales / $user->target->monthly_target) * 100, 1) : 0 }}%
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data Sales atau SPG
                                yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection