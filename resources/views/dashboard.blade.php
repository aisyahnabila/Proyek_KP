@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Dashboard</div>
        {{-- first row --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div class="flex flex-col items-center justify-center h-36 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-black font-medium my-2 dark:text-gray-500">Total Barang Tersedia</p>
                <p class="text-black font-medium my-3 text-5xl dark:text-gray-500">50</p>
            </div>

            <div class="flex items-center justify-center h-36 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500"></p>
            </div>
            <div class="flex items-center justify-center h-36 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500"></p>
            </div>
            <div class="flex items-center justify-center h-36 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500"></p>
            </div>
        </div>

        {{-- second rows --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <div class="flex items-center justify-center h-72 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500"></p>
            </div>
            <div class="flex items-center justify-center h-72 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500"></p>
            </div>
        </div>
    </div>
@endsection
