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
    <h1 class="text-3xl font-bold text-slate-800">Maternal Care Management</h1>
    <p class="text-slate-600 mt-2">Track and manage maternal health records for pregnant mothers</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Column: Add New Record Form -->
    <div class="lg:col-span-1">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 sticky top-6">
            <h2 class="text-lg font-bold text-slate-800 mb-4">📝 Add New Record</h2>

            <form action="{{ route('maternal.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                           placeholder="Enter full name" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Age -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Age *</label>
                    <input type="number" name="age" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                           placeholder="Enter age" value="{{ old('age') }}" min="15" max="50" required>
                    @error('age')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Address *</label>
                    <textarea name="address" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                              placeholder="Enter address" rows="2" required>{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Number -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Contact Number *</label>
                    <input type="text" name="contact_number" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                           placeholder="09123456789" value="{{ old('contact_number') }}" required>
                    @error('contact_number')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pregnancy Stage -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pregnancy Stage *</label>
                    <select name="pregnancy_stage" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition" required>
                        <option value="">Select stage</option>
                        <option value="first_trimester" {{ old('pregnancy_stage') === 'first_trimester' ? 'selected' : '' }}>First Trimester (0-3 months)</option>
                        <option value="second_trimester" {{ old('pregnancy_stage') === 'second_trimester' ? 'selected' : '' }}>Second Trimester (4-6 months)</option>
                        <option value="third_trimester" {{ old('pregnancy_stage') === 'third_trimester' ? 'selected' : '' }}>Third Trimester (7-9 months)</option>
                    </select>
                    @error('pregnancy_stage')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Checkup Date -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Last Checkup Date *</label>
                    <input type="date" name="last_checkup_date" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                           value="{{ old('last_checkup_date') }}" required>
                    @error('last_checkup_date')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expected Delivery Date -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Expected Delivery Date *</label>
                    <input type="date" name="expected_delivery_date" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                           value="{{ old('expected_delivery_date') }}" required>
                    @error('expected_delivery_date')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Risk Level -->
                <div>
                    <p class="block text-sm font-semibold text-slate-700 mb-2">🤖 Risk Level Status</p>
                    <div class="w-full rounded-lg border border-emerald-300 bg-emerald-50 px-4 py-2.5 text-emerald-800 text-sm">
                        ✓ Risk status will be automatically calculated
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Based on age, pregnancy stage, and checkup history</p>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-4 rounded-lg transition">
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
                            id="maternalSearchInput"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                            placeholder="Search..."
                            value="{{ request('search') }}"
                        >
                        <div id="maternalSearchLoading" class="absolute right-3 top-1/2 -translate-y-1/2 hidden">
                            <svg class="w-4 h-4 text-emerald-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Filter by Risk Level</label>
                    <select
                        id="maternalRiskFilter"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                    >
                        <option value="">All Risk Levels</option>
                        <option value="low" {{ request('risk_level') === 'low' ? 'selected' : '' }}>🟢 Low Risk</option>
                        <option value="medium" {{ request('risk_level') === 'medium' ? 'selected' : '' }}>🟡 Medium Risk</option>
                        <option value="high" {{ request('risk_level') === 'high' ? 'selected' : '' }}>🔴 High Risk</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button
                        id="maternalClearFilters"
                        class="flex-1 bg-slate-600 hover:bg-slate-700 text-white font-bold py-2.5 px-4 rounded-lg transition"
                    >
                        ✕ Clear
                    </button>
                </div>
            </div>
        </div>

        <!-- Records Table -->
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 overflow-hidden">
            <!-- Table Header with View Archived Button -->
            <div class="bg-slate-50 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">📋 Maternal Records</h3>
                <a href="{{ route('maternal.index', ['show_archived' => 1]) }}" class="px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-semibold rounded-lg transition">
                    📦 View Archived Records
                </a>
            </div>

            @if ($records->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Age</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Pregnancy Stage</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Risk Level</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Last Checkup</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Expected Delivery</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($records as $record)
                                <tr class="hover:bg-gray-50 transition {{ $record->trashed() ? 'bg-gray-100 opacity-75' : '' }}">
                                    <td class="px-6 py-4 text-sm font-medium text-slate-800">
                                        {{ $record->full_name }}
                                        @if($record->trashed())
                                            <span class="ml-2 text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded">Archived</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->age }} years</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        @if ($record->pregnancy_stage === 'first_trimester')
                                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">1st Trimester</span>
                                        @elseif ($record->pregnancy_stage === 'second_trimester')
                                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">2nd Trimester</span>
                                        @else
                                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-pink-100 text-pink-800">3rd Trimester</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if ($record->risk_level === 'low')
                                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800">🟢 Low</span>
                                        @elseif ($record->risk_level === 'medium')
                                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">🟡 Medium</span>
                                        @else
                                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800">🔴 High</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->last_checkup_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $record->expected_delivery_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <!-- Container: Fixed width to prevent overlapping -->
<div class="flex items-center justify-center gap-3">
        <!-- View Button (Modal Trigger) -->
        <button
            onclick="openViewModal({{ $record }})"
            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 transition-all duration-200 hover:scale-110"
            title="View Details"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
        </button>

        @if(!$record->trashed())
            <!-- Edit Button -->
            <a
                href="{{ route('maternal.edit', $record->id) }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all duration-200 hover:scale-110"
                title="Edit Record"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </a>

            <!-- Report Button (PDF) -->
            <a
                href="{{ route('maternal.pdf', $record->id) }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-all duration-200 hover:scale-110"
                title="Download Report"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </a>

            <!-- Archive Button -->
            <button
                onclick="openArchiveModal({{ $record->id }}, '{{ $record->full_name }}')"
                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200 hover:scale-110"
                title="Archive"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
            </button>
        @else
            <!-- Restore Button -->
            <button
                onclick="openRestoreModal({{ $record->id }}, '{{ $record->full_name }}')"
                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-all duration-200 hover:scale-110"
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

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 bg-slate-50">
                    {{ $records->links() }}
                </div>
            @else
                <div class="p-8 text-center">
                    <p class="text-slate-600 text-lg">📋 No maternal records found</p>
                    <p class="text-slate-500 text-sm mt-2">Add your first record using the form on the left</p>
                </div>
            @endif
        </div>
    </div>

