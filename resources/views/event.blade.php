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

    <!-- HEADER -->
    <div
        class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA]
           py-5 px-4 text-center shadow-md
           rounded-3xl mx-4 mt-4 relative overflow-hidden">

        <h2 class="text-xl md:text-2xl font-bold text-white tracking-wide drop-shadow">
            Daftar Event
        </h2>

        <p class="text-xs md:text-sm text-gray-100 mt-1 tracking-wide">
            Temukan acara musik terbaru di Lampung
        </p>

    </div>

    <!-- GRID EVENT -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div id="event-grid" class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @forelse ($events as $event)
                <a href="{{ route('viewEvent', $event->id) }}"
                    class="bg-white rounded-xl shadow-md overflow-hidden transform transition hover:scale-105 hover:shadow-2xl group">
                    <div class="relative h-72">
                        <img src="{{ $event->flyer ? asset('storage/' . $event->flyer) : 'https://picsum.photos/400/600' }}"
                            alt="Event Poster"
                            class="w-full h-72 object-cover group-hover:scale-110 transition duration-500">
                        <span
                            class="absolute top-3 left-3 bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                            {{ \Carbon\Carbon::parse($event->tanggal)->isFuture() ? 'UPCOMING' : 'SELESAI' }}
                        </span>
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        <h3 class="text-sm font-semibold text-gray-900 group-hover:text-[#1C4E95] transition">
                            {{ $event->nama_event }}
                        </h3>
                        <p class="text-xs text-gray-600">{{ $event->lokasi }} |
                            {{ \Carbon\Carbon::parse($event->tanggal)->format('d-m-Y') }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="col-span-4 text-center text-gray-500">Belum ada event tersedia.</p>
            @endforelse
        </div>
    </div>

    <!-- SWIPER -->
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
@endsection
