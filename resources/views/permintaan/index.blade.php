@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Permintaan Barang</div>

        {{-- button cart --}}
        <div class="flex justify-end my-4">
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="block text-black bg-red-600 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                <i class="text-white fa-solid fa-cart-shopping"></i>
            </button>
        </div>

        <!-- Main Modal List Barang -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="p-4 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl h-full max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-3 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            List Barang yang Diminta
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        {{-- Content --}}
                        <div class="space-y-4">
                            <div class="flex items-center justify-between h-12 rounded bg-white dark:bg-gray-800 p-2">
                                <span class="text-black dark:text-gray-500">Cutter Kecil</span>
                                <div class="flex items-center space-x-2">
                                    <button class="text-black border border-gray-700 px-3 py-1 rounded">+</button>
                                    <span class="text-black text-xl p-2">2</span>
                                    <button class="text-black border border-gray-700 px-3 py-1 rounded">-</button>
                                    <button class="text-black p-2 bg-gray-300 rounded">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between h-12 rounded bg-white dark:bg-gray-800 p-2">
                                <span class="text-black dark:text-gray-500">Tipex / tape</span>
                                <div class="flex items-center space-x-2">
                                    <button class="text-black border border-gray-700 px-3 py-1 rounded">+</button>
                                    <span class="text-black text-xl p-2">6</span>
                                    <button class="text-black border border-gray-700 px-3 py-1 rounded">-</button>
                                    <button class="text-black p-2 bg-gray-300 rounded">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between h-12 rounded bg-white dark:bg-gray-800 p-2">
                                <span class="text-black dark:text-gray-500">Tisu Kamar Mandi</span>
                                <div class="flex items-center space-x-2">
                                    <button class="text-black border border-gray-700 px-3 py-1 rounded">+</button>
                                    <span class="text-black text-xl p-2">4</span>
                                    <button class="text-black border border-gray-700 px-3 py-1 rounded">-</button>
                                    <button class="text-black p-2 bg-gray-300 rounded">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 md:p-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <a href="#" class="font-semibold text-black bg-white border border-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Kembali</a>
                        <a href="{{ route('permintaan.create') }}" data-modal-hide="default-modal" type="button"
                            class="flex text-black bg-yellow-400 ml-3 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Buat Permintaan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            <!-- Left Section: List of Items -->
            <div class="flex-1 border overflow-x-auto shadow-xl sm:rounded">
                <div class="flex justify-end items-center p-4 bg-white dark:bg-gray-900 space-x-4">
                    <!-- Search Feature -->
                    <div class="relative w-full lg:w-auto lg:px-0">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-items"
                                class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Cari">
                        </div>
                    </div>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Barang</th>
                            <th scope="col" class="px-6 py-3">Spesifikasi</th>
                            <th scope="col" class="px-6 py-3">Stok</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody id="item-table-body">
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">Cutter Kecil</td>
                            <td class="px-6 py-4">apaya</td>
                            <td class="px-6 py-4">10</td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tambah</a>
                            </td>
                        </tr>
                        <!-- Add more rows here -->
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">Paper clip k, no. 1</td>
                            <td class="px-6 py-4">apaya</td>
                            <td class="px-6 py-4">5</td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tambah</a>
                            </td>
                        </tr>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">Pulpen</td>
                            <td class="px-6 py-4">apaya</td>
                            <td class="px-6 py-4">15</td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tambah</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- No Data Found Message -->
                <div id="no-data-message" class="hidden p-4 text-center text-gray-500 dark:text-gray-400">
                    Data Not Found
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('table-search-items').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#item-table-body tr');
            let found = false;

            rows.forEach(row => {
                let itemName = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                if (itemName.indexOf(filter) > -1) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show "Data Not Found" message if no rows are visible
            let noDataMessage = document.getElementById('no-data-message');
            if (!found) {
                noDataMessage.classList.remove('hidden');
            } else {
                noDataMessage.classList.add('hidden');
            }
        });
    </script>
@endsection
