{{-- Toggle Sidebar (Mobile) --}}
<div class="md:hidden fixed top-20 left-4 z-30">
    <button onclick="toggleAdminSidebar()"
        class="p-2 rounded-xl bg-[#1C4E95] text-white shadow-lg flex items-center gap-2 active:scale-95 transition">
        <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <span class="text-sm font-medium">Menu</span>
    </button>
</div>

<!-- Sidebar -->
<div id="admin-sidebar"
    class="w-64 fixed top-20 left-0
           h-[calc(100vh-4rem)] overflow-y-auto
           bg-gradient-to-b from-white via-slate-50 to-slate-100
           border-r border-slate-200/80 shadow-xl flex flex-col z-20
           transform -translate-x-full transition-transform duration-300
           md:translate-x-0 pt-3">

    {{-- Header Sidebar (putih, lebih compact, sejajar navbar) --}}
    <div class="px-4 pb-3 border-b border-slate-200/70">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-white shadow-md flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                     class="w-9 h-9 object-contain">
            </div>

            <div class="leading-tight">
                <p class="font-semibold text-slate-900 text-sm sm:text-base">Sumber Suara</p>
                <p class="text-[11px] text-slate-500">Admin Dashboard</p>
            </div>
        </div>
    </div>

    @php
        function admin_menu_item($isActive) {
            return $isActive
                ? 'bg-blue-100 text-[#1C4E95] border-l-4 border-[#1C4E95] shadow-inner'
                : 'text-slate-700 hover:bg-blue-50 hover:text-[#1C4E95]';
        }
        function admin_icon_wrap($isActive) {
            return $isActive
                ? 'bg-[#1C4E95]/10'
                : 'bg-slate-100 group-hover:bg-[#1C4E95]/10';
        }
    @endphp

    <!-- Menu Utama -->
    <div class="flex-1 px-2 space-y-1 mt-4 text-sm">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium
                  {{ admin_menu_item(Route::is('admin.dashboard')) }} transition duration-200">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center
                        {{ admin_icon_wrap(Route::is('admin.dashboard')) }} transition duration-200">
                <img src="{{ asset('icons/dashboard.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>
            <span>Dashboard</span>
        </a>

        {{-- Dropdown: Kelola Akun Musisi --}}
        <div class="space-y-1">
            <button onclick="toggleDropdown('dropdown-akun')"
                class="w-full group flex justify-between items-center px-3 py-2.5 rounded-xl font-medium
                       {{ admin_menu_item(Route::is('admin.verifikasi','admin.daftarAcc')) }} transition duration-200">

                <span class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center
                                {{ admin_icon_wrap(Route::is('admin.verifikasi','admin.daftarAcc')) }} transition duration-200">
                        <img src="{{ asset('icons/kelola-akun.svg') }}"
                             class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <span>Kelola Akun Musisi</span>
                </span>

                <svg id="icon-dropdown-akun"
                    class="w-4 h-4 transform transition-transform duration-300
                           {{ Route::is('admin.verifikasi','admin.daftarAcc') ? 'rotate-180 text-[#1C4E95]' : 'text-slate-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Submenu -->
            <div id="dropdown-akun"
                 class="pl-6 pr-2 mt-1 space-y-1 border-l-2 border-slate-200
                        {{ Route::is('admin.verifikasi','admin.daftarAcc') ? '' : 'hidden' }}">

                <a href="{{ route('admin.verifikasi') }}"
                   class="block px-3 py-2 rounded-lg text-[13px] font-medium
                          {{ Route::is('admin.verifikasi') ? 'bg-blue-100 text-[#1C4E95]' : 'text-slate-600 hover:bg-blue-50 hover:text-[#1C4E95]' }}
                          transition">
                    Verifikasi Akun
                </a>

                <a href="{{ route('admin.daftarAcc') }}"
                   class="block px-3 py-2 rounded-lg text-[13px] font-medium
                          {{ Route::is('admin.daftarAcc') ? 'bg-blue-100 text-[#1C4E95]' : 'text-slate-600 hover:bg-blue-50 hover:text-[#1C4E95]' }}
                          transition">
                    Daftar Akun
                </a>
            </div>
        </div>

        {{-- Kalender Event --}}
        <a href="{{ route('admin.event') }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium
                  {{ admin_menu_item(Route::is('admin.event')) }} transition duration-200">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center
                        {{ admin_icon_wrap(Route::is('admin.event')) }} transition duration-200">
                <img src="{{ asset('icons/kalender-event.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>
            <span>Kalender Event</span>
        </a>

        {{-- Kelola Artikel --}}
        <a href="{{ route('admin.artikel') }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium
                  {{ admin_menu_item(Route::is('admin.artikel')) }} transition duration-200">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center
                        {{ admin_icon_wrap(Route::is('admin.artikel')) }} transition duration-200">
                <img src="{{ asset('icons/kelola-artikel.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>
            <span>Kelola Artikel</span>
        </a>

        {{-- Kelola Hero Section --}}
        <a href="{{ route('admin.heroSection') }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium
                  {{ admin_menu_item(Route::is('admin.heroSection')) }} transition duration-200">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center
                        {{ admin_icon_wrap(Route::is('admin.heroSection')) }} transition duration-200">
                <img src="{{ asset('icons/herosection.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>
            <span>Kelola Hero Section</span>
        </a>

        {{-- Logout --}}
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="group flex items-center gap-3 px-3 py-2.5 mt-1 rounded-xl font-medium text-slate-700
                  hover:bg-rose-50 hover:text-rose-600 transition duration-200">
            <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center
                        group-hover:bg-rose-100 transition duration-200">
                <img src="{{ asset('icons/logout.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>
            <span>Logout</span>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </a>
    </div>
</div>

<!-- Script -->
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const icon = document.getElementById('icon-' + id);

        if (!dropdown || !icon) return;

        dropdown.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }

    function toggleAdminSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        if (!sidebar) return;

        sidebar.classList.toggle('-translate-x-full');
    }
</script>
