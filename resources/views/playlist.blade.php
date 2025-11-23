@extends('layouts.layout')

@section('content')
    <div class="pb-16 mt-12">
        <div class="relative max-w-7xl mx-auto px-0 sm:px-4">
            <div class="relative rounded-xl overflow-hidden shadow-lg">
                <img src="{{ asset('public/images/hsfixed.jpg') }}" alt="Concert" class="w-full h-96 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 text-white flex justify-center">
                    <div class="max-w-xl">
                        <h1 class="text-2xl text-center md:text-3xl font-bold">
                            Playlist - Sumber Suara
                        </h1>
                        <p class="mt-2 text-center text-xs md:text-base font-light">
                            Kumpulkan dan dengarkan kembali lagu-lagu yang kamu sukai. Nikmati karya terbaik dari musisi
                            lokal pilihanmu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md:px-20">
        <!-- HEADER -->
        <div
            class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA]
           py-5 px-4 text-center shadow-md
           rounded-3xl mx-4 mt-4 relative overflow-hidden">

            <h3 class="font-semibold tracking-wide text-white text-sm md:text-base uppercase drop-shadow">
                Daftar Lagu Favorit
            </h3>

            <p class="text-[10px] md:text-xs text-white mt-0.5 tracking-wide">
                Kumpulan lagu yang kamu sukai dari para musisi lokal
            </p>

        </div>


        <div id="playlist" class="space-y-1.5 max-h-96 overflow-y-auto">
            @auth
                @forelse ($favorites as $i => $favorite)
                    @php
                        $karya = $favorite->karya;
                        $musisi = $karya->musisi ?? null;

                        // 🔹 pakai accessor display_name supaya konsisten dengan sidebar
                        $artistName = $musisi?->display_name ?? 'Musisi Lokal';

                        $audioSrc = $karya->file_mp3 ? asset('storage/' . $karya->file_mp3) : '';

                        // 🔹 COVER: gunakan accessor cover_url (logo musisi / cover lagu) + fallback
                        $cover = $karya->cover_url ?? asset('public/images/hsfixed.jpg');
                    @endphp

                    <div class="song-item group flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer"
                        data-karya-id="{{ $karya->id_karya }}" data-title="{{ $karya->judul }}"
                        data-artist="{{ $artistName }}" data-src="{{ $audioSrc }}" data-cover="{{ $cover }}"
                        data-favorite="1">

                        <!-- Nomor (desktop) -->
                        <span class="hidden md:block w-8 text-center text-sm text-gray-500">
                            {{ $i + 1 }}
                        </span>

                        <!-- Thumbnail + Nomor (mobile badge) -->
                        <div class="relative shrink-0">
                            <div class="w-11 h-11 rounded-lg overflow-hidden bg-gray-200">
                                <img src="{{ $cover }}" class="w-11 h-11 object-cover rounded-lg"
                                    alt="Logo {{ $artistName }}">
                            </div>
                            <span
                                class="md:hidden absolute -top-1 -left-1 text-[10px] px-1.5 py-0.5 rounded bg-white/90 text-gray-700 shadow">
                                {{ $i + 1 }}
                            </span>
                        </div>

                        <!-- Title + Artist + Year -->
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">
                                {{ $karya->judul }}
                            </p>
                            <p class="text-xs text-gray-500 truncate">
                                {{ $artistName }}
                                @if ($karya->tahun)
                                    • <span class="text-gray-400">{{ $karya->tahun }}</span>
                                @endif
                            </p>
                        </div>

                        <!-- Link ke Profil Musisi -->
                        @if ($musisi)
                            <a href="{{ route('musisi.show', $musisi->id_musisi) }}"
                                class="inline-flex items-center gap-1 text-xs font-medium text-[#1C4E95] hover:underline whitespace-nowrap mr-2 md:mr-8">
                                Lihat Profil
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-sm text-gray-500 py-8">
                        Belum ada lagu favorit. Putar lagu lalu tekan tombol ❤️ untuk menambahkannya ke playlist ini.
                    </p>
                @endforelse
            @endauth

            @guest
                <p class="text-center text-sm text-gray-500 py-8">
                    Kamu perlu login terlebih dahulu untuk melihat dan menyimpan lagu favorit.
                </p>
            @endguest
        </div>

        {{-- POPUP WAJIB LOGIN (muncul hanya untuk guest) --}}
        @guest
            <div id="must-login-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                <div class="bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2 text-center">
                        Login dulu, yuk! 🎧
                    </h2>
                    <p class="text-sm text-gray-600 mb-4 text-center">
                        Untuk mengakses dan menyimpan playlist lagu favorit, kamu perlu login terlebih dahulu.
                    </p>
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg bg-[#1C4E95] text-white text-sm font-semibold hover:bg-[#163b70] transition">
                            Login sekarang
                        </a>
                        <button type="button" id="close-login-modal"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 bg-white hover:bg-gray-50 transition">
                            Nanti saja
                        </button>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const modal = document.getElementById('must-login-modal');
                    const closeBtn = document.getElementById('close-login-modal');

                    if (modal && closeBtn) {
                        closeBtn.addEventListener('click', () => {
                            modal.classList.add('hidden');
                        });

                        // klik area gelap di luar card -> tutup popup
                        modal.addEventListener('click', (e) => {
                            if (e.target === modal) {
                                modal.classList.add('hidden');
                            }
                        });
                    }
                });
            </script>
        @endguest
    </div>
@endsection
