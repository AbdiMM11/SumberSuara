@extends('layouts.layout')

@section('content')
    {{-- HEADER --}}
    <div
        class="bg-gradient-to-b from-[#1C4E95] via-[#1E3A8A] to-white
              lg:bg-gradient-to-r lg:from-[#1C4E95] lg:to-[#2563EB]
              rounded-lg shadow-xl p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>

        {{-- MOBILE: SWIPER (logo + hero + 3 foto) --}}
        <div class="flex flex-col items-center text-center lg:hidden relative z-10 w-full">
            <div class="w-full relative">
                <div class="swiper band-slider rounded-xl overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ $musisi->profil?->logo ? asset('storage/' . $musisi->profil->logo) : asset('images/placeholder-logo.png') }}"
                                 class="w-full h-64 object-cover" alt="Logo">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ $musisi->profil?->foto ? asset('storage/' . $musisi->profil->foto) : asset('images/placeholder-main.jpg') }}"
                                 class="w-full h-64 object-cover" alt="Foto utama">
                        </div>
                        @foreach ($photos ?? [] as $p)
                            <div class="swiper-slide">
                                <img src="{{ $p }}" class="w-full h-64 object-cover" alt="Foto">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="mt-5 space-y-1">
                <h2 class="text-3xl font-extrabold text-white tracking-wide drop-shadow-lg">
                    {{ $musisi->profil?->nama_panggung ?? ($musisi->user?->nama ?? 'Musisi') }}
                </h2>
                <p class="text-gray-200 text-sm">
                    {{ $musisi->domisili ?? '—' }}@if (!empty($musisi->genre))
                        | {{ $musisi->genre }}
                    @endif
                </p>
                @if (!empty($musisi->profil?->desk_musisi))
                    <p class="text-gray-100 text-xs px-4 leading-relaxed mt-2">
                        {{ $musisi->profil->desk_musisi }}
                    </p>
                @endif
            </div>

            {{-- MOBILE: Sosial Media --}}
            <div class="flex items-center justify-center gap-6 mt-4">
                @if (!empty($musisi->spotify))
                    <a href="{{ 'https://open.spotify.com/' . ltrim($musisi->spotify, '@') }}"
                       target="_blank" rel="noopener"
                       class="w-12 h-12 rounded-full flex items-center justify-center bg-green-500 shadow-lg hover:bg-green-600 transition transform hover:scale-110"
                       aria-label="Spotify">
                        <img src="{{ asset('icons/spotify.svg') }}" class="w-6 h-6 invert brightness-0" alt="">
                    </a>
                @endif

                @if (!empty($musisi->instagram))
                    <a href="{{ 'https://instagram.com/' . ltrim($musisi->instagram, '@') }}"
                       target="_blank" rel="noopener"
                       class="w-12 h-12 rounded-full flex items-center justify-center bg-gradient-to-tr from-pink-500 to-purple-500 shadow-lg hover:opacity-90 transition transform hover:scale-110"
                       aria-label="Instagram">
                        <img src="{{ asset('icons/instagram.svg') }}" class="w-12 h-12 object-contain" alt="">
                    </a>
                @endif

                @if (!empty($musisi->youtube))
                    <a href="{{ 'https://www.youtube.com/@' . ltrim($musisi->youtube, '@') }}"
                       target="_blank" rel="noopener"
                       class="w-12 h-12 rounded-full flex items-center justify-center bg-red-600 shadow-lg hover:bg-red-700 transition transform hover:scale-110"
                       aria-label="YouTube">
                        <img src="{{ asset('icons/youtube.svg') }}" class="w-6 h-6 invert brightness-0" alt="">
                    </a>
                @endif
            </div>
        </div>

        {{-- DESKTOP HEADER --}}
        <div class="hidden lg:flex items-center gap-4 relative z-10 ml-4">
            <div class="w-16 h-16 rounded-full overflow-hidden shadow-lg ring-4 ring-white/30">
                <img src="{{ $musisi->profil?->logo ? asset('storage/' . $musisi->profil->logo) : asset('images/placeholder-logo.png') }}"
                     class="w-full h-full object-cover" alt="Logo">
            </div>
            <div>
                <h2 class="text-2xl font-bold text-white">
                    {{ $musisi->profil?->nama_panggung ?? ($musisi->user?->nama ?? 'Musisi') }}
                </h2>
                <p class="text-sm text-blue-100">
                    {{ $musisi->domisili ?? '—' }}@if (!empty($musisi->genre))
                        | {{ $musisi->genre }}
                    @endif
                </p>
            </div>
        </div>

        {{-- DESKTOP: Sosial Media --}}
        <div class="hidden lg:flex items-center justify-end gap-3 relative z-10 mr-4">
            @if (!empty($musisi->spotify))
                <a href="{{ 'https://open.spotify.com/' . ltrim($musisi->spotify, '@') }}"
                   target="_blank" rel="noopener"
                   class="w-9 h-9 flex items-center justify-center rounded-full bg-green-500 hover:bg-green-600 shadow-md transition transform hover:scale-110"
                   aria-label="Spotify">
                    <img src="{{ asset('icons/spotify.svg') }}" class="w-5 h-5 invert brightness-0" alt="">
                </a>
            @endif

            @if (!empty($musisi->instagram))
                <a href="{{ 'https://instagram.com/' . ltrim($musisi->instagram, '@') }}"
                   target="_blank" rel="noopener"
                   class="w-9 h-9 flex items-center justify-center rounded-full bg-gradient-to-tr from-pink-500 to-purple-500 hover:opacity-90 shadow-md transition transform hover:scale-110"
                   aria-label="Instagram">
                    <img src="{{ asset('icons/instagram.svg') }}" class="w-9 h-9 object-contain" alt="">
                </a>
            @endif

            @if (!empty($musisi->youtube))
                <a href="{{ 'https://www.youtube.com/@' . ltrim($musisi->youtube, '@') }}"
                   target="_blank" rel="noopener"
                   class="w-9 h-9 flex items-center justify-center rounded-full bg-red-600 hover:bg-red-700 shadow-md transition transform hover:scale-110"
                   aria-label="YouTube">
                    <img src="{{ asset('icons/youtube.svg') }}" class="w-5 h-5 invert brightness-0" alt="">
                </a>
            @endif
        </div>
    </div>

    {{-- DESKTOP: Hero + Thumbs + Deskripsi --}}
    <div class="container mx-auto px-4 lg:px-8 py-10 -mt-24 lg:-mt-0">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-9 relative hidden lg:block">
                <img src="{{ $musisi->profil?->foto ? asset('storage/' . $musisi->profil->foto) : asset('images/placeholder-main.jpg') }}"
                     alt="Concert" class="w-full h-[500px] object-cover rounded-2xl shadow-2xl">
                @if (!empty($musisi->profil?->desk_musisi))
                    <div class="absolute -bottom-16 left-12 right-12 bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] text-white p-6 shadow-lg text-center">
                        <p class="text-sm md:text-base leading-relaxed font-normal">
                            {{ $musisi->profil->desk_musisi }}
                        </p>
                    </div>
                @endif
            </div>

            <div class="lg:col-span-3 hidden lg:grid grid-rows-3 gap-4 h-[500px]">
                @forelse(($photos ?? []) as $thumb)
                    <img src="{{ $thumb }}" alt="Thumbnail"
                         class="w-full h-full object-cover rounded-xl shadow-lg hover:scale-[1.03] hover:shadow-2xl transition-all duration-300 cursor-pointer">
                @empty
                    <div class="rounded-xl bg-gray-100 grid place-content-center text-gray-400">No photos</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="mt-20 md:px-20">
        <!-- HEADER -->
        <div class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] text-gray-100 px-3 md:px-4 py-2 rounded-xl shadow-md mb-2">
            <h3 class="text-center font-semibold tracking-wide">Daftar Lagu</h3>
        </div>

        <!-- LIST -->
        <div id="playlist" class="space-y-1.5 max-h-96 overflow-y-auto">
            {{-- $songs dikirim dari Public\ProfilController@show --}}
            @forelse (($songs ?? []) as $i => $song)
                <div class="song-item group flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer"
                     data-karya-id="{{ $song->id_karya }}" {{-- penting untuk toggle favorit --}}
                     data-src="{{ $song->audio_url }}"
                     data-title="{{ $song->judul }}"
                     data-artist="{{ $musisi->display_name }}"
                     data-cover="{{ $song->cover_url }}"
                     data-duration="{{ $song->durasi_format ?? '' }}"
                     data-favorite="{{ in_array($song->id_karya, $favoriteIds ?? []) ? 1 : 0 }}">

                    <!-- Nomor (desktop) -->
                    <span class="hidden md:block w-8 text-center text-sm text-gray-500">{{ $i + 1 }}</span>

                    <!-- Thumbnail -->
                    <div class="relative shrink-0">
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-200">
                            <img src="{{ $song->cover_url }}" class="w-12 h-12 object-cover rounded-lg" alt="cover">
                        </div>
                        <span
                            class="md:hidden absolute -top-1 -left-1 text-[10px] px-1.5 py-0.5 rounded bg-white/90 text-gray-700 shadow">
                            {{ $i + 1 }}
                        </span>
                    </div>

                    <!-- Title + Artist -->
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $song->judul }}</p>
                        <p class="text-xs text-gray-500 truncate">
                            {{ $musisi->display_name }}
                            @if (!empty($song->tahun))
                                • <span class="text-gray-400">{{ $song->tahun }}</span>
                            @endif
                        </p>
                    </div>

                    <span class="px-2 text-gray-300 select-none" aria-hidden="true">…</span>
                </div>
            @empty
                <div class="text-center text-sm text-gray-500 py-3">Belum ada karya.</div>
            @endforelse
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.band-slider', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false
                },
            });
        });
    </script>
@endpush
