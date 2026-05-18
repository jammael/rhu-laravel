@extends('admin.admin_master')
@section('admin')

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Patient Records</h2>
            <p class="text-sm text-slate-500 mt-1">Sierra Bullones RHU - Manage patient information</p>
        </div>

        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
            <button @click="open = !open" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700 transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Patient
            </button>

            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden z-50">
                <a href="{{ route('patients.create', ['type' => 'maternal']) }}" class="flex items-start gap-3 px-4 py-3 hover:bg-emerald-50 transition-colors duration-150 border-b border-gray-100">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900">Pregnant Woman</p>
                        <p class="text-xs text-slate-500 mt-0.5">Enroll maternal care patient</p>
                    </div>
                </a>
                <a href="{{ route('patients.create', ['type' => 'child']) }}" class="flex items-start gap-3 px-4 py-3 hover:bg-blue-50 transition-colors duration-150">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900">Malnourished Child</p>
                        <p class="text-xs text-slate-500 mt-0.5">Enroll nutrition support patient</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="rounded-lg border border-green-300 bg-green-50 p-4">
            <p class="font-semibold text-green-800">{{ $message }}</p>
        </div>
    @endif

    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:gap-3">
            <div class="flex-1 relative">
                <input type="text" id="searchInput" placeholder="Search by patient name..." value="{{ request('search') }}" class="w-full rounded-lg border border-gray-200 px-4 py-2.5 pl-10 text-sm text-slate-900 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-all duration-200">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <div id="searchLoading" class="absolute right-3 top-1/2 -translate-y-1/2 hidden">
                    <svg class="w-4 h-4 text-emerald-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>

            <select id="categoryFilter" class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-all duration-200 bg-white cursor-pointer">
                <option value="">All Categories</option>
                <option value="pregnant" {{ request('category') == 'pregnant' ? 'selected' : '' }}>Pregnant Women</option>
                <option value="child" {{ request('category') == 'child' ? 'selected' : '' }}>Malnourished Children</option>
            </select>

            <button id="clearFilters" class="rounded-lg bg-slate-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-slate-700 transition-colors duration-200 flex items-center justify-center gap-2">
                Clear
            </button>
        </div>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white shadow-sm overflow-hidden">
        <div class="bg-slate-50 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Patient Records</h3>
            <a href="{{ route('patients.index', ['show_archived' => 1]) }}" class="px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-semibold rounded-lg transition">
                View Archived Records
            </a>
        </div>

        <div class="overflow-x-auto min-w-full w-full block whitespace-nowrap">
            <table class="w-full text-sm">
                <thead class="sticky top-0 bg-slate-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700">Name</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700">Category</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700">Barangay</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700">Contact</th>
                        <th class="px-6 py-4 text-center font-semibold text-slate-700">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($patients as $patient)
                        <tr class="hover:bg-slate-50 transition-colors duration-150 {{ $patient->trashed() ? 'bg-gray-100 opacity-75' : '' }}">
                            <td class="px-6 py-4">
                                <div class="text-slate-900 font-medium">
                                    {{ $patient->name }}
                                    @if($patient->trashed())
                                        <span class="ml-2 text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded">Archived</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($patient->category === 'pregnant')
                                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Pregnant</span>
                                @elseif($patient->category === 'child')
                                    <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Child</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-600">{{ $patient->barangay }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-600 font-mono text-sm">{{ $patient->contact_number }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3">
                                    @if(!$patient->trashed())
                                        <button
                                            onclick="openViewModal({{ $patient->toJson() }})"
                                            class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 transition-all duration-200 hover:scale-110"
                                            title="View Details"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>

                                        <x-table-action-button :href="route('patients.edit', $patient->id)" variant="edit" title="Edit Patient">
                                            <x-table-action-icons icon="edit" />
                                        </x-table-action-button>

                                        <x-table-action-button :href="route('patients.pdf', $patient->id)" variant="report" title="Download Report">
                                            <x-table-action-icons icon="report" />
                                        </x-table-action-button>

                                        <button
                                            onclick="openArchiveModal({{ $patient->id }}, @js($patient->name))"
                                            class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200 hover:scale-110"
                                            title="Archive"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                            </svg>
                                        </button>
                                    @else
                                        <button
                                            onclick="openViewModal({{ $patient->toJson() }})"
                                            class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 transition-all duration-200 hover:scale-110"
                                            title="View Details"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>

                                        <button
                                            onclick="openRestoreModal({{ $patient->id }}, @js($patient->name))"
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
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <p class="text-slate-600 font-medium">No patients found</p>
                                <p class="text-slate-500 text-sm mt-1">Try adjusting your search or filter criteria</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-200 bg-slate-50 px-6 py-3 flex items-center justify-between">
            <p class="text-sm text-slate-600">
                Showing <span class="font-semibold">{{ count($patients) }}</span> patient(s)
            </p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const clearButton = document.getElementById('clearFilters');
    const searchLoading = document.getElementById('searchLoading');
    let searchTimeout;

    function performSearch() {
        const searchTerm = searchInput.value;
        const categoryTerm = categoryFilter.value;

        searchLoading.classList.remove('hidden');

        const params = new URLSearchParams();
        if (searchTerm) params.append('search', searchTerm);
        if (categoryTerm) params.append('category', categoryTerm);

        fetch(`{{ route('patients.index') }}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(html, 'text/html');
            const newTableBody = newDoc.querySelector('tbody');
            const newFooter = newDoc.querySelector('.bg-slate-50.px-6.py-3');

            if (newTableBody) {
                document.querySelector('tbody').innerHTML = newTableBody.innerHTML;
            }
            if (newFooter) {
                document.querySelector('.bg-slate-50.px-6.py-3').innerHTML = newFooter.innerHTML;
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

    categoryFilter.addEventListener('change', performSearch);

    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        categoryFilter.value = '';
        performSearch();
    });
});
</script>

<!-- View Modal -->
<div id="viewModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 p-4" style="display: none; align-items: center; justify-content: center;">
    <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Patient Record Details</h3>
            <button onclick="closeViewModal()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2">
                ✕
            </button>
        </div>

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Name</label>
                    <p id="modalName" class="text-lg font-semibold text-slate-800"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Category</label>
                    <p id="modalCategory" class="text-lg font-semibold text-slate-800"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Barangay</label>
                    <p id="modalBarangay" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Contact Number</label>
                    <p id="modalContact" class="text-sm text-slate-700"></p>
                </div>
                <div class="col-span-2">
                    <label class="text-xs font-semibold text-slate-600 uppercase">Birthdate</label>
                    <p id="modalBirthdate" class="text-sm text-slate-700"></p>
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
            <p class="text-slate-700 mb-2">Are you sure you want to archive this patient and linked records?</p>
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
            <p class="text-slate-700 mb-2">Are you sure you want to restore this archived patient?</p>
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
    function openViewModal(patientData) {
        // Parse patient object if it's a string
        const patient = typeof patientData === 'string' ? JSON.parse(patientData) : patientData;

        document.getElementById('modalName').textContent = patient.name;
        document.getElementById('modalBarangay').textContent = patient.barangay;
        document.getElementById('modalContact').textContent = patient.contact_number;

        const categoryLabel = patient.category === 'pregnant' ? '🤰 Pregnant Woman' : '👶 Malnourished Child';
        document.getElementById('modalCategory').textContent = categoryLabel;

        const birthdate = new Date(patient.birthdate);
        document.getElementById('modalBirthdate').textContent = birthdate.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        document.getElementById('viewModal').style.display = 'flex';
    }

    function closeViewModal() {
        document.getElementById('viewModal').style.display = 'none';
    }

    // Archive Modal Functions
    function openArchiveModal(patientId, patientName) {
        document.getElementById('archivePatientName').textContent = patientName;
        const baseUrl = "{{ url('/patients') }}";
        document.getElementById('archiveForm').action = baseUrl + '/' + patientId;

        document.getElementById('archiveModal').style.display = 'flex';
    }

    function closeArchiveModal() {
        document.getElementById('archiveModal').style.display = 'none';
    }

    // Restore Modal Functions
    function openRestoreModal(patientId, patientName) {
        document.getElementById('restorePatientName').textContent = patientName;
        const baseUrl = "{{ url('/patients') }}";
        document.getElementById('restoreForm').action = baseUrl + '/' + patientId + '/restore';

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
