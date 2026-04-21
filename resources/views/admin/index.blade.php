@extends('admin.admin_master')
@section('admin')

<div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

    <!-- Card 1: Active Pregnancies (Clickable) -->
    <a href="{{ route('patients.index', ['filter' => 'pregnant']) }}" class="group rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200 transition-colors duration-300">
                <span class="text-2xl">🤰</span>
            </div>
            <svg class="w-5 h-5 text-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors duration-300">{{ $pregnantPatients }}</h4>
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Active Pregnancies</p>
        </div>
        <div class="mt-4 flex items-center text-emerald-600 text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            View Details <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </div>
    </a>

    <!-- Card 2: High Risk Cases (Clickable) -->
    <a href="{{ route('maternal.index', ['filter' => 'high_risk']) }}" class="group rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-100 text-red-600 group-hover:bg-red-200 transition-colors duration-300">
                <span class="text-2xl">⚠️</span>
            </div>
            <svg class="w-5 h-5 text-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-3xl font-extrabold text-slate-800 group-hover:text-red-600 transition-colors duration-300">{{ $highRiskCount }}</h4>
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">High Risk Cases</p>
        </div>
        <div class="mt-4 flex items-center text-red-600 text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            View Details <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </div>
    </a>

    <!-- Card 3: Medium Risk Cases (Clickable) -->
    <a href="{{ route('maternal.index', ['filter' => 'medium_risk']) }}" class="group rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 group-hover:bg-yellow-200 transition-colors duration-300">
                <span class="text-2xl">📋</span>
            </div>
            <svg class="w-5 h-5 text-yellow-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-3xl font-extrabold text-slate-800 group-hover:text-yellow-600 transition-colors duration-300">{{ $mediumRiskCount }}</h4>
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Medium Risk Cases</p>
        </div>
        <div class="mt-4 flex items-center text-yellow-600 text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            View Details <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </div>
    </a>

    <!-- Card 4: Total Registered (Clickable) -->
    <a href="{{ route('patients.index', ['filter' => 'all']) }}" class="group rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-200 transition-colors duration-300">
                <span class="text-2xl">👥</span>
            </div>
            <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">{{ $totalPatients }}</h4>
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide group-hover:text-slate-600 transition-colors duration-300">Total Registered</p>
        </div>
        <div class="mt-4 flex items-center text-blue-600 text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            View Details <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </div>
    </a>

</div>

<!-- Advanced Monitoring Section -->
<div class="mt-8">

    <!-- Right Column: Priority Patient Alerts -->
    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="mb-6">
            <h3 class="text-lg font-bold text-slate-800">Urgent Health Alerts</h3>
            <p class="text-sm text-slate-500">5 Most Recent Critical Cases</p>
        </div>

        <!-- Alert List -->
        <div class="space-y-4 max-h-96 overflow-y-auto">

            @forelse($urgentAlerts as $index => $alert)
                <!-- Alert Item -->
                <div class="flex items-start justify-between gap-4 rounded-lg p-4 border transition-all
{{ $alert->risk_level == 'high' ? 'bg-red-50 border-red-200' : 'bg-yellow-50 border-yellow-200' }}">

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-800">{{ $alert->full_name }}</p>
                        <p class="text-xs text-slate-600 mt-1">Age: {{ $alert->age }} years • Pregnancy: {{ ucfirst(str_replace('_', ' ', $alert->pregnancy_stage)) }}</p>
                        <p class="text-xs text-slate-500 mt-1">Expected Delivery: {{ $alert->expected_delivery_date->format('M d, Y') }}</p>
                    </div>
                    <span class="inline-flex items-center justify-center px-3 py-1 rounded text-white text-xs font-bold
{{ $alert->risk_level === 'high' ? 'bg-red-600' : 'bg-yellow-500' }}">
{{ $alert->risk_level === 'high' ? 'CRITICAL' : 'WARNING' }}
</span>

                        {{ $alert->risk_level === 'high' ? 'CRITICAL' : 'WARNING' }}
                    </span>
                </div>
            @empty
                <div class="rounded-lg bg-gray-50 p-6 text-center border border-gray-200">
                    <p class="text-sm text-slate-600">No maternal records found</p>
                </div>
            @endforelse

        </div>
    </div>

</div>



@endsection
