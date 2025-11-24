@extends('layouts.layout')

@section('content')
    {{-- ================= HERO ================= --}}
    <div class="relative mt-12">
        <div class="max-w-6xl mx-auto px-4">

            <div class="relative rounded-2xl overflow-hidden shadow-lg bg-black/20">
                <img src="{{ asset('public/images/hsfixed.jpg') }}"
                    class="w-full h-[260px] md:h-[360px] lg:h-[420px] object-cover">

                {{-- Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                {{-- Text --}}
                <div class="absolute bottom-6 left-0 right-0 px-6">
                    <div class="max-w-2xl text-white">
                        <h1 class="text-3xl md:text-4xl font-bold leading-tight drop-shadow">
                            Artikel - Sumber Suara
                        </h1>
                        <p class="mt-2 text-sm md:text-base font-light text-gray-200">
                            Kisah, wawasan, dan inspirasi dunia musik lokal.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ================= BODY WRAPPER ================= --}}
    <div class="py-12 bg-[#F7F7F7] px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-6 md:p-12">

            {{-- ================= TITLE ================= --}}
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight tracking-tight">
                    {{ $artikel->judul }}
                </h1>
            </div>

            {{-- ================= META ================= --}}
            <div class="mt-6 flex flex-col items-center text-sm text-gray-600 space-y-1">
                <p class="font-semibold text-gray-800 text-base">
                    {{ $artikel->author }}
                </p>
                <div class="flex items-center gap-2 text-xs md:text-sm text-gray-500">
                    <span>• {{ optional($artikel->published_at)->translatedFormat('d F Y') }}</span>
                    <span>• {{ $artikel->kategori->nama ?? 'Artikel' }}</span>
                    <span>• {{ (str_word_count($artikel->konten) / 200) | round(1) }} Min Read</span>
                </div>
            </div>

            {{-- ================= COVER ================= --}}
            <div class="mt-10">
                @php
                    $cover = $artikel->cover_path
                        ? asset('storage/app/public/' . $artikel->cover_path)
                        : 'https://placehold.co/1200x600';
                @endphp

                <img src="{{ $cover }}" class="rounded-xl w-full shadow-md object-cover">
            </div>

            {{-- ================= CONTENT ================= --}}
            <article class="prose prose-lg max-w-none text-gray-800 leading-relaxed mt-10">

                {{-- Agar break line dari DB tetap rapi --}}
                {!! nl2br(e($artikel->konten)) !!}

            </article>

            {{-- ================= KOMENTAR ================= --}}
            <div class="mt-14 border-t pt-10">

                {{-- Flash --}}
                @if (session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-50 text-green-700 text-sm shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-sm shadow-sm">
                        <ul class="list-disc pl-4">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-5">Komentar</h2>

                {{-- LIST KOMENTAR --}}
                @php $currentUser = auth()->user(); @endphp

                <div class="space-y-5 max-h-[350px] overflow-y-auto px-1">

                    @forelse ($artikel->komentars as $k)
                        @php
                            $isMine = $currentUser && $k->user_id === $currentUser->id;
                            $isAdmin = $currentUser?->role?->nama_roles === 'Admin';
                        @endphp

                        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[80%]">

                                <div class="text-xs text-gray-500 mb-1 {{ $isMine ? 'text-right' : '' }}">
                                    <span class="font-semibold text-gray-700">
                                        {{ $k->user->nama ?? ($k->user->email ?? 'User') }}
                                    </span>
                                    • {{ $k->created_at->format('d M Y H:i') }}
                                </div>

                                <div
                                    class="p-4 text-sm rounded-2xl shadow-sm
                                    {{ $isMine ? 'bg-blue-600 text-white rounded-br-sm' : 'bg-gray-100 text-gray-800 rounded-bl-sm' }}">
                                    {{ $k->isi }}
                                </div>

                                {{-- Delete --}}
                                @if ($currentUser && ($isMine || $isAdmin))
                                    <form method="POST" class="{{ $isMine ? 'text-right' : '' }}"
                                        action="{{ route('komentar.destroy', $k->id_komentar) }}"
                                        onsubmit="return confirm('Hapus komentar ini?');">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-[11px] mt-1 text-red-500 hover:text-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada komentar</p>
                    @endforelse

                </div>

                {{-- FORM KOMENTAR --}}
                @auth
                    <div class="mt-8">
                        <h3 class="text-lg font-bold mb-2">Tulis Komentar</h3>

                        <form method="POST" action="{{ route('artikel.komentar.store', $artikel->slug) }}" class="space-y-3">
                            @csrf

                            <textarea name="isi" rows="3"
                                class="w-full border rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Tulis komentar kamu..."></textarea>

                            <button
                                class="px-5 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                                Kirim Komentar
                            </button>
                        </form>
                    </div>
                @else
                    <p class="mt-8 text-sm text-gray-700">
                        Silakan <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">login</a>
                        untuk berkomentar.
                    </p>
                @endauth

            </div>
        </div>
    </div>
@endsection
