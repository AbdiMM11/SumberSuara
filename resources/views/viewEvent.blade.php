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

            {{-- Title Card --}}
            <div
                class="bg-gradient-to-r from-blue-600 via-blue-500 to-purple-600 rounded-3xl shadow-2xl p-6 md:p-8 relative overflow-hidden group">

                {{-- Animated Background Shapes --}}
                <div
                    class="absolute -top-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000 pointer-events-none">
                </div>
                <div
                    class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000 pointer-events-none">
                </div>
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none">
                </div>

                {{-- Content --}}
                <div class="relative z-10">
                    <div class="flex items-start gap-4">
                        <div class="bg-white/20 backdrop-blur-sm p-3 rounded-2xl flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white leading-tight">
                                {{ $event->nama_event }}
                            </h1>
                        </div>
                    </div>
                </div>
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
                        class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-4 md:p-5 transition-all duration-300 hover:-translate-y-2 border border-gray-100 group">
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

            {{-- Description Card --}}
            <div
                class="bg-white rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 md:p-8 border border-gray-100">

                {{-- Section Header --}}
                <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-100 text-left md:text-center">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900">
                        Tentang Kegiatan
                    </h2>
                </div>

                {{-- Description Text --}}
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-700 text-base md:text-lg leading-relaxed text-justify">
                        {{ $event->deskripsi }}
                    </p>
                </div>
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
