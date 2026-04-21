<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name', 'NutriCare') }} | Sign In</title>

    {{-- ADD THIS LINE: To show your logo in the browser tab here too --}}
    <link rel="icon" type="image/png" href="{{ asset('images/NutriCare_Logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">

  {{-- Header & Logo Section --}}
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <!-- Link to your saved NutriCare_Logo in public/images -->
    <img src="{{ asset('images/NutriCare_Logo.png') }}"
     alt="NutriCare Logo"
     class="mx-auto h-24 w-auto mb-6 brightness-110 contrast-150 saturate-125" />


    <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
    <p class="text-center text-sm text-gray-500 mt-1">Sierra Bullones Health Monitoring System</p>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

    {{-- Main Login Form --}}
    <form action="{{ route('login') }}" method="POST" class="space-y-6">
      @csrf

      {{-- Display Validation Errors --}}
      @if ($errors->any())
          <div class="p-3 rounded-md bg-red-50 text-xs text-red-600 border border-red-200">
              {{ $errors->first() }}
          </div>
      @endif

      <div>
        <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                 class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-emerald-600 sm:text-sm">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
          <div class="text-sm">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-semibold text-emerald-600 hover:text-emerald-500">Forgot password?</a>
            @endif
          </div>
        </div>
        <div class="mt-2">
          <input id="password" type="password" name="password" required autocomplete="current-password"
                 class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-emerald-600 sm:text-sm">
        </div>
      </div>

      <div>
        {{-- Professional Emerald Green Button --}}
        <button type="submit" class="flex w-full justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition">
            Sign in
        </button>
      </div>
    </form>

    {{-- Balanced Navigation Links --}}
    <p class="mt-10 text-center text-sm text-gray-500">
      Not yet registered?
      <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-500">
          Create an account
      </a>
    </p>

  </div>
</div>
</body>
</html>
