<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-20 bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] shadow-md">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16 md:h-20">

            @php
                use Illuminate\Support\Facades\Auth;

                $user = Auth::user();
                $roleName = $user?->role?->nama_roles; // 'Admin' | 'Musisi' | 'Audiens'

                // Tentukan route dashboard masing-masing role
                if ($roleName === 'Admin') {
                    $dashboardRoute = route('admin.dashboard');
                } elseif ($roleName === 'Musisi') {
                    $dashboardRoute = route('musisi.dashboard');
                } elseif ($roleName === 'Audiens') {
                    $dashboardRoute = route('index');
                } else {
                    $dashboardRoute = route('index');
                }

                // Logo musisi (kalau ada profil.logo)
                $musisiLogo = null;
                if ($roleName === 'Musisi' && $user?->musisi) {
                    $musisiLogo = $user->musisi->profil->logo ?? null;
                }

                if (!function_exists('nav_link_classes')) {
                    function nav_link_classes($isActive)
                    {
                        $base = 'text-white font-medium px-3 py-1 rounded-full transition transform duration-150';
                        $hover = 'hover:bg-white/10 hover:scale-105';
                        $active = 'bg-white/20 scale-105 shadow-md';

                        return $base . ' ' . ($isActive ? $active : $hover);
                    }
                }
            @endphp

            <!-- Logo utama (disamakan feel-nya dengan footer) -->
            <div class="flex justify-center md:justify-start items-center w-full md:w-auto">
                <a href="{{ url('/') }}" class="inline-flex items-center">
                    <img src="{{ asset('public/images/logo3.png') }}" alt="Logo"
                         class="h-16 sm:h-20 md:h-24 lg:h-30 w-auto object-contain drop-shadow-lg">
                </a>
            </div>

            <!-- Login / User Icon (Mobile) -->
            <div class="absolute right-4 md:hidden flex items-center">
                @guest
                    {{-- Belum login: icon user → login --}}
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-200">
                        <img src="{{ asset('public/icons/user.svg') }}" alt="Login"
                             class="h-8 w-8 transition transform hover:scale-110" />
                    </a>
                @else
                    @if ($roleName === 'Audiens')
                        {{-- Audiens MOBILE: klik logo → popover Logout --}}
                        <button id="audIconButtonMobile"
                                type="button"
                                class="flex items-center justify-center h-9 w-9 rounded-full bg-white/10 border border-white/30
                                       hover:bg-white/20 transition transform hover:scale-110 focus:outline-none">
                            <img src="{{ asset('public/icons/user.svg') }}" alt="Akun Audiens"
                                 class="h-5 w-5" />
                        </button>

                        <!-- Popover Logout (Mobile) -->
                        <div id="audLogoutPopoverMobile"
                             class="hidden fixed top-16 right-4 w-32 bg-white rounded-lg shadow-lg border border-gray-100 py-2 text-sm z-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Admin & Musisi MOBILE: icon → langsung ke dashboard --}}
                        <a href="{{ $dashboardRoute }}" class="text-white hover:text-blue-200 flex items-center">
                            @if ($roleName === 'Musisi' && $musisiLogo)
                                <img src="{{ asset('storage/app/public/' . $musisiLogo) }}" alt="Musisi"
                                     class="h-8 w-8 rounded-full object-cover border-2 border-white transition transform hover:scale-110" />
                            @else
                                <img src="{{ asset('public/icons/user.svg') }}" alt="Akun"
                                     class="h-8 w-8 transition transform hover:scale-110" />
                            @endif
                        </a>
                    @endif
                @endguest
            </div>

            <!-- Navigation (Desktop) -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('index') }}"
                   class="{{ nav_link_classes(request()->routeIs('index')) }}">
                    Home
                </a>

                <a href="{{ route('event') }}"
                   class="{{ nav_link_classes(request()->routeIs('event', 'viewEvent')) }}">
                    Event
                </a>

                <a href="{{ route('article') }}"
                   class="{{ nav_link_classes(request()->routeIs('article', 'viewArtikel')) }}">
                    Artikel
                </a>

                <a href="{{ route('playlist') }}"
                   class="{{ nav_link_classes(request()->routeIs('playlist')) }}">
                    Lagu Favorit
                </a>

                <a href="{{ route('about') }}"
                   class="{{ nav_link_classes(request()->routeIs('about')) }}">
                    Tentang
                </a>

                @guest
                    {{-- Belum login: tombol Login biasa --}}
                    <a href="{{ route('login') }}"
                       class="{{ nav_link_classes(request()->routeIs('login')) }}">
                        Login
                    </a>
                @else
                    {{-- Icon akun --}}
                    @if ($roleName === 'Audiens')
                        {{-- Audiens DESKTOP: klik logo → popover Logout --}}
                        <div class="relative">
                            <button id="audIconButtonDesktop"
                                    type="button"
                                    class="flex items-center justify-center h-9 w-9 rounded-full bg-white/10 border border-white/30
                                           hover:bg-white/20 transition transform hover:scale-110 focus:outline-none">
                                <img src="{{ asset('public/icons/user.svg') }}" alt="Akun Audiens"
                                     class="h-5 w-5" />
                            </button>

                            <!-- Popover Logout (Desktop) -->
                            <div id="audLogoutPopoverDesktop"
                                 class="hidden absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg border border-gray-100 py-2 text-sm z-30">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Admin & Musisi DESKTOP: icon → langsung ke dashboard --}}
                        <a href="{{ $dashboardRoute }}"
                           class="flex items-center justify-center h-9 w-9 rounded-full bg-white/10 border border-white/30
                                  hover:bg-white/20 transition transform hover:scale-110">
                            @if ($roleName === 'Musisi' && $musisiLogo)
                                <img src="{{ asset('storage/app/public/' . $musisiLogo) }}" alt="Musisi"
                                     class="h-7 w-7 rounded-full object-cover border border-white" />
                            @else
                                <img src="{{ asset('public/icons/user.svg') }}" alt="Akun"
                                     class="h-5 w-5" />
                            @endif
                        </a>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Bottom Navigation (Mobile Only) -->
