<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Careventory's Web</title>
    @vite('resources/sass/app.scss')
    {{-- UI and Font --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.51.0/apexcharts.min.js" integrity="sha512-rgvuw7+rpm6cEJOUFmmzb2UWUVWg2VkIbmw6vMoWjbX/7CsyPgiMvrXhzZJbS0Ow1Bq/3illaZaqQej1n3AA7Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    {{-- sidebar --}}
    @include('layouts.sidebar')
    {{-- navbar --}}
    @include('layouts.navbar')

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</body>

</html>
