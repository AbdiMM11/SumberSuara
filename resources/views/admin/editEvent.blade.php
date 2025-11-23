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
                            <!-- icon edit calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl md:text-3xl font-semibold text-white leading-tight">
                                Edit Event
                            </h1>
                            <p class="text-sm text-blue-100 mt-1">
                                Perbarui informasi event komunitas Sumber Suara dengan data terbaru.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="px-6 md:px-8 py-6 md:py-8">
                <form action="{{ route('admin.updateEvent', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nama Event --}}
                        <div class="space-y-1.5">
                            <label for="nama_event" class="text-sm font-medium text-gray-800">
                                Nama Event
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6m-9 4h6m3.5-11.5L19 7.5M4 6h8l2 2h6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="nama_event"
                                    name="nama_event"
                                    value="{{ old('nama_event', $event->nama_event) }}"
                                    placeholder="Contoh: Sumber Suara Showcase Vol. 01"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                            @error('nama_event')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="space-y-1.5">
                            <label for="lokasi" class="text-sm font-medium text-gray-800">
                                Lokasi
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 21s-6-5.373-6-10a6 6 0 1 1 12 0c0 4.627-6 10-6 10z"/>
                                        <circle cx="12" cy="11" r="2.5"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="lokasi"
                                    name="lokasi"
                                    value="{{ old('lokasi', $event->lokasi) }}"
                                    placeholder="Contoh: Taman Budaya Lampung"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                            @error('lokasi')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div class="space-y-1.5">
                            <label for="tanggal" class="text-sm font-medium text-gray-800">
                                Tanggal
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"/>
                                    </svg>
                                </span>
                                <input
                                    type="date"
                                    id="tanggal"
                                    name="tanggal"
                                    value="{{ old('tanggal', $event->tanggal) }}"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                            @error('tanggal')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Pengisi --}}
                        <div class="space-y-1.5">
                            <label for="pengisi" class="text-sm font-medium text-gray-800">
                                Pengisi Acara
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
                                    id="pengisi"
                                    name="pengisi"
                                    value="{{ old('pengisi', $event->pengisi) }}"
                                    placeholder="Contoh: Raksajah, Sunyata, dan lainnya"
                                    class="w-full rounded-2xl border border-gray-300 bg-white pl-9 pr-3 py-2.5 text-sm text-gray-900
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                            </div>
                            @error('pengisi')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi (full width) --}}
                        <div class="space-y-1.5 md:col-span-2">
                            <label for="deskripsi" class="text-sm font-medium text-gray-800">
                                Deskripsi Kegiatan
                            </label>
                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="4"
                                placeholder="Tulis deskripsi singkat tentang konsep event, rundown, atau informasi penting lainnya."
                                class="w-full rounded-2xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                            >{{ old('deskripsi', $event->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Flyer (full width) --}}
                        <div class="space-y-2 md:col-span-2">
                            <label for="flyer" class="text-sm font-medium text-gray-800">
                                Flyer Event
                            </label>

                            {{-- Preview flyer lama (jika ada) --}}
                            @if ($event->flyer)
                                <div class="flex items-center gap-4 mb-1">
                                    <div class="rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm">
                                        <img
                                            src="{{ asset('storage/' . $event->flyer) }}"
                                            alt="Flyer Event"
                                            class="w-40 h-40 object-cover"
                                        >
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        Flyer saat ini. Anda dapat mengganti dengan file baru di bawah ini.
                                    </p>
                                </div>
                            @endif

                            <div class="flex flex-col gap-3 md:flex-row md:items-center">
                                <label
                                    for="flyer"
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
                                            Pilih file flyer baru (opsional)
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Format gambar (JPG, PNG). Ukuran maksimal 2 MB.
                                        </p>
                                    </div>
                                </label>

                                <input
                                    type="file"
                                    id="flyer"
                                    name="flyer"
                                    class="hidden"
                                >
                            </div>

                            @error('flyer')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="pt-2 flex flex-col md:flex-row md:justify-end gap-3">
                        <a
                            href="{{ route('admin.event') }}"
                            class="w-full md:w-auto inline-flex justify-center rounded-2xl border border-gray-300
                                   px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="w-full md:w-auto inline-flex justify-center rounded-2xl bg-blue-600 px-6 py-2.5
                                   text-sm font-semibold text-white shadow-md hover:bg-blue-500 transition"
                        >
                            Update Event
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
