@extends('admin.admin_master')
@section('admin')

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">Edit Maternal Record</h1>
    <p class="text-slate-600 mt-2">Update health details for {{ $maternalRecord->display_name }}</p>
</div>

<div class="max-w-2xl mx-auto">
    <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100">

        <form action="{{ route('maternal.update', $maternalRecord->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PATCH')

            <!-- Full Name -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                <input type="text" name="full_name" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                       value="{{ old('full_name', $maternalRecord->display_name) }}" required>
                @error('full_name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Age -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Age *</label>
                <input type="number" name="age" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                       value="{{ old('age', $maternalRecord->age) }}" min="15" max="50" required>
                @error('age')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Address *</label>
                <textarea name="address" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                          rows="3" required>{{ old('address', $maternalRecord->display_address) }}</textarea>
                @error('address')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact Number -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Contact Number *</label>
                <input type="text" name="contact_number" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                       value="{{ old('contact_number', $maternalRecord->display_contact_number) }}" required>
                @error('contact_number')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregnancy Stage -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Pregnancy Stage *</label>
                <select name="pregnancy_stage" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition" required>
                    <option value="">Select stage</option>
                    <option value="first_trimester" {{ old('pregnancy_stage', $maternalRecord->pregnancy_stage) === 'first_trimester' ? 'selected' : '' }}>First Trimester (0-3 months)</option>
                    <option value="second_trimester" {{ old('pregnancy_stage', $maternalRecord->pregnancy_stage) === 'second_trimester' ? 'selected' : '' }}>Second Trimester (4-6 months)</option>
                    <option value="third_trimester" {{ old('pregnancy_stage', $maternalRecord->pregnancy_stage) === 'third_trimester' ? 'selected' : '' }}>Third Trimester (7-9 months)</option>
                </select>
                @error('pregnancy_stage')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Checkup Date -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Last Checkup Date *</label>
                <input type="date" name="last_checkup_date" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                       value="{{ old('last_checkup_date', $maternalRecord->last_checkup_date->format('Y-m-d')) }}" required>
                @error('last_checkup_date')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Expected Delivery Date -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Expected Delivery Date *</label>
                <input type="date" name="expected_delivery_date" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                       value="{{ old('expected_delivery_date', $maternalRecord->expected_delivery_date->format('Y-m-d')) }}" required>
                @error('expected_delivery_date')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Risk Level -->
            <div>
                <p class="block text-sm font-semibold text-slate-700 mb-2">🤖 Risk Level Status</p>
                <div class="w-full rounded-lg border border-blue-300 bg-blue-50 px-4 py-2.5 text-blue-800 text-sm flex items-center justify-between">
                    <span>✓ Current Risk Level:</span>
                    <span class="font-bold">
                        @if($maternalRecord->risk_level === 'low')
                            🟢 Low Risk
                        @elseif($maternalRecord->risk_level === 'medium')
                            🟡 Medium Risk
                        @else
                            🔴 High Risk
                        @endif
                    </span>
                </div>
                <p class="text-xs text-slate-500 mt-2">This value is automatically calculated based on age, pregnancy stage, and checkup history. It will update when you save changes.</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-4 rounded-lg transition">
                    💾 Save Changes
                </button>
                <a href="{{ route('maternal.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2.5 px-4 rounded-lg transition text-center">
                    ✕ Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
