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
                    $type = request('type', 'maternal');
                    $title = match($type) {
                        'maternal' => 'New Maternal Enrollment',
                        'child' => 'New Child Nutrition Record',
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

                    <!-- Hidden type field -->
                    <input type="hidden" name="type" value="{{ $type }}">

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

                    <!-- Birthdate Input -->
                    <div>
                        <label for="birthdate" class="block text-sm font-semibold text-slate-700 mb-2">
                            Date of Birth <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            id="birthdate"
                            name="birthdate"
                            value="{{ old('birthdate') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-slate-700
                                   focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                                   transition-all duration-200 @error('birthdate') border-red-500 @enderror"
                            required>
                        @error('birthdate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hidden Category Input -->
                    <input
                        type="hidden"
                        name="category"
                        value="{{ request('type') === 'child' ? 'child' : 'pregnant' }}"
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

                    <!-- Child Nutrition Fields (Only for type=child) -->
                    @if($type === 'child')
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4">Child Nutrition Information</h3>

                            <!-- Age (months) -->
                            <div>
                                <label for="age_months" class="block text-sm font-semibold text-slate-700 mb-2">
                                    Age (months) <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="age_months"
                                    name="age_months"
                                    value="{{ old('age_months') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-slate-700 placeholder-gray-400
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200 @error('age_months') border-red-500 @enderror"
                                    placeholder="e.g., 24"
                                    min="0"
                                    max="180"
                                    required>
                                @error('age_months')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Weight (kg) -->
                            <div class="mt-6">
                                <label for="weight_kg" class="block text-sm font-semibold text-slate-700 mb-2">
                                    Weight (kg) <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="weight_kg"
                                    name="weight_kg"
                                    value="{{ old('weight_kg') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-slate-700 placeholder-gray-400
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200 @error('weight_kg') border-red-500 @enderror"
                                    placeholder="e.g., 12.5"
                                    step="0.1"
                                    min="0"
                                    required>
                                @error('weight_kg')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Height (cm) -->
                            <div class="mt-6">
                                <label for="height_cm" class="block text-sm font-semibold text-slate-700 mb-2">
                                    Height (cm) <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="height_cm"
                                    name="height_cm"
                                    value="{{ old('height_cm') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-slate-700 placeholder-gray-400
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200 @error('height_cm') border-red-500 @enderror"
                                    placeholder="e.g., 85.5"
                                    step="0.1"
                                    min="0"
                                    required>
                                @error('height_cm')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Last Weigh-in Date -->
                            <div class="mt-6">
                                <label for="last_weigh_in_date" class="block text-sm font-semibold text-slate-700 mb-2">
                                    Last Weigh-in Date <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="date"
                                    id="last_weigh_in_date"
                                    name="last_weigh_in_date"
                                    value="{{ old('last_weigh_in_date', date('Y-m-d')) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-slate-700
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200 @error('last_weigh_in_date') border-red-500 @enderror"
                                    required>
                                @error('last_weigh_in_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nutritional Status Display (Read-only) -->
                            <div class="mt-6 p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                                <p class="text-sm text-slate-600">
                                    <span class="font-semibold">Note:</span> The nutritional status will be automatically calculated based on the child's weight, height, and age using WHO/DOH standards.
                                </p>
                            </div>
                        </div>
                    @endif

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
