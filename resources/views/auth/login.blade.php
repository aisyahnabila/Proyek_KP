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

<body class="flex items-center justify-center min-h-screen bg-white">
    <div class="w-full max-w-4xl p-8 mt-14 bg-gradient rounded-lg shadow-lg flex flex-col lg:flex-row">
        <!-- Left Content -->
        <div class="flex flex-col items-center justify-center w-full lg:w-1/2 p-4 border-r">
            <div class="flex justify-center mb-6">
                <img src="../img/logo-provinsi.png" alt="Logo 1" class="h-24 w-22">
                <img src='../img/logo-dinsos.png' alt="Logo 2" class="h-22 w-24">
            </div>
            <p class="text-4xl">Careventory</p>
            <p class="text-black mb-4 text-center"> </p>
        </div>

        <!-- Right Content -->
        <div class="w-full lg:w-1/2 p-8">
            {{-- message status log out --}}
            @if (session('status'))
                <div id="flash-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline pr-10">{{ session('status') }}</span>
                    <span class="absolute top-0 right-0 px-4 py-3">
                        <svg id="close-flash-message" class="fill-current h-6 w-6 text-green-500 cursor-pointer"
                            role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 5.652a.5.5 0 00-.707 0L10 9.293 6.36 5.652a.5.5 0 10-.707.707L9.293 10l-3.64 3.64a.5.5 0 00.707.707L10 10.707l3.64 3.64a.5.5 0 00.707-.707L10.707 10l3.64-3.64a.5.5 0 000-.707z" />
                        </svg>
                    </span>
                </div>
            @endif
            <p class="font-bold text-3xl text-center text-white mb-4">LOGIN</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Username Field -->
                <div class="mb-5">
                    <label for="username"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="username" name="username" autocomplete="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Username" value="{{ old('username') }}" required />
                    @if ($errors->has('username'))
                        <div class="mt-2 text-red-700 font-medium text-sm mb-1">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                </div>
                <!-- Password Field -->
                <div class="mb-5">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password" name="password" autocomplete="current-password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Password" value="{{ old('password') }}" required />
                    @if ($errors->has('password'))
                        <div class="mt-2 text-red-700 font-medium text-sm mb-1">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <!-- Remember Me -->
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" name="remember" value="1" autocomplete="off"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                            {{ old('remember') ? 'checked' : '' }} />
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                        me</label>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class=" text-black bg-yellow-300 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('close-flash-message').addEventListener('click', function() {
            document.getElementById('flash-message').style.display = 'none';
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Load saved username and password
            if (localStorage.getItem('rememberMe') === 'true') {
                document.getElementById('username').value = localStorage.getItem('username');
                document.getElementById('password').value = localStorage.getItem('password');
                document.getElementById('remember').checked = true;
            }

            // Save username and password on form submit
            document.querySelector('form').addEventListener('submit', function() {
                if (document.getElementById('remember').checked) {
                    localStorage.setItem('username', document.getElementById('username').value);
                    localStorage.setItem('password', document.getElementById('password').value);
                    localStorage.setItem('rememberMe', 'true');
                } else {
                    localStorage.removeItem('username');
                    localStorage.removeItem('password');
                    localStorage.removeItem('rememberMe');
                }
            });
        });
    </script>
</body>

</html>
