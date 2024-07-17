<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Careventory's Web</title>
    @vite('resources/sass/app.scss')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
