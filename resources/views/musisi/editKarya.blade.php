@extends('layouts.layoutMusisi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-slate-50 to-slate-200 px-4 py-8 md:ml-16">
    <div class="max-w-3xl mx-auto">

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">

            {{-- Header --}}
            <div class="px-6 md:px-8 py-5 bg-gradient-to-r from-[#1C4E95] via-blue-600 to-indigo-500">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="flex items-center gap-4">
                        <div class="h-11 w-11 rounded-2xl bg-white/15 flex items-center justify-center shadow-sm">
                            {{-- Icon music --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 19V6l10-2v13M9 19a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm10-2a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl md:text-3xl font-semibold text-white leading-tight">
                                Edit Karya
                            </h1>
                            <p class="text-sm text-blue-100 mt-1">
                                Perbarui judul, tahun rilis, dan file lagu yang sudah kamu unggah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 md:px-8 py-6 md:py-8">

                {{-- Global error --}}
                @if ($errors->any())
                    <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 shadow-sm">
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

                <form action="{{ route('musisi.karya.update', $karya->id_karya) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Judul --}}
                        <div class="space-y-1.5 md:col-span-2">
                            <label for="judul" class="text-sm font-medium text-gray-800">
                                Judul Lagu
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6M5 7h14M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="judul"
                                    name="judul"
                                    value="{{ old('judul', $karya->judul) }}"
                                    placeholder="Masukkan judul lagu"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                            @error('judul')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tahun rilis --}}
                        <div class="space-y-1.5">
                            <label for="tahun" class="text-sm font-medium text-gray-800">
                                Tahun Rilis
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"/>
                                    </svg>
                                </span>
                                <input
                                    type="number"
                                    id="tahun"
                                    name="tahun"
                                    value="{{ old('tahun', $karya->tahun) }}"
                                    placeholder="Masukkan tahun rilis"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                            @error('tahun')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Spacer for grid alignment --}}
                        <div class="hidden md:block"></div>

                        {{-- File MP3 --}}
                        <div class="space-y-2 md:col-span-2">
                            <label for="file_mp3" class="text-sm font-medium text-gray-800">
                                File Lagu (MP3)
                            </label>

                            {{-- Dropzone style upload --}}
                            <label
                                for="file_mp3"
                                class="cursor-pointer rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-4
                                       text-sm text-gray-500 hover:border-blue-400 hover:bg-blue-50/40 transition flex items-center gap-3"
                            >
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 19V6l10-2v8"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 19a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm10-2a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">
                                        Pilih file lagu baru (opsional)
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Format MP3, ukuran maksimal menyesuaikan batas server. Jika tidak diubah, file lama tetap digunakan.
                                    </p>
                                </div>
                            </label>

                            <input
                                type="file"
                                id="file_mp3"
                                name="file_mp3"
                                accept=".mp3,audio/*"
                                class="hidden"
                            >
                            @error('file_mp3')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror

                            {{-- Preview file lama --}}
                            @if ($karya->file_mp3)
                                <div class="mt-4 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 shadow-sm space-y-2">
                                    <p class="text-xs font-medium text-gray-700">
                                        File saat ini:
                                        <span class="font-semibold">{{ basename($karya->file_mp3) }}</span>
                                    </p>
                                    <audio class="w-full" controls
                                           src="{{ asset('storage/app/public/'.$karya->file_mp3) }}"></audio>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="pt-2 flex flex-col md:flex-row md:justify-end gap-3">
                        <a href="{{ route('musisi.karya') }}"
                           class="w-full md:w-auto inline-flex justify-center rounded-2xl border border-gray-300
                                  px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                            Batal
                        </a>

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
