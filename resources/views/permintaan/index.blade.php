@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">List Barang</div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Left Section: List of Items -->
            <div class="flex-1 border overflow-x-auto shadow-xl sm:rounded">
                <div class="flex justify-end items-center p-4 bg-white dark:bg-gray-900 space-x-4">
                    <!-- Search Feature -->
                    <div class="relative w-full lg:w-auto lg:px-0">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-users" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Barang">
                        </div>
                    </div>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Barang</th>
                            <th scope="col" class="px-6 py-3">Stok</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">Cutter Kecil</td>
                            <td class="px-6 py-4">10</td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tambah</a>
                            </td>
                        </tr>
                        <!-- Add more rows here -->
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">Paper clip k, no. 1</td>
                            <td class="px-6 py-4">5</td>
                            <td class="px-6 py-4">
                                <button href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tambah</>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Right Section: Item Details -->
            <div class="flex-1 border overflow-x-auto shadow-xl sm:rounded p-4 bg-white dark:bg-gray-800">
                <div class="text-lg mb-4">Detail Barang</div>
                <div class="flex justify-end">
                    <a href="{{route('permintaan.create')}}" class="px-4 py-2 bg-yellow-400 text-black rounded-lg font-medium text-sm">Buat Permintaan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
