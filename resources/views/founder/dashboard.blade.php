<x-app-layout>
    {{-- Scripts: Chart.js + inisialisasi + Filter Pencarian (satu tempat saja) --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <script>
            // Tunggu sampai semua resource (termasuk Alpine) selesai dimuat
            window.addEventListener('load', function () {
                try {
                    const dbg = (msg, obj = null) =>
                        console.log('%c[Dashboard] %c' + msg, 'color:#0f172a; font-weight:bold', '', obj);

                    if (typeof Chart === 'undefined') {
                        dbg('Chart.js not found. Check CDN or duplicate includes.');
                        return;
                    }
                    dbg('Chart.js ready');

                    // ===== PRODUCT MIX (DOUGHNUT) =====
                    const productMixData = @json($productMix ?? []);
                    dbg('productMixData', productMixData);

                    // Filter out zero-value products (optional) to keep chart meaningful
                    const productMixFiltered = (productMixData || []).filter(p => Number(p.value) > 0);
                    const sourceProduct = (productMixFiltered.length ? productMixFiltered : productMixData);
                    const productLabels = sourceProduct.map(p => p.name ?? 'Unknown');
                    const productValues = sourceProduct.map(p => Number(p.value) || 0);

                    const productCanvas = document.getElementById('productMixChart');
                    if (!productCanvas) {
                        dbg('Canvas #productMixChart not found');
                    } else if (!productLabels.length || productValues.every(v => v === 0)) {
                        dbg('productMixData empty or all zeros — skipping doughnut chart');
                        const holder = productCanvas.closest('.h-64');
                        if (holder) {
                            holder.innerHTML =
                                '<p class="text-xs text-gray-500">Tidak ada data produk untuk ditampilkan.</p>';
                        }
                    } else {
                        const ctx = productCanvas.getContext('2d');
                        const defaultColors = ['#6366f1', '#fbbf24', '#34d399', '#fb7185', '#60a5fa', '#a78bfa'];
                        const colors = productLabels.map((_, i) => defaultColors[i % defaultColors.length]);

                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: productLabels,
                                datasets: [{
                                    label: 'Volume Penjualan Produk',
                                    data: productValues,
                                    backgroundColor: colors,
                                    hoverOffset: 8
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            padding: 12,
                                            boxWidth: 12
                                        }
                                    },
                                    title: {
                                        display: false
                                    }
                                }
                            }
                        });

                        dbg('Product doughnut initialized', {
                            labels: productLabels,
                            values: productValues
                        });
                    }

                    // ===== WEEKLY PERFORMANCE (LINE) =====
                    // NOTE: gunakan array kosong sebagai fallback — jangan gunakan {}
                    const weekly = @json($weeklyPerformance ?? []);
                    dbg('weeklyPerformance', weekly);

                    const weekLabels = (weekly.labels ?? []);
                    const weekSales = (weekly.sales ?? []).map(n => Number(n) || 0);
                    const weekTarget = (weekly.target_weekly ?? []).map(n => Number(n) || 0);

                    const weeklyCanvas = document.getElementById('weeklyPerformanceChart');
                    if (!weeklyCanvas) {
                        dbg('Canvas #weeklyPerformanceChart not found');
                    } else if (!weekLabels.length) {
                        dbg('weeklyPerformance.labels empty — skipping line chart');
                        const holder = weeklyCanvas.closest('.h-56');
                        if (holder) {
                            holder.innerHTML =
                                '<p class="text-xs text-gray-500">Tidak ada data mingguan untuk ditampilkan.</p>';
                        }
                    } else {
                        const ctx2 = weeklyCanvas.getContext('2d');
                        new Chart(ctx2, {
                            type: 'line',
                            data: {
                                labels: weekLabels,
                                datasets: [{
                                    label: 'Total Sales',
                                    data: weekSales,
                                    tension: 0.3,
                                    fill: false,
                                    borderColor: '#6366f1',
                                    backgroundColor: '#6366f1',
                                    borderWidth: 2,
                                    pointRadius: 3
                                },
                                {
                                    label: 'Target Mingguan',
                                    data: weekTarget,
                                    tension: 0.3,
                                    borderDash: [6, 4],
                                    borderColor: '#f97316',
                                    backgroundColor: '#f97316',
                                    borderWidth: 1.5,
                                    pointRadius: 0
                                }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            precision: 0
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    }
                                }
                            }
                        });

                        dbg('Weekly line chart initialized', {
                            labels: weekLabels,
                            sales: weekSales,
                            target: weekTarget
                        });
                    }

                    // ===== SALES LEADERBOARD SEARCH FILTER (FITUR BARU) =====
                    const searchInput = document.getElementById('salesSearchInput');
                    const tableBody = document.querySelector('.min-w-full tbody');

                    if (searchInput && tableBody) {
                        searchInput.addEventListener('input', (event) => {
                            const filter = event.target.value.toLowerCase();
                            const rows = tableBody.querySelectorAll('tr');

                            rows.forEach(row => {
                                // Kolom Nama Sales adalah <td> ke-2 (index 1)
                                const nameCell = row.children[1];
                                if (nameCell) {
                                    const name = nameCell.textContent.toLowerCase();
                                    row.style.display = name.includes(filter) ? '' : 'none';
                                }
                            });
                        });
                        dbg('Leaderboard search filter attached');
                    }

                } catch (err) {
                    console.error('[Dashboard] Chart initialization failed:', err);
                }
            });
        </script>
    @endpush

    {{-- Card Konten Utama Dashboard --}}
    <div class="bg-white shadow-xl rounded-xl overflow-hidden mb-8">
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h1 class="text-2xl font-extrabold text-gray-800">Monitoring Strategis (Founder) 👋</h1>
            <p class="text-sm text-gray-500 mt-1">Data kinerja tim motoris per periode ini.</p>
        </div>

        <div class="p-6 space-y-8">
            {{-- KPI Grid --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                {{-- KPI 1: Pencapaian Target Tim --}}
                <div
                    class="p-5 bg-indigo-50 border-l-4 border-indigo-600 rounded-lg shadow-sm transition hover:shadow-md">
                    <h2 class="text-sm font-medium text-indigo-700 uppercase tracking-wider">Pencapaian Target Tim</h2>
                    <div class="mt-1 flex items-center justify-between">
                        <p class="text-3xl font-extrabold text-gray-900">{{ $achievementPercentage ?? 'N/A' }}</p>
                        <span
                            class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                            @if (($statusPencapaian ?? '') == 'On-Track') bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                            {{ $statusPencapaian ?? 'Loading' }}
                        </span>
                    </div>
                    <p class="text-xs text-indigo-600 mt-1">Realisasi: <strong>{{ $totalSales ?? '0' }}</strong> Pcs /
                        Target: <strong>{{ $totalTarget ?? '0' }}</strong> Pcs</p>
                </div>

                {{-- KPI 2: Rata-rata Kehadiran --}}
                <div class="p-5 bg-sky-50 border-l-4 border-sky-600 rounded-lg shadow-sm transition hover:shadow-md">
                    <h2 class="text-sm font-medium text-sky-700 uppercase tracking-wider">Rata-rata Kehadiran</h2>
                    <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $avgAttendance ?? 'N/A' }}</p>
                    <p class="text-xs text-sky-600 mt-1">Indikator disiplin dan produktivitas tim.</p>
                </div>

                {{-- KPI 3: Peringatan Absensi --}}
                <div class="p-5 bg-red-50 border-l-4 border-red-600 rounded-lg shadow-sm transition hover:shadow-md">
                    <h2 class="text-sm font-medium text-red-700 uppercase tracking-wider">Peringatan Absensi
                        (Alpha/Izin)</h2>
                    <div class="mt-1 space-y-1">
                        @if (!empty($attendanceAlerts) && count($attendanceAlerts) > 0)
                            <p class="text-xl font-bold text-red-700">{{ count($attendanceAlerts) }} Sales Bermasalah</p>
                            @foreach ($attendanceAlerts as $alert)
                                <p class="text-xs text-red-600 truncate">{{ $alert }}</p>
                            @endforeach
                        @else
                            <p class="text-3xl font-extrabold text-green-700">Nihil</p>
                            <p class="text-xs text-green-600">Semua sales hadir sesuai jadwal.</p>
                        @endif
                    </div>
                </div>

                {{-- KPI 4: Total Volume Penjualan --}}
                <div
                    class="p-5 bg-purple-50 border-l-4 border-purple-600 rounded-lg shadow-sm transition hover:shadow-md">
                    <h2 class="text-sm font-medium text-purple-700 uppercase tracking-wider">Total Volume Penjualan</h2>
                    <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalSales ?? 0 }} Pcs</p>
                    <p class="text-xs text-purple-600 mt-1">Total produk terjual oleh seluruh tim.</p>
                </div>
            </div>

            {{-- Leaderboard + Product Mix --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-4">
                {{-- Leaderboard Table --}}
                <div class="lg:col-span-2 bg-gray-50 p-6 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Peringkat Pencapaian Sales Individu</h2>

                    {{-- Elemen Pencarian Baru --}}
                    <div class="mb-4">
                        <label for="salesSearchInput" class="sr-only">Cari Sales</label>
                        <input type="text" id="salesSearchInput" placeholder="Ketik nama sales untuk mencari..."
                            class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                            aria-label="Cari sales">
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Peringkat</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Nama Sales</th>
                                    <th
                                        class="px-4 py-2 text-right text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Realisasi (Pcs)</th>
                                    <th
                                        class="px-4 py-2 text-right text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        % Capai</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach (collect($allSalesData ?? [])->sortByDesc(3)->values() as $index => $sales)
                                    @php
                                        // $sales structure: [Nama, Total Sales, Target Bulanan, % Pencapaian]
                                        $achievement = isset($sales[3]) ? number_format($sales[3] * 100, 1) . '%' : 'N/A';
                                        $status = (isset($sales[3]) && $sales[3] >= 0.40) ? 'High Achiever' : ((isset($sales[3])
                                            && $sales[3] >= 0.30) ? 'On Track' : 'Need Focus');
                                        $statusColor = $status == 'High Achiever' ? 'bg-green-100 text-green-800' : ($status ==
                                            'On Track' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                                    @endphp
                                    <tr
                                        class="@if ($index < 3) bg-indigo-50/50 font-semibold @endif hover:bg-gray-50 cursor-pointer">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                            <span
                                                class="font-bold @if ($index < 3) text-indigo-700 @endif">{{ $index + 1 }}</span>
                                            @if ($index == 0)
                                                <span class="ml-1 text-yellow-500" aria-hidden="true">⭐</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $sales[0] ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 text-right">
                                            {{ isset($sales[1]) ? number_format($sales[1]) : '-' }}
                                        </td>
                                        <td
                                            class="px-4 py-3 whitespace-nowrap text-sm text-indigo-600 font-bold text-right">
                                            {{ $achievement }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">{{ $status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (empty($allSalesData) || count($allSalesData) == 0)
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-xs text-gray-500">Belum ada data
                                            sales.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Product Mix Chart (Doughnut) --}}
                <div class="lg:col-span-1 bg-gray-50 p-6 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Komposisi Penjualan Produk</h2>
                    <div class="h-64 flex items-center justify-center" role="img" aria-label="Diagram komposisi produk">
                        <canvas id="productMixChart" aria-hidden="true"></canvas>
                    </div>
                    <p class="text-xs text-gray-500 mt-4 text-center">Distribusi volume penjualan (Pcs) CR, JA, dan
                        CC16.</p>
                </div>
            </div>

            {{-- Weekly Trend Chart (Line) --}}
            <div class="bg-gray-50 p-6 rounded-xl shadow-md border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-3">Tren Kinerja Mingguan</h2>
                <div class="h-56">
                    <canvas id="weeklyPerformanceChart" aria-hidden="true"></canvas>
                </div>
                <p class="text-xs text-gray-500 mt-3">Perbandingan total sales mingguan tim vs target mingguan.</p>
            </div>
        </div>
    </div>
</x-app-layout>