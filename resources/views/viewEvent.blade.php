@extends('layouts.layout')

@section('content')
    <div class="pb-16 mt-12">
        <div class="relative max-w-7xl mx-auto px-0 sm:px-4">
            <div class="relative rounded-xl overflow-hidden shadow-lg">
                <img src="{{ asset('public/images/hsfixed.jpg') }}" alt="Concert" class="w-full h-96 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                <div class="absolute bottom-6 left-6 right-6 text-white flex justify-center">
                    <div class="max-w-xl">
                        <h1 class="text-2xl text-center md:text-3xl font-bold">Event - Sumber Suara</h1>
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
        <div class="max-w-5xl mx-auto">

            {{-- GRID UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-start">

                {{-- KOLOM KIRI (FLYER) --}}
                <div class="order-2 md:order-1">
                    @php
                        $flyer = $event->flyer
                            ? asset('storage/app/public/' . $event->flyer)
                            : 'https://picsum.photos/400/600';
                    @endphp

                    <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6 h-full flex flex-col items-center justify-center">
                        <div class="w-full flex flex-col items-center gap-2">
                            <button type="button" onclick="openFlyerModal()"
                                class="inline-block rounded-2xl border border-gray-100 bg-gray-50 shadow-inner p-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2
                                   max-w-xs md:max-w-sm">

                                <img src="{{ $flyer }}" alt="Flyer Event"
                                    class="max-h-[420px] md:max-h-[520px] w-auto max-w-full object-contain rounded-xl">
                            </button>

                            <p class="text-[11px] md:text-xs text-gray-500 text-center">
                                Klik gambar untuk melihat flyer ukuran penuh
                            </p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: JUDUL + DETAIL + DESKRIPSI --}}
                <div class="order-1 md:order-2">
                    <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6 space-y-5">

                        {{-- Judul --}}
                        <div
                            class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] py-3 px-4 md:px-6 text-center rounded-2xl relative overflow-hidden">

                            {{-- Shapes abu kecil --}}
                            <div
                                class="pointer-events-none absolute -left-6 -top-6 w-14 h-14 rounded-full border border-gray-300/70">
                            </div>
                            <div
                                class="pointer-events-none absolute -right-6 bottom-0 w-16 h-16 rounded-full border border-gray-300/70">
                            </div>

                            <h3 class="relative font-semibold tracking-wide text-white text-sm md:text-lg uppercase">
                                {{ $event->nama_event }}
                            </h3>
                        </div>

                        {{-- DETAIL EVENT --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                            {{-- Card Tanggal --}}
                            <div
                                class="flex items-center sm:flex-col sm:items-center bg-gray-50/90 p-4
                                    rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1
                                    transition-all duration-200">
                                <div
                                    class="w-11 h-11 flex items-center justify-center rounded-full bg-orange-100 text-orange-600
                                       text-xl mr-3 sm:mr-0 sm:mb-2">
                                    📅
                                </div>
                                <div class="text-left sm:text-center">
                                    <p class="text-[11px] text-gray-500 uppercase">Tanggal</p>
                                    <p class="mt-1 font-semibold text-gray-800 text-sm">
                                        {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Card Lokasi --}}
                            <div
                                class="flex items-center sm:flex-col sm:items-center bg-gray-50/90 p-4
                                    rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1
                                    transition-all duration-200">
                                <div
                                    class="w-11 h-11 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600
                                       text-xl mr-3 sm:mr-0 sm:mb-2">
                                    📍
                                </div>
                                <div class="text-left sm:text-center">
                                    <p class="text-[11px] text-gray-500 uppercase">Lokasi</p>
                                    <p class="mt-1 font-semibold text-gray-800 text-sm">
                                        {{ $event->lokasi }}
                                    </p>
                                </div>
                            </div>

                            {{-- Card Pengisi --}}
                            <div
                                class="flex items-center sm:flex-col sm:items-center bg-gray-50/90 p-4
                                    rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1
                                    transition-all duration-200">
                                <div
                                    class="w-11 h-11 flex items-center justify-center rounded-full bg-green-100 text-green-600
                                       text-xl mr-3 sm:mr-0 sm:mb-2">
                                    🎤
                                </div>
                                <div class="text-left sm:text-center">
                                    <p class="text-[11px] text-gray-500 uppercase">Pengisi Acara</p>
                                    <p class="mt-1 font-semibold text-gray-800 text-sm">
                                        {{ $event->pengisi ?? '-' }}
                                    </p>
                                </div>
                            </div>

                        </div>

                        {{-- DESKRIPSI --}}
                        <div>
                            <h3 class="text-base md:text-lg font-bold text-gray-800 mb-2 text-center">
                                Tentang Kegiatan
                            </h3>
                            <p class="text-gray-600 text-sm md:text-base leading-relaxed text-justify">
                                {{ $event->deskripsi }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            {{-- MODAL --}}
            <div id="flyer-modal"
                class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden z-50 flex items-center justify-center px-4">

                <div class="absolute inset-0" onclick="closeFlyerModal()"></div>

                <button onclick="closeFlyerModal()"
                    class="absolute top-4 right-4 text-white/80 hover:text-white text-xl">✕</button>

                <img src="{{ $flyer }}" class="max-h-[90vh] max-w-[90vw] object-contain rounded-2xl shadow-2xl">
            </div>

            <script>
                function openFlyerModal() {
                    document.getElementById('flyer-modal').classList.remove('hidden');
                }

                function closeFlyerModal() {
                    document.getElementById('flyer-modal').classList.add('hidden');
                }
            </script>

        </div>
    </div>
@endsection
