@props(['musisi'])

@php
    $user = $musisi->user;
    $id = $musisi->id_musisi;
    $initial = strtoupper(mb_substr($musisi->display_name, 0, 1));
@endphp

<div>
    {{-- Tombol untuk membuka popup --}}
    <button type="button"
        class="inline-flex items-center gap-1.5 rounded-full border border-gray-300 bg-white px-3 py-1.5
               text-xs font-semibold text-gray-700 shadow-sm hover:bg-gray-50 hover:border-blue-400
               hover:text-blue-700 transition"
        onclick="
            document.getElementById('verifyPopup-{{ $id }}').classList.remove('hidden');
            document.getElementById('popupOverlay-{{ $id }}').classList.remove('hidden');
        ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        <span>Lihat & Verifikasi</span>
    </button>

    <!-- Overlay -->
    <div id="popupOverlay-{{ $id }}" class="fixed inset-0 bg-black/70 hidden z-40 transition-opacity"
        onclick="
            document.getElementById('verifyPopup-{{ $id }}').classList.add('hidden');
            document.getElementById('popupOverlay-{{ $id }}').classList.add('hidden');
         ">
    </div>

    <!-- Popup -->
    <div id="verifyPopup-{{ $id }}"
        class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 py-6">
        <div
            class="relative w-full max-w-5xl bg-white rounded-3xl shadow-2xl border border-gray-100
                   max-h-[90vh] flex flex-col overflow-hidden">

            <!-- Close icon -->
            <button type="button"
                onclick="
                    document.getElementById('verifyPopup-{{ $id }}').classList.add('hidden');
                    document.getElementById('popupOverlay-{{ $id }}').classList.add('hidden');
                "
                class="absolute right-5 top-5 inline-flex h-9 w-9 items-center justify-center
                       rounded-full border border-gray-200 bg-white/80 hover:bg-gray-50 shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Header + Profile -->
            <div class="px-6 pt-6 pb-4 bg-gradient-to-r from-blue-600 to-indigo-500">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <!-- Avatar -->
                        <div
                            class="h-16 w-16 rounded-full overflow-hidden border-2 border-white/80 bg-white/20 flex items-center justify-center shadow-md">
                            <span class="text-xl font-semibold text-white">
                                {{ $initial }}
                            </span>
                        </div>

                        <div>
                            <h2 class="text-xl sm:text-2xl font-semibold text-white text-left">
                                Data Akun Musisi
                            </h2>
                            <p class="mt-1 text-sm text-blue-100">
                                {{ $musisi->display_name }}
                                • {{ $musisi->genre ?? 'Genre tidak diisi' }}
                                • {{ $musisi->domisili ?? 'Domisili tidak diisi' }}
                            </p>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-[11px] font-medium text-white">
                                    Calon musisi Sumber Suara
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-2 sm:mt-0 items-start sm:items-center gap-2">
                        @if ($musisi->isPending())
                            <span
                                class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-[11px] font-semibold text-amber-700">
                                Menunggu verifikasi
                            </span>
                        @elseif($musisi->isApproved())
                            <span
                                class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-[11px] font-semibold text-emerald-700">
                                Sudah disetujui
                            </span>
                        @elseif($musisi->isRejected())
                            <span
                                class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-[11px] font-semibold text-red-700">
                                Ditolak
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="px-6 py-5 bg-gray-50/80 flex-1 overflow-y-auto">
                <div class="grid gap-5 md:grid-cols-2">

                    <!-- Email -->
                    <div class="space-y-1">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            Email
                        </label>
                        <div
                            class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm text-gray-800 shadow-sm">
                            {{ $user?->email ?? '-' }}
                        </div>
                    </div>

                    <!-- No HP -->
                    <div class="space-y-1">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            No. HP
                        </label>
                        <div
                            class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm text-gray-800 shadow-sm">
                            {{ $musisi->no_telp ?? '-' }}
                        </div>
                    </div>

                    <!-- Nama Band -->
                    <div class="space-y-1">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            Nama Band / Musisi
                        </label>
                        <div
                            class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm text-gray-800 shadow-sm">
                            {{ $musisi->display_name }}
                        </div>
                    </div>

                    <!-- Genre -->
                    <div class="space-y-1">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            Genre
                        </label>
                        <div
                            class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm text-gray-800 shadow-sm">
                            {{ $musisi->genre ?? '-' }}
                        </div>
                    </div>

                    <!-- Domisili -->
                    <div class="space-y-1">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            Domisili
                        </label>
                        <div
                            class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm text-gray-800 shadow-sm">
                            {{ $musisi->domisili ?? '-' }}
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div class="space-y-1">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            Instagram
                        </label>
                        @if ($musisi->instagram)
                            <a href="https://instagram.com/{{ $musisi->instagram }}" target="_blank"
                                class="flex items-center bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm
                                      text-blue-600 hover:bg-blue-50 hover:border-blue-200 shadow-sm transition break-words">
                                instagram.com/{{ $musisi->instagram }}
                            </a>
                        @else
                            <div
                                class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm text-gray-400 shadow-sm">
                                Tidak diisi
                            </div>
                        @endif
                    </div>

                    <!-- Spotify -->
                    <div class="space-y-1">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            Spotify
                        </label>
                        @if ($musisi->spotify)
                            <a href="https://spotify.com/{{ $musisi->spotify }}" target="_blank"
                                class="flex items-center bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm
                                      text-blue-600 hover:bg-blue-50 hover:border-blue-200 shadow-sm transition break-words">
                                spotify.com/{{ $musisi->spotify }}
                            </a>
                        @else
                            <div
                                class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm text-gray-400 shadow-sm">
                                Tidak diisi
                            </div>
                        @endif
                    </div>

                    <!-- Youtube -->
                    <div class="space-y-1">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            Youtube
                        </label>
                        @if ($musisi->youtube)
                            <a href="https://youtube.com/{{ $musisi->youtube }}" target="_blank"
                                class="flex items-center bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm
                                      text-blue-600 hover:bg-blue-50 hover:border-blue-200 shadow-sm transition break-words">
                                youtube.com/{{ $musisi->youtube }}
                            </a>
                        @else
                            <div
                                class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 text-sm text-gray-400 shadow-sm">
                                Tidak diisi
                            </div>
                        @endif
                    </div>

                    <!-- Karya -->
                    <div class="space-y-1 md:col-span-2">
                        <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            Karya (Lagu Original)
                        </label>
                        <div class="bg-white border border-gray-200 rounded-2xl px-3.5 py-2.5 shadow-sm">
                            @if ($musisi->file_mp3)
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ basename($musisi->file_mp3) }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            File audio terunggah (click play di bawah untuk preview)
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <audio controls class="w-full">
                                        <source src="{{ asset('storage/' . $musisi->file_mp3) }}" type="audio/mpeg">
                                        Browser kamu tidak mendukung pemutar audio.
                                    </audio>
                                </div>
                            @else
                                <p class="text-sm text-gray-400">
                                    Tidak ada file lagu yang diunggah.
                                </p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <div
                class="px-6 py-4 bg-white border-t border-gray-100 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-xs sm:text-sm text-gray-500">
                    Pastikan seluruh informasi sesuai sebelum memverifikasi akun musisi ini.
                </p>

                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                    {{-- Tombol Tolak --}}
                    <form action="{{ route('admin.verifikasi.reject', $musisi) }}" method="POST"
                        onsubmit="return confirm('Yakin menolak pendaftaran musisi ini?');" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center rounded-2xl border border-red-200
                                       px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 hover:bg-red-100 transition">
                            Tolak
                        </button>
                    </form>

                    {{-- Tombol Setujui --}}
                    <form action="{{ route('admin.verifikasi.approve', $musisi) }}" method="POST"
                        onsubmit="return confirm('Setujui pendaftaran musisi ini? Akun akan diaktifkan.');"
                        class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center rounded-2xl bg-blue-600 px-5 py-2
                                       text-sm font-semibold text-white shadow-md hover:bg-blue-500 transition">
                            Verifikasi & Aktifkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
