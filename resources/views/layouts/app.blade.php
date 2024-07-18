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

</head>

<body>
    {{-- sidebar --}}
    @include('layouts.sidebar')
    {{-- navbar --}}
    @include('layouts.navbar')

    @yield('content')

</body>

</html>
