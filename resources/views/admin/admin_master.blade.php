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
    x-data="{ 'darkMode': false, 'sidebarToggle': false, 'scrollTop': false }"
    class="bg-gray-50 text-slate-800"
  >

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar: We will create this file next -->
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

</>
</html>
