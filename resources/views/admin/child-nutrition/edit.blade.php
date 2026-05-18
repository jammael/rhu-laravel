@extends('admin.admin_master')
@section('admin')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">Edit Child Nutrition Record</h1>
    <p class="text-slate-600 mt-2">Update nutrition details for {{ $record->display_name }}</p>
</div>

<div class="max-w-2xl mx-auto">
    <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100">
        <form action="{{ route('child-nutrition.update', $record->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                <input type="text" name="full_name" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" value="{{ old('full_name', $record->display_name) }}" required>
                @error('full_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Age (Months) *</label>
                <input type="number" name="age_months" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" value="{{ old('age_months', $record->age_months) }}" min="0" max="180" required>
                @error('age_months') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Barangay *</label>
                <input type="text" name="barangay" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" value="{{ old('barangay', $record->display_barangay) }}" required>
                @error('barangay') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Weight (kg) *</label>
                <input type="number" name="weight_kg" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" value="{{ old('weight_kg', $record->weight_kg) }}" step="0.1" min="0.1" max="100" required>
                @error('weight_kg') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Height (cm) *</label>
                <input type="number" name="height_cm" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" value="{{ old('height_cm', $record->height_cm) }}" step="0.1" min="0.1" max="200" required>
                @error('height_cm') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Last Weigh-in Date *</label>
                <input type="date" name="last_weigh_in_date" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none transition" value="{{ old('last_weigh_in_date', $record->last_weigh_in_date->format('Y-m-d')) }}" required>
                @error('last_weigh_in_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2.5 px-4 rounded-lg transition">Save Changes</button>
                <a href="{{ route('child-nutrition.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2.5 px-4 rounded-lg transition text-center">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
