<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NutriCare') }} | Password Reset Successful</title>
    <link rel="icon" type="image/png" href="{{ asset('images/NutriCare_Logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans text-slate-900 antialiased">
    <main class="relative flex min-h-full items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-teal-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="pointer-events-none absolute -left-24 top-10 h-72 w-72 rounded-full bg-emerald-300/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 bottom-0 h-80 w-80 rounded-full bg-teal-300/25 blur-3xl"></div>
        <div class="pointer-events-none absolute left-1/2 top-1/4 h-40 w-40 -translate-x-1/2 rounded-full bg-lime-200/30 blur-3xl"></div>

        <section class="relative w-full max-w-2xl">
            <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/85 px-5 py-8 text-center shadow-2xl shadow-emerald-900/10 backdrop-blur-xl sm:px-10 sm:py-10">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-3 rounded-2xl">
                    <img src="{{ asset('images/NutriCare_Logo_Mark.png') }}" alt="NutriCare Logo" class="h-16 w-16 shrink-0 object-contain brightness-110 contrast-125 saturate-125">
                    <span class="text-left">
                        <span class="block text-2xl font-black leading-none tracking-tight text-slate-950">NutriCare</span>
                        <span class="mt-2 block text-[0.68rem] font-bold uppercase leading-none tracking-[0.28em] text-emerald-600">RHU Sierra Bullones</span>
                    </span>
                </a>

                <div class="mx-auto mt-8 max-w-md">
                    <div class="mb-8" aria-label="Password recovery progress">
                        <div class="flex items-center">
                            <div class="flex flex-1 items-center">
                                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-600 text-white shadow-lg shadow-emerald-500/35 ring-4 ring-emerald-100 transition duration-300">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                    </svg>
                                </div>
                                <div class="h-1 flex-1 rounded-full bg-emerald-400 transition-all duration-700"></div>
                            </div>
                            <div class="flex flex-1 items-center">
                                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-600 text-white shadow-lg shadow-emerald-500/35 ring-4 ring-emerald-100 transition duration-300">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                    </svg>
                                </div>
                                <div class="h-1 flex-1 rounded-full bg-emerald-400 transition-all duration-700"></div>
                            </div>
                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-600 text-white shadow-lg shadow-emerald-500/40 ring-4 ring-emerald-100 transition duration-300">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3 grid grid-cols-3 text-center text-[11px] font-semibold uppercase tracking-wide text-emerald-700">
                            <span>Enter Email</span>
                            <span>Verify OTP</span>
                            <span>Success</span>
                        </div>
                    </div>

                    <div class="relative mx-auto flex h-28 w-28 items-center justify-center">
                        <span class="absolute h-full w-full animate-ping rounded-full bg-emerald-300/40"></span>
                        <span class="absolute h-24 w-24 rounded-full bg-emerald-100"></span>
                        <span class="relative flex h-20 w-20 items-center justify-center rounded-full bg-emerald-600 text-white shadow-xl shadow-emerald-600/25">
                            <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                            </svg>
                        </span>
                    </div>

                    <h1 class="mt-8 text-3xl font-black tracking-tight text-slate-950">Password Reset Successful</h1>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Your NutriCare account password has been updated successfully.
                    </p>

                    <a href="{{ route('login') }}" class="mt-8 inline-flex w-full items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/25 transition duration-200 hover:-translate-y-0.5 hover:bg-emerald-500 hover:shadow-emerald-600/35 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                        Return to Login
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
