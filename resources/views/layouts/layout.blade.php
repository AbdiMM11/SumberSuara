<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sumber Suara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('public/images/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://unpkg.com/@hotwired/turbo@8.0.4/dist/turbo.js" defer></script>
</head>

<body class="bg-gray-100">
    <x-navbar />

    <main class="max-w-7xl mx-auto px-6 py-8 pb-32 pt-24">
        {{-- Notifikasi global --}}
        @if (session('success'))
            <div class="mb-4">
                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <x-footer />

    <x-music_player />
</body>

</html>
