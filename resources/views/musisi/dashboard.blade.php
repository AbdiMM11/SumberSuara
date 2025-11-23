@extends('layouts.layoutMusisi')

@section('content')
<div class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Musisi</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Ringkasan karya dan audiens yang menyukai musikmu.
                </p>
            </div>
        </div>

        {{-- Statistik Utama --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            {{-- Total Karya --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-20 h-20 bg-blue-100 rounded-full opacity-70"></div>

                <div class="p-5 relative z-10">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-500">Total Karya</h2>
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-50 text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 19V6l13-2v9M9 19a3 3 0 11-3-3 3 3 0 013 3zM22 16a3 3 0 11-3-3" />
                            </svg>
                        </span>
                    </div>

                    <p class="text-3xl font-bold text-gray-900 mt-3">{{ $totalKarya }}</p>
                    <p class="text-xs text-gray-500 mt-1">Lagu / karya yang sudah kamu upload.</p>
                </div>
            </div>

            {{-- Total Lagu Disukai --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-20 h-20 bg-red-100 rounded-full opacity-70"></div>

                <div class="p-5 relative z-10">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-500">Total Lagu Disukai</h2>
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 10-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </span>
                    </div>

                    <p class="text-3xl font-bold text-gray-900 mt-3">{{ $totalLikeLagu }}</p>
                    <p class="text-xs text-gray-500 mt-1">Total like dari seluruh lagu kamu.</p>
                </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="space-y-6">

            {{-- Chart Gender --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Audiens Berdasarkan Gender</h2>
                        <p class="text-xs text-gray-500">Distribusi gender audiens yang menyukai lagu kamu.</p>
                    </div>
                    <div class="flex gap-3 text-xs">
                        <span class="inline-flex items-center gap-1">
                            <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                            Laki-laki
                        </span>
                        <span class="inline-flex items-center gap-1">
                            <span class="w-3 h-3 bg-pink-500 rounded-full"></span>
                            Perempuan
                        </span>
                    </div>
                </div>

                <div class="relative h-56">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>

            {{-- Chart Umur --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Audiens Berdasarkan Umur</h2>
                    <p class="text-xs text-gray-500">Kelompok usia audiens yang berinteraksi dengan lagu kamu.</p>
                </div>

                <div class="relative h-56">
                    <canvas id="umurChart"></canvas>
                </div>
            </div>

        </div>

    </div>
</div>

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const genderLabels = @json($genderLabels);
    const genderData   = @json($genderData);
    const umurLabels   = @json($umurLabels);
    const umurData     = @json($umurData);

    // Chart Gender
    new Chart(document.getElementById('genderChart'), {
        type: 'bar',
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderData,
                backgroundColor: ['#3b82f6', '#ec4899'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }},
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 }}
            }
        }
    });

    // Chart Umur
    new Chart(document.getElementById('umurChart'), {
        type: 'bar',
        data: {
            labels: umurLabels,
            datasets: [{
                data: umurData,
                backgroundColor: '#10b981',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }},
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 }}
            }
        }
    });
</script>
@endsection
