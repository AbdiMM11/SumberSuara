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

    <div class="min-h-screen bg-gray-100 py-10 px-3">
        <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-3xl overflow-hidden">

            {{-- ================= WRAPPER KONTEN ARTIKEL ================= --}}
            <div class="px-6 md:px-12 pt-8 pb-10">

                {{-- Label kecil --}}
                <div class="flex justify-center mb-3">
                    <span
                        class="inline-flex items-center px-3 py-1 text-[11px] font-semibold tracking-wide uppercase rounded-full bg-gray-100 text-gray-600">
                        Artikel
                    </span>
                </div>

                {{-- ================= JUDUL ================= --}}
                <div class="text-center">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 leading-snug">
                        {{ $artikel->judul }}
                    </h1>
                </div>

                {{-- ================= META: AUTHOR + TANGGAL + LABEL ================= --}}
                <div
                    class="mt-4 flex flex-wrap items-center justify-center gap-x-2 gap-y-1 text-xs md:text-sm text-gray-500">
                    <span class="font-semibold text-gray-800">
                        {{ $artikel->author }}
                    </span>
                    <span class="text-gray-400">•</span>
                    <span>
                        {{ optional($artikel->published_at)->translatedFormat('d F Y') }}
                    </span>
                    <span class="text-gray-400">•</span>
                    <span>Artikel</span>
                </div>

                {{-- ================= COVER ARTIKEL ================= --}}
                <div class="mt-8 md:mt-10">
                    @php
                        $cover = $artikel->cover_path
                            ? asset('storage/app/public/' . $artikel->cover_path)
                            : 'https://placehold.co/1200x600';
                    @endphp

                    <div class="overflow-hidden rounded-2xl shadow-md">
                        <img src="{{ $cover }}" alt="Gambar Artikel"
                            class="w-full object-cover transform hover:scale-[1.01] transition duration-300 ease-out">
                    </div>
                </div>

                {{-- ================= KONTEN ARTIKEL ================= --}}
                <div class="mt-10 text-gray-800 leading-relaxed">
                    <div class="prose prose-sm md:prose-base prose-slate max-w-none text-justify">
                        {!! nl2br(e($artikel->konten)) !!}
                    </div>
                </div>
            </div>

            {{-- ================= AREA KOMENTAR ================= --}}
            <div class="border-t border-gray-200 bg-gray-50 px-6 md:px-12 py-8">

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-50 text-green-700 text-sm shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-sm shadow-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 md:mb-5">
                    Komentar
                </h2>

                {{-- ================= LIST KOMENTAR (BUBBLE CHAT) ================= --}}
                @php
                    $currentUser = auth()->user();
                @endphp

                <div class="space-y-4 max-h-96 overflow-y-auto pr-1">

                    @forelse ($artikel->komentars as $k)
                        @php
                            $isMine = $currentUser && $k->user_id === $currentUser->id;
                            $isAdmin = $currentUser?->role?->nama_roles === 'Admin';

                            $namaUser = $k->user->nama ?? ($k->user->email ?? 'Pengguna');
                            $initial = mb_substr($namaUser, 0, 1);
                        @endphp

                        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                            <div class="flex items-end gap-2 max-w-[85%] {{ $isMine ? 'flex-row-reverse' : '' }}">

                                {{-- Avatar bulat --}}
                                <div class="flex-shrink-0">
                                    <div
                                        class="h-8 w-8 rounded-full flex items-center justify-center text-xs font-semibold
                                    {{ $isMine ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-800' }}">
                                        {{ strtoupper($initial) }}
                                    </div>
                                </div>

                                <div class="flex flex-col {{ $isMine ? 'items-end' : 'items-start' }} w-full">

                                    {{-- Nama + waktu --}}
                                    <div class="mb-1 text-[11px] text-gray-500 {{ $isMine ? 'text-right' : '' }}">
                                        <span class="font-semibold text-gray-700">
                                            {{ $namaUser }}
                                        </span>
                                        • {{ $k->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </div>

                                    {{-- Bubble --}}
                                    <div class="relative">
                                        <div
                                            class="px-4 py-2.5 text-sm leading-relaxed shadow-sm
                                        {{ $isMine
                                            ? 'bg-[#1C4E95] text-white rounded-2xl rounded-br-sm'
                                            : 'bg-white text-gray-800 border border-gray-200 rounded-2xl rounded-bl-sm' }}">
                                            {{ $k->isi }}
                                        </div>
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
                        <p class="text-sm text-gray-500">
                            Belum ada komentar. Jadilah yang pertama!
                        </p>
                    @endforelse

                </div>

                {{-- ================= FORM KOMENTAR ================= --}}
                @auth
                    <div class="mt-6">
                        <h3 class="text-md md:text-lg font-semibold mb-2">
                            Tulis Komentar
                        </h3>

                        <form action="{{ route('artikel.komentar.store', $artikel->slug) }}" method="POST" class="space-y-3">
                            @csrf

                            <textarea name="isi" rows="3"
                                class="w-full border rounded-xl px-3 py-2.5 text-sm bg-white focus:ring-2 focus:ring-[#1C4E95] focus:outline-none"
                                placeholder="Bagikan pendapat atau tanggapanmu di sini...">{{ old('isi') }}</textarea>

                            <button
                                class="px-5 py-2.5 bg-[#1C4E95] text-white text-sm font-semibold rounded-xl hover:bg-[#153a70] transition">
                                Kirim Komentar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-6 text-sm text-gray-700">
                        Silakan
                        <a href="{{ route('login') }}" class="text-[#1C4E95] font-semibold hover:underline">
                            login
                        </a>
                        untuk menulis komentar.
                    </div>
                @endauth

            </div>
        </div>
    </div>

@endsection
