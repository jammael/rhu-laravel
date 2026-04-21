@extends('admin.admin_master')
@section('admin')

<!-- Main Container -->
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">

        <!-- Professional Card -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">

            <!-- Card Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-gray-100 px-8 py-6">
                <h1 class="text-2xl font-bold text-slate-800">Patient Details</h1>
                <p class="text-sm text-slate-600 mt-1">Sierra Bullones Rural Health Unit</p>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mx-8 mt-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                    <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Card Body -->
            <div class="px-8 py-8">

                <!-- Category Badge -->
                <div class="mb-6">
                    @if($patient->category === 'pregnant')
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">
                            <span class="text-lg">🤰</span>
                            Pregnant Woman
                        </span>
                    @elseif($patient->category === 'child')
                        <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold text-blue-700">
                            <span class="text-lg">👧</span>
                            Malnourished Child
                        </span>
                    @endif
                </div>

                <!-- Patient Information Grid -->
                <div class="space-y-6">

                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                        <p class="text-lg text-slate-900 font-medium">{{ $patient->name }}</p>
                    </div>

                    <!-- Birthdate -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Date of Birth</label>
                        <p class="text-lg text-slate-900">{{ $patient->birthdate->format('F d, Y') }}</p>
                    </div>

                    <!-- Barangay -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Barangay</label>
                        <p class="text-lg text-slate-900">{{ $patient->barangay }}</p>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Contact Number</label>
                        <p class="text-lg text-slate-900 font-mono">{{ $patient->contact_number }}</p>
                    </div>

                    <!-- Health Remarks -->
                    @if($patient->health_remarks)
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Health Remarks</label>
                            <p class="text-slate-900">{{ $patient->health_remarks }}</p>
                        </div>
                    @endif

                    <!-- Enrollment Date -->
                    <div class="border-t border-gray-100 pt-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Enrolled Since</label>
                        <p class="text-sm text-slate-600">{{ $patient->created_at->format('F d, Y') }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-100 mt-8">
                    <a
                        href="{{ route('patients.edit', $patient->id) }}"
                        class="flex-1 px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold
                               rounded-lg transition-all duration-200 shadow-sm hover:shadow-md text-center
                               focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        Edit Patient
                    </a>
                    <a
                        href="{{ route('patients.index') }}"
                        class="flex-1 px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-slate-700 font-semibold
                               rounded-lg transition-all duration-200 text-center
                               focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
