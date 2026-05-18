@extends('admin.admin_master')
@section('admin')

@if ($message = Session::get('success'))
    <div class="mb-6 rounded-lg border border-green-300 bg-green-50 p-4 flex items-center gap-3">
        <div>
            <p class="font-semibold text-green-800">{{ $message }}</p>
        </div>
    </div>
@endif

<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">Child Nutrition Management</h1>
    <p class="text-slate-600 mt-2">Track and manage nutritional health records for children</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 sticky top-6">
            <h2 class="text-lg font-bold text-slate-800 mb-4">New Growth Record</h2>

            <form action="{{ route('child-nutrition.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" placeholder="Enter child's full name" value="{{ old('full_name') }}" required>
                    @error('full_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Age (Months) *</label>
                    <input type="number" name="age_months" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" placeholder="Enter age in months" value="{{ old('age_months') }}" min="0" max="180" required>
                    @error('age_months') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Barangay *</label>
                    <input type="text" name="barangay" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" placeholder="Enter barangay" value="{{ old('barangay') }}" required>
                    @error('barangay') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Weight (kg) *</label>
                    <input type="number" name="weight_kg" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" placeholder="Enter weight in kg" value="{{ old('weight_kg') }}" step="0.1" min="0" max="100" required>
                    @error('weight_kg') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Height (cm) *</label>
                    <input type="number" name="height_cm" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" placeholder="Enter height in cm" value="{{ old('height_cm') }}" step="0.1" min="0" max="200" required>
                    @error('height_cm') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <p class="text-xs text-blue-800">
                        <span class="font-semibold">Nutritional Status</span><br>
                        Status is automatically calculated based on weight, height, and age using WHO/DOH standards.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Last Weigh-in Date *</label>
                    <input type="date" name="last_weigh_in_date" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" value="{{ old('last_weigh_in_date') }}" required>
                    @error('last_weigh_in_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2.5 px-4 rounded-lg transition">
                    Add Record
                </button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Search by Name</label>
                    <div class="relative">
                        <input type="text" id="childSearchInput" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" placeholder="Search..." value="{{ request('search') }}">
                        <div id="childSearchLoading" class="absolute right-3 top-1/2 -translate-y-1/2 hidden">
                            <svg class="w-4 h-4 text-cyan-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Filter by Status</label>
                    <select id="childStatusFilter" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition">
                        <option value="">All Statuses</option>
                        <option value="normal" {{ request('nutritional_status') === 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="underweight" {{ request('nutritional_status') === 'underweight' ? 'selected' : '' }}>Underweight</option>
                        <option value="severely_underweight" {{ request('nutritional_status') === 'severely_underweight' ? 'selected' : '' }}>Severely Underweight</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button id="childClearFilters" class="flex-1 bg-slate-600 hover:bg-slate-700 text-white font-bold py-2.5 px-4 rounded-lg transition">
                        Clear
                    </button>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-slate-50 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Child Nutrition Records</h3>
                <a href="{{ route('child-nutrition.index', ['show_archived' => 1]) }}" class="px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-semibold rounded-lg transition">
                    View Archived Records
                </a>
            </div>

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
                                <th class="px-6 py-3 text-center text-xs font-bold text-slate-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($records as $record)
                                <tr class="hover:bg-gray-50 transition {{ $record->trashed() ? 'bg-gray-100 opacity-75' : '' }}">
                                    <td class="px-6 py-4 text-sm font-medium text-slate-800">
                                        {{ $record->display_name }}
                                        @if($record->trashed())
                                            <span class="ml-2 text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded">Archived</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->age_months }} months</td>
                                    <td class="px-6 py-4 text-sm">
                                        <x-nutrition-status-badge :status="$record->nutritional_status" />
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->last_weigh_in_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->weight_kg }} kg / {{ $record->height_cm }} cm</td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex items-center justify-center gap-3">
                                            <!-- View Button (Modal Trigger) -->
                                            <button
                                                onclick="openViewModal({{ $record }})"
                                                class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 transition-all duration-200 hover:scale-110"
                                                title="View Details"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>

                                            @if(!$record->trashed())
                                                <x-table-action-button :href="route('child-nutrition.edit', $record->id)" variant="edit" title="Edit Record">
                                                    <x-table-action-icons icon="edit" />
                                                </x-table-action-button>

                                                <x-table-action-button :href="route('child-nutrition.report', $record->id)" variant="report" title="Download Report">
                                                    <x-table-action-icons icon="report" />
                                                </x-table-action-button>

                                                <button
                                                    onclick="openArchiveModal({{ $record->id }}, @js($record->display_name))"
                                                    class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200 hover:scale-110"
                                                    title="Archive"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                                    </svg>
                                                </button>
                                            @else
                                                <button
                                                    onclick="openRestoreModal({{ $record->id }}, @js($record->display_name))"
                                                    class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-all duration-200 hover:scale-110"
                                                    title="Restore"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 bg-slate-50">
                    {{ $records->links() }}
                </div>
            @else
                <div class="p-8 text-center">
                    <p class="text-slate-600 text-lg">No child nutrition records found</p>
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

