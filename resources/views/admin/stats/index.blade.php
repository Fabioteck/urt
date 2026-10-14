<x-guest-layout>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="space-y-8">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-xl font-bold text-white uppercase tracking-widest">STATISTICHE TRAFFICO & TELEMETRIA</h1>
            <a href="{{ route('admin.dashboard') }}" class="font-mono text-xs text-gray-400 hover:text-white">← DASHBOARD</a>
        </div>

        <!-- Top Counters -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-black border border-zinc-800 p-6 rounded-lg text-center space-y-2">
                <span class="font-mono text-xs text-gray-400 uppercase tracking-wider">VISITE TOTALI</span>
                <div class="font-mono text-3xl font-bold text-white">{{ number_format($totalViews) }}</div>
            </div>

            <div class="bg-black border border-zinc-800 p-6 rounded-lg text-center space-y-2">
                <span class="font-mono text-xs text-gray-400 uppercase tracking-wider">IP UNICI</span>
                <div class="font-mono text-3xl font-bold text-red-500">{{ number_format($uniqueVisitors) }}</div>
            </div>

            <div class="bg-black border border-zinc-800 p-6 rounded-lg text-center space-y-2">
                <span class="font-mono text-xs text-gray-400 uppercase tracking-wider">TEMPO MEDIO (SEC)</span>
                <div class="font-mono text-3xl font-bold text-white">{{ $avgTimeSpent }}s</div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Line Chart: Trend -->
            <div class="bg-black border border-zinc-800 p-6 rounded-lg space-y-4">
                <h2 class="font-mono text-sm font-bold text-white uppercase tracking-wide">Andamento Ultimi 7 Giorni</h2>
                <div class="relative h-72">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            <!-- Bar Chart: Top Pages -->
            <div class="bg-black border border-zinc-800 p-6 rounded-lg space-y-4">
                <h2 class="font-mono text-sm font-bold text-white uppercase tracking-wide">Pagine Più Viste</h2>
                <div class="relative h-72">
                    <canvas id="pagesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart.js Dark Theme Defaults
            Chart.defaults.color = '#a1a1aa';
            Chart.defaults.borderColor = '#27272a';
            Chart.defaults.font.family = 'Space Mono';

            // 1. Trend Line Chart
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartDates) !!},
                    datasets: [
                        {
                            label: 'Visualizzazioni',
                            data: {!! json_encode($chartViews) !!},
                            borderColor: '#dc2626',
                            backgroundColor: 'rgba(220, 38, 38, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.3
                        },
                        {
                            label: 'IP Unici',
                            data: {!! json_encode($chartUnique) !!},
                            borderColor: '#ffffff',
                            backgroundColor: 'rgba(255, 255, 255, 0.05)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#18181b' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // 2. Top Pages Bar Chart
            const pagesCtx = document.getElementById('pagesChart').getContext('2d');
            new Chart(pagesCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($topPageUrls) !!},
                    datasets: [{
                        label: 'Visualizzazioni',
                        data: {!! json_encode($topPageViews) !!},
                        backgroundColor: '#dc2626',
                        borderColor: '#991b1b',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: { beginAtZero: true, grid: { color: '#18181b' } },
                        y: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
</x-guest-layout>
