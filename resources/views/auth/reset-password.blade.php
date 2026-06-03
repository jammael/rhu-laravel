<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NutriCare') }} | Verify OTP</title>
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
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-emerald-100">OTP Verification</p>
                            <h1 class="mt-4 text-4xl font-black leading-tight tracking-tight">Confirm identity before updating access.</h1>
                            <p class="mt-5 max-w-sm text-sm leading-6 text-emerald-50/90">
                                A focused verification step keeps NutriCare accounts protected while making recovery simple for RHU users.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-3 text-sm text-emerald-50/95">
                        <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                            <p class="font-bold">Sierra Bullones Health Monitoring System</p>
                            <p class="mt-1 text-emerald-50/80">Maternal and child nutrition records stay guarded behind verified credentials.</p>
                        </div>
                    </div>
                </aside>

                <div class="px-5 py-7 sm:px-10 sm:py-10 lg:px-12">
                    <div class="mx-auto w-full max-w-md" x-data="{
                        otp: ['', '', '', '', '', ''],
                        seconds: 119,
                        init() {
                            this.$nextTick(() => this.$refs.otp0?.focus());
                            setInterval(() => {
                                if (this.seconds > 0) {
                                    this.seconds--;
                                }
                            }, 1000);
                        },
                        typeDigit(index, event) {
                            const value = event.target.value.replace(/[^0-9]/g, '').slice(-1);
                            this.otp[index] = value;
                            event.target.value = value;
                            if (value && index < 5) {
                                this.$refs['otp' + (index + 1)].focus();
                            }
                        },
                        backspace(index) {
                            if (!this.otp[index] && index > 0) {
                                this.$refs['otp' + (index - 1)].focus();
                            }
                        },
                        paste(event) {
                            const pasted = (event.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '').slice(0, 6).split('');
                            if (!pasted.length) return;
                            event.preventDefault();
                            this.otp = ['', '', '', '', '', ''];
                            pasted.forEach((digit, index) => this.otp[index] = digit);
                            this.$nextTick(() => this.$refs['otp' + Math.min(pasted.length, 5)].focus());
                        },
                        timer() {
                            const minutes = String(Math.floor(this.seconds / 60)).padStart(2, '0');
                            const seconds = String(this.seconds % 60).padStart(2, '0');
                            return `${minutes}:${seconds}`;
                        }
                    }">
                        <div class="mb-8 flex flex-col items-center text-center lg:items-start lg:text-left">
                            <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-3 rounded-2xl lg:hidden">
                                <img src="{{ asset('images/NutriCare_Logo_Mark.png') }}" alt="NutriCare Logo" class="h-14 w-14 shrink-0 object-contain brightness-110 contrast-125 saturate-125">
                                <span class="text-left">
                                    <span class="block text-xl font-black leading-none tracking-tight text-slate-950">NutriCare</span>
                                    <span class="mt-1.5 block text-[0.62rem] font-bold uppercase leading-none tracking-[0.26em] text-emerald-600">RHU Sierra Bullones</span>
                                </span>
                            </a>
                            <p class="mt-3 text-xs font-bold uppercase tracking-[0.28em] text-emerald-600 lg:mt-0">NutriCare Recovery</p>
                            <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950">Verify your OTP</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Enter the 6-digit code sent to your email, then create a new password.
                            </p>
                        </div>

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
                                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-600 text-sm font-bold text-white shadow-lg shadow-emerald-500/40 ring-4 ring-emerald-100 transition duration-300">2</div>
                                    <div class="h-1 flex-1 rounded-full bg-slate-200">
                                        <div class="h-1 w-1/2 rounded-full bg-emerald-400 transition-all duration-700"></div>
                                    </div>
                                </div>
                                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-200 text-sm font-bold text-slate-400 transition duration-300">3</div>
                            </div>
                            <div class="mt-3 grid grid-cols-3 text-center text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                <span class="text-emerald-700">Enter Email</span>
                                <span class="text-emerald-700">Verify OTP</span>
                                <span>Success</span>
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="mb-5 flex gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800 shadow-sm shadow-emerald-900/5 transition duration-300" x-transition.opacity.duration.300ms>
                                <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                </svg>
                                <span>OTP successfully sent to your email</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-bold text-slate-800">Recovery email</label>
                                <input id="email" class="mt-2 block w-full rounded-2xl border border-emerald-100 bg-white/90 px-4 py-3.5 text-sm font-medium text-slate-900 shadow-sm shadow-emerald-900/5 transition duration-200 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" type="email" name="email" value="{{ old('email', $email) }}" placeholder="you@nutricare-rhu.gov" required autocomplete="email">
                                @error('email')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between gap-4">
                                    <label for="otp_0" class="block text-sm font-bold text-slate-800">6-digit OTP</label>
                                    <p class="text-xs font-semibold text-emerald-700" aria-live="polite">OTP expires in <span x-text="timer()">01:59</span></p>
                                </div>
                                <input type="hidden" name="otp" :value="otp.join('')">
                                <div class="mt-3 grid grid-cols-6 gap-2 sm:gap-3" @paste="paste($event)">
                                    @for ($i = 0; $i < 6; $i++)
                                        <input id="otp_{{ $i }}" x-ref="otp{{ $i }}" x-model="otp[{{ $i }}]" @input="typeDigit({{ $i }}, $event)" @keydown.backspace="backspace({{ $i }})" class="h-12 w-full rounded-2xl border border-emerald-100 bg-white text-center text-lg font-black text-slate-900 shadow-sm shadow-emerald-900/5 transition duration-200 hover:border-emerald-200 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100 sm:h-14 sm:text-xl" type="text" inputmode="numeric" maxlength="1" autocomplete="{{ $i === 0 ? 'one-time-code' : 'off' }}" aria-label="OTP digit {{ $i + 1 }}">
                                    @endfor
                                </div>
                                @error('otp')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="password" class="block text-sm font-bold text-slate-800">New password</label>
                                    <input id="password" class="mt-2 block w-full rounded-2xl border border-emerald-100 bg-white/90 px-4 py-3.5 text-sm font-medium text-slate-900 shadow-sm shadow-emerald-900/5 transition duration-200 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" type="password" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-bold text-slate-800">Confirm password</label>
                                    <input id="password_confirmation" class="mt-2 block w-full rounded-2xl border border-emerald-100 bg-white/90 px-4 py-3.5 text-sm font-medium text-slate-900 shadow-sm shadow-emerald-900/5 transition duration-200 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" type="password" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/25 transition duration-200 hover:-translate-y-0.5 hover:bg-emerald-500 hover:shadow-emerald-600/35 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                                Reset Password
                                <svg class="h-4 w-4 transition duration-200 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m13 6 6 6-6 6" />
                                </svg>
                            </button>
                        </form>

                        <div class="mt-6 flex flex-col items-center justify-between gap-3 text-sm sm:flex-row">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ old('email', $email) }}">
                                <button type="submit" class="font-bold text-emerald-600 transition hover:text-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100">Resend OTP</button>
                            </form>
                            <a href="{{ route('login') }}" class="font-semibold text-slate-500 transition hover:text-slate-700">Return to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
