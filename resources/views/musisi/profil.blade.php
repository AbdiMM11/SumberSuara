@extends('layouts.layoutMusisi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-slate-50 to-slate-200 px-4 py-8">
    <div class="max-w-5xl mx-auto space-y-8">

        {{-- Header halaman --}}
        <div class="flex flex-col gap-1">
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-900">
                Kelola Profil Musisi
            </h1>
            <p class="text-sm text-gray-500">
                Lengkapi profil agar lebih menarik bagi pendengar dan panitia event.
            </p>
        </div>

        {{-- Flash message --}}
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 flex items-start gap-2 text-sm text-emerald-800 shadow-sm">
                <span class="mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </span>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Error bag global --}}
        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 shadow-sm">
                <div class="flex items-start gap-2">
                    <span class="mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 3a9 9 0 1 1-9 9"/>
                        </svg>
                    </span>
                    <div>
                        <p class="font-medium mb-1">Terdapat beberapa kesalahan:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('musisi.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- ================== INFORMASI UMUM ================== --}}
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
                {{-- Header card --}}
                <div class="px-6 md:px-8 py-4 bg-gradient-to-r from-[#1C4E95] via-blue-600 to-indigo-500">
                    <div class="flex items-center gap-4">
                        <div class="h-11 w-11 rounded-2xl bg-white/15 flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5.5 21v-2a4 4 0 0 1 4-4h5a4 4 0 0 1 4 4v2M12 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg md:text-xl font-semibold text-white">
                                Informasi Umum
                            </h2>
                            <p class="text-xs md:text-sm text-blue-100 mt-0.5">
                                Data dasar musisi/band yang tampil di halaman profil.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="px-6 md:px-8 py-6 md:py-7 space-y-6">
                    {{-- Nama --}}
                    <div class="space-y-1.5">
                        <label for="nama" class="text-sm font-medium text-gray-800">
                            Nama Musisi / Band
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 0 0-8 0v1m-2 4h12M6 14v2a4 4 0 0 0 4 4h4a4 4 0 0 0 4-4v-2"/>
                                </svg>
                            </span>
                            <input
                                id="nama"
                                type="text"
                                name="nama"
                                value="{{ old('nama', $profil->nama_panggung ?? '') }}"
                                placeholder="Masukkan nama musisi atau band"
                                autocomplete="organization"
                                class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            >
                        </div>
                        @error('nama')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Genre & Domisili (grid) --}}
                    @php
                        $genreOptions = [
                            'Pop',
                            'Rock',
                            'Jazz',
                            'Blues',
                            'Metal',
                            'Reggae / SKA',
                            'Hip hop',
                            'Other',
                        ];

                        $ds = [
                            'Bandar Lampung',
                            'Metro',
                            'Lampung Selatan',
                            'Lampung Tengah',
                            'Lampung Timur',
                            'Lampung Barat',
                            'Lampung Utara',
                            'Pesawaran',
                            'Mesuji',
                            'Pesisir Barat',
                            'Pringsewu',
                            'Tanggamus',
                            'Tulang Bawang',
                            'Tulang Bawang Barat',
                            'Way Kanan',
                        ];
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Genre --}}
                        <div class="space-y-1.5">
                            <label for="genre" class="text-sm font-medium text-gray-800">
                                Genre
                            </label>
                            <select
                                id="genre"
                                name="genre"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            >
                                <option value="">Pilih Genre</option>
                                @foreach ($genreOptions as $g)
                                    <option value="{{ $g }}" @selected(old('genre', $musisi->genre ?? '') === $g)>{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('genre')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Domisili --}}
                        <div class="space-y-1.5">
                            <label for="domisili" class="text-sm font-medium text-gray-800">
                                Domisili
                            </label>
                            <select
                                id="domisili"
                                name="domisili"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            >
                                <option value="">Pilih Domisili</option>
                                @foreach ($ds as $d)
                                    <option value="{{ $d }}" @selected(old('domisili', $musisi->domisili ?? '') === $d)>{{ $d }}</option>
                                @endforeach
                            </select>
                            @error('domisili')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="space-y-1.5">
                        <label for="deskripsi" class="text-sm font-medium text-gray-800">
                            Deskripsi
                        </label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="3"
                            placeholder="Tulis deskripsi singkat tentang musisi atau band"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-y"
                        >{{ old('deskripsi', $profil->desk_musisi ?? '') }}</textarea>
                        @error('deskripsi')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Logo + preview --}}
                    <div class="space-y-2">
                        <label for="logo" class="text-sm font-medium text-gray-800">
                            Logo Musisi / Band
                        </label>

                        <div class="grid gap-4 md:grid-cols-[minmax(0,3fr)_minmax(0,1.2fr)] md:items-center">
                            {{-- Dropzone logo --}}
                            <label
                                for="logo"
                                class="cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
                                       text-sm text-gray-500 hover:border-blue-400 hover:bg-blue-50/40 transition flex items-center gap-3"
                            >
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">
                                        Pilih file logo
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Format JPG/PNG/WebP, bentuk persegi (disarankan), ukuran maksimal 2 MB.
                                    </p>
                                </div>
                            </label>

                            {{-- Preview logo --}}
                            @if (!empty($profil->logo))
                                <div class="flex items-center">
                                    <div class="h-16 w-16 rounded-full overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                        <img
                                            src="{{ asset('storage/' . $profil->logo) }}"
                                            class="h-full w-full object-cover"
                                            alt="Logo"
                                        >
                                    </div>
                                </div>
                            @endif
                        </div>

                        <input
                            id="logo"
                            type="file"
                            name="logo"
                            accept="image/png,image/jpeg,image/jpg,image/webp,image/avif"
                            class="hidden"
                        >
                        @error('logo')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ================== SOSIAL MEDIA ================== --}}
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
                {{-- Header --}}
                <div class="px-6 md:px-8 py-4 bg-gradient-to-r from-[#1C4E95] via-blue-600 to-indigo-500">
                    <div class="flex items-center gap-4">
                        <div class="h-11 w-11 rounded-2xl bg-white/15 flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M18 2h-3a1 1 0 0 0-1 1v3h4V2zM9 2H6v4h4V3a1 1 0 0 0-1-1zM6 9v6h4V9H6zm8 0v6h4V9h-4zM6 19v3h3a1 1 0 0 0 1-1v-2H6zm8 0v2a1 1 0 0 0 1 1h3v-3h-4z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg md:text-xl font-semibold text-white">
                                Tautan Sosial Media (username / ID saja)
                            </h2>
                            <p class="text-xs md:text-sm text-blue-100 mt-0.5">
                                Masukkan hanya username/ID, bukan link lengkap.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="px-6 md:px-8 py-6 md:py-7 space-y-5">
                    {{-- Spotify --}}
                    <div class="space-y-1.5">
                        <label for="spotify" class="text-sm font-medium text-gray-800">
                            Spotify
                        </label>
                        <input
                            id="spotify"
                            type="text"
                            name="spotify"
                            value="{{ old('spotify', $musisi->spotify ?? '') }}"
                            placeholder="mis. raksajah123"
                            pattern="[A-Za-z0-9._-]{3,40}"
                            title="Masukkan username/ID Spotify (huruf/angka/._-), tanpa spasi dan tanpa link."
                            class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        >
                        @error('spotify')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            Masukkan <b>username / ID</b>, bukan tautan (tanpa https:// dan tanpa @).
                        </p>
                    </div>

                    {{-- Instagram --}}
                    <div class="space-y-1.5">
                        <label for="instagram" class="text-sm font-medium text-gray-800">
                            Instagram
                        </label>
                        <input
                            id="instagram"
                            type="text"
                            name="instagram"
                            value="{{ old('instagram', $musisi->instagram ?? '') }}"
                            placeholder="mis. raksajah123 (tanpa @)"
                            pattern="[A-Za-z0-9._]{3,30}"
                            title="Hanya huruf/angka/titik/underscore, 3–30 karakter. Tanpa @ dan tanpa link."
                            class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        >
                        @error('instagram')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            Masukkan <b>username</b>, bukan tautan (tanpa @).
                        </p>
                    </div>

                    {{-- YouTube --}}
                    <div class="space-y-1.5">
                        <label for="youtube" class="text-sm font-medium text-gray-800">
                            YouTube
                        </label>
                        <input
                            id="youtube"
                            type="text"
                            name="youtube"
                            value="{{ old('youtube', $musisi->youtube ?? '') }}"
                            placeholder="mis. raksajah123 (tanpa @)"
                            pattern="[A-Za-z0-9._-]{3,40}"
                            title="Huruf/angka/._- saja, 3–40 karakter. Tanpa @ dan tanpa link."
                            class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        >
                        @error('youtube')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            Masukkan <b>handle</b>, bukan tautan (tanpa @).
                        </p>
                    </div>
                </div>
            </div>

            {{-- ================== FOTO KEGIATAN ================== --}}
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
                {{-- Header --}}
                <div class="px-6 md:px-8 py-4 bg-gradient-to-r from-[#1C4E95] via-blue-600 to-indigo-500">
                    <div class="flex items-center gap-4">
                        <div class="h-11 w-11 rounded-2xl bg-white/15 flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 7h3l2-3h8l2 3h3v12H3z"/>
                                <circle cx="12" cy="13" r="3"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg md:text-xl font-semibold text-white">
                                Foto Kegiatan
                            </h2>
                            <p class="text-xs md:text-sm text-blue-100 mt-0.5">
                                Unggah foto terbaik saat tampil atau latihan untuk galeri profil.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="px-6 md:px-8 py-6 md:py-7 space-y-6">
                    {{-- Foto utama --}}
                    <div class="space-y-2">
                        <label for="foto_utama" class="text-sm font-medium text-gray-800">
                            Foto Utama
                        </label>

                        <div class="grid gap-4 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] md:items-center">
                            {{-- Dropzone --}}
                            <label
                                for="foto_utama"
                                class="cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
                                       text-sm text-gray-500 hover:border-blue-400 hover:bg-blue-50/40 transition flex items-center gap-3"
                            >
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4-4 3 3 5-5 4 4M4 7h16"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">
                                        Pilih foto utama
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Foto landscape/portrait yang merepresentasikan musisi/band.
                                    </p>
                                </div>
                            </label>

                            {{-- Preview --}}
                            @if (!empty($profil->foto))
                                <div class="rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                    <img
                                        src="{{ asset('storage/' . $profil->foto) }}"
                                        class="w-full h-32 md:h-40 object-cover"
                                        alt="Foto utama"
                                    >
                                </div>
                            @endif
                        </div>

                        <input
                            id="foto_utama"
                            type="file"
                            name="foto_utama"
                            accept="image/png,image/jpeg,image/jpg,image/webp,image/avif"
                            class="hidden"
                        >
                        @error('foto_utama')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Galeri 1–3 --}}
                    @foreach (['foto1' => 'foto_pilihan1', 'foto2' => 'foto_pilihan2', 'foto3' => 'foto_pilihan3'] as $name => $col)
                        <div class="space-y-2">
                            <label for="{{ $name }}" class="text-sm font-medium text-gray-800">
                                Foto Galeri {{ $loop->iteration }}
                            </label>

                            <div class="grid gap-4 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] md:items-center">
                                <label
                                    for="{{ $name }}"
                                    class="cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
                                           text-sm text-gray-500 hover:border-blue-400 hover:bg-blue-50/40 transition flex items-center gap-3"
                                >
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4-4 3 3 5-5 4 4M4 7h16"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">
                                            Pilih foto {{ $loop->iteration }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Contoh: dokumentasi panggung, latihan, atau behind the scene.
                                        </p>
                                    </div>
                                </label>

                                @if (!empty($profil->{$col}))
                                    <div class="rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                        <img
                                            src="{{ asset('storage/' . $profil->{$col}) }}"
                                            class="w-full h-28 md:h-32 object-cover"
                                            alt="Foto {{ $loop->iteration }}"
                                        >
                                    </div>
                                @endif
                            </div>

                            <input
                                id="{{ $name }}"
                                type="file"
                                name="{{ $name }}"
                                accept="image/png,image/jpeg,image/jpg,image/webp,image/avif"
                                class="hidden"
                            >
                            @error($name)
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Tombol submit --}}
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-2xl bg-blue-600 px-6 py-2.5
                           text-sm font-semibold text-white shadow-md hover:bg-blue-500 transition"
                >
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
