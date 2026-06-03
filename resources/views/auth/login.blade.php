<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NutriCare') }} | Login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/NutriCare_Logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans text-slate-900 antialiased">
    <main class="relative flex min-h-full items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-teal-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="pointer-events-none absolute -left-24 top-10 h-72 w-72 rounded-full bg-emerald-300/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 bottom-0 h-80 w-80 rounded-full bg-teal-300/25 blur-3xl"></div>
        <div class="pointer-events-none absolute left-1/2 top-1/4 h-40 w-40 -translate-x-1/2 rounded-full bg-lime-200/30 blur-3xl"></div>

        <section class="relative w-full max-w-5xl">
            <div class="grid overflow-hidden rounded-[2rem] border border-white/70 bg-white/80 shadow-2xl shadow-emerald-900/10 backdrop-blur-xl lg:grid-cols-[0.92fr_1.08fr]">
                <aside class="hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-teal-600 p-10 text-white lg:flex lg:flex-col lg:justify-between">
                    <div>
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-4 rounded-2xl transition duration-200 hover:translate-x-0.5">
                            <img src="{{ asset('images/NutriCare_Logo_Mark.png') }}" alt="NutriCare Logo" class="h-16 w-16 shrink-0 object-contain brightness-125 contrast-125 saturate-125 drop-shadow-[0_10px_22px_rgba(6,78,59,0.35)]">
                            <span class="pt-1">
                                <span class="block text-2xl font-black leading-none tracking-tight text-white drop-shadow-sm">NutriCare</span>
                                <span class="mt-2 block text-[0.7rem] font-bold uppercase leading-none tracking-[0.34em] text-emerald-100/95">RHU Sierra Bullones</span>
                            </span>
                        </a>

                        <div class="mt-16">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-emerald-100">Secure Login</p>
                            <h1 class="mt-4 text-4xl font-black leading-tight tracking-tight">Welcome back to your health monitoring workspace.</h1>
                            <p class="mt-5 max-w-sm text-sm leading-6 text-emerald-50/90">
                                Access NutriCare records, nutrition monitoring, and RHU account tools through a protected sign-in page.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-3 text-sm text-emerald-50/95">
                        <div class="flex items-center gap-3 rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                            <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-4.35 7-11V5l-7-3-7 3v5c0 6.65 7 11 7 11Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 12 1.5 1.5 3.25-4" />
                            </svg>
                            <span>Protected access for registered NutriCare users</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                            <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16v10H4z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4 8 8 5 8-5" />
                            </svg>
                            <span>Password recovery is available through email OTP</span>
                        </div>
                    </div>
                </aside>

                <div class="px-5 py-7 sm:px-10 sm:py-10 lg:px-12">
                    <div class="mx-auto w-full max-w-md">
                        <div class="mb-8 flex flex-col items-center text-center lg:items-start lg:text-left">
                            <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-3 rounded-2xl lg:hidden">
                                <img src="{{ asset('images/NutriCare_Logo_Mark.png') }}" alt="NutriCare Logo" class="h-14 w-14 shrink-0 object-contain brightness-110 contrast-125 saturate-125">
                                <span class="text-left">
                                    <span class="block text-xl font-black leading-none tracking-tight text-slate-950">NutriCare</span>
                                    <span class="mt-1.5 block text-[0.62rem] font-bold uppercase leading-none tracking-[0.26em] text-emerald-600">RHU Sierra Bullones</span>
                                </span>
                            </a>
                            <p class="mt-3 text-xs font-bold uppercase tracking-[0.28em] text-emerald-600 lg:mt-0">NutriCare Account</p>
                            <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950">Sign in to NutriCare</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Enter your registered email and password to continue.
                            </p>
                        </div>

                        @if (session('status'))
                            <div class="mb-5 flex gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800 shadow-sm shadow-emerald-900/5">
                                <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                </svg>
                                <span>{{ session('status') }}</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-bold text-slate-800">Email address</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-emerald-600">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16v10H4z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4 8 8 5 8-5" />
                                        </svg>
                                    </span>
                                    <input id="email" class="block w-full rounded-2xl border border-emerald-100 bg-white/90 py-3.5 pl-12 pr-4 text-sm font-medium text-slate-900 shadow-sm shadow-emerald-900/5 transition duration-200 placeholder:text-slate-400 hover:border-emerald-200 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" type="email" name="email" value="{{ old('email') }}" placeholder="you@nutricare-rhu.gov" required autofocus autocomplete="username">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-bold text-slate-800">Password</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-emerald-600">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 10V8a6 6 0 1 1 12 0v2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10h14v10H5z" />
                                        </svg>
                                    </span>
                                    <input id="password" class="block w-full rounded-2xl border border-emerald-100 bg-white/90 py-3.5 pl-12 pr-4 text-sm font-medium text-slate-900 shadow-sm shadow-emerald-900/5 transition duration-200 placeholder:text-slate-400 hover:border-emerald-200 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-emerald-200 text-emerald-600 shadow-sm focus:ring-4 focus:ring-emerald-100" name="remember">
                                    <span class="ms-2 text-sm font-medium text-slate-500">Remember me</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-sm font-bold text-emerald-600 transition hover:text-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" href="{{ route('password.request') }}">
                                        Forgot your password?
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/25 transition duration-200 hover:-translate-y-0.5 hover:bg-emerald-500 hover:shadow-emerald-600/35 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                                <span>Log in</span>
                                <svg class="h-4 w-4 transition duration-200 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m13 6 6 6-6 6" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
