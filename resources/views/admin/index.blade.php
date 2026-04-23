@extends('admin.admin_master')
@section('admin')

<!-- ========== MATERNAL STATISTICS ROW ========== -->
<div class="mb-4">
    <div class="mb-3">
        <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
            <span>🤰</span> Maternal Health
        </h2>
        <p class="text-xs text-slate-500 mt-0.5">Track pregnancies and risk categories</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

        <!-- Card 1: Total Pregnancies -->
        <a href="{{ route('maternal.index') }}" class="group rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <div class="flex items-center justify-between mb-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200 transition-colors duration-300">
                    <span class="text-xl">👪</span>
                </div>
                <svg class="w-4 h-4 text-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors duration-300">{{ $totalPregnancies }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Total Pregnancies</p>
            </div>
        </a>

        <!-- Card 2: Low Risk Cases -->
        <a href="{{ route('maternal.index', ['filter' => 'low_risk']) }}" class="group rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <div class="flex items-center justify-between mb-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-200 transition-colors duration-300">
                    <span class="text-xl">✓</span>
                </div>
                <svg class="w-4 h-4 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">{{ $lowRiskCount }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Low Risk Cases</p>
            </div>
        </a>

        <!-- Card 3: Medium Risk Cases -->
        <a href="{{ route('maternal.index', ['filter' => 'medium_risk']) }}" class="group rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <div class="flex items-center justify-between mb-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 group-hover:bg-yellow-200 transition-colors duration-300">
                    <span class="text-xl">📋</span>
                </div>
                <svg class="w-4 h-4 text-yellow-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-extrabold text-slate-800 group-hover:text-yellow-600 transition-colors duration-300">{{ $mediumRiskCount }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Medium Risk Cases</p>
            </div>
        </a>

        <!-- Card 4: High Risk Cases -->
        <a href="{{ route('maternal.index', ['filter' => 'high_risk']) }}" class="group rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <div class="flex items-center justify-between mb-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-100 text-red-600 group-hover:bg-red-200 transition-colors duration-300">
                    <span class="text-xl">🚨</span>
                </div>
                <svg class="w-4 h-4 text-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-extrabold text-slate-800 group-hover:text-red-600 transition-colors duration-300">{{ $highRiskCount }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">High Risk Cases</p>
            </div>
        </a>

    </div>
</div>

<!-- ========== CHILD NUTRITION STATISTICS ROW ========== -->
<div class="mb-4">
    <div class="mb-3">
        <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
            <span>👶</span> Child Nutrition
        </h2>
        <p class="text-xs text-slate-500 mt-0.5">Monitor nutritional status across children</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

        <!-- Card 1: Total Children Registered -->
        <a href="{{ route('child-nutrition.index') }}" class="group rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <div class="flex items-center justify-between mb-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 group-hover:bg-indigo-200 transition-colors duration-300">
                    <span class="text-xl">📊</span>
                </div>
                <svg class="w-4 h-4 text-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-extrabold text-slate-800 group-hover:text-indigo-600 transition-colors duration-300">{{ $totalChildren }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Total Children</p>
            </div>
        </a>

        <!-- Card 2: Normal Nutrition Status -->
        <a href="{{ route('child-nutrition.index', ['nutritional_status' => 'normal']) }}" class="group rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <div class="flex items-center justify-between mb-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100 text-green-600 group-hover:bg-green-200 transition-colors duration-300">
                    <span class="text-xl">✅</span>
                </div>
                <svg class="w-4 h-4 text-green-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-extrabold text-slate-800 group-hover:text-green-600 transition-colors duration-300">{{ $normalNutritionCount }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Normal Status</p>
            </div>
        </a>

        <!-- Card 3: Underweight Children -->
        <a href="{{ route('child-nutrition.index', ['nutritional_status' => 'underweight']) }}" class="group rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <div class="flex items-center justify-between mb-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 group-hover:bg-yellow-200 transition-colors duration-300">
                    <span class="text-xl">⚠️</span>
                </div>
                <svg class="w-4 h-4 text-yellow-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-extrabold text-slate-800 group-hover:text-yellow-600 transition-colors duration-300">{{ $underweightCount }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Underweight</p>
            </div>
        </a>

        <!-- Card 4: Severely Underweight Children -->
        <a href="{{ route('child-nutrition.index', ['nutritional_status' => 'severely_underweight']) }}" class="group rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <div class="flex items-center justify-between mb-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-100 text-red-600 group-hover:bg-red-200 transition-colors duration-300">
                    <span class="text-xl">🔴</span>
                </div>
                <svg class="w-4 h-4 text-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-extrabold text-slate-800 group-hover:text-red-600 transition-colors duration-300">{{ $severelyUnderweightCount }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Severely Underweight</p>
            </div>
        </a>

    </div>
</div>

<!-- ========== URGENT HEALTH ALERTS SECTION ========== -->
<div class="mt-6">
    <div class="rounded-lg border border-gray-100 bg-white p-4 shadow-sm hover:shadow-md transition-shadow">
        <div class="mb-4">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <span>🚨</span> Urgent Health Alerts
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">5 Most Recent Critical & Warning Cases</p>
        </div>

        <!-- Alert List -->
        <div class="space-y-2 max-h-64 overflow-y-auto">

            @forelse($urgentAlerts as $index => $alert)
                <!-- Alert Item -->
                <div class="flex items-start justify-between gap-3 rounded-lg p-3 border transition-all
{{ $alert->risk_level == 'high' ? 'bg-red-50 border-red-200' : 'bg-yellow-50 border-yellow-200' }}">

                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-slate-800">{{ $alert->full_name }}</p>
                        <p class="text-xs text-slate-600 mt-0.5">Age: {{ $alert->age }} • {{ ucfirst(str_replace('_', ' ', $alert->pregnancy_stage)) }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">Delivery: {{ $alert->expected_delivery_date->format('M d, Y') }}</p>
                    </div>
                    <span class="inline-flex items-center justify-center px-2 py-0.5 rounded text-white text-xs font-bold whitespace-nowrap
{{ $alert->risk_level === 'high' ? 'bg-red-600' : 'bg-yellow-500' }}">
{{ $alert->risk_level === 'high' ? 'CRITICAL' : 'WARNING' }}
                    </span>
                </div>
            @empty
                <div class="rounded-lg bg-gray-50 p-4 text-center border border-gray-200">
                    <p class="text-xs text-slate-600">No maternal records found</p>
                </div>
            @endforelse

        </div>
    </div>

</div>

<!-- ========== NUTRITIONAL GROWTH TRENDS CHART ========== -->
<div class="mt-6">
    <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="mb-6">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <span>📈</span> Nutritional Growth Trends
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">Last 3 Months - Normal vs Underweight Children</p>
        </div>

        <!-- Chart Container -->
        <div class="relative h-64">
            <canvas id="nutritionalGrowthChart" class="max-h-64"></canvas>
        </div>

        <!-- Chart Legend Info -->
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg border border-green-100">
                <div class="w-4 h-4 rounded bg-green-500"></div>
                <div>
                    <p class="text-xs font-semibold text-slate-700">Normal Status</p>
                    <p class="text-xs text-slate-500">Children with healthy nutrition</p>
                </div>
            </div>
            <div class="flex items-center gap-3 p-3 bg-yellow-50 rounded-lg border border-yellow-100">
                <div class="w-4 h-4 rounded bg-yellow-500"></div>
                <div>
                    <p class="text-xs font-semibold text-slate-700">Underweight</p>
                    <p class="text-xs text-slate-500">Including severely underweight cases</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart data from controller
        const chartData = @json($chartData);

        // Get canvas context
        const ctx = document.getElementById('nutritionalGrowthChart');

        if (ctx) {
            // Create chart
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: chartData.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                color: '#374151'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 13,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' children';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12
                                },
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush

@endsection
