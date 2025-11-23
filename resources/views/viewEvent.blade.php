@extends('layouts.layout')

@section('content')
    <div class="pb-16 mt-12">
        <div class="relative max-w-7xl mx-auto px-0 sm:px-4">
            <div class="relative rounded-xl overflow-hidden shadow-lg">
                <img src="{{ asset('images/hsfixed.jpg') }}" alt="Concert" class="w-full h-96 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 text-white flex justify-center">
                    <div class="max-w-xl">
                        <h1 class="text-2xl text-center md:text-3xl font-bold">
                            Event - Sumber Suara
                        </h1>
                        <p class="mt-2 text-center text-xs md:text-base font-light">
                            Temukan berbagai acara musik dan kreatif dari komunitas lokal. Jangan lewatkan jadwal konser,
                            showcase, dan kegiatan terbaru Sumber Suara.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-gray-50 py-10 px-4">
        <div class="max-w-5xl mx-auto space-y-6 md:space-y-8">

            {{-- NAMA EVENT (GRADIENT CARD) --}}
            <div
                class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] py-5 px-4 md:px-8 text-center shadow-md rounded-3xl mx-1 md:mx-0 mt-2 relative overflow-hidden">
                {{-- dekorasi halus --}}
                <div class="pointer-events-none absolute -right-10 -top-10 w-32 h-32 rounded-full border border-white/10">
                </div>
                <div class="pointer-events-none absolute -left-16 bottom-0 w-40 h-40 rounded-full border border-white/10">
                </div>

                <h3 class="font-semibold tracking-wide text-white text-sm md:text-base uppercase drop-shadow">
                    {{ $event->nama_event }}
                </h3>
                <p class="text-[10px] md:text-xs text-white mt-1 tracking-wide">
                    Informasi lengkap mengenai event komunitas musik lokal
                </p>
            </div>

            {{-- FLYER EVENT (POTRAIT + KLIK UNTUK ZOOM) --}}
            <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6">
                <div class="w-full flex flex-col items-center gap-2">
                    {{-- Wrapper flyer --}}
                    <button type="button" onclick="openFlyerModal()"
                        class="inline-block rounded-2xl border border-gray-100 bg-gray-50 shadow-inner p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-white max-w-xs md:max-w-sm">
                        <img src="{{ $event->flyer ? asset('storage/' . $event->flyer) : 'https://picsum.photos/400/600' }}"
                            alt="Flyer Event"
                            class="max-h-[420px] md:max-h-[520px] w-auto max-w-full object-contain rounded-xl">
                    </button>

                    <p class="text-[11px] md:text-xs text-gray-500">
                        Klik gambar untuk melihat flyer dalam ukuran penuh
                    </p>
                </div>
            </div>

            {{-- MODAL ZOOM FLYER --}}
            <div id="flyer-modal"
                class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden z-50 flex items-center justify-center px-4">
                {{-- area klik luar untuk close --}}
                <div class="absolute inset-0" onclick="closeFlyerModal()"></div>

                {{-- tombol close --}}
                <button type="button" onclick="closeFlyerModal()"
                    class="absolute top-4 right-4 text-white/80 hover:text-white text-xl font-semibold">
                    ✕
                </button>

                {{-- gambar besar --}}
                <img src="{{ $event->flyer ? asset('storage/' . $event->flyer) : 'https://picsum.photos/400/600' }}"
                    alt="Flyer Event Fullscreen" class="max-h-[90vh] max-w-[90vw] object-contain rounded-2xl shadow-2xl">
            </div>

            {{-- INFO TANGGAL, LOKASI, PENGISI (SEJAJAR) --}}
            <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6">
                <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <span
                        class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-blue-100 text-blue-600 text-xs">
                        ℹ️
                    </span>
                    Detail Event
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    {{-- Tanggal --}}
                    <div class="flex items-center gap-3 bg-gray-50/80 p-4 rounded-2xl border border-gray-100">
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-orange-100 text-orange-600 text-xl">
                            📅
                        </div>
                        <div class="min-w-0">
                            <p class="text-[11px] text-gray-500 uppercase tracking-wide">Tanggal</p>
                            <p class="font-semibold text-gray-800 text-sm truncate">
                                {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- Lokasi --}}
                    <div class="flex items-center gap-3 bg-gray-50/80 p-4 rounded-2xl border border-gray-100">
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600 text-xl">
                            📍
                        </div>
                        <div class="min-w-0">
                            <p class="text-[11px] text-gray-500 uppercase tracking-wide">Lokasi</p>
                            <p class="font-semibold text-gray-800 text-sm truncate">
                                {{ $event->lokasi }}
                            </p>
                        </div>
                    </div>

                    {{-- Pengisi / Musisi --}}
                    <div class="flex items-center gap-3 bg-gray-50/80 p-4 rounded-2xl border border-gray-100">
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-green-100 text-green-600 text-xl">
                            🎤
                        </div>
                        <div class="min-w-0">
                            <p class="text-[11px] text-gray-500 uppercase tracking-wide">Pengisi Acara</p>
                            <p class="font-semibold text-gray-800 text-sm truncate">
                                {{ $event->pengisi ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TENTANG KEGIATAN --}}
            <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6">
                <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">
                    Tentang Kegiatan
                </h3>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed text-justify break-words">
                    {{ $event->deskripsi ?? 'Belum ada deskripsi kegiatan untuk event ini.' }}
                </p>
            </div>
        </div>

        {{-- SCRIPT MODAL FLYER --}}
        <script>
            function openFlyerModal() {
                const modal = document.getElementById('flyer-modal');
                if (modal) modal.classList.remove('hidden');
            }

            function closeFlyerModal() {
                const modal = document.getElementById('flyer-modal');
                if (modal) modal.classList.add('hidden');
            }
        </script>
    </div>
@endsection
