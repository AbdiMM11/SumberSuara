@extends('layouts.layout')

@section('content')
    <div class="pb-16 mt-12">
        <div class="relative max-w-7xl mx-auto px-0 sm:px-4">
            <div class="relative rounded-xl overflow-hidden shadow-lg">
                <img src="{{ asset('public/images/hsfixed.jpg') }}" alt="Concert" class="w-full h-96 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 text-white flex justify-center">
                    <div class="max-w-xl">
                        <h1 class="text-2xl text-center md:text-3xl font-bold">
                            Artikel - Sumber Suara
                        </h1>
                        <p class="mt-2 text-center text-xs md:text-base font-light">
                            Baca kisah, berita, dan inspirasi seputar dunia musik lokal. Ruang berbagi cerita dari musisi
                            dan komunitas "Local Pasti Vocal".
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-[#1C4E95] to-[#2F6EEA]
           py-5 px-4 text-center shadow-md
           rounded-3xl mx-4 mt-4 relative overflow-hidden">

        <h2 class="text-xl md:text-2xl font-bold text-white tracking-wide uppercase drop-shadow">
            Artikel
        </h2>

        <p class="text-xs md:text-sm text-white/80 mt-1 tracking-wide">
            Baca wawasan, berita, dan insight terbaru seputar musik lokal Lampung
        </p>

    </div>

    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <aside class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 md:col-span-1">
                <h2 class="text-lg font-bold text-[#1C4E95] mb-5">Rekomendasi Artikel</h2>
                <div class="space-y-4">
                    @foreach ($rekomendasi as $r)
                        <a href="{{ route('viewArtikel', $r->slug) }}" class="group block border-b pb-3">
                            <p class="text-sm text-gray-700 group-hover:text-[#1C4E95]">
                                {{ \Illuminate\Support\Str::limit($r->judul, 80) }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ optional($r->published_at)->format('d M Y') }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </aside>

            <!-- Main list -->
            <main class="md:col-span-3 space-y-6">
                @foreach ($artikels as $a)
                    @php
                        $cover = $a->cover_path
                            ? asset('storage/app/public/' . $a->cover_path)
                            : 'https://placehold.co/600x400';
                    @endphp

                    <a href="{{ route('viewArtikel', $a->slug) }}"
                        class="flex flex-col md:flex-row items-start bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                        <div class="relative w-full md:w-52 h-40 overflow-hidden">
                            <img src="{{ $cover }}"
                                alt="Thumbnail" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 p-4">
                            <h3 class="text-lg md:text-xl font-bold text-gray-800 hover:text-[#1C4E95]">
                                {{ $a->judul }}
                            </h3>
                            <p class="text-sm text-gray-700 mt-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($a->konten), 160) }}
                            </p>
                            <div class="mt-3 text-xs text-gray-500 flex items-center space-x-4">
                                <span>By {{ $a->author }}</span>
                                <span>{{ optional($a->published_at)->timezone('Asia/Jakarta')->format('d M Y') }}</span>
                                <span>Published</span>
                            </div>
                        </div>
                    </a>
                @endforeach

                <div>{{ $artikels->links() }}</div>
            </main>
        </div>
    </div>
@endsection
