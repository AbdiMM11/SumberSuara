@extends('layouts.layout')

@php
    /** @var \App\Models\HeroSection|null $hero */
    $hero = \App\Models\HeroSection::where('is_active', true)->first();

    $genreOptions = ['Pop', 'Rock', 'Jazz', 'Blues', 'Metal', 'Reggae / SKA', 'Hip Hop', 'Other'];
    $domOptions = [
        'Bandar Lampung',
        'Metro',
        'Lampung Selatan',
        'Lampung Tengah',
        'Lampung Timur',
        'Lampung Barat',
        'Lampung Utara',
        'Pesawaran',
        'Mesuji',
        'Pesisir Barat',
        'Pringsewu',
        'Tanggamus',
        'Tulang Bawang',
        'Tulang Bawang Barat',
        'Way Kanan',
    ];
@endphp

@section('content')
    <div class="pb-20">
        {{-- ====== HERO + SIDEBAR ====== --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-20 mt-5">

            {{-- HERO (mobile: swiper, desktop: gambar + caption) --}}
            <div class="lg:col-span-8 relative">

                {{-- MOBILE: Swiper --}}
                <div class="lg:hidden">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @if (!empty($hero?->banner_url))
                                <div class="swiper-slide relative">
                                    <img src="{{ $hero->banner_url }}" alt="Hero Utama"
                                         class="w-full h-[380px] sm:h-[420px] object-cover rounded-lg">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent rounded-lg">
                                    </div>
                                    <div
                                        class="absolute bottom-5 left-4 right-4 text-white p-3 text-center text-xs sm:text-sm">
                                        <h2 class="text-sm sm:text-lg font-semibold mb-1 sm:mb-2">
                                            {{ $hero->title ?? 'Sumber Suara' }}
                                        </h2>
                                        @if (!empty($hero?->desk))
                                            <p class="text-[11px] sm:text-xs">{{ $hero->desk }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if (!empty($hero?->sec1_url))
                                <div class="swiper-slide relative">
                                    <img src="{{ $hero->sec1_url }}" alt="Hero Sekunder 1"
                                         class="w-full h-[380px] sm:h-[420px] object-cover rounded-lg">
                                    <div class="absolute inset-0 bg-black/30 rounded-lg"></div>
                                </div>
                            @endif

                            @if (!empty($hero?->sec2_url))
                                <div class="swiper-slide relative">
                                    <img src="{{ $hero->sec2_url }}" alt="Hero Sekunder 2"
                                         class="w-full h-[380px] sm:h-[420px] object-cover rounded-lg">
                                    <div class="absolute inset-0 bg-black/30 rounded-lg"></div>
                                </div>
                            @endif

                            @if (!empty($hero?->sec3_url))
                                <div class="swiper-slide relative">
                                    <img src="{{ $hero->sec3_url }}" alt="Hero Sekunder 3"
                                         class="w-full h-[380px] sm:h-[420px] object-cover rounded-lg">
                                    <div class="absolute inset-0 bg-black/30 rounded-lg"></div>
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                {{-- DESKTOP: Hero --}}
                @if (!empty($hero?->banner_url))
                    <div class="hidden lg:block relative">
                        <img src="{{ $hero->banner_url }}" alt="Hero Utama"
                             class="w-full h-96 lg:h-[500px] object-cover">
                        @if (!empty($hero?->desk))
                            <div
                                class="absolute -bottom-16 left-12 right-12 bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] text-white p-5 shadow-lg text-center rounded-lg">
                                <p class="text-sm md:text-base leading-relaxed font-normal">{{ $hero->desk }}</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            {{-- SIDEBAR PLAYLIST --}}
            <div class="lg:col-span-4">
                <div class="bg-white shadow-sm rounded-xl p-4 h-full flex flex-col gap-3">

                    {{-- Header daftar lagu --}}
                    <div class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] text-gray-100 px-4 py-2 rounded-lg shadow-sm">
                        <h3 class="text-xs sm:text-sm font-semibold tracking-wide text-center">
                            Daftar Lagu
                        </h3>
                    </div>

                    {{-- Search (filter playlist lagu) --}}
                    <div class="pt-2 border-t border-gray-100">
                        <form action="{{ route('index') }}" method="GET"
                              class="w-full grid grid-cols-2 gap-2 text-[11px] sm:flex sm:items-stretch sm:gap-2">

                            {{-- Input pencarian lagu --}}
                            <div class="relative sm:flex-1">
                                <input type="text" name="q_song" value="{{ request('q_song') ?? '' }}"
                                       placeholder="Cari judul / musisi"
                                       class="w-full pl-7 pr-3 py-1.5 border border-gray-200 rounded-lg bg-gray-50
                                              focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-400
                                              text-[11px] sm:text-xs text-gray-800" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                                    <svg class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Dropdown genre (auto submit) --}}
                            <div class="relative sm:w-32">
                                <select name="genre_song" onchange="this.form.submit()"
                                        class="w-full appearance-none pl-3 pr-6 py-1.5 border border-gray-200 rounded-lg
                                               bg-gray-50 text-[11px] sm:text-xs text-gray-700
                                               focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-400">
                                    <option value="" {{ request('genre_song') ? '' : 'selected' }}>Genre</option>
                                    @foreach ($genreOptions as $g)
                                        <option value="{{ $g }}"
                                            {{ request('genre_song') === $g ? 'selected' : '' }}>
                                            {{ $g }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-gray-400">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- LIST lagu sidebar --}}
                    <div id="playlist" class="space-y-2 max-h-80 sm:max-h-96 overflow-y-auto pr-1">
                        @forelse ($songs as $i => $song)
                            @php
                                // file_mp3 disimpan lewat ->store('karya/audio', 'public')
                                $audioUrl = $song->file_mp3
                                    ? asset('storage/app/public/' . $song->file_mp3)
                                    : '';

                                // logo musisi (fallback placeholder)
                                $logoPath = $song->musisi?->profil?->logo;
                                $coverUrl = $logoPath
                                    ? asset('storage/app/public/' . $logoPath)
                                    : asset('public/images/placeholder-band.jpg');
                            @endphp

                            <div class="song-item group flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer"
                                 data-karya-id="{{ $song->id_karya }}"
                                 data-src="{{ $audioUrl }}"
                                 data-title="{{ $song->judul }}"
                                 data-artist="{{ $song->musisi?->display_name ?? 'Musisi' }}"
                                 data-cover="{{ $coverUrl }}"
                                 data-duration="{{ $song->durasi_format ?? '' }}"
                                 data-favorite="{{ in_array($song->id_karya, $favoriteIds ?? []) ? 1 : 0 }}">

                                <span
                                    class="hidden md:block w-7 text-center text-[11px] text-gray-500">{{ $i + 1 }}</span>

                                <div class="relative shrink-0">
                                    <div class="w-11 h-11 rounded-lg overflow-hidden bg-gray-200">
                                        <img src="{{ $coverUrl }}" class="w-11 h-11 object-cover rounded-lg"
                                             alt="cover">
                                    </div>
                                    <span
                                        class="md:hidden absolute -top-1 -left-1 text-[10px] px-1.5 py-0.5 rounded bg-white/90 text-gray-700 shadow">
                                        {{ $i + 1 }}
                                    </span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-[13px] font-semibold text-gray-900 truncate">{{ $song->judul }}</p>
                                    <p class="text-[11px] text-gray-500 truncate">
                                        {{ $song->musisi?->display_name ?? 'Musisi' }}
                                        @if ($song->tahun)
                                            • <span class="text-gray-400">{{ $song->tahun }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-xs text-gray-500 py-3">Belum ada karya.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- HERO tambahan (desktop) --}}
        @if (!empty($hero?->sec1_url) || !empty($hero?->sec2_url) || !empty($hero?->sec3_url))
            <div class="hidden md:grid grid-cols-3 gap-4 mt-24">
                @if (!empty($hero?->sec1_url))
                    <div class="aspect-[4/3]">
                        <img src="{{ $hero->sec1_url }}" alt="Hero Sekunder 1"
                             class="w-full h-56 object-cover rounded-lg">
                    </div>
                @endif
                @if (!empty($hero?->sec2_url))
                    <div class="aspect-[4/3]">
                        <img src="{{ $hero->sec2_url }}" alt="Hero Sekunder 2"
                             class="w-full h-56 object-cover rounded-lg">
                    </div>
                @endif
                @if (!empty($hero?->sec3_url))
                    <div class="aspect-[4/3]">
                        <img src="{{ $hero->sec3_url }}" alt="Hero Sekunder 3"
                             class="w-full h-56 object-cover rounded-lg">
                    </div>
                @endif
            </div>
        @endif

        {{-- SEARCH BAR BLUE STRIP (FILTER MUSISI) --}}
        <div class="p-3 sm:p-4 h-auto sm:h-20 rounded-lg mb-8 -mt-6 sm:-mt-8 flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4 bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA]"
             style="background-color: #1C4E95 ;">

            <div class="flex-shrink-0 flex justify-center sm:justify-end w-full sm:w-auto">
                <img src="{{ asset('public/images/OurMusicians.png') }}" alt="Logo Komunitas"
                     class="w-auto max-w-[70%] sm:max-w-none mx-auto sm:h-40 object-contain">
            </div>

            {{-- FORM FILTER (q, genre, domisili) --}}
            <form action="{{ route('index') }}" method="GET"
                  class="w-full grid grid-cols-4 gap-2 sm:flex sm:items-center sm:gap-3">

                {{-- Search text (2 kolom di mobile) --}}
                <div class="relative col-span-2 sm:col-span-1 sm:flex-1">
                    <input type="text" name="q" value="{{ request('q') ?? '' }}"
                           placeholder="Cari musisi / genre / domisili"
                           class="w-full pl-8 pr-3 py-1.5 sm:py-2 border border-transparent rounded-full
                                  text-[11px] sm:text-sm focus:outline-none focus:ring-1 focus:ring-blue-200
                                  text-gray-800" />
                    <div class="absolute inset-y-0 left-0 pl-2 flex items-center">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-white/80" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Genre (1 kolom) --}}
                <div class="relative col-span-1">
                    <select name="genre" onchange="this.form.submit()"
                            class="w-full px-2 py-1.5 sm:px-3 sm:py-2 border border-transparent rounded-full
                                   text-[11px] sm:text-sm focus:outline-none focus:ring-1 focus:ring-blue-200
                                   text-gray-800 bg-white">
                        <option value="" {{ request('genre') ? '' : 'selected' }}>Genre</option>
                        @foreach ($genreOptions as $g)
                            <option value="{{ $g }}" {{ request('genre') === $g ? 'selected' : '' }}>
                                {{ $g }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Domisili (1 kolom) --}}
                <div class="relative col-span-1">
                    <select name="domisili" onchange="this.form.submit()"
                            class="w-full px-2 py-1.5 sm:px-3 sm:py-2 border border-transparent rounded-full
                                   text-[11px] sm:text-sm focus:outline-none focus:ring-1 focus:ring-blue-200
                                   text-gray-800 bg-white">
                        <option value="" {{ request('domisili') ? '' : 'selected' }}>Domisili</option>
                        @foreach ($domOptions as $d)
                            <option value="{{ $d }}" {{ request('domisili') === $d ? 'selected' : '' }}>
                                {{ $d }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        {{-- GRID MUSISI --}}
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($musisi as $m)
                    <a href="{{ route('musisi.show', ['id' => $m->id_musisi]) }}"
                       class="bg-white rounded-xl shadow-md overflow-hidden transform transition duration-300 cursor-pointer hover:scale-105 hover:shadow-xl h-72 sm:h-80"
                       aria-label="Lihat profil {{ $m->display_name }}">
                        <div class="relative h-40 sm:h-48">
                            @php
                                $logo = $m->profil?->logo
                                    ? asset('storage/app/public/' . $m->profil->logo)
                                    : asset('public/images/placeholder-band.jpg');
                            @endphp
                            <img src="{{ $logo }}" alt="Logo {{ $m->display_name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-3 sm:p-4 flex flex-col justify-between h-28">
                            <div>
                                <h3 class="font-semibold text-sm sm:text-base text-gray-800 mb-1 truncate">
                                    {{ $m->display_name }}
                                </h3>
                                <p class="text-xs sm:text-sm text-gray-600 truncate">
                                    {{ $m->domisili ?? '—' }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-4 text-center text-gray-500 text-sm">Belum ada musisi.</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($musisi instanceof \Illuminate\Contracts\Pagination\Paginator)
                <div class="mt-6">
                    {{ $musisi->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper(".swiper", {
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false
                },
            });
        });
    </script>
@endpush
