<title>{{ config('app.name', 'NutriCare') }} | Register</title>
<x-guest-layout>
    <x-slot name="logo">
        <a href="/" class="flex flex-col items-center">
            <div class="pt-12 mb-2">
                <img src="{{ asset('images/NutriCare_Logo.png') }}"
                class="mx-auto mb-0 h-28 w-auto brightness-110 contrast-125 mix-blend-multiply"
                alt="NutriCare Logo">
            </div>
        </a>
    </x-slot>

    <div class="mb-1 mt-0 text-center">
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Create NutriCare Account</h2>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number (New Field for RHU) -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required placeholder="09123456789" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Barangay (New Field for RHU) -->
        <div class="mt-4">
            <x-input-label for="barangay" :value="__('Barangay')" />
            <x-text-input id="barangay" class="block mt-1 w-full" type="text" name="barangay" :value="old('barangay')" required placeholder="e.g. Poblacion" />
            <x-input-error :messages="$errors->get('barangay')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-emerald-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <!-- Emerald Green Styling for the Button -->
            <x-primary-button class="ms-4 bg-emerald-600 hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-800">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
