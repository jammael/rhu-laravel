@extends('admin.admin_master')
@section('admin')

<!-- Main Container -->
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-800 mb-3">
                Add Patient Information
            </h1>
            <p class="text-lg text-slate-600">
                Select the type of patient enrollment you'd like to create
            </p>
        </div>

        <!-- Selection Cards Grid -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

            <!-- Card 1: Maternal Health -->
            <a href="{{ route('patients.create', ['type' => 'maternal']) }}"
               class="group relative block">
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>

                <div class="relative h-full rounded-2xl border-2 border-emerald-200 bg-white p-8 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col">

                    <!-- Icon -->
                    <div class="mb-8">
                        <div class="inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200 transition-colors duration-300">
                            <!-- Pregnancy Icon -->
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors duration-300">
                            Maternal Health
                        </h2>
                        <p class="text-slate-600 leading-relaxed mb-4">
                            Register a pregnant mother and monitor maternal health records, pregnancy progress, and prenatal care status.
                        </p>
                        <ul class="space-y-2 text-sm text-slate-600">
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                Pregnancy tracking
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                Prenatal monitoring
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                Health records
                            </li>
                        </ul>
                    </div>

                    <!-- Call to Action -->
                    <div class="flex items-center gap-2 mt-6 pt-6 border-t border-emerald-100 text-emerald-600">
                        <span class="text-sm font-semibold uppercase tracking-wide">Select</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Card 2: Child Nutrition -->
            <a href="{{ route('patients.create', ['type' => 'child']) }}"
               class="group relative block">
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-indigo-500 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>

                <div class="relative h-full rounded-2xl border-2 border-indigo-200 bg-white p-8 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col">

                    <!-- Icon -->
                    <div class="mb-8">
                        <div class="inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 group-hover:bg-indigo-200 transition-colors duration-300">
                            <!-- Child Icon -->
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors duration-300">
                            Child Nutrition
                        </h2>
                        <p class="text-slate-600 leading-relaxed mb-4">
                            Register a child and monitor nutritional status, growth patterns, and child health development indicators.
                        </p>
                        <ul class="space-y-2 text-sm text-slate-600">
                            <li class="flex items-center gap-2">
                                <span class="text-indigo-600 font-bold">✓</span>
                                Nutrition tracking
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-indigo-600 font-bold">✓</span>
                                Growth monitoring
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-indigo-600 font-bold">✓</span>
                                Health assessment
                            </li>
                        </ul>
                    </div>

                    <!-- Call to Action -->
                    <div class="flex items-center gap-2 mt-6 pt-6 border-t border-indigo-100 text-indigo-600">
                        <span class="text-sm font-semibold uppercase tracking-wide">Select</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>
            </a>

        </div>

        <!-- Back Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-800 font-medium transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

    </div>
</div>

@endsection
