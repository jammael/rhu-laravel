<!-- Main Sidebar Container: Changed bg-black to bg-white and added a subtle border -->
<aside
  :class="sidebarToggle ? 'translate-x-0 lg:w-[290px]' : '-translate-x-full'"
  class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 lg:static lg:translate-x-0 transition-all duration-300 shadow-sm"
>
  <!-- SIDEBAR HEADER -->
  <div class="flex items-center justify-center pt-10 pb-8 px-4">
    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center">
        {{-- Enhanced filters: Brightness 110 washes out the gray, contrast 125 sharpens the green --}}
        <img
            src="{{ asset('images/NutriCare_Logo.png') }}"
            alt="NutriCare Logo"
            class="h-24 w-auto mix-blend-multiply filter brightness-110 contrast-125 saturate-110"
        />
        {{-- Optional: Add a small text label if the logo text is still too light --}}
        <span class="mt-2 text-xs font-bold text-emerald-700 uppercase tracking-widest">RHU Sierra Bullones</span>
    </a>
</div>


  <div class="flex flex-col overflow-y-auto no-scrollbar">
    <nav x-data="{selected: $persist('RHU')}">

      <!-- HEALTH MONITORING GROUP -->
      <div>
        <h3 class="mb-4 text-xs uppercase font-bold text-slate-400">HEALTH MONITORING</h3>
        <ul class="flex flex-col gap-2 mb-6">
          <li>
            {{-- Active Item: Green Background, White Text --}}
            <a href="{{ route('admin.dashboard') }}"
               class="group flex items-center gap-2.5 rounded-md py-2 px-4 font-bold text-white bg-emerald-600 shadow-md">
              <span>📊</span>
              NutriCare Overview
            </a>
          </li>

          <li>
            {{-- Inactive Items: White Background, Dark Text, Green Hover --}}
            <a href="{{ route('maternal.index') }}" class="group flex items-center gap-2.5 rounded-md py-2 px-4 font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">
              <span>🤰</span>
              Maternal Care
            </a>
          </li>

          <li>
            <a href="{{ route('child-nutrition.index') }}" class="group flex items-center gap-2.5 rounded-md py-2 px-4 font-medium text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition">
              <span>👶</span>
              Child Nutrition
            </a>
          </li>
        </ul>
      </div>

      <!-- SYSTEM OPERATIONS GROUP -->
      <div class="mt-8">
        <h3 class="mb-4 text-xs uppercase font-bold text-slate-400">SYSTEM OPERATIONS</h3>
        <ul class="flex flex-col gap-2 mb-6">
          <li>
            <a href="#" class="group flex items-center gap-2.5 rounded-md py-2 px-4 font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">
              <span>📱</span>
              SMS Reminders
            </a>
          </li>
          <li>
            <a href="{{ route('patients.index') }}" class="group flex items-center gap-2.5 rounded-md py-2 px-4 font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">
              <span>📝</span>
              Patient Enrollment
            </a>
          </li>

          <!-- SYSTEM ADMINISTRATION GROUP - Only visible to Admin -->
          @if(Auth::user() && Auth::user()->role === 'admin')
          <li class="mt-4 pt-4 border-t border-gray-100">
            <h3 class="mb-4 text-xs uppercase font-bold text-slate-400">SYSTEM ADMINISTRATION</h3>
            <ul class="flex flex-col gap-2">
              <li>
                <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-2.5 rounded-md py-2 px-4 font-medium text-slate-600 hover:bg-purple-50 hover:text-purple-600 transition">
                  <span>👥</span>
                  User Management
                </a>
              </li>
              <li>
                <a href="{{ route('admin.logs.index') }}" class="group flex items-center gap-2.5 rounded-md py-2 px-4 font-medium text-slate-600 hover:bg-purple-50 hover:text-purple-600 transition">
                  <span>📋</span>
                  Activity Logs
                </a>
              </li>
            </ul>
          </li>
          @endif

          <li class="mt-4 pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 rounded-md py-2 px-4 font-bold text-red-500 hover:bg-red-50 transition">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</aside>
