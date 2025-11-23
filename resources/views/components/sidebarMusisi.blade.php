@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $musisiModel = isset($musisi) ? $musisi : $user?->musisi;

    $musisiLogo = $musisiModel?->profil?->logo ?? null;

    $musisiName = $musisiModel?->profil?->nama_panggung
                ?? ($musisiModel?->user?->nama ?? 'Musisi');
@endphp

<!-- Tombol Hamburger (Mobile Only) -->
<div class="md:hidden fixed top-20 left-4 z-30">
    <button onclick="toggleSidebarMusisi()"
        class="p-2 rounded-xl bg-[#1C4E95] text-white shadow-lg flex items-center gap-2 active:scale-95 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <span class="text-sm font-medium">Menu</span>
    </button>
</div>

<!-- Sidebar Musisi -->
<div id="sidebar-musisi"
    class="w-64 fixed top-20 left-0
           h-[calc(100vh-4rem)] overflow-y-auto
           bg-gradient-to-b from-white via-slate-50 to-slate-100
           border-r border-slate-200/80 shadow-xl flex flex-col z-20
           transform -translate-x-full transition-transform duration-300
           md:translate-x-0 pt-3">

    {{-- HEADER: Lebih compact & match admin --}}
    <div class="px-4 pb-3 border-b border-slate-200/70">
        <div class="flex items-center gap-4">

            @if ($musisiLogo)
                <div class="w-12 h-12 rounded-xl bg-white shadow-md overflow-hidden border border-slate-200">
                    <img src="{{ asset('storage/app/public/' . $musisiLogo) }}"
                         class="w-full h-full object-cover" alt="Musisi">
                </div>
            @else
                <div class="w-12 h-12 rounded-xl bg-white shadow-md flex items-center justify-center border border-slate-200">
                    <img src="{{ asset('public/icons/user.svg') }}"
                         class="w-7 h-7 opacity-70" alt="Musisi">
                </div>
            @endif

            <div class="leading-tight">
                <p class="font-semibold text-slate-900 text-sm">
                    {{ $musisiName }}
                </p>
                <p class="text-xs text-slate-500">Akun Musisi</p>
            </div>
        </div>
    </div>

    @php
        function ms_item($isActive) {
            return $isActive
                ? 'bg-blue-100 text-[#1C4E95] border-l-4 border-[#1C4E95]'
                : 'text-slate-700 hover:bg-blue-50 hover:text-[#1C4E95]';
        }
        function ms_icon($isActive) {
            return $isActive
                ? 'bg-[#1C4E95]/10'
                : 'bg-slate-100 group-hover:bg-[#1C4E95]/10';
        }
    @endphp

    <!-- MENU -->
    <div class="flex-1 px-2 space-y-1 mt-4 text-sm">

        {{-- Dashboard --}}
        <a href="{{ route('musisi.dashboard') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium
                   {{ ms_item(Route::is('musisi.dashboard')) }} transition duration-200">

            <div class="w-9 h-9 rounded-xl flex items-center justify-center
                        {{ ms_icon(Route::is('musisi.dashboard')) }} transition duration-200">
                <img src="{{ asset('public/icons/dashboard.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>

            <span>Dashboard</span>
        </a>

        {{-- Kelola Profil --}}
        <a href="{{ route('musisi.profil') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium
                   {{ ms_item(Route::is('musisi.profil')) }} transition duration-200">

            <div class="w-9 h-9 rounded-xl flex items-center justify-center
                        {{ ms_icon(Route::is('musisi.profil')) }} transition duration-200">
                <img src="{{ asset('public/icons/kelola-profil.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>

            <span>Kelola Profil</span>
        </a>

        {{-- Kelola Karya --}}
        <a href="{{ route('musisi.karya') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium
                   {{ ms_item(Route::is('musisi.karya')) }} transition duration-200">

            <div class="w-9 h-9 rounded-xl flex items-center justify-center
                        {{ ms_icon(Route::is('musisi.karya')) }} transition duration-200">
                <img src="{{ asset('public/icons/kelola-karya.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>

            <span>Kelola Karya</span>
        </a>

        {{-- Logout --}}
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="group flex items-center gap-3 px-3 py-2.5 mt-1 rounded-xl font-medium
                   text-slate-700 hover:bg-rose-50 hover:text-rose-600 transition duration-200">

            <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center
                        group-hover:bg-rose-100 transition duration-200">
                <img src="{{ asset('public/icons/logout.svg') }}"
                     class="w-5 h-5 transition-transform duration-300 group-hover:scale-110">
            </div>

            <span>Logout</span>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </a>

    </div>
</div>

<!-- Script -->
<script>
    function toggleSidebarMusisi() {
        const sidebar = document.getElementById('sidebar-musisi');
        if (!sidebar) return;

        sidebar.classList.toggle('-translate-x-full');
    }
</script>
