@extends('layouts.layoutAdmin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-100 via-slate-50 to-slate-200 px-4 py-10 md:ml-12">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Ringkasan aktivitas dan statistik ekosistem Sumber Suara.
                    </p>
                </div>

                {{-- Ringkasan kecil artikel --}}
                <div class="flex flex-wrap gap-3 text-xs md:text-sm">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
                        Published Artikel:
                        <span class="font-semibold ml-1">{{ $artikelPublished }}</span>
                    </span>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                        Draft Artikel:
                        <span class="font-semibold ml-1">{{ $artikelDraft }}</span>
                    </span>
                </div>
            </div>

            {{-- Statistik Utama --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">
                {{-- Total Musisi --}}
                <div
                    class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="absolute -right-6 -top-6 w-20 h-20 bg-blue-100 rounded-full opacity-70"></div>
                    <div class="p-5 relative z-10">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-medium text-gray-500">Total Musisi</h2>
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-50 text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6H7v-2a4 4 0 014-4h2m-6 6v-2a4 4 0 014-4h2m1-4a3 3 0 110-6 3 3 0 010 6zm6 0a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mt-3">{{ $totalMusisi }}</p>
                        <p class="text-xs text-gray-500 mt-1">Band / musisi yang terdaftar di platform.</p>
                    </div>
                </div>

                {{-- Total Audiens --}}
                <div
                    class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="absolute -right-6 -top-6 w-20 h-20 bg-purple-100 rounded-full opacity-70"></div>
                    <div class="p-5 relative z-10">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-medium text-gray-500">Total Audiens</h2>
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-purple-50 text-purple-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6H7v-2a4 4 0 014-4h2m-6 6v-2a4 4 0 014-4h2M9 7a4 4 0 108 0 4 4 0 00-8 0z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mt-3">{{ $totalAudiens }}</p>
                        <p class="text-xs text-gray-500 mt-1">Pendengar yang aktif di Sumber Suara.</p>
                    </div>
                </div>

                {{-- Total Event --}}
                <div
                    class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="absolute -right-6 -top-6 w-20 h-20 bg-red-100 rounded-full opacity-70"></div>
                    <div class="p-5 relative z-10">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-medium text-gray-500">Total Event</h2>
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mt-3">{{ $totalEvent }}</p>
                        <p class="text-xs text-gray-500 mt-1">Semua event (upcoming & selesai).</p>
                    </div>
                </div>

                {{-- Total Artikel --}}
                <div
                    class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="absolute -right-6 -top-6 w-20 h-20 bg-yellow-100 rounded-full opacity-70"></div>
                    <div class="p-5 relative z-10">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-medium text-gray-500">Total Artikel</h2>
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-yellow-50 text-yellow-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 20h9M12 4h9m-9 8h9M3 6h.01M3 12h.01M3 18h.01" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mt-3">{{ $totalArtikel }}</p>
                        <p class="text-xs text-gray-500 mt-1">Artikel berita & konten komunitas.</p>
                    </div>
                </div>

                {{-- Total Lagu --}}
                <div
                    class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="absolute -right-6 -top-6 w-20 h-20 bg-emerald-100 rounded-full opacity-70"></div>
                    <div class="p-5 relative z-10">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-medium text-gray-500">Total Lagu</h2>
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-emerald-50 text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19V6l12-2v7M9 19a3 3 0 11-3-3 3 3 0 013 3zm12-3a3 3 0 11-3-3 3 3 0 013 3z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mt-3">{{ $totalLagu }}</p>
                        <p class="text-xs text-gray-500 mt-1">Total lagu yang diupload seluruh musisi.</p>
                    </div>
                </div>
            </div>

            {{-- Semua chart & insight ditumpuk ke bawah --}}
            <div class="space-y-6">

                {{-- Chart Audiens: Umur & Jenis Kelamin --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">
                                Demografi Audiens
                            </h2>
                            <p class="text-xs text-gray-500">
                                Distribusi audiens berdasarkan kelompok umur dan jenis kelamin.
                            </p>
                        </div>
                        <div class="flex gap-3 text-xs">
                            <div class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                                <span>Laki-laki</span>
                            </div>
                            <div class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full bg-pink-500"></span>
                                <span>Perempuan</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative h-56">
                        <canvas id="audiensDemografiChart"></canvas>
                    </div>

                    @php
                        $totalAudiensChart = array_sum($umurDataLaki ?? []) + array_sum($umurDataPerempuan ?? []);
                    @endphp

                    @if ($totalAudiensChart === 0)
                        <p class="text-[11px] text-gray-400 mt-3">
                            Belum ada data audiens lengkap (umur & jenis kelamin).
                        </p>
                    @endif
                </div>

                {{-- Insight Pendaftar --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">
                        Insight Pendaftar
                    </h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Total Pendaftar Musisi</span>
                            <span class="font-semibold text-gray-900">
                                {{ number_format(array_sum($pendaftarMusisiData ?? [])) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Total Pendaftar Audiens</span>
                            <span class="font-semibold text-gray-900">
                                {{ number_format(array_sum($pendaftarAudiensData ?? [])) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Chart Pendaftar per Bulan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">
                                Statistik Pendaftar per Bulan
                            </h2>
                            <p class="text-xs text-gray-500">
                                Perbandingan jumlah pendaftar Musisi dan Audiens dalam 6 bulan terakhir.
                            </p>
                        </div>
                        <div class="flex gap-3 text-xs">
                            <div class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full bg-indigo-500"></span>
                                <span>Musisi</span>
                            </div>
                            <div class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                                <span>Audiens</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative h-64">
                        <canvas id="pendaftarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart.js CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Data dari controller (PHP -> JS)
            const umurLabels = @json($umurLabels);
            const umurDataLaki = @json($umurDataLaki);
            const umurDataPerempuan = @json($umurDataPerempuan);

            const bulanLabels = @json($bulanLabels);
            const pendaftarMusisiData = @json($pendaftarMusisiData);
            const pendaftarAudiensData = @json($pendaftarAudiensData);

            // ======== Chart: Demografi Audiens (Bar Grouped) ========
            const audiensCanvas = document.getElementById('audiensDemografiChart');
            if (audiensCanvas) {
                const audiensCtx = audiensCanvas.getContext('2d');
                new Chart(audiensCtx, {
                    type: 'bar',
                    data: {
                        labels: umurLabels,
                        datasets: [{
                                label: 'Laki-laki',
                                data: umurDataLaki,
                                backgroundColor: '#3b82f6',
                                borderRadius: 6,
                            },
                            {
                                label: 'Perempuan',
                                data: umurDataPerempuan,
                                backgroundColor: '#ec4899',
                                borderRadius: 6,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.parsed.y} orang`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                },
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                },
                                grid: {
                                    color: '#e5e7eb'
                                }
                            }
                        }
                    }
                });
            }

            // ======== Chart: Pendaftar per Bulan (Line) ========
            const pendaftarCanvas = document.getElementById('pendaftarChart');
            if (pendaftarCanvas) {
                const pendaftarCtx = pendaftarCanvas.getContext('2d');
                new Chart(pendaftarCtx, {
                    type: 'line',
                    data: {
                        labels: bulanLabels,
                        datasets: [{
                                label: 'Musisi',
                                data: pendaftarMusisiData,
                                borderColor: '#4f46e5',
                                backgroundColor: 'rgba(79, 70, 229, 0.12)',
                                fill: true,
                                tension: 0.35,
                                borderWidth: 2,
                                pointRadius: 3,
                                pointHoverRadius: 4,
                            },
                            {
                                label: 'Audiens',
                                data: pendaftarAudiensData,
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.12)',
                                fill: true,
                                tension: 0.35,
                                borderWidth: 2,
                                pointRadius: 3,
                                pointHoverRadius: 4,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.parsed.y} pendaftar`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                },
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                },
                                grid: {
                                    color: '#e5e7eb'
                                }
                            }
                        }
                    }
                });
            }
        </script>
    </div>
@endsection
