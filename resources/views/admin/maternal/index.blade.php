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
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Risk Level *</label>
                    <select name="risk_level" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition" required>
                        <option value="">Select risk level</option>
                        <option value="low" {{ old('risk_level') === 'low' ? 'selected' : '' }}>🟢 Low Risk</option>
                        <option value="medium" {{ old('risk_level') === 'medium' ? 'selected' : '' }}>🟡 Medium Risk</option>
                        <option value="high" {{ old('risk_level') === 'high' ? 'selected' : '' }}>🔴 High Risk</option>
                    </select>
                    @error('risk_level')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
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
            <form action="{{ route('maternal.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Search by Name</label>
                    <input type="text" name="search" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                           placeholder="Search..." value="{{ request('search') }}">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Filter by Risk Level</label>
                    <select name="risk_level" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition">
                        <option value="">All Risk Levels</option>
                        <option value="low" {{ request('risk_level') === 'low' ? 'selected' : '' }}>🟢 Low Risk</option>
                        <option value="medium" {{ request('risk_level') === 'medium' ? 'selected' : '' }}>🟡 Medium Risk</option>
                        <option value="high" {{ request('risk_level') === 'high' ? 'selected' : '' }}>🔴 High Risk</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-4 rounded-lg transition">
                        🔍 Search
                    </button>
                </div>
            </form>
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
                                        <div class="grid grid-cols-2 gap-2">
                                            <!-- View Button -->
                                            <button onclick="openViewModal({{ $record }})" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                                                👁 View
                                            </button>

                                            @if(!$record->trashed())
                                                <!-- Edit Button -->
                                                <a href="{{ route('maternal.edit', $record) }}" class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg transition">
                                                    ✏️ Edit
                                                </a>

                                                <!-- Report Button -->
                                                <a href="{{ route('maternal.pdf', $record) }}" class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition">
                                                    📄 Report
                                                </a>

                                                <!-- Archive Button -->
                                                <button onclick="openArchiveModal({{ $record->id }}, '{{ $record->full_name }}')" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition">
                                                    🗑️ Archive
                                                </button>

                                            @else
                                                <!-- Restore Button -->
                                                <button onclick="openRestoreModal({{ $record->id }}, '{{ $record->full_name }}')" class="px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold rounded-lg transition">
                                                    ↩️ Restore
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
<div id="viewModal" style="display: none;" class="fixed inset-0 z-50 items-center justify-center p-4 bg-black bg-opacity-50 flex">
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
<div id="archiveModal" style="display: none;" class="fixed inset-0 z-50 items-center justify-center p-4 bg-black bg-opacity-50 flex">
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
<div id="restoreModal" style="display: none;" class="fixed inset-0 z-50 items-center justify-center p-4 bg-black bg-opacity-50 flex">
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

        document.getElementById('viewModal').classList.remove('hidden');
    }

    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
    }

    // Archive Modal Functions
    function openArchiveModal(recordId, patientName) {
        document.getElementById('archivePatientName').textContent = patientName;
        const baseUrl = "{{ url('/maternal-care') }}";
        document.getElementById('archiveForm').action = baseUrl + '/' + recordId;
        document.getElementById('archiveModal').classList.remove('hidden');
    }

    function closeArchiveModal() {
        document.getElementById('archiveModal').classList.add('hidden');
    }

    // Restore Modal Functions
    function openRestoreModal(recordId, patientName) {
        document.getElementById('restorePatientName').textContent = patientName;
        const baseUrl = "{{ url('/maternal-care') }}";
        document.getElementById('restoreForm').action = baseUrl + '/' + recordId + '/restore';
        document.getElementById('restoreModal').classList.remove('hidden');
    }

    function closeRestoreModal() {
        document.getElementById('restoreModal').classList.add('hidden');
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
</script>

@endsection
