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

    @php
        $flyer = $event->flyer ? asset('storage/app/public/' . $event->flyer) : 'https://picsum.photos/400/600';
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/30 to-purple-50/20 py-8 px-4 sm:py-12">
        <div class="max-w-7xl mx-auto">

            {{-- Main Container dengan Flexbox --}}
            <div class="flex flex-col lg:flex-row lg:items-start gap-6 lg:gap-8">

                {{-- KOLOM KIRI: FLYER (40% di Desktop) --}}
                <div class="w-full lg:w-2/5 flex-shrink-0 order-2 lg:order-1">
                    <div
                        class="bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 p-5 overflow-hidden relative lg:sticky lg:top-8 max-h-[90vh]">

                        {{-- Decorative Background --}}
                        <div
                            class="absolute -top-20 -right-20 w-40 h-40 bg-gradient-to-br from-blue-400/10 to-purple-400/10 rounded-full blur-3xl pointer-events-none">
                        </div>
                        <div
                            class="absolute -bottom-20 -left-20 w-40 h-40 bg-gradient-to-tr from-pink-400/10 to-orange-400/10 rounded-full blur-3xl pointer-events-none">
                        </div>

                        <div class="relative z-10">
                            {{-- Flyer Image --}}
                            <button type="button" onclick="openFlyerModal()"
                                class="relative w-full overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-500/50 group block">

                                <img src="{{ $flyer }}" alt="Event Flyer"
                                    class="w-full h-auto max-h-[600px] lg:max-h-[700px] object-contain rounded-2xl">

                                {{-- Overlay on Hover --}}
                                <div
                                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center rounded-2xl">
                                    <div
                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300 bg-white/90 backdrop-blur-sm rounded-full p-4 shadow-xl transform scale-75 group-hover:scale-100">
                                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                        </svg>
                                    </div>
                                </div>
                            </button>

                            {{-- Hint Text --}}
                            <p class="text-xs text-gray-500 text-center mt-4 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Klik untuk memperbesar
                            </p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: KONTEN (60% di Desktop) --}}
                <div class="w-full lg:w-3/5 flex-shrink-0 order-1 lg:order-2 space-y-6">

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
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-blue-100 text-xs md:text-sm font-medium mb-2 uppercase tracking-wider">
                                        Featured Event</p>
                                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white leading-tight">
                                        {{ $event->nama_event }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Detail Event Cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        {{-- Date Card --}}
                        <div
                            class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-4 md:p-5 transition-all duration-300 hover:-translate-y-2 border border-gray-100 group">
                            <div class="flex items-center gap-3 md:gap-4">
                                <div
                                    class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 flex items-center justify-center rounded-2xl bg-gradient-to-br from-orange-400 to-red-500 text-white text-xl md:text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    📅
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-[10px] md:text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">
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
                                    <p
                                        class="text-[10px] md:text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">
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
                                    <p
                                        class="text-[10px] md:text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">
                                        Pengisi Acara</p>
                                    <p class="font-bold text-gray-900 text-xs md:text-sm leading-tight">
                                        {{ $event->pengisi ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Description Card --}}
                    <div
                        class="bg-white rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 md:p-8 border border-gray-100">

                        {{-- Section Header --}}
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-100">
                            <div
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 text-white shadow-lg flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
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

            </div>

            {{-- Modal Flyer --}}
            <div id="flyer-modal"
                class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-[9999] items-center justify-center px-4 animate-fade-in">

                {{-- Close on backdrop click --}}
                <div class="absolute inset-0" onclick="closeFlyerModal()"></div>

                {{-- Close Button --}}
                <button onclick="closeFlyerModal()"
                    class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white hover:rotate-90 transition-all duration-300 z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- Image Container --}}
                <div class="relative max-w-5xl max-h-[90vh] animate-scale-in z-10">
                    <img src="{{ $flyer }}" class="max-h-[90vh] max-w-full object-contain rounded-3xl shadow-2xl">
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }

        .animate-scale-in {
            animation: scale-in 0.3s ease-out;
        }

        /* Pastikan tidak ada CSS yang override flex layout */
        @media (min-width: 1024px) {
            .lg\:flex-row {
                flex-direction: row !important;
            }
        }
    </style>

    <script>
        function openFlyerModal() {
            const modal = document.getElementById('flyer-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeFlyerModal() {
            const modal = document.getElementById('flyer-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeFlyerModal();
            }
        });

        // Prevent modal from closing when clicking on image
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('flyer-modal');
            if (modal) {
                const imageContainer = modal.querySelector('.animate-scale-in');
                if (imageContainer) {
                    imageContainer.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                }
            }
        });
    </script>
@endsection
