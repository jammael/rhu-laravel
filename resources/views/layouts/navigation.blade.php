<nav x-data="{ open: false }" class="bg-white border-b border-slate-100 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left: Logo and Title -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center bg-white">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4">
                        <img src="{{ asset('images/NutriCare_Logo.png') }}" alt="NutriCare Logo" class="h-12 w-auto mb-3 brightness-100 contrast-150 saturate-125">
                        <div class="flex flex-col items-start">
                            <div class="flex items-center gap-2">
                                <h2 class="text-lg font-bold text-slate-800">NutriCare Management Portal</h2>
                                <div class="flex items-center gap-1.5 px-2 py-1 bg-emerald-50 rounded-full">
                                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                    <span class="text-emerald-600 font-medium text-xs">Live</span>
                                </div>
                            </div>
                            <p class="text-slate-400 text-[10px] uppercase tracking-widest mt-0.5">Sierra Bullones RHU • Maternal & Child Health</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 ms-10 lg:flex">
                    @php
                        $dashboardLinkClasses = 'inline-flex items-center px-3 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out border-b-2 ';
                        if (request()->routeIs('dashboard')) {
                            $dashboardLinkClasses .= 'text-emerald-600 border-emerald-600';
                        } else {
                            $dashboardLinkClasses .= 'text-slate-600 border-transparent hover:text-emerald-600 hover:border-emerald-500';
                        }
                    @endphp
                    <a href="{{ route('dashboard') }}" class="{{ $dashboardLinkClasses }}">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <!-- Right: Settings Dropdown with Role Badge -->
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-600 bg-white hover:text-slate-800 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex flex-col items-end">
                                <div class="font-medium text-slate-800">{{ Auth::user()->name }}</div>
                                <!-- Role Badge -->
                                <span class="inline-block bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-xs font-medium">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-50 focus:outline-none focus:bg-slate-100 focus:text-slate-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-100">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @php
                $responsiveDashboardClasses = 'block w-full text-left px-3 py-2 rounded-md text-base font-medium ';
                if (request()->routeIs('dashboard')) {
                    $responsiveDashboardClasses .= 'text-emerald-600 bg-emerald-50';
                } else {
                    $responsiveDashboardClasses .= 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50';
                }
            @endphp
            <a href="{{ route('dashboard') }}" class="{{ $responsiveDashboardClasses }}">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-100">
            <div class="px-4">
                <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                <span class="inline-block bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-xs font-medium mt-2">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
