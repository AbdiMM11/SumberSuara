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
        $flyer = $event->flyer ? asset('storage/app/public/' . $event->flyer) : 'https://picsum.photos/800/1200';
    @endphp

    {{-- ================== HERO IMAGE ================== --}}
    <div class="relative w-full h-[360px] md:h-[480px] overflow-hidden">
        <img src="{{ $flyer }}" class="w-full h-full object-cover rounded-b-[40px] shadow-lg">

        {{-- Like button --}}
        <button
            class="absolute top-5 right-5 bg-white/90 backdrop-blur-sm h-10 w-10 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition">
            ❤️
        </button>
    </div>

    {{-- ================== CARD CONTENT ================== --}}
    <div class="px-4 pb-20 -mt-12 relative z-20">
        <div class="bg-white rounded-3xl shadow-xl p-6 md:p-10 space-y-6">

            {{-- ========= TITLE & BADGE ========= --}}
            <div class="flex items-start justify-between">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight">
                    {{ $event->nama_event }}
                </h1>

                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-orange-100 text-orange-600">
                    FREE
                </span>
            </div>

            {{-- ========== PEOPLE JOINED (DUMMY) =========== --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="flex -space-x-2">
                        <img src="https://i.pravatar.cc/40?img=2" class="h-7 w-7 rounded-full border-2 border-white">
                        <img src="https://i.pravatar.cc/40?img=3" class="h-7 w-7 rounded-full border-2 border-white">
                        <img src="https://i.pravatar.cc/40?img=4" class="h-7 w-7 rounded-full border-2 border-white">
                        <img src="https://i.pravatar.cc/40?img=5" class="h-7 w-7 rounded-full border-2 border-white">
                    </div>

                    <p class="text-gray-600 text-sm">1,2K people joined</p>
                </div>

                <button class="text-blue-600 text-sm font-semibold hover:underline">
                    View All
                </button>
            </div>

            {{-- ========== DESCRIPTION ========== --}}
            <div>
                <h3 class="font-semibold text-gray-900 text-lg mb-1">Deskripsi</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $event->deskripsi ?? 'Belum ada deskripsi kegiatan untuk event ini.' }}
                </p>
            </div>

            {{-- ========== LOCATION ========== --}}
            <div class="space-y-3">
                <div class="flex items-start gap-3 bg-gray-50 p-4 rounded-2xl">
                    <div class="h-10 w-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                        📍
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase">Lokasi</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $event->lokasi }}</p>
                    </div>
                </div>

                {{-- ========== DATE ========== --}}
                <div class="flex items-start gap-3 bg-gray-50 p-4 rounded-2xl">
                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                        📅
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase">Tanggal</p>
                        <p class="font-semibold text-gray-800 text-sm">
                            {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>

                {{-- ========== PENGISI ========== --}}
                <div class="flex items-start gap-3 bg-gray-50 p-4 rounded-2xl">
                    <div class="h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                        🎤
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase">Pengisi Acara</p>
                        <p class="font-semibold text-gray-800 text-sm">
                            {{ $event->pengisi ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- ========== MAP PLACEHOLDER ========== --}}
            <div class="mt-4">
                <h3 class="font-semibold text-gray-900 text-lg mb-2">Maps</h3>
                <div class="w-full h-40 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-500">
                    Map Here (Coming Soon)
                </div>
            </div>

            {{-- ========== CTA BUTTON ========== --}}
            <div class="mt-6">
                <button
                    class="w-full bg-[#1C4E95] hover:bg-[#153a70] transition text-white text-sm font-semibold px-6 py-3 rounded-full shadow-md">
                    Daftar / Join Event
                </button>
            </div>

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

    <script>
        function openFlyerModal() {
            document.getElementById('flyer-modal').classList.remove('hidden');
        }

        function closeFlyerModal() {
            document.getElementById('flyer-modal').classList.add('hidden');
        }
    </script>
@endsection
