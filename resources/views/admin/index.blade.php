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



@endsection
