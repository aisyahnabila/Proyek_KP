<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

</head>

<body class=" flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 bg-blue-pv rounded-lg shadow-lg mt-14">
        <div class="flex justify-center mb-4">
            <img src="../img/logo-provinsi.png" alt="Logo 1" class="h-16 w-12 mr-4">
            <img src='../img/logo-dinsos.png' alt="Logo 2" class="ml-3 h-14 w-14">
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            {{-- field username --}}
            <div class="mb-5">
                <label for="username"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                @if ($errors->has('username'))
                    <div class="text-red-500 text-sm mb-1">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <input type="text" id="username" name="username"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukkan Username" value="{{ old('username') }}" required />
            </div>
            {{-- field username End --}}

            {{-- field password --}}
            <div class="mb-5">
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                @if ($errors->has('password'))
                    <div class="text-red-500 text-sm mb-1">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <input type="password" id="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukkan Password" value="{{ old('password') }}" required />
            </div>
            {{-- field password End --}}

            {{-- input remember me --}}
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" name="remember" value="1"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                        {{ old('remember') ? 'checked' : '' }} />
                </div>
                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                    me</label>
            </div>
            {{-- input remember me End --}}

            {{-- button Log in --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-yellow-300 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                    Log In
                </button>
            </div>
            {{-- button Log in End --}}

        </form>

    </div>
</body>

</html>
