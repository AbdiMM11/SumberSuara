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
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-2 md:p-16">

            {{-- ================= JUDUL & META ================= --}}
            <div class="px-6 py-6 text-center border-b border-gray-200">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    {{ $artikel->judul }}
                </h1>
            </div>

            <div class="px-6 pt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-600">
                <p class="font-semibold text-gray-800">{{ $artikel->author }}</p>
                <p class="mt-1 sm:mt-0">
                    • {{ optional($artikel->published_at)->translatedFormat('d F Y') }}
                </p>
            </div>

            {{-- ================= COVER ARTIKEL ================= --}}
            <div class="px-6 py-8">
                @php
                    $cover = $artikel->cover_path
                        ? asset('storage/app/public/' . $artikel->cover_path)
                        : 'https://placehold.co/1200x600';
                @endphp

                <img src="{{ $cover }}"
                     alt="Gambar Artikel"
                     class="w-full rounded-lg object-cover shadow-md">
            </div>

            {{-- ================= KONTEN ARTIKEL ================= --}}
            <div class="px-6 pb-8 text-gray-700 space-y-6 leading-relaxed prose max-w-none">
                {!! nl2br(e($artikel->konten)) !!}
            </div>

            {{-- ================= KOMENTAR ARTIKEL ================= --}}
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-6 mt-4 rounded-b-lg">

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div class="mb-4 p-3 rounded bg-green-50 text-green-700 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded bg-red-50 text-red-700 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4">Komentar</h2>

                {{-- ================= LIST KOMENTAR CHAT BUBBLE ================= --}}
                @php
                    $currentUser = auth()->user();
                @endphp

                <div class="space-y-4 max-h-96 overflow-y-auto pr-1">

                    @forelse ($artikel->komentars as $k)
                        @php
                            $isMine  = $currentUser && $k->user_id === $currentUser->id;
                            $isAdmin = $currentUser?->role?->nama_roles === 'Admin';
                        @endphp

                        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[80%] flex flex-col {{ $isMine ? 'items-end' : 'items-start' }}">

                                {{-- Nama + waktu --}}
                                <div class="mb-1 text-xs text-gray-500 {{ $isMine ? 'text-right' : 'text-left' }}">
                                    <span class="font-semibold text-gray-700">
                                        {{ $k->user->nama ?? $k->user->email ?? 'Pengguna' }}
                                    </span>
                                    • {{ $k->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                </div>

                                {{-- Bubble Chat --}}
                                <div class="relative">

                                    <div class="px-4 py-2 rounded-2xl text-sm leading-relaxed shadow-sm
                                        {{ $isMine
                                            ? 'bg-[#1C4E95] text-white rounded-br-sm'
                                            : 'bg-white text-gray-800 border border-gray-200 rounded-bl-sm' }}">
                                        {{ $k->isi }}
                                    </div>

                                    {{-- Tombol Hapus --}}
                                    @if ($currentUser && ($isMine || $isAdmin))
                                        <form action="{{ route('komentar.destroy', $k->id_komentar) }}"
                                              method="POST"
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

                {{-- ================= FORM KOMENTAR ================= --}}
                @auth
                    <div class="mt-6">
                        <h3 class="text-md md:text-lg font-semibold mb-2">Tulis Komentar</h3>

                        <form action="{{ route('artikel.komentar.store', $artikel->slug) }}" method="POST" class="space-y-3">
                            @csrf

                            <textarea name="isi" rows="3"
                                      class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#1C4E95] focus:outline-none"
                                      placeholder="Tulis komentar kamu di sini...">{{ old('isi') }}</textarea>

                            <button class="px-4 py-2 bg-[#1C4E95] text-white text-sm font-semibold rounded-lg hover:bg-[#153a70] transition">
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
@endsection
