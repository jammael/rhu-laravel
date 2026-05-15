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
</head>

<body
    x-data="{ 'darkMode': false, 'sidebarToggle': false, 'scrollTop': false, 'mobileSidebarOpen': false }"
    class="bg-gray-50 text-slate-800"
  >

    <!-- ===== Mobile Fixed Top Header Start ===== -->
    <div class="flex md:hidden items-center justify-between h-16 px-4 bg-white border-b border-slate-100 shadow-sm fixed top-0 w-full z-40">
        <!-- Left: Logo & Brand -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
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
