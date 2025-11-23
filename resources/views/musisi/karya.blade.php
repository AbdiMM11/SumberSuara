@extends('layouts.layoutMusisi')

@section('content')
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-5 gap-3">
                <h2 class="text-xl md:text-2xl font-bold text-gray-800">Kelola Karya</h2>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    {{-- Search --}}
                    <form method="get" class="relative w-full sm:w-64">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari karya..."
                            class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1C4E95] focus:border-[#1C4E95]">
                        <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                        </svg>
                    </form>

                    {{-- Tambah Karya --}}
                    <a href="{{ route('musisi.karya.create') }}"
                        class="flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm font-medium transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Karya
                    </a>
                </div>
            </div>

            {{-- Flash message --}}
            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-50 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tabel --}}
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
                    <thead class="bg-blue-900 text-white uppercase text-xs">
                        <tr>
                            <th class="py-3 px-4 text-left whitespace-nowrap">Judul</th>
                            <th class="py-3 px-4 text-left whitespace-nowrap hidden sm:table-cell">Tahun</th>
                            <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($karyas as $karya)
                            <tr class="hover:bg-gray-50 transition">
                                {{-- Judul + Cover --}}
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        @php
                                            $coverPath = $karya->cover_path ?? null;
                                        @endphp
                                        <img src="{{ $coverPath ? asset('storage/' . $coverPath) : asset('public/images/song-placeholder.png') }}"
                                            alt="cover" class="w-10 h-10 object-cover rounded-lg bg-gray-200">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $karya->judul }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Tahun --}}
                                <td class="py-3 px-4 hidden sm:table-cell">{{ $karya->tahun }}</td>

                                {{-- Aksi --}}
                                <td class="py-3 px-4">
                                    <div class="flex justify-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('musisi.karya.edit', $karya->id_karya) }}"
                                            class="p-2 rounded-lg bg-gray-50 hover:bg-blue-100 text-gray-600 hover:text-blue-600 transition"
                                            title="Edit">
                                            <img src="{{ asset('public/icons/edit.svg') }}" alt="Edit" class="w-5 h-5">
                                        </a>

                                        {{-- Hapus --}}
                                        <button type="button" onclick="openDeletePopup(this)"
                                            data-delete-url="{{ route('musisi.karya.destroy', $karya->id_karya) }}"
                                            class="p-2 rounded-lg bg-gray-50 hover:bg-red-100 text-gray-600 hover:text-red-600 transition"
                                            title="Hapus">
                                            <img src="{{ asset('public/icons/delete.svg') }}" alt="Hapus"
                                                class="w-5 h-5">
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-gray-500 text-sm">Belum ada karya.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $karyas->links() }}</div>
        </div>
    </div>

    {{-- Popup konfirmasi delete --}}
    @include('components.popup-deleteKarya')
@endsection
