<x-app-layout>
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-slate-800">
                    Good day, <span class="text-emerald-600">{{ Auth::user()->name }}!</span>
                </h1>
                <p class="text-slate-500 mt-2">Select a task to begin.</p>
            </div>

            <!-- Quick Access Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">

                <!-- Card 1: Add Patient Information (Primary - Larger) -->
                <a href="{{ route('patients.select') }}" class="group lg:col-span-1 md:row-span-2 rounded-2xl border border-gray-200 bg-white p-8 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer flex flex-col justify-between min-h-64">
                    <div>
                        <!-- Icon -->
                        <div class="mb-6">
                            <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200 transition-colors duration-300">
                                <!-- User Plus Icon -->
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div>
                            <h3 class="text-2xl font-bold text-slate-800 group-hover:text-emerald-600 transition-colors duration-300 mb-2">
                                Add Patient Information
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Register a new patient and begin monitoring their maternal or child nutrition health status.
                            </p>
                        </div>
                    </div>

                    <!-- Arrow Icon (appears on hover) -->
                    <div class="flex items-center gap-2 mt-6 text-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-sm font-semibold uppercase tracking-wide">Start Now</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </a>

                <!-- Card 2: Health Monitoring -->
                <a href="{{ route('maternal.index') }}" class="group rounded-2xl border border-gray-200 bg-white p-8 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer flex flex-col justify-between">
                    <div>
                        <!-- Icon -->
                        <div class="mb-6">
                            <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-blue-100 text-blue-600 group-hover:bg-blue-200 transition-colors duration-300">
                                <!-- Heartbeat Icon -->
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors duration-300 mb-2">
                                Health Monitoring
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Track maternal health records and pregnancy progress.
                            </p>
                        </div>
                    </div>

                    <!-- Arrow Icon (appears on hover) -->
                    <div class="flex items-center gap-2 mt-6 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-sm font-semibold uppercase tracking-wide">View Records</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </a>

                <!-- Card 3: Child Nutrition Monitoring -->
                <a href="{{ route('child-nutrition.index') }}" class="group rounded-2xl border border-gray-200 bg-white p-8 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer flex flex-col justify-between">
                    <div>
                        <!-- Icon -->
                        <div class="mb-6">
                            <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 group-hover:bg-indigo-200 transition-colors duration-300">
                                <!-- Child Nutrition Icon (Folder) -->
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors duration-300 mb-2">
                                Child Nutrition
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Monitor nutritional status and growth patterns of children.
                            </p>
                        </div>
                    </div>

                    <!-- Arrow Icon (appears on hover) -->
                    <div class="flex items-center gap-2 mt-6 text-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-sm font-semibold uppercase tracking-wide">View Records</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </a>

            </div>

            <!-- Quick Stats Section -->
            <div class="mt-12 grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Last Updated</p>
                    <p class="text-2xl font-bold text-slate-800 mt-2">Today</p>
                    <p class="text-xs text-slate-500 mt-1">Your information is current</p>
                </div>

                <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Account Status</p>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-block h-3 w-3 rounded-full bg-emerald-500"></span>
                        <p class="text-lg font-bold text-slate-800">Active</p>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">All systems operational</p>
                </div>

                <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Support</p>
                    <p class="text-lg font-bold text-slate-800 mt-2">Available 24/7</p>
                    <p class="text-xs text-slate-500 mt-1">Contact admin for assistance</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
