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

    <div class="min-h-screen bg-gradient-to-b from-slate-50 via-slate-100 to-slate-50 py-8 md:py-10 px-4">
        @php
            $flyer = $event->flyer
                ? asset('storage/app/public/' . $event->flyer) // sesuaikan jika path storage-mu berbeda
                : 'https://picsum.photos/800/1200';

            $tanggal = \Carbon\Carbon::parse($event->tanggal);
            $isUpcoming = $tanggal->isFuture();
        @endphp

        <div class="max-w-6xl mx-auto space-y-6 md:space-y-8">

            {{-- TOP BAR: Back + Status --}}
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <button type="button" onclick="window.history.back()"
                    class="inline-flex items-center gap-2 text-xs md:text-sm text-slate-600 hover:text-slate-900 group">
                    <span
                        class="flex h-7 w-7 items-center justify-center rounded-full border border-slate-200 bg-white shadow-sm group-hover:border-blue-400 group-hover:text-blue-500 transition">
                        ←
                    </span>
                    <span class="font-medium">Kembali ke daftar event</span>
                </button>

                <div class="flex flex-wrap gap-2 justify-start md:justify-end">
                    <span
                        class="inline-flex items-center gap-1 rounded-full border border-slate-200 bg-white/80 px-3 py-1 text-[11px] md:text-xs font-medium text-slate-600 shadow-sm">
                        🎵 <span>Event Komunitas Musik Lokal</span>
                    </span>

                    <span
                        class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] md:text-xs font-semibold shadow-sm
                    {{ $isUpcoming ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-rose-50 text-rose-700 border border-rose-100' }}">
                        <span class="h-2 w-2 rounded-full {{ $isUpcoming ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                        {{ $isUpcoming ? 'Akan berlangsung' : 'Sudah berlangsung' }}
                    </span>
                </div>
            </div>

            {{-- HEADER EVENT --}}
            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA] px-5 py-6 md:px-8 md:py-7 shadow-lg">
                <div class="pointer-events-none absolute -right-10 -top-16 h-40 w-40 rounded-full border border-white/10">
                </div>
                <div class="pointer-events-none absolute -left-24 bottom-0 h-48 w-48 rounded-full border border-white/10">
                </div>

                <div class="relative z-10 space-y-3 md:space-y-4">
                    <p
                        class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-[11px] md:text-xs text-blue-100 backdrop-blur">
                        📅 <span>{{ $tanggal->translatedFormat('l, d F Y') }}</span>
                    </p>

                    <h1 class="text-lg md:text-2xl font-semibold tracking-tight text-white leading-snug">
                        {{ $event->nama_event }}
                    </h1>

                    <p class="text-[11px] md:text-sm text-blue-100/90 max-w-2xl">
                        Informasi lengkap seputar kegiatan komunitas musik lokal, mulai dari tanggal, lokasi, hingga pengisi
                        acara.
                    </p>

                    <div class="flex flex-wrap gap-2 pt-1 md:pt-2 text-[11px] md:text-xs text-blue-50">
                        <span class="inline-flex items-center gap-1 rounded-full bg-black/10 px-3 py-1">
                            📍 <span>{{ $event->lokasi }}</span>
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-full bg-black/10 px-3 py-1">
                            🎤 <span>{{ $event->pengisi ?? 'Lineup akan diumumkan' }}</span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT: GRID --}}
            <div class="grid gap-6 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,1.4fr)] xl:gap-8 items-start">

                {{-- LEFT: FLYER + INFO KECIL --}}
                <div class="space-y-4 lg:space-y-5">
                    <div class="bg-white rounded-3xl shadow-md border border-slate-100/70 p-3 md:p-4">
                        <div class="flex flex-col items-center gap-3">
                            <button type="button" onclick="openFlyerModal()"
                                class="group inline-block rounded-2xl border border-slate-100 bg-slate-50/70 shadow-inner p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-slate-50 max-w-xs md:max-w-sm">
                                <div class="relative">
                                    <img src="{{ $flyer }}" alt="Flyer Event"
                                        class="max-h-[380px] md:max-h-[480px] w-auto max-w-full object-contain rounded-xl shadow-md group-hover:shadow-lg group-hover:-translate-y-[1px] transition">
                                    <span
                                        class="pointer-events-none absolute bottom-3 right-3 inline-flex items-center gap-1 rounded-full bg-black/60 px-2.5 py-1 text-[10px] md:text-[11px] text-slate-50">
                                        🔍 Klik untuk perbesar
                                    </span>
                                </div>
                            </button>

                            <p class="text-[11px] md:text-xs text-slate-500 text-center">
                                Simpan flyer ini untuk dibagikan ke teman atau komunitasmu.
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-3xl shadow-md border border-slate-100/70 p-4 md:p-5 text-xs md:text-sm text-slate-600 space-y-3">
                        <h3 class="font-semibold text-slate-800 text-sm md:text-base">
                            ℹ️ Info Singkat
                        </h3>
                        <ul class="space-y-2">
                            <li class="flex gap-2">
                                <span class="mt-[3px] h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                <p>Event ini diselenggarakan untuk mendukung ekosistem musik lokal dan mempertemukan musisi
                                    dengan penikmat musik.</p>
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-[3px] h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                <p>Pastikan kamu datang lebih awal untuk mendapatkan pengalaman terbaik dan tempat yang
                                    nyaman.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- RIGHT: DETAIL EVENT + DESKRIPSI --}}
                <div class="space-y-4 lg:space-y-5">

                    {{-- DETAIL EVENT --}}
                    <div class="bg-white rounded-3xl shadow-md border border-slate-100/70 p-4 md:p-6">
                        <div class="flex items-center justify-between gap-3 mb-4 md:mb-5">
                            <div class="flex items-center gap-2 md:gap-3">
                                <span
                                    class="inline-flex h-9 w-9 md:h-10 md:w-10 items-center justify-center rounded-2xl bg-blue-50 text-lg">
                                    ℹ️
                                </span>
                                <div>
                                    <h3 class="text-sm md:text-base font-semibold text-slate-800">
                                        Detail Event
                                    </h3>
                                    <p class="text-[11px] md:text-xs text-slate-500">
                                        Ringkasan informasi utama dari event ini.
                                    </p>
                                </div>
                            </div>

                            <button type="button"
                                class="hidden sm:inline-flex items-center gap-1.5 rounded-full border border-blue-100 bg-blue-50 px-3 py-1.5 text-[11px] md:text-xs font-medium text-blue-700 hover:bg-blue-100 transition">
                                📆 Simpan ke kalender
                            </button>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5 md:gap-4">

                            {{-- Tanggal --}}
                            <div
                                class="flex items-center gap-3 bg-slate-50/80 p-3.5 md:p-4 rounded-2xl border border-slate-100">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-2xl bg-orange-50 text-orange-600 text-xl">
                                    📅
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] text-slate-500 uppercase tracking-wide">
                                        Tanggal
                                    </p>
                                    <p class="font-semibold text-slate-800 text-xs md:text-sm truncate">
                                        {{ $tanggal->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Lokasi --}}
                            <div
                                class="flex items-center gap-3 bg-slate-50/80 p-3.5 md:p-4 rounded-2xl border border-slate-100">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-2xl bg-yellow-50 text-yellow-600 text-xl">
                                    📍
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] text-slate-500 uppercase tracking-wide">
                                        Lokasi
                                    </p>
                                    <p class="font-semibold text-slate-800 text-xs md:text-sm truncate">
                                        {{ $event->lokasi }}
                                    </p>
                                </div>
                            </div>

                            {{-- Pengisi --}}
                            <div
                                class="flex items-center gap-3 bg-slate-50/80 p-3.5 md:p-4 rounded-2xl border border-slate-100">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 text-xl">
                                    🎤
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] text-slate-500 uppercase tracking-wide">
                                        Pengisi Acara
                                    </p>
                                    <p class="font-semibold text-slate-800 text-xs md:text-sm truncate">
                                        {{ $event->pengisi ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- CTA --}}
                        <div class="mt-5 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                            <p class="text-[11px] md:text-xs text-slate-500 max-w-md">
                                Ajak temanmu dan komunitas lain untuk meramaikan event ini. Semakin banyak yang hadir,
                                semakin hidup skena musik lokal!
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button"
                                    class="inline-flex items-center justify-center gap-1.5 rounded-full bg-blue-600 px-4 py-2 text-[11px] md:text-xs font-semibold text-white shadow-sm hover:bg-blue-700 transition">
                                    📤 Bagikan Event
                                </button>
                                <button type="button"
                                    class="inline-flex items-center justify-center gap-1.5 rounded-full border border-slate-200 bg-white px-4 py-2 text-[11px] md:text-xs font-medium text-slate-700 hover:border-blue-200 hover:text-blue-700 transition">
                                    ⭐ Tandai Event
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- DESKRIPSI / TENTANG KEGIATAN --}}
                    <div class="bg-white rounded-3xl shadow-md border border-slate-100/70 p-4 md:p-6">
                        <h3 class="text-sm md:text-base font-semibold text-slate-800 flex items-center gap-2 mb-3 md:mb-4">
                            <span
                                class="inline-flex h-8 w-8 md:h-9 md:w-9 items-center justify-center rounded-2xl bg-slate-50 text-base">
                                📝
                            </span>
                            <span>Tentang Kegiatan</span>
                        </h3>

                        <div class="text-[13px] md:text-sm leading-relaxed text-slate-700 text-justify break-words">
                            {{ $event->deskripsi ?? 'Belum ada deskripsi kegiatan untuk event ini.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL ZOOM FLYER --}}
        <div id="flyer-modal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm px-4 transition-opacity">
            {{-- backdrop klik untuk close --}}
            <div class="absolute inset-0" onclick="closeFlyerModal()"></div>

            {{-- tombol close --}}
            <button type="button" onclick="closeFlyerModal()"
                class="absolute top-4 right-4 text-white/80 hover:text-white text-2xl font-semibold leading-none">
                ✕
            </button>

            <div class="relative z-10 max-h-[90vh] max-w-[90vw]">
                <img src="{{ $flyer }}" alt="Flyer Event Fullscreen"
                    class="max-h-[90vh] max-w-[90vw] object-contain rounded-2xl shadow-2xl">
            </div>
        </div>

        {{-- SCRIPT --}}
        <script>
            function openFlyerModal() {
                const modal = document.getElementById('flyer-modal');
                modal.classList.remove('hidden');
            }

            function closeFlyerModal() {
                const modal = document.getElementById('flyer-modal');
                modal.classList.add('hidden');
            }

            // Optional: tutup modal dengan tombol ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeFlyerModal();
                }
            });
        </script>
    </div>
@endsection
