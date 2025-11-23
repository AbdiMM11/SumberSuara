@extends('layouts.layoutAdmin')

@section('content')
    <div class="bg-gray-100 min-h-screen pt-8 md:pt-0">
        <div class="bg-white shadow-md rounded-lg p-6">

            <!-- Flash Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 space-y-3 md:space-y-0">
                <h2 class="text-xl font-bold text-gray-800">Kalender Event</h2>

                <div class="flex flex-col sm:flex-row items-stretch gap-3 w-full md:w-auto">
                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('admin.event') }}" class="relative w-full sm:w-56">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search event"
                            class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <svg class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                        </svg>
                    </form>

                    <!-- Tambah Event Button -->
                    <a href="{{ route('admin.createEvent') }}"
                        class="flex items-center justify-center gap-2 bg-gray-100 px-4 py-2 text-sm font-medium text-gray-800 border border-gray-300 rounded-md hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Event
                    </a>
                </div>
            </div>

            <!-- Table Wrapper (Responsive) -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left whitespace-nowrap">Nama Event</th>
                            <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Lokasi</th>
                            <th class="py-3 px-4 text-left whitespace-nowrap hidden md:table-cell">Tanggal</th>
                            <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50 divide-y divide-gray-200">
                        @forelse($events as $event)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="py-3 px-4 font-medium text-gray-800">{{ $event->nama_event }}</td>
                                <td class="py-3 px-4 hidden md:table-cell">{{ $event->lokasi }}</td>
                                <td class="py-3 px-4 hidden md:table-cell">
                                    {{ \Carbon\Carbon::parse($event->tanggal)->format('d-m-Y') }}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex justify-center gap-3">
                                        <!-- Detail (publik) -->
                                        <a href="{{ route('viewEvent', $event->id) }}"
                                            class="p-2 rounded-lg bg-gray-100 hover:bg-green-100 text-gray-600 hover:text-green-600 transition"
                                            title="Lihat Detail">
                                            <img src="{{ asset('icons/view.svg') }}" alt="Lihat Detail"
                                                class="w-5 h-5 inline-block">
                                        </a>

                                        <!-- Edit (admin) -->
                                        <a href="{{ route('admin.editEvent', $event->id) }}"
                                            class="p-2 rounded-lg bg-gray-100 hover:bg-blue-100 text-gray-600 hover:text-blue-600 transition"
                                            title="Edit">
                                            <img src="{{ asset('icons/edit.svg') }}" alt="Edit"
                                                class="w-5 h-5 inline-block">
                                        </a>

                                        <!-- Hapus (admin) pakai popup -->
                                        <button type="button"
                                            onclick="openDeletePopup(this)"
                                            data-delete-url="{{ route('admin.deleteEvent', $event->id) }}"
                                            class="p-2 rounded-lg bg-gray-100 hover:bg-red-100 text-gray-600 hover:text-red-600 transition"
                                            title="Hapus">
                                            <img src="{{ asset('icons/delete.svg') }}" alt="Hapus"
                                                class="w-5 h-5 inline-block">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">Belum ada event tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>

    {{-- Popup konfirmasi delete event --}}
    @include('components.popup-deleteEvent')
@endsection
