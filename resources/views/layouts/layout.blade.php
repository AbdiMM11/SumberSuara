<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://unpkg.com/@hotwired/turbo@8.0.4/dist/turbo.js" defer></script>
</head>

<body class="bg-gray-100">
    <x-navbar />

    <main class="max-w-7xl mx-auto px-6 py-8 pb-32 pt-24">
        @yield('content')
    </main>

    <x-footer />

    <x-music_player />
</body>

</html>