<div
    class="fixed bottom-0 left-0 right-0 bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] text-white flex justify-around items-center py-3 md:hidden z-50 shadow-lg border-t border-white/10">
    <a href="{{ route('index') }}"
       class="flex flex-col items-center text-[11px] transition transform
              {{ request()->routeIs('index') ? 'scale-110 font-semibold' : 'hover:scale-110' }}">
        <img src="{{ asset('public/icons/home.svg') }}" alt="Home"
             class="h-5 w-5 mt-1 mb-0.5" />
        Home
    </a>

    <a href="{{ route('event') }}"
       class="flex flex-col items-center text-[11px] transition transform
              {{ request()->routeIs('event','viewEvent') ? 'scale-110 font-semibold' : 'hover:scale-110' }}">
        <img src="{{ asset('public/icons/event.svg') }}" alt="Event"
             class="h-5 w-5 mt-1 mb-0.5" />
        Event
    </a>

    <a href="{{ route('article') }}"
       class="flex flex-col items-center text-[11px] transition transform
              {{ request()->routeIs('article','viewArtikel') ? 'scale-110 font-semibold' : 'hover:scale-110' }}">
        <img src="{{ asset('public/icons/article.svg') }}" alt="Artikel"
             class="h-5 w-5 mt-1 mb-0.5" />
        Artikel
    </a>

    <a href="{{ route('playlist') }}"
       class="flex flex-col items-center text-[11px] transition transform
              {{ request()->routeIs('playlist') ? 'scale-110 font-semibold' : 'hover:scale-110' }}">
        <img src="{{ asset('public/icons/playlist.svg') }}" alt="Playlist"
             class="h-5 w-5 mt-1 mb-0.5" />
        Playlist
    </a>

    <a href="{{ route('about') }}"
       class="flex flex-col items-center text-[11px] transition transform
              {{ request()->routeIs('about') ? 'scale-110 font-semibold' : 'hover:scale-110' }}">
        <img src="{{ asset('public/icons/about.svg') }}" alt="Tentang"
             class="h-5 w-5 mt-1 mb-0.5" />
        Tentang
    </a>
</div>

{{-- Script popover logout audiens (desktop + mobile) --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Desktop
        const btnDesk = document.getElementById('audIconButtonDesktop');
        const popDesk = document.getElementById('audLogoutPopoverDesktop');

        if (btnDesk && popDesk) {
            btnDesk.addEventListener('click', function (e) {
                e.stopPropagation();
                popDesk.classList.toggle('hidden');
            });

            document.addEventListener('click', function (e) {
                if (!popDesk.contains(e.target) && !btnDesk.contains(e.target)) {
                    popDesk.classList.add('hidden');
                }
            });
        }

        // Mobile
        const btnMob = document.getElementById('audIconButtonMobile');
        const popMob = document.getElementById('audLogoutPopoverMobile');

        if (btnMob && popMob) {
            btnMob.addEventListener('click', function (e) {
                e.stopPropagation();
                popMob.classList.toggle('hidden');
            });

            document.addEventListener('click', function (e) {
                if (!popMob.contains(e.target) && !btnMob.contains(e.target)) {
                    popMob.classList.add('hidden');
                }
            });
        }
    });
</script>
