@extends('admin.admin_master')
@section('admin')

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">Maternal Record Details</h1>
    <p class="text-slate-600 mt-2">Complete health profile for {{ $maternalRecord->full_name }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 mb-6">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">👤 Personal Information</h2>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Full Name</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $maternalRecord->full_name }}</p>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Age</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $maternalRecord->age }} years</p>
                </div>

                <div class="col-span-2">
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Address</label>
                    <p class="text-sm text-slate-700 mt-1">{{ $maternalRecord->address }}</p>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Contact Number</label>
                    <p class="text-sm text-slate-700 mt-1">{{ $maternalRecord->contact_number }}</p>
                </div>
            </div>
        </div>

        <!-- Pregnancy Information -->
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 mb-6">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">🤰 Pregnancy Information</h2>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Pregnancy Stage</label>
                    <div class="mt-1">
                        @if($maternalRecord->pregnancy_stage === 'first_trimester')
                            <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">First Trimester (0-3 months)</span>
                        @elseif($maternalRecord->pregnancy_stage === 'second_trimester')
                            <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">Second Trimester (4-6 months)</span>
                        @else
                            <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full bg-pink-100 text-pink-800">Third Trimester (7-9 months)</span>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Risk Level</label>
                    <div class="mt-1">
                        @if($maternalRecord->risk_level === 'low')
                            <span class="inline-block px-4 py-2 text-sm font-bold rounded-full bg-green-100 text-green-800">🟢 Low Risk</span>
                        @elseif($maternalRecord->risk_level === 'medium')
                            <span class="inline-block px-4 py-2 text-sm font-bold rounded-full bg-yellow-100 text-yellow-800">🟡 Medium Risk</span>
                        @else
                            <span class="inline-block px-4 py-2 text-sm font-bold rounded-full bg-red-100 text-red-800">🔴 High Risk</span>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Last Checkup Date</label>
                    <p class="text-sm text-slate-700 mt-1">{{ $maternalRecord->last_checkup_date->format('F d, Y') }}</p>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Expected Delivery Date</label>
                    <p class="text-sm text-slate-700 mt-1">{{ $maternalRecord->expected_delivery_date->format('F d, Y') }}</p>
                </div>
            </div>

            <!-- Days Calculation -->
            <div class="mt-6 p-4 bg-emerald-50 rounded-lg border border-emerald-200">
                <p class="text-sm text-slate-700">
                    <strong>Time Until Expected Delivery:</strong>
                    {{ now()->diffInDays($maternalRecord->expected_delivery_date) }} days
                </p>
            </div>
        </div>
    </div>

    <!-- Sidebar Actions -->
    <div class="lg:col-span-1">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 sticky top-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">📋 Actions</h3>

            <div class="space-y-3">
                <!-- Edit Button -->
                <a href="{{ route('maternal.edit', $maternalRecord->id) }}" class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-4 rounded-lg transition text-center">
                    ✏️ Edit Record
                </a>

                <!-- PDF Report Button -->
                <a href="{{ route('maternal.pdf', $maternalRecord->id) }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg transition text-center">
                    📄 Download PDF Report
                </a>

                <!-- Archive Button -->
                <button onclick="openArchiveModal({{ $maternalRecord->id }}, '{{ $maternalRecord->full_name }}')" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 px-4 rounded-lg transition">
                    🗑️ Archive Record
                </button>

                <!-- Back Button -->
                <a href="{{ route('maternal.index') }}" class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2.5 px-4 rounded-lg transition text-center">
                    ← Back to Records
                </a>
            </div>

            <!-- Record Info -->
            <div class="mt-6 pt-6 border-t border-gray-200 text-xs text-slate-500 space-y-2">
                <p><strong>Record ID:</strong> {{ $maternalRecord->id }}</p>
                <p><strong>Created:</strong> {{ $maternalRecord->created_at->format('M d, Y h:i A') }}</p>
                <p><strong>Last Updated:</strong> {{ $maternalRecord->updated_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Archive Confirmation Modal -->
<div id="archiveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
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

<script>
    function openArchiveModal(recordId, patientName) {
        document.getElementById('archivePatientName').textContent = patientName;
        const baseUrl = "{{ url('/maternal-care') }}";
        document.getElementById('archiveForm').action = baseUrl + '/' + recordId;
        document.getElementById('archiveModal').classList.remove('hidden');
    }

    function closeArchiveModal() {
        document.getElementById('archiveModal').classList.add('hidden');
    }

    document.getElementById('archiveModal').addEventListener('click', function(e) {
        if (e.target === this) closeArchiveModal();
    });
</script>

@endsection
