@extends('layouts.layoutAdmin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-slate-50 to-slate-200 px-4 py-10 md:ml-12">
    <div class="max-w-5xl mx-auto space-y-8">

        {{-- Title --}}
        <div class="flex flex-col gap-1">
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-900">
                Kelola Hero Section
            </h1>
            <p class="text-sm text-gray-500">
                Atur gambar utama dan galeri hero untuk halaman depan Sumber Suara.
            </p>
        </div>

        {{-- Alert Success & Error --}}
        @if(session('success'))
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
                        <p class="font-medium mb-1">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- HERO SECTION UTAMA --}}
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
            {{-- Header --}}
            <div class="px-6 md:px-8 py-4 bg-gradient-to-r from-[#1C4E95] via-blue-600 to-indigo-500">
                <div class="flex items-center gap-4">
                    <div class="h-11 w-11 rounded-2xl bg-white/15 flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 5h16M4 9h10M4 19h16M4 14h10"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg md:text-xl font-semibold text-white">
                            Hero Section Utama
                        </h2>
                        <p class="text-xs md:text-sm text-blue-100 mt-0.5">
                            Gambar utama dan tagline yang muncul di bagian atas halaman utama.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 md:px-8 py-6 md:py-7">
                <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Upload Gambar Utama --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-800">
                            Gambar Hero Utama
                        </label>

                        <div class="grid gap-4 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] md:items-center">
                            {{-- Dropzone --}}
                            <label
                                for="gambar"
                                class="cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
                                       text-sm text-gray-500 hover:border-blue-400 hover:bg-blue-50/40 transition flex items-center gap-3"
                            >
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2l1.586-1.586a2 2 0 0 1 2.828 0L20 14m-6-10h-4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">
                                        Pilih gambar hero utama
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Rekomendasi rasio landscape, format JPG/PNG, ukuran maksimal 2 MB.
                                    </p>
                                </div>
                            </label>

                            {{-- Preview --}}
                            @if(!empty($hero?->banner_url))
                                <div class="rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                    <img
                                        src="{{ $hero->banner_url }}"
                                        alt="banner"
                                        class="w-full h-32 md:h-40 object-cover"
                                    >
                                </div>
                            @endif
                        </div>

                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            class="hidden"
                        >
                    </div>

                    {{-- Deskripsi --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-800">
                            Deskripsi / Tagline
                        </label>
                        <input
                            type="text"
                            name="deskripsi"
                            value="{{ old('deskripsi', $hero->desk ?? '') }}"
                            placeholder="Contoh: Ruang kolaborasi musisi lokal Lampung."
                            class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        >
                    </div>

                    {{-- Tombol --}}
                    <div class="pt-2 flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-2xl bg-blue-600 px-6 py-2.5
                                   text-sm font-semibold text-white shadow-md hover:bg-blue-500 transition"
                        >
                            Simpan Hero Utama
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- HERO SECTION SEKUNDER --}}
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
            {{-- Header --}}
            <div class="px-6 md:px-8 py-4 bg-gradient-to-r from-[#1C4E95] via-blue-600 to-indigo-500">
                <div class="flex items-center gap-4">
                    <div class="h-11 w-11 rounded-2xl bg-white/15 flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h7v7H4zM13 6h7v4h-7zM13 12h7v6h-7zM4 15h7v3H4z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg md:text-xl font-semibold text-white">
                            Hero Section Sekunder
                        </h2>
                        <p class="text-xs md:text-sm text-blue-100 mt-0.5">
                            Tiga gambar pendukung yang tampil sebagai galeri hero di halaman utama.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 md:px-8 py-6 md:py-7">
                <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data" class="space-y-7">
                    @csrf

                    {{-- Hero 1 --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-800">
                            Hero Section 1
                        </label>

                        <div class="grid gap-4 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] md:items-center">
                            <label
                                for="hero1"
                                class="cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
                                       text-sm text-gray-500 hover:border-blue-400 hover:bg-blue-50/40 transition flex items-center gap-3"
                            >
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2l1.586-1.586a2 2 0 0 1 2.828 0L20 14m-6-10h-4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">
                                        Pilih gambar Hero 1
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Rekomendasi ukuran 4:3 atau 16:9.
                                    </p>
                                </div>
                            </label>

                            @if(!empty($hero?->sec1_url))
                                <div class="rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                    <img
                                        src="{{ $hero->sec1_url }}"
                                        alt="sec1"
                                        class="w-full h-24 md:h-28 object-cover"
                                    >
                                </div>
                            @endif
                        </div>

                        <input
                            type="file"
                            id="hero1"
                            name="hero1"
                            class="hidden"
                        >
                    </div>

                    {{-- Hero 2 --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-800">
                            Hero Section 2
                        </label>

                        <div class="grid gap-4 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] md:items-center">
                            <label
                                for="hero2"
                                class="cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
                                       text-sm text-gray-500 hover:border-blue-400 hover:bg-blue-50/40 transition flex items-center gap-3"
                            >
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2l1.586-1.586a2 2 0 0 1 2.828 0L20 14m-6-10h-4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">
                                        Pilih gambar Hero 2
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Sesuaikan nuansa dengan gambar lainnya.
                                    </p>
                                </div>
                            </label>

                            @if(!empty($hero?->sec2_url))
                                <div class="rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                    <img
                                        src="{{ $hero->sec2_url }}"
                                        alt="sec2"
                                        class="w-full h-24 md:h-28 object-cover"
                                    >
                                </div>
                            @endif
                        </div>

                        <input
                            type="file"
                            id="hero2"
                            name="hero2"
                            class="hidden"
                        >
                    </div>

                    {{-- Hero 3 --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-800">
                            Hero Section 3
                        </label>

                        <div class="grid gap-4 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] md:items-center">
                            <label
                                for="hero3"
                                class="cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
                                       text-sm text-gray-500 hover:border-blue-400 hover:bg-blue-50/40 transition flex items-center gap-3"
                            >
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2l1.586-1.586a2 2 0 0 1 2.828 0L20 14m-6-10h-4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">
                                        Pilih gambar Hero 3
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Misalnya dokumentasi event atau aktivitas komunitas.
                                    </p>
                                </div>
                            </label>

                            @if(!empty($hero?->sec3_url))
                                <div class="rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                    <img
                                        src="{{ $hero->sec3_url }}"
                                        alt="sec3"
                                        class="w-full h-24 md:h-28 object-cover"
                                    >
                                </div>
                            @endif
                        </div>

                        <input
                            type="file"
                            id="hero3"
                            name="hero3"
                            class="hidden"
                        >
                    </div>

                    {{-- Tombol --}}
                    <div class="pt-2 flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-2xl bg-blue-600 px-6 py-2.5
                                   text-sm font-semibold text-white shadow-md hover:bg-blue-500 transition"
                        >
                            Simpan Hero Sekunder
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
