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

    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/30 to-purple-50/20 py-8 px-4 sm:py-12">
        <div class="max-w-7xl mx-auto">

            {{-- Header Breadcrumb --}}
            <div class="mb-6 animate-fade-in">
                <nav class="flex items-center gap-2 text-sm text-gray-600">
                    <a href="#" class="hover:text-blue-600 transition-colors">Home</a>
                    <span>›</span>
                    <a href="#" class="hover:text-blue-600 transition-colors">Events</a>
                    <span>›</span>
                    <span class="text-gray-900 font-medium">Detail</span>
                </nav>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-8">

                {{-- LEFT COLUMN - Flyer & Quick Actions (40%) --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Flyer Card --}}
                    <div
                        class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 p-5 overflow-hidden relative">

                        {{-- Decorative Background --}}
                        <div
                            class="absolute -top-20 -right-20 w-40 h-40 bg-gradient-to-br from-blue-400/10 to-purple-400/10 rounded-full blur-3xl">
                        </div>
                        <div
                            class="absolute -bottom-20 -left-20 w-40 h-40 bg-gradient-to-tr from-pink-400/10 to-orange-400/10 rounded-full blur-3xl">
                        </div>

                        @php
                            $flyer = $event->flyer
                                ? asset('storage/app/public/' . $event->flyer)
                                : 'https://picsum.photos/400/600';
                        @endphp

                        <div class="relative">
                            {{-- Flyer Image --}}
                            <button type="button" onclick="openFlyerModal()"
                                class="relative w-full overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50
                                   shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300
                                   focus:outline-none focus:ring-4 focus:ring-blue-500/50 group">

                                <img src="{{ $flyer }}" alt="Event Flyer"
                                    class="w-full h-auto max-h-[500px] object-cover rounded-2xl">

                                {{-- Overlay on Hover --}}
                                <div
                                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300
                                        flex items-center justify-center rounded-2xl">
                                    <div
                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300
                                            bg-white/90 backdrop-blur-sm rounded-full p-4 shadow-xl transform scale-75 group-hover:scale-100">
                                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                        </svg>
                                    </div>
                                </div>
                            </button>

                            {{-- Hint Text --}}
                            <p class="text-xs text-gray-500 text-center mt-3 flex items-center justify-center gap-2">
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

                    {{-- Quick Action Buttons --}}
                    <div class="grid grid-cols-2 gap-4">
                        <button
                            class="group bg-white hover:bg-gradient-to-r hover:from-blue-600 hover:to-blue-500
                                   text-gray-700 hover:text-white font-semibold py-4 px-6 rounded-2xl
                                   shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300
                                   flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            <span>Bagikan</span>
                        </button>

                        <button
                            class="group bg-white hover:bg-gradient-to-r hover:from-pink-600 hover:to-rose-500
                                   text-gray-700 hover:text-white font-semibold py-4 px-6 rounded-2xl
                                   shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300
                                   flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span>Simpan</span>
                        </button>
                    </div>

                </div>

                {{-- RIGHT COLUMN - Event Details (60%) --}}
                <div class="lg:col-span-3 space-y-6">

                    {{-- Title Card --}}
                    <div
                        class="bg-gradient-to-r from-blue-600 via-blue-500 to-purple-600 rounded-3xl shadow-2xl p-8 relative overflow-hidden group">

                        {{-- Animated Background Shapes --}}
                        <div
                            class="absolute -top-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000">
                        </div>
                        <div
                            class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000">
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full blur-3xl">
                        </div>

                        {{-- Content --}}
                        <div class="relative">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="bg-white/20 backdrop-blur-sm p-3 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-blue-100 text-sm font-medium mb-2">FEATURED EVENT</p>
                                    <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight tracking-tight">
                                        {{ $event->nama_event }}
                                    </h1>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div
                                class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium mt-2">
                                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                Pendaftaran Dibuka
                            </div>
                        </div>
                    </div>

                    {{-- Info Cards Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- Date Card --}}
                        <div
                            class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-5 transition-all duration-300 hover:-translate-y-2 border border-gray-100 group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-orange-400 to-red-500 text-white text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    📅
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Tanggal</p>
                                    <p class="font-bold text-gray-900 text-sm mt-1 leading-tight">
                                        {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Location Card --}}
                        <div
                            class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-5 transition-all duration-300 hover:-translate-y-2 border border-gray-100 group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 text-white text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    📍
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Lokasi</p>
                                    <p class="font-bold text-gray-900 text-sm mt-1 leading-tight">
                                        {{ $event->lokasi }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Speaker Card --}}
                        <div
                            class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-5 transition-all duration-300 hover:-translate-y-2 border border-gray-100 group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-emerald-500 text-white text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    🎤
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Pembicara</p>
                                    <p class="font-bold text-gray-900 text-sm mt-1 leading-tight">
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
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 text-white shadow-lg">
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

                        {{-- Tags or Categories (Optional) --}}
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-medium">
                                    #Event
                                </span>
                                <span class="px-4 py-2 bg-purple-50 text-purple-700 rounded-full text-sm font-medium">
                                    #Workshop
                                </span>
                                <span class="px-4 py-2 bg-pink-50 text-pink-700 rounded-full text-sm font-medium">
                                    #Networking
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- CTA Button --}}
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl shadow-2xl p-6 md:p-8">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="text-white text-center md:text-left">
                                <h3 class="text-xl md:text-2xl font-bold mb-2">Tertarik Mengikuti Event Ini?</h3>
                                <p class="text-blue-100">Daftar sekarang dan dapatkan pengalaman tak terlupakan!</p>
                            </div>
                            <button
                                class="bg-white text-blue-600 hover:bg-blue-50 font-bold py-4 px-8 rounded-2xl
                                       shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300
                                       whitespace-nowrap">
                                Daftar Sekarang →
                            </button>
                        </div>
                    </div>

                </div>

            </div>

            {{-- Modal Flyer --}}
            <div id="flyer-modal"
                class="fixed inset-0 bg-black/80 backdrop-blur-md hidden z-50 flex items-center justify-center px-4 animate-fade-in">

                {{-- Close on backdrop click --}}
                <div class="absolute inset-0" onclick="closeFlyerModal()"></div>

                {{-- Close Button --}}
                <button onclick="closeFlyerModal()"
                    class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center rounded-full
                       bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white hover:rotate-90
                       transition-all duration-300 z-10 group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- Image Container --}}
                <div class="relative max-w-5xl max-h-[90vh] animate-scale-in">
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
    </style>

    <script>
        function openFlyerModal() {
            const modal = document.getElementById('flyer-modal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeFlyerModal() {
            const modal = document.getElementById('flyer-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeFlyerModal();
            }
        });
    </script>
@endsection
