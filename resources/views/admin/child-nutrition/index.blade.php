@extends('admin.admin_master')
@section('admin')

<!-- Success Message -->
@if ($message = Session::get('success'))
    <div class="mb-6 rounded-lg border border-green-300 bg-green-50 p-4 flex items-center gap-3">
        <span class="text-2xl">✅</span>
        <div>
            <p class="font-semibold text-green-800">{{ $message }}</p>
        </div>
    </div>
@endif

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">Child Nutrition Management</h1>
    <p class="text-slate-600 mt-2">Track and manage nutritional health records for children</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Column: Add New Record Form -->
    <div class="lg:col-span-1">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 sticky top-6">
            <h2 class="text-lg font-bold text-slate-800 mb-4">📝 New Growth Record</h2>

            <form action="{{ route('child-nutrition.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition"
                           placeholder="Enter child's full name" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Age (Months) -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Age (Months) *</label>
                    <input type="number" name="age_months" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition"
                           placeholder="Enter age in months" value="{{ old('age_months') }}" min="0" max="180" required>
                    @error('age_months')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Barangay -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Barangay *</label>
                    <input type="text" name="barangay" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition"
                           placeholder="Enter barangay" value="{{ old('barangay') }}" required>
                    @error('barangay')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Weight (kg) -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Weight (kg) *</label>
                    <input type="number" name="weight_kg" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition"
                           placeholder="Enter weight in kg" value="{{ old('weight_kg') }}" step="0.1" min="0" max="100" required>
                    @error('weight_kg')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Height (cm) -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Height (cm) *</label>
                    <input type="number" name="height_cm" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition"
                           placeholder="Enter height in cm" value="{{ old('height_cm') }}" step="0.1" min="0" max="200" required>
                    @error('height_cm')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nutritional Status: Auto-calculated -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <p class="text-xs text-blue-800">
                        <span class="font-semibold">ℹ️ Nutritional Status</span><br>
                        Status is automatically calculated based on weight, height, and age using WHO/DOH standards.
                    </p>
                </div>

                <!-- Last Weigh-in Date -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Last Weigh-in Date *</label>
                    <input type="date" name="last_weigh_in_date" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition"
                           value="{{ old('last_weigh_in_date') }}" required>
                    @error('last_weigh_in_date')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2.5 px-4 rounded-lg transition">
                    ➕ Add Record
                </button>
            </form>
        </div>
    </div>

    <!-- Right Column: Records Table -->
    <div class="lg:col-span-2">
        <!-- Search & Filter Section -->
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Search by Name</label>
                    <div class="relative">
                        <input
                            type="text"
                            id="childSearchInput"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition"
                            placeholder="Search..."
                            value="{{ request('search') }}"
                        >
                        <div id="childSearchLoading" class="absolute right-3 top-1/2 -translate-y-1/2 hidden">
                            <svg class="w-4 h-4 text-cyan-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Filter by Status</label>
                    <select
                        id="childStatusFilter"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition"
                    >
                        <option value="">All Statuses</option>
                        <option value="normal" {{ request('nutritional_status') === 'normal' ? 'selected' : '' }}>🟢 Normal</option>
                        <option value="underweight" {{ request('nutritional_status') === 'underweight' ? 'selected' : '' }}>🟡 Underweight</option>
                        <option value="severely_underweight" {{ request('nutritional_status') === 'severely_underweight' ? 'selected' : '' }}>🔴 Severely Underweight</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button
                        id="childClearFilters"
                        class="flex-1 bg-slate-600 hover:bg-slate-700 text-white font-bold py-2.5 px-4 rounded-lg transition"
                    >
                        ✕ Clear
                    </button>
                </div>
            </div>
        </div>

        <!-- Records Table -->
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 overflow-hidden">
            @if ($records->count() > 0)
                <div class="overflow-x-auto min-w-full w-full block whitespace-nowrap">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Child Name</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Age (Months)</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Last Weigh-in</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Weight/Height</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($records as $record)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-slate-800">{{ $record->full_name }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->age_months }} months</td>
                                    <td class="px-6 py-4 text-sm">
                                        <x-nutrition-status-badge :status="$record->nutritional_status" />
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->last_weigh_in_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->weight_kg }} kg / {{ $record->height_cm }} cm</td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('child-nutrition.report', $record->id) }}" class="inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded transition text-xs">
                                            📄 PDF Report
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 bg-slate-50">
                    {{ $records->links() }}
                </div>
            @else
                <div class="p-8 text-center">
                    <p class="text-slate-600 text-lg">📋 No child nutrition records found</p>
                    <p class="text-slate-500 text-sm mt-2">Add your first record using the form on the left</p>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('childSearchInput');
    const statusFilter = document.getElementById('childStatusFilter');
    const clearButton = document.getElementById('childClearFilters');
    const searchLoading = document.getElementById('childSearchLoading');
    let searchTimeout;

    function performSearch() {
        const searchTerm = searchInput.value;
        const statusTerm = statusFilter.value;

        searchLoading.classList.remove('hidden');

        const params = new URLSearchParams();
        if (searchTerm) params.append('search', searchTerm);
        if (statusTerm) params.append('nutritional_status', statusTerm);

        fetch(`{{ route('child-nutrition.index') }}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(html, 'text/html');
            const newTableBody = newDoc.querySelector('tbody');
            const newFooter = newDoc.querySelector('.px-6.py-4.border-t.border-gray-200.bg-slate-50');

            if (newTableBody) {
                document.querySelector('tbody').innerHTML = newTableBody.innerHTML;
            }
            if (newFooter) {
                const currentFooter = document.querySelector('.px-6.py-4.border-t.border-gray-200.bg-slate-50');
                if (currentFooter) {
                    currentFooter.innerHTML = newFooter.innerHTML;
                }
            }

            searchLoading.classList.add('hidden');
        })
        .catch(error => {
            console.error('Search error:', error);
            searchLoading.classList.add('hidden');
        });
    }

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 300);
    });

    statusFilter.addEventListener('change', performSearch);

    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = '';
        performSearch();
    });
});
</script>
@endpush
