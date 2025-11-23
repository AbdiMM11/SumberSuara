@extends('layouts.layoutAdmin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-slate-50 to-slate-200 px-4 py-10 md:ml-12">
    <div class="max-w-5xl mx-auto">

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">

            <!-- Header -->
            <div class="px-6 md:px-8 py-5 bg-gradient-to-r from-[#1C4E95] via-blue-600 to-indigo-500">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-white/15 flex items-center justify-center shadow-sm">
                            <!-- icon artikel / document -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 7h10M7 11h7M7 15h5M6 4h9l3 3v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl md:text-3xl font-semibold text-white leading-tight">
                                Edit Artikel
                            </h1>
                            <p class="text-sm text-blue-100 mt-1">
                                Perbarui isi artikel agar tetap relevan dengan kegiatan dan karya terbaru Sumber Suara.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="px-6 md:px-8 py-6 md:py-8">
                <form action="{{ route('admin.artikel.update', $artikel) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Judul Artikel --}}
                        <div class="space-y-1.5 md:col-span-2">
                            <label for="judul" class="text-sm font-medium text-gray-800">
                                Judul Artikel
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6M9 16h4M5 7h14M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="judul"
                                    name="judul"
                                    value="{{ old('judul', $artikel->judul) }}"
                                    placeholder="Judul artikel"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                            @error('judul')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Author --}}
                        <div class="space-y-1.5">
                            <label for="author" class="text-sm font-medium text-gray-800">
                                Author
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5.5 21v-2a4 4 0 0 1 4-4h5a4 4 0 0 1 4 4v2M12 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4z"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="author"
                                    name="author"
                                    value="{{ old('author', $artikel->author) }}"
                                    placeholder="Nama penulis"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                            @error('author')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Meta Tag --}}
                        <div class="space-y-1.5">
                            <label for="metatag" class="text-sm font-medium text-gray-800">
                                Meta Tag
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 7h.01M4 4h16v12H4V4zm4 11v3m6-3v3"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="metatag"
                                    name="metatag"
                                    value="{{ old('metatag', $artikel->metatag) }}"
                                    placeholder="Contoh: musik, komunitas, lampung"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                        </div>

                        {{-- Tanggal Rilis --}}
                        <div class="space-y-1.5">
                            <label for="published_at" class="text-sm font-medium text-gray-800">
                                Tanggal Rilis
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"/>
                                    </svg>
                                </span>
                                <input
                                    type="datetime-local"
                                    id="published_at"
                                    name="published_at"
                                    value="{{ old('published_at', optional($artikel->published_at)->format('Y-m-d\TH:i')) }}"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                        </div>

                        {{-- Gambar --}}
                        <div class="space-y-2 md:col-span-2">
                            <label for="gambar" class="text-sm font-medium text-gray-800">
                                Gambar Artikel
                            </label>

                            {{-- Preview gambar lama --}}
                            @if($artikel->cover_path)
                                <div class="flex items-center gap-4 mb-1">
                                    <div class="rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                        <img
                                            class="w-40 h-40 object-cover"
                                            src="{{ asset('storage/'.$artikel->cover_path) }}"
                                            alt="cover"
                                        >
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        Gambar saat ini. Anda dapat menggantinya dengan file baru di bawah ini.
                                    </p>
                                </div>
                            @endif

                            <div class="flex flex-col gap-3 md:flex-row md:items-center">
                                <label
                                    for="gambar"
                                    class="flex-1 cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
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
                                            Pilih gambar artikel baru (opsional)
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Format gambar (JPG, PNG). Ukuran maksimal 2 MB.
                                        </p>
                                    </div>
                                </label>

                                <input
                                    type="file"
                                    id="gambar"
                                    name="gambar"
                                    class="hidden"
                                >
                            </div>

                            @error('gambar')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Isi Artikel --}}
                        <div class="space-y-1.5 md:col-span-2">
                            <label for="konten" class="text-sm font-medium text-gray-800">
                                Isi Artikel
                            </label>
                            <textarea
                                id="konten"
                                name="konten"
                                rows="7"
                                placeholder="Perbarui isi artikel di sini."
                                class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-y"
                            >{{ old('konten', $artikel->konten) }}</textarea>
                            @error('konten')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="pt-2 flex flex-col md:flex-row md:justify-end gap-3">
                        <button
                            type="submit"
                            class="w-full md:w-auto inline-flex justify-center rounded-2xl bg-blue-600 px-6 py-2.5
                                   text-sm font-semibold text-white shadow-md hover:bg-blue-500 transition"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
