@extends('layouts.layoutAdmin')

@section('content')
    <div class="bg-gray-100 min-h-screen pt-8 md:pt-0">
        <div class="bg-white shadow-md rounded-lg p-6">

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Header --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-3 md:space-y-0">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Daftar Akun Sumber Suara</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Ringkasan akun Admin, Musisi, dan Audiens yang terdaftar di platform.
                    </p>
                </div>

                {{-- (Optional) tempat tombol/filter jika nanti dibutuhkan --}}
                <div class="flex flex-col sm:flex-row items-stretch gap-3 w-full md:w-auto">
                    {{-- Placeholder filter/search jika diperlukan --}}
                </div>
            </div>

            {{-- Ringkasan Kartu --}}
            <div class="grid gap-4 md:grid-cols-4 mb-6">
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Admin</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $admins->count() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Akun dengan hak akses penuh.</p>
                </div>

                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Musisi Aktif</p>
                    <p class="text-2xl font-bold text-emerald-600">{{ $musisiApproved->count() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Status sudah disetujui dan akun aktif.</p>
                </div>

                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Musisi Pending</p>
                    <p class="text-2xl font-bold text-amber-500">{{ $musisiPending }}</p>
                    <p class="text-xs text-gray-400 mt-1">
                        Menunggu verifikasi.
                        <a href="{{ route('admin.verifikasi') }}" class="text-blue-600 hover:underline">
                            Lihat verifikasi
                        </a>
                    </p>
                </div>

                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Audiens</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $audiens->count() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Pendengar & penikmat musik.</p>
                </div>
            </div>

            {{-- TABEL ADMIN --}}
            <div class="mb-10">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Daftar Admin</h3>

                @if ($admins->isEmpty())
                    <div class="py-3 text-sm text-gray-500">
                        Belum ada akun Admin yang terdaftar.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-blue-900 text-white">
                                <tr>
                                    <th class="py-3 px-4 text-left whitespace-nowrap">Nama</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap">Email</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-50 divide-y divide-gray-200">
                                @foreach ($admins as $admin)
                                    @php
                                        $active = $admin->is_active ?? 1;
                                    @endphp
                                    <tr class="hover:bg-gray-100 transition">
                                        <td class="py-3 px-4 font-medium text-gray-800">
                                            {{ $admin->nama }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">
                                            {{ $admin->email }}
                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($active)
                                                <span
                                                    class="inline-flex px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                                    Aktif
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex px-2 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold">
                                                    Non Aktif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- TABEL MUSISI AKTIF --}}
            <div class="mb-10">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Daftar Musisi Aktif</h3>
                <p class="text-xs text-gray-500 mb-2">
                    Hanya menampilkan musisi dengan status <strong>approved</strong> dan user aktif.
                </p>

                @if ($musisiApproved->isEmpty())
                    <div class="py-3 text-sm text-gray-500">
                        Belum ada musisi yang disetujui.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-blue-900 text-white">
                                <tr>
                                    <th class="py-3 px-4 text-left whitespace-nowrap">Nama Musisi / Band</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Email</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Domisili</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Genre</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap">Status Akun</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Disetujui Pada
                                    </th>
                                    <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-50 divide-y divide-gray-200">
                                @foreach ($musisiApproved as $musisi)
                                    @php
                                        $u = $musisi->user;
                                        $active = $u?->is_active ?? 0;
                                    @endphp
                                    <tr class="hover:bg-gray-100 transition">
                                        <td class="py-3 px-4 font-medium text-gray-800">
                                            {{ $musisi->display_name }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-600 hidden md:table-cell">
                                            {{ $u?->email ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4 hidden md:table-cell">
                                            {{ $musisi->domisili ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4 hidden md:table-cell">
                                            {{ $musisi->genre ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($active)
                                                <span
                                                    class="inline-flex px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                                    Aktif
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex px-2 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold">
                                                    Non Aktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-xs text-gray-500 hidden md:table-cell">
                                            {{ $musisi->approved_at ? $musisi->approved_at->format('d-m-Y H:i') : '-' }}
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            @if ($u)
                                                <form action="{{ route('admin.akun.destroy', $u->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus akun musisi ini? Semua data terkait akan ikut terhapus.');"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-semibold rounded-md bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-400">User hilang</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- TABEL AUDIENS --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Daftar Audiens</h3>

                @if ($audiens->isEmpty())
                    <div class="py-3 text-sm text-gray-500">
                        Belum ada audiens yang terdaftar.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-blue-900 text-white">
                                <tr>
                                    <th class="py-3 px-4 text-left whitespace-nowrap">Nama</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Email</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Umur</th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Jenis Kelamin
                                    </th>
                                    <th class="py-3 px-4 text-left whitespace-nowrap">Status Akun</th>
                                    <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-50 divide-y divide-gray-200">
                                @foreach ($audiens as $audien)
                                    @php
                                        $u = $audien->user;
                                        $active = $u?->is_active ?? 1;
                                    @endphp
                                    <tr class="hover:bg-gray-100 transition">
                                        <td class="py-3 px-4 font-medium text-gray-800">
                                            {{ $u?->nama ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-600 hidden md:table-cell">
                                            {{ $u?->email ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4 hidden md:table-cell">
                                            {{ $audien->umur ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4 hidden md:table-cell">
                                            @if ($audien->jenis_kelamin === 'L')
                                                Laki-laki
                                            @elseif ($audien->jenis_kelamin === 'P')
                                                Perempuan
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($active)
                                                <span
                                                    class="inline-flex px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                                    Aktif
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex px-2 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold">
                                                    Non Aktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            @if ($u)
                                                <form action="{{ route('admin.akun.destroy', $u->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus akun audiens ini? Semua data terkait akan ikut terhapus.');"
                                                    class="inline-block">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="p-2 rounded-lg bg-gray-100 hover:bg-red-100 text-gray-600 hover:text-red-600 transition"
                                                        title="Hapus">

                                                        <img src="{{ asset('public/icons/delete.svg') }}" alt="Hapus"
                                                            class="w-5 h-5 inline-block">

                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-400">User hilang</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
