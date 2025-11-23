@extends('layouts.layoutAdmin')

@section('content')
    <div class="bg-gray-100 min-h-screen pt-8 md:pt-0">
        <div class="bg-white shadow-md rounded-lg p-6">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 space-y-3 md:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Verifikasi Pendaftaran Musisi</h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Daftar musisi yang menunggu persetujuan Admin sebelum akun diaktifkan.
                    </p>
                </div>
            </div>

            {{-- Flash message --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('info'))
                <div class="mb-4 p-3 bg-blue-100 text-blue-800 rounded-lg text-sm">
                    {{ session('info') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($musisis->isEmpty())
                <div class="bg-gray-50 border border-dashed border-gray-300 rounded-lg p-6 text-center text-gray-600">
                    Belum ada pendaftaran musisi yang menunggu verifikasi.
                </div>
            @else
                {{-- Tabel Wrapper (Responsive) --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left whitespace-nowrap">Nama Musisi</th>
                                <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Email</th>
                                <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Domisili</th>
                                <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Genre</th>
                                <th class="py-3 px-4 text-left whitespace-nowrap">Status</th>
                                <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-50 divide-y divide-gray-200">
                            @foreach ($musisis as $musisi)
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="py-3 px-4 font-medium text-gray-800">
                                        {{ $musisi->display_name }}
                                    </td>
                                    <td class="py-3 px-4 text-gray-700 hidden md:table-cell">
                                        {{ $musisi->user?->email ?? '-' }}
                                    </td>
                                    <td class="py-3 px-4 hidden md:table-cell">
                                        {{ $musisi->domisili ?? '-' }}
                                    </td>
                                    <td class="py-3 px-4 hidden md:table-cell">
                                        {{ $musisi->genre ?? '-' }}
                                    </td>
                                    <td class="py-3 px-4">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                                   bg-amber-100 text-amber-800">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        {{-- Popup detail + tombol verifikasi (desain modern) --}}
                                        <x-popup-verifikasi :musisi="$musisi" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
@endsection