<!-- View Modal -->
<div id="viewModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 p-4" style="display: none; align-items: center; justify-content: center;">
    <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-gradient-to-r from-cyan-600 to-cyan-700 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Child Nutrition Record Details</h3>
            <button onclick="closeViewModal()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2">
                ✕
            </button>
        </div>

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Full Name</label>
                    <p id="modalFullName" class="text-lg font-semibold text-slate-800"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Age (Months)</label>
                    <p id="modalAge" class="text-lg font-semibold text-slate-800"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Barangay</label>
                    <p id="modalBarangay" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Nutritional Status</label>
                    <p id="modalStatus" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Weight (kg)</label>
                    <p id="modalWeight" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Height (cm)</label>
                    <p id="modalHeight" class="text-sm text-slate-700"></p>
                </div>
                <div class="col-span-2">
                    <label class="text-xs font-semibold text-slate-600 uppercase">Last Weigh-in Date</label>
                    <p id="modalDate" class="text-sm text-slate-700"></p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
            <button onclick="closeViewModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition">
                Close
            </button>
        </div>
    </div>
</div>

<!-- Archive Confirmation Modal -->
<div id="archiveModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 p-4" style="display: none; align-items: center; justify-content: center;">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full">
        <div class="bg-red-600 px-6 py-4">
            <h3 class="text-xl font-bold text-white">⚠️ Confirm Archive</h3>
        </div>

        <div class="p-6">
            <p class="text-slate-700 mb-2">Are you sure you want to archive this child nutrition record?</p>
            <p id="archivePatientName" class="text-lg font-bold text-red-600 mb-4"></p>
            <p class="text-sm text-slate-600">This record will be hidden from the main view but kept in the database for medical history retention. You can restore it later if needed.</p>
        </div>

        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
            <button onclick="closeArchiveModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition">
                Cancel
            </button>
            <form id="archiveForm" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                    Archive Record
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Restore Confirmation Modal -->
<div id="restoreModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 p-4" style="display: none; align-items: center; justify-content: center;">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full">
        <div class="bg-amber-600 px-6 py-4">
            <h3 class="text-xl font-bold text-white">↩️ Confirm Restore</h3>
        </div>

        <div class="p-6">
            <p class="text-slate-700 mb-2">Are you sure you want to restore this archived child nutrition record?</p>
            <p id="restorePatientName" class="text-lg font-bold text-amber-600 mb-4"></p>
            <p class="text-sm text-slate-600">This record will be restored to the active list and be visible in the main view again.</p>
        </div>

        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
            <button onclick="closeRestoreModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition">
                Cancel
            </button>
            <form id="restoreForm" method="POST" style="display: inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-lg transition">
                    Restore Record
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // View Modal Functions
    function openViewModal(record) {
        document.getElementById('modalFullName').textContent = record.full_name;
        document.getElementById('modalAge').textContent = record.age_months + ' months';
        document.getElementById('modalBarangay').textContent = record.barangay;
        document.getElementById('modalWeight').textContent = record.weight_kg + ' kg';
        document.getElementById('modalHeight').textContent = record.height_cm + ' cm';

        const statusLabels = {
            'normal': '✅ Normal',
            'underweight': '⚠️ Underweight',
            'severely_underweight': '🔴 Severely Underweight'
        };
        document.getElementById('modalStatus').textContent = statusLabels[record.nutritional_status] || record.nutritional_status;
        document.getElementById('modalDate').textContent = new Date(record.last_weigh_in_date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

        document.getElementById('viewModal').style.display = 'flex';
    }

    function closeViewModal() {
        document.getElementById('viewModal').style.display = 'none';
    }

    // Archive Modal Functions
    function openArchiveModal(recordId, recordName) {
        document.getElementById('archivePatientName').textContent = recordName;
        const baseUrl = "{{ url('/child-nutrition') }}";
        document.getElementById('archiveForm').action = baseUrl + '/' + recordId;

        document.getElementById('archiveModal').style.display = 'flex';
    }

    function closeArchiveModal() {
        document.getElementById('archiveModal').style.display = 'none';
    }

    // Restore Modal Functions
    function openRestoreModal(recordId, recordName) {
        document.getElementById('restorePatientName').textContent = recordName;
        const baseUrl = "{{ url('/child-nutrition') }}";
        document.getElementById('restoreForm').action = baseUrl + '/' + recordId + '/restore';

        document.getElementById('restoreModal').style.display = 'flex';
    }

    function closeRestoreModal() {
        document.getElementById('restoreModal').style.display = 'none';
    }

    // Close modals when clicking outside
    document.getElementById('archiveModal').addEventListener('click', function(e) {
        if (e.target === this) closeArchiveModal();
    });
    document.getElementById('restoreModal').addEventListener('click', function(e) {
        if (e.target === this) closeRestoreModal();
    });
    document.getElementById('viewModal').addEventListener('click', function(e) {
        if (e.target === this) closeViewModal();
    });
</script>

@endpush
