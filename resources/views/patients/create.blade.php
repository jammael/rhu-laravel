@extends('admin.admin_master')
@section('admin')

<!-- Main Container -->
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">

        <!-- Professional Card -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">

            <!-- Card Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-gray-100 px-8 py-6">
                @php
                    $type = request('type', 'pregnant');
                    $title = match($type) {
                        'pregnant' => 'New Maternal Enrollment',
                        'malnourished' => 'New Child Nutrition Record',
                        default => 'Patient Enrollment'
                    };
                @endphp
                <h1 class="text-2xl font-bold text-slate-800">{{ $title }}</h1>
                <p class="text-sm text-slate-600 mt-1">Sierra Bullones Rural Health Unit</p>
            </div>

            <!-- Card Body -->
            <div class="px-8 py-8">

                <!-- Validation Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm font-semibold text-red-800 mb-2">Please correct the following errors:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm text-red-700">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('patients.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Full Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-slate-700 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                                   transition-all duration-200 @error('name') border-red-500 @enderror"
                            placeholder="Enter patient's full name"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hidden Category Input -->
                    <input
                        type="hidden"
                        name="category"
                        value="{{ request('type') === 'malnourished' ? 'child' : 'pregnant' }}"
                    >

                    <!-- Barangay Input -->
                    <div>
                        <label for="barangay" class="block text-sm font-semibold text-slate-700 mb-2">
                            Barangay <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="barangay"
                            name="barangay"
                            value="{{ old('barangay') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-slate-700 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                                   transition-all duration-200 @error('barangay') border-red-500 @enderror"
                            placeholder="Enter barangay name"
                            required>
                        @error('barangay')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Number Input -->
                    <div>
                        <label for="contact_number" class="block text-sm font-semibold text-slate-700 mb-2">
                            Contact Number (for SMS) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="contact_number"
                            name="contact_number"
                            value="{{ old('contact_number') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-slate-700 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                                   transition-all duration-200 @error('contact_number') border-red-500 @enderror"
                            placeholder="09123456789"
                            required>
                        @error('contact_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-6 border-t border-gray-100">
                        <button
                            type="submit"
                            class="flex-1 px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold
                                   rounded-lg transition-all duration-200 shadow-sm hover:shadow-md
                                   focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            Save Patient
                        </button>
                        <a
                            href="{{ route('patients.index') }}"
                            class="flex-1 px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-slate-700 font-semibold
                                   rounded-lg transition-all duration-200 text-center
                                   focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                            Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
