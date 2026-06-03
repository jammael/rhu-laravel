<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare | Admin Dashboard</title>

    <!-- Tab Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/NutriCare_Logo.png') }}">
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Load Tailwind and Alpine.js via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body
    x-data="{ 'darkMode': false, 'sidebarToggle': false, 'scrollTop': false, 'mobileSidebarOpen': false, 'unauthorizedModal': {{ session('error') ? 'true' : 'false' }} }"
    @unauthorized-access.window="unauthorizedModal = true"
    class="bg-gray-50 text-slate-800"
  >

    <div
        x-show="unauthorizedModal"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 px-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="unauthorized-title"
    >
        <div
            @click.outside="unauthorizedModal = false"
            x-transition.scale.origin.center
            class="w-full max-w-md rounded-2xl border border-red-100 bg-white p-6 text-center shadow-2xl shadow-slate-950/25"
        >
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-50 text-red-600 ring-8 ring-red-50/60">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 17h.01" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.3 4.3 2.8 17.5A2 2 0 0 0 4.5 20h15a2 2 0 0 0 1.7-2.5L13.7 4.3a2 2 0 0 0-3.4 0Z" />
                </svg>
            </div>
            <h2 id="unauthorized-title" class="mt-5 text-2xl font-black tracking-tight text-slate-950">Unauthorized Access</h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">
                {{ session('error', 'Only administrators can access NutriCare Overview.') }}
            </p>
            <button
                type="button"
                @click="unauthorizedModal = false"
                class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-red-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-red-600/20 transition hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-100"
            >
                OK
            </button>
        </div>
    </div>

    <!-- ===== Mobile Fixed Top Header Start ===== -->
    <div class="flex md:hidden items-center justify-between h-16 px-4 bg-white border-b border-slate-100 shadow-sm fixed top-0 w-full z-40">
        <!-- Left: Logo & Brand -->
        <a href="{{ Auth::user()?->role === 'admin' ? route('admin.dashboard') : '#' }}"
           @if(Auth::user()?->role !== 'admin') @click.prevent="$dispatch('unauthorized-access')" @endif
           class="flex items-center gap-2">
            <img src="{{ asset('images/NutriCare_Logo.png') }}" alt="NutriCare Logo" class="h-8 w-auto mix-blend-multiply filter brightness-110 contrast-125">
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest hidden xs:block">NutriCare</span>
        </a>

        <!-- Right: Hamburger Menu -->
        <button
            @click="mobileSidebarOpen = !mobileSidebarOpen"
            class="inline-flex items-center justify-center p-2 rounded-lg text-emerald-600 hover:bg-emerald-50 transition-colors"
            title="Toggle menu"
        >
            <svg x-show="!mobileSidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileSidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <!-- ===== Mobile Fixed Top Header End ===== -->

    <!-- ===== Mobile Sidebar Overlay & Drawer Start ===== -->
    <div
        x-show="mobileSidebarOpen"
        @click="mobileSidebarOpen = false"
        x-transition
        class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden"
    ></div>
    <!-- ===== Mobile Sidebar Overlay & Drawer End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden pt-16 md:pt-0">

        <!-- Sidebar -->
        @include('admin.body.sidebar')

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
                    {{-- This is where your Patient List, Forms, and Stats will appear --}}
                    @yield('admin')
                </div>
            </main>
            <!-- ===== Main Content End ===== -->

        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    @stack('scripts')
</body>
</html>
