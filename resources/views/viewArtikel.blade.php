@extends('layouts.layout')

@section('content')
    <div class="pb-16 mt-12">
        <div class="relative max-w-7xl mx-auto px-0 sm:px-4">
            <div class="relative rounded-xl overflow-hidden shadow-lg">
                <img src="{{ asset('public/images/hsfixed.jpg') }}" alt="Concert" class="w-full h-96 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                <div class="absolute bottom-6 left-6 right-6 text-white flex justify-center">
                    <div class="max-w-xl text-center">
                        <h1 class="text-2xl md:text-3xl font-bold">Artikel - Sumber Suara</h1>
                        <p class="mt-2 text-xs md:text-base font-light">
                            Baca kisah, berita, dan inspirasi seputar dunia musik lokal. Ruang berbagi cerita dari musisi
                            dan komunitas "Local Pasti Vocal".
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="min-h-screen bg-gray-100 py-8 px-2">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white shadow-lg rounded-3xl overflow-hidden p-4 md:p-8 lg:p-10">

                {{-- ================= JUDUL + SHAPES ================= --}}
                <div class="relative mb-8">
                    {{-- Shapes abu-abu, kecil --}}
                    <div
                        class="pointer-events-none absolute -top-6 -left-4 w-12 h-12 rounded-full border border-gray-300/70">
                    </div>
                    <div
                        class="pointer-events-none absolute -bottom-8 -right-8 w-20 h-20 rounded-full border border-gray-300/60">
                    </div>

                    <div class="text-center px-4 py-4">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-snug">
                            {{ $artikel->judul }}
                        </h1>
                    </div>
                </div>

                @php
                    $cover = $artikel->cover_path
                        ? asset('storage/app/public/' . $artikel->cover_path)
                        : 'https://placehold.co/1200x600';
                @endphp

                {{-- ================= GRID UTAMA (DESKTOP: 2 KOLOM, MOBILE: 1 KOLOM) ================= --}}
                <div class="grid gap-8 md:grid-cols-2 md:items-start">

                    {{-- KOLOM KIRI: FLYER / COVER ARTIKEL --}}
                    <div class="px-2 md:px-0">
                        <div class="relative overflow-hidden rounded-2xl shadow-md bg-gray-50">
                            <img src="{{ $cover }}" alt="Gambar Artikel"
                                class="w-full h-full object-cover rounded-2xl">
                        </div>
                    </div>

                    {{-- KOLOM KANAN: META + KONTEN --}}
                    <div class="px-2 md:px-0">

                        {{-- META AUTHOR + TANGGAL --}}
                        <div class="flex flex-row items-center justify-between text-sm text-gray-600 mb-4">
                            {{-- Author kiri --}}
                            <p class="font-semibold text-gray-800">
                                {{ $artikel->author }}
                            </p>

                            {{-- Published At kanan --}}
                            <p class="text-right">
                                • {{ optional($artikel->published_at)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                        {{-- KONTEN ARTIKEL --}}
                        <div class="text-gray-700 space-y-6 leading-relaxed prose max-w-none text-justify">
                            {!! nl2br(e($artikel->konten)) !!}
                        </div>

                    </div>

                </div>

                {{-- ================= KOMENTAR ARTIKEL ================= --}}
                <div class="border-t border-gray-200 bg-gray-50 px-4 md:px-6 py-6 mt-8 rounded-3xl">

                    {{-- FLASH MESSAGE --}}
                    @if (session('success'))
                        <div class="mb-4 p-3 rounded-xl bg-green-50 text-green-700 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-3 rounded-xl bg-red-50 text-red-700 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4">Komentar</h2>

                    @php
                        $currentUser = auth()->user();
                    @endphp

                    {{-- LIST KOMENTAR (CHAT BUBBLE) --}}
                    <div class="space-y-4 max-h-96 overflow-y-auto pr-1">

                        @forelse ($artikel->komentars as $k)
                            @php
                                $isMine = $currentUser && $k->user_id === $currentUser->id;
                                $isAdmin = $currentUser?->role?->nama_roles === 'Admin';
                            @endphp

                            <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-[80%] flex flex-col {{ $isMine ? 'items-end' : 'items-start' }}">

                                    {{-- Nama + waktu --}}
                                    <div class="mb-1 text-xs text-gray-500 {{ $isMine ? 'text-right' : 'text-left' }}">
                                        <span class="font-semibold text-gray-700">
                                            {{ $k->user->nama ?? ($k->user->email ?? 'Pengguna') }}
                                        </span>
                                        • {{ $k->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </div>

                                    {{-- Bubble Chat --}}
                                    <div class="relative">
                                        <div
                                            class="px-4 py-2 rounded-2xl text-sm leading-relaxed shadow-sm
                                        {{ $isMine
                                            ? 'bg-[#1C4E95] text-white rounded-br-sm'
                                            : 'bg-white text-gray-800 border border-gray-200 rounded-bl-sm' }}">
                                            {{ $k->isi }}
                                        </div>

                                        {{-- Tombol Hapus --}}
                                        @if ($currentUser && ($isMine || $isAdmin))
                                            <form action="{{ route('komentar.destroy', $k->id_komentar) }}" method="POST"
                                                class="mt-1 {{ $isMine ? 'text-right' : 'text-left' }}"
                                                onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-[11px] text-red-500 hover:text-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada komentar. Jadilah yang pertama!</p>
                        @endforelse

                    </div>

                    {{-- FORM KOMENTAR --}}
                    @auth
                        <div class="mt-6">
                            <h3 class="text-md md:text-lg font-semibold mb-2">Tulis Komentar</h3>

                            <form action="{{ route('artikel.komentar.store', $artikel->slug) }}" method="POST"
                                class="space-y-3">
                                @csrf

                                <textarea name="isi" rows="3"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#1C4E95] focus:outline-none"
                                    placeholder="Tulis komentar kamu di sini...">{{ old('isi') }}</textarea>

                                <button
                                    class="px-4 py-2 bg-[#1C4E95] text-white text-sm font-semibold rounded-lg hover:bg-[#153a70] transition">
                                    Kirim Komentar
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="mt-6 text-sm text-gray-700">
                            Silakan
                            <a href="{{ route('login') }}" class="text-[#1C4E95] font-semibold hover:underline">login</a>
                            untuk menulis komentar.
                        </div>
                    @endauth

                </div>

            </div>
        </div>
    </div>
@endsection
