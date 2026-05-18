@extends('admin.admin_master')
@section('admin')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">Child Nutrition Details</h1>
    <p class="text-slate-600 mt-2">Complete nutrition profile for {{ $record->display_name }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 mb-6">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Patient Information</h2>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Full Name</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $record->display_name }}</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Age</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $record->age_months }} months</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Barangay</label>
                    <p class="text-sm text-slate-700 mt-1">{{ $record->display_barangay }}</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Last Weigh-in</label>
                    <p class="text-sm text-slate-700 mt-1">{{ $record->last_weigh_in_date->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Growth Information</h2>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Weight</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $record->weight_kg }} kg</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Height</label>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $record->height_cm }} cm</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Nutritional Status</label>
                    <div class="mt-1">
                        <x-nutrition-status-badge :status="$record->nutritional_status" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 sticky top-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('child-nutrition.edit', $record->id) }}" class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-4 rounded-lg transition text-center">Edit Record</a>
                <a href="{{ route('child-nutrition.report', $record->id) }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg transition text-center">Download PDF Report</a>
                <a href="{{ route('child-nutrition.index') }}" class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2.5 px-4 rounded-lg transition text-center">Back to Records</a>
            </div>
        </div>
    </div>
</div>

@endsection
