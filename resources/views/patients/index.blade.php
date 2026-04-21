@extends('admin.admin_master')
@section('admin')

<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Patient Records</h2>
            <p class="text-sm text-slate-500 mt-1">Sierra Bullones RHU - Manage patient information</p>
        </div>

        <!-- Add Patient Dropdown Button -->
        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
            <!-- Main Button -->
            <button
                @click="open = !open"
                class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700 transition-colors duration-200"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Patient
                <svg
                    x-show="!open"
                    class="w-4 h-4 transition-transform duration-200"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
                <svg
                    x-show="open"
                    class="w-4 h-4 transition-transform duration-200"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div
                x-show="open"
                @click.away="open = false"
                x-transition
                class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden z-50"
            >
                <!-- Pregnant Women Option -->
                <a
                    href="{{ route('patients.create', ['type' => 'pregnant']) }}"
                    class="flex items-start gap-3 px-4 py-3 hover:bg-emerald-50 transition-colors duration-150 border-b border-gray-100"
                >
                    <div class="flex-shrink-0 mt-1">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-100">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h-2m0 0H10m2 0v2m0-2v-2m7 2a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900">Pregnant Woman</p>
                        <p class="text-xs text-slate-500 mt-0.5">Enroll maternal care patient</p>
                    </div>
                </a>

                <!-- Malnourished Child Option -->
                <a
                    href="{{ route('patients.create', ['type' => 'malnourished']) }}"
                    class="flex items-start gap-3 px-4 py-3 hover:bg-blue-50 transition-colors duration-150"
                >
                    <div class="flex-shrink-0 mt-1">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900">Malnourished Child</p>
                        <p class="text-xs text-slate-500 mt-0.5">Enroll nutrition support patient</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
        <form action="{{ route('patients.index') }}" method="GET" class="flex flex-col gap-4 md:flex-row md:items-center md:gap-3">
            <!-- Search Input -->
            <div class="flex-1 relative">
                <input
                    type="text"
                    name="search"
                    placeholder="Search by patient name..."
                    value="{{ request('search') }}"
                    class="w-full rounded-lg border border-gray-200 px-4 py-2.5 pl-10 text-sm text-slate-900 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-all duration-200"
                >
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <!-- Category Dropdown -->
            <select
                name="category"
                class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-all duration-200 bg-white cursor-pointer"
            >
                <option value="">All Categories</option>
                <option value="pregnant" {{ request('category') == 'pregnant' ? 'selected' : '' }}>Pregnant Women</option>
                <option value="child" {{ request('category') == 'child' ? 'selected' : '' }}>Malnourished Children</option>
            </select>

            <!-- Filter Button -->
            <button
                type="submit"
                class="rounded-lg bg-emerald-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700 transition-colors duration-200 flex items-center justify-center gap-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter
            </button>
        </form>
    </div>

    <!-- Data Table Section -->
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm overflow-hidden">
        <!-- Responsive Table Wrapper -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <!-- Sticky Header -->
                <thead class="sticky top-0 bg-slate-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700">Name</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700">Category</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700">Barangay</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700">Contact</th>
                        <th class="px-6 py-4 text-center font-semibold text-slate-700">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-gray-200">
                    @forelse($patients as $patient)
                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                            <!-- Patient Name -->
                            <td class="px-6 py-4">
                                <div class="text-slate-900 font-medium">{{ $patient->name }}</div>
                            </td>

                            <!-- Category Badge -->
                            <td class="px-6 py-4">
                                @if($patient->category === 'pregnant')
                                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        <span class="text-lg">🤰</span>
                                        Pregnant
                                    </span>
                                @elseif($patient->category === 'child')
                                    <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        <span class="text-lg">👧</span>
                                        Child
                                    </span>
                                @endif
                            </td>

                            <!-- Barangay -->
                            <td class="px-6 py-4">
                                <div class="text-slate-600">{{ $patient->barangay }}</div>
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-4">
                                <div class="text-slate-600 font-mono text-sm">{{ $patient->contact_number }}</div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3">
                                    <!-- View Button -->
                                    <a
                                        href="{{ route('patients.show', $patient->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 transition-all duration-200 hover:scale-110"
                                        title="View"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('patients.edit', $patient->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all duration-200 hover:scale-110"
                                        title="Edit"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form
                                        action="{{ route('patients.destroy', $patient->id) }}"
                                        method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this patient? This action cannot be undone.');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200 hover:scale-110"
                                            title="Delete"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-slate-600 font-medium">No patients found</p>
                                    <p class="text-slate-500 text-sm mt-1">Try adjusting your search or filter criteria</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer with Count -->
        <div class="border-t border-gray-200 bg-slate-50 px-6 py-3 flex items-center justify-between">
            <p class="text-sm text-slate-600">
                Showing <span class="font-semibold">{{ count($patients) }}</span> patient(s)
            </p>
        </div>
    </div>

</div>

@endsection

