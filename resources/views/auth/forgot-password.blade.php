<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NutriCare') }} | Forgot Password</title>
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
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-emerald-100">Secure Recovery</p>
                            <h1 class="mt-4 text-4xl font-black leading-tight tracking-tight">Health monitoring access, restored safely.</h1>
                            <p class="mt-5 max-w-sm text-sm leading-6 text-emerald-50/90">
                                Reset credentials through a guided OTP flow built for a clean, trustworthy RHU authentication experience.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-3 text-sm text-emerald-50/95">
                        <div class="flex items-center gap-3 rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                            <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-4.35 7-11V5l-7-3-7 3v5c0 6.65 7 11 7 11Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 12 1.5 1.5 3.25-4" />
                            </svg>
                            <span>Protected by one-time password verification</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                            <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16v10H4z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4 8 8 5 8-5" />
                            </svg>
                            <span>OTP delivered to the registered NutriCare email</span>
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
                            <p class="mt-3 text-xs font-bold uppercase tracking-[0.28em] text-emerald-600 lg:mt-0">NutriCare Recovery</p>
                            <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950">Forgot your password?</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Enter your registered NutriCare email to receive a secure 6-digit OTP.
                            </p>
                        </div>

                        <div class="mb-8" aria-label="Password recovery progress">
                            <div class="flex items-center">
                                <div class="flex flex-1 items-center">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-600 text-sm font-bold text-white shadow-lg shadow-emerald-500/40 ring-4 ring-emerald-100 transition duration-300">1</div>
                                    <div class="h-1 flex-1 rounded-full bg-slate-200">
                                        <div class="h-1 w-1/3 rounded-full bg-emerald-400 transition-all duration-700"></div>
                                    </div>
                                </div>
                                <div class="flex flex-1 items-center">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-200 text-sm font-bold text-slate-400 transition duration-300">2</div>
                                    <div class="h-1 flex-1 rounded-full bg-slate-200"></div>
                                </div>
                                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-200 text-sm font-bold text-slate-400 transition duration-300">3</div>
                            </div>
                            <div class="mt-3 grid grid-cols-3 text-center text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                <span class="text-emerald-700">Enter Email</span>
                                <span>Verify OTP</span>
                                <span>Success</span>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                                    <input id="email" class="block w-full rounded-2xl border border-emerald-100 bg-white/90 py-3.5 pl-12 pr-4 text-sm font-medium text-slate-900 shadow-sm shadow-emerald-900/5 transition duration-200 placeholder:text-slate-400 hover:border-emerald-200 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" type="email" name="email" value="{{ old('email') }}" placeholder="you@nutricare-rhu.gov" required autofocus autocomplete="email">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/25 transition duration-200 hover:-translate-y-0.5 hover:bg-emerald-500 hover:shadow-emerald-600/35 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                                <span>Send OTP</span>
                                <svg class="h-4 w-4 transition duration-200 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m13 6 6 6-6 6" />
                                </svg>
                            </button>
                        </form>

                        <div class="mt-8 flex items-center justify-center gap-2 text-center text-sm text-slate-500">
                            <span>Remembered your password?</span>
                            <a href="{{ route('login') }}" class="font-bold text-emerald-600 transition hover:text-emerald-500">Return to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
