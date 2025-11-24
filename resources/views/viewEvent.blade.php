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
        <div class="max-w-5xl mx-auto space-y-6 md:space-y-8">

            {{-- CARD JUDUL EVENT --}}
            <div
                class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] py-5 px-4 md:px-8 text-center shadow-md rounded-3xl mx-1 md:mx-0 mt-2 relative overflow-hidden">
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

            {{-- FLYER EVENT --}}
            @php
                $flyer = $event->flyer ? asset('storage/app/public/' . $event->flyer) : 'https://picsum.photos/400/600';
            @endphp

            <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6">
                <div class="w-full flex flex-col items-center gap-2">
                    <button type="button" onclick="openFlyerModal()"
                        class="inline-block rounded-2xl border border-gray-100 bg-gray-50 shadow-inner p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 max-w-xs md:max-w-sm">
                        <img src="{{ $flyer }}" alt="Flyer Event"
                            class="max-h-[420px] md:max-h-[520px] w-auto max-w-full object-contain rounded-xl">
                    </button>

                    <p class="text-[11px] md:text-xs text-gray-500">Klik gambar untuk melihat flyer ukuran penuh</p>
                </div>
            </div>

            {{-- MODAL ZOOM FLYER --}}
            <div id="flyer-modal"
                class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden z-50 flex items-center justify-center px-4">

                <div class="absolute inset-0" onclick="closeFlyerModal()"></div>

                <button type="button" onclick="closeFlyerModal()"
                    class="absolute top-4 right-4 text-white/80 hover:text-white text-xl font-semibold">✕</button>

                <img src="{{ $flyer }}" alt="Flyer Event Fullscreen"
                    class="max-h-[90vh] max-w-[90vw] object-contain rounded-2xl shadow-2xl">
            </div>

            {{-- DETAIL EVENT --}}
            <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    {{-- Date Card --}}
                    <div
                        class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-4 md:p-5 transition-all duration-300 hover:-translate-y-2 border border-gray-100 group">
                        <div class="flex items-center gap-3 md:gap-4">
                            <div
                                class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 flex items-center justify-center rounded-2xl bg-gradient-to-br from-orange-400 to-red-500 text-white text-xl md:text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                📅
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] md:text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">
                                    Tanggal</p>
                                <p class="font-bold text-gray-900 text-xs md:text-sm leading-tight">
                                    {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Location Card --}}
                    <div
                        class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-4 md:p-5 transition-all duration-300 hover:-translate-y-2 border border-gray-100 group">
                        <div class="flex items-center gap-3 md:gap-4">
                            <div
                                class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 flex items-center justify-center rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 text-white text-xl md:text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                📍
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] md:text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">
                                    Lokasi</p>
                                <p class="font-bold text-gray-900 text-xs md:text-sm leading-tight">
                                    {{ $event->lokasi }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Speaker Card --}}
                    <div
                        class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-4 md:p-5 transition-all duration-300 hover:-translate-y-2 border border-gray-100 group sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center gap-3 md:gap-4">
                            <div
                                class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 flex items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-emerald-500 text-white text-xl md:text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                🎤
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] md:text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">
                                    Pengisi Acara</p>
                                <p class="font-bold text-gray-900 text-xs md:text-sm leading-tight">
                                    {{ $event->pengisi ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6">
                <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">Tentang Kegiatan</h3>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed text-justify break-words">
                    {{ $event->deskripsi ?? 'Belum ada deskripsi kegiatan untuk event ini.' }}
                </p>
            </div>
        </div>

        {{-- SCRIPT --}}
        <script>
            function openFlyerModal() {
                document.getElementById('flyer-modal').classList.remove('hidden');
            }

            function closeFlyerModal() {
                document.getElementById('flyer-modal').classList.add('hidden');
            }
        </script>
    </div>
@endsection