</div>

<!-- View Modal -->
<div id="viewModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 p-4" style="display: none; align-items: center; justify-content: center;">
    <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Maternal Record Details</h3>
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
                    <label class="text-xs font-semibold text-slate-600 uppercase">Age</label>
                    <p id="modalAge" class="text-lg font-semibold text-slate-800"></p>
                </div>
                <div class="col-span-2">
                    <label class="text-xs font-semibold text-slate-600 uppercase">Address</label>
                    <p id="modalAddress" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Contact Number</label>
                    <p id="modalContact" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Pregnancy Stage</label>
                    <p id="modalStage" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Last Checkup Date</label>
                    <p id="modalCheckup" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Expected Delivery Date</label>
                    <p id="modalDelivery" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase">Risk Level</label>
                    <p id="modalRisk" class="text-sm text-slate-700"></p>
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
            <p class="text-slate-700 mb-2">Are you sure you want to archive this maternal record?</p>
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
            <p class="text-slate-700 mb-2">Are you sure you want to restore this archived maternal record?</p>
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
        document.getElementById('modalAge').textContent = record.age + ' years';
        document.getElementById('modalAddress').textContent = record.address;
        document.getElementById('modalContact').textContent = record.contact_number;

        const stageLabels = {
            'first_trimester': '1st Trimester (0-3 months)',
            'second_trimester': '2nd Trimester (4-6 months)',
            'third_trimester': '3rd Trimester (7-9 months)'
        };
        document.getElementById('modalStage').textContent = stageLabels[record.pregnancy_stage] || record.pregnancy_stage;
        document.getElementById('modalCheckup').textContent = new Date(record.last_checkup_date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        document.getElementById('modalDelivery').textContent = new Date(record.expected_delivery_date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

        const riskLabels = {
            'low': '🟢 Low Risk',
            'medium': '🟡 Medium Risk',
            'high': '🔴 High Risk'
        };
        document.getElementById('modalRisk').textContent = riskLabels[record.risk_level] || record.risk_level;

        // FIXED: Change display to flex to show and center the modal
        document.getElementById('viewModal').style.display = 'flex';
    }

    function closeViewModal() {
        // FIXED: Change display to none to hide
        document.getElementById('viewModal').style.display = 'none';
    }

    // Archive Modal Functions
    function openArchiveModal(recordId, patientName) {
        document.getElementById('archivePatientName').textContent = patientName;
        const baseUrl = "{{ url('/maternal-care') }}";
        document.getElementById('archiveForm').action = baseUrl + '/' + recordId;

        // FIXED: Change display to flex
        document.getElementById('archiveModal').style.display = 'flex';
    }

    function closeArchiveModal() {
        // FIXED: Change display to none
        document.getElementById('archiveModal').style.display = 'none';
    }

    // Restore Modal Functions
    function openRestoreModal(recordId, patientName) {
        document.getElementById('restorePatientName').textContent = patientName;
        const baseUrl = "{{ url('/maternal-care') }}";
        document.getElementById('restoreForm').action = baseUrl + '/' + recordId + '/restore';

        // FIXED: Change display to flex
        document.getElementById('restoreModal').style.display = 'flex';
    }

    function closeRestoreModal() {
        // FIXED: Change display to none
        document.getElementById('restoreModal').style.display = 'none';
    }

    // Close modals when clicking outside
    document.getElementById('viewModal').addEventListener('click', function(e) {
        if (e.target === this) closeViewModal();
    });
    document.getElementById('archiveModal').addEventListener('click', function(e) {
        if (e.target === this) closeArchiveModal();
    });
    document.getElementById('restoreModal').addEventListener('click', function(e) {
        if (e.target === this) closeRestoreModal();
    });

    // Reactive Search Functionality
    const maternalSearchInput = document.getElementById('maternalSearchInput');
    const maternalRiskFilter = document.getElementById('maternalRiskFilter');
    const maternalClearFilters = document.getElementById('maternalClearFilters');
    const maternalSearchLoading = document.getElementById('maternalSearchLoading');
    let maternalSearchTimeout;

    function performMaternalSearch() {
        const searchTerm = maternalSearchInput.value;
        const riskTerm = maternalRiskFilter.value;

        maternalSearchLoading.classList.remove('hidden');

        const params = new URLSearchParams();
        if (searchTerm) params.append('search', searchTerm);
        if (riskTerm) params.append('risk_level', riskTerm);

        fetch(`{{ route('maternal.index') }}?${params.toString()}`, {
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

            maternalSearchLoading.classList.add('hidden');
        })
        .catch(error => {
            console.error('Search error:', error);
            maternalSearchLoading.classList.add('hidden');
        });
    }

    maternalSearchInput.addEventListener('input', function() {
        clearTimeout(maternalSearchTimeout);
        maternalSearchTimeout = setTimeout(performMaternalSearch, 300);
    });

    maternalRiskFilter.addEventListener('change', performMaternalSearch);

    maternalClearFilters.addEventListener('click', function() {
        maternalSearchInput.value = '';
        maternalRiskFilter.value = '';
        performMaternalSearch();
    });
</script>
@endsection
