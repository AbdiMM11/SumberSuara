<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="bg-gray-100">
    <x-navbar />
    <x-sidebarAdmin />
    <main class="ml-0 md:ml-72 mt-16 px-6 pb-32 pt-12">
        @yield('content')
    </main>
</body>

</html>
