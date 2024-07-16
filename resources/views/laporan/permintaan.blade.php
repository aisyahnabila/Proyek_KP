@extends('layouts.app')

@section('content')
    {{-- content --}}
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Laporan Per Permintaan</div>

        <div class="p-3 overflow-x-auto flex justify-end items-center pb-4 bg-white dark:bg-gray-900 space-x-4">
            <!-- Search Feature -->
            <div class="relative w-full lg:w-auto lg:px-0 mt-5 lg:mt-0 lg:ml-4 lg:mt-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search-users"
                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-800 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cari">
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="border relative overflow-x-auto shadow-xl sm:rounded">
            <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Permintaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kode Permintaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Unit Kerja
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Pemohon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            01 Juli 2024
                        </td>
                        <td class="px-6 py-4">
                            A-001
                        </td>
                        <td class="px-6 py-4">
                            Sub Bag Umum dan Kepegawaian
                        </td>
                        <td class="px-6 py-4">
                            Bu Vedra
                        </td>
                        <td class="px-6 py-4">
                            {{-- <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a> --}}
                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                                class="block text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                Detail
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal" tabindex="-1" aria-hidden="true"
                                class="p-4 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-4xl h-full max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-3 md:p-3 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                                Detail Permintaan
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="default-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 overflow-y-auto max-h-[70vh]">
                                            <div
                                                class="border overflow-x-auto flex flex-col lg:flex-row justify-between pb-4 bg-white dark:bg-gray-900 space-y-4 lg:space-y-0 lg:space-x-4">
                                                <!-- Tulisan Detail Barang -->
                                                <div class="ms-4 mt-3">
                                                    <span class="font-medium text-gray-900 dark:text-white">Sub.Bag.Umum dan
                                                        Kepegawaian</span>
                                                </div>
                                            </div>

                                            {{-- Content --}}
                                            <div class="border relative overflow-x-auto sm:rounded">
                                                <table
                                                    class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                                                    <thead
                                                        class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3">Kode Barang</th>
                                                            <th scope="col" class="px-6 py-3">Nama Barang</th>
                                                            <th scope="col" class="px-6 py-3">Spesifikasi Barang</th>
                                                            <th scope="col" class="px-6 py-3">Jumlah</th>
                                                            <th scope="col" class="px-6 py-3">Satuan</th>
                                                            <th scope="col" class="px-6 py-3">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                            <td class="px-6 py-4">3101</td>
                                                            <td class="px-6 py-4">Cutter Kecil</td>
                                                            <td class="px-6 py-4">A-300, Joyko</td>
                                                            <td class="px-6 py-4">1</td>
                                                            <td class="px-6 py-4">Buah</td>
                                                            <td class="px-6 py-4"></td>
                                                        </tr>
                                                        <tr
                                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                            <td class="px-6 py-4">3101</td>
                                                            <td class="px-6 py-4">Paper clip k, no.1</td>
                                                            <td class="px-6 py-4">No.1/1 dos isi 10 boxes</td>
                                                            <td class="px-6 py-4">2</td>
                                                            <td class="px-6 py-4">Boxes</td>
                                                            <td class="px-6 py-4"></td>
                                                        </tr>
                                                        <tr
                                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                            <td class="px-6 py-4">3101</td>
                                                            <td class="px-6 py-4">Tipex / tape</td>
                                                            <td class="px-6 py-4">Faber castel, 5x10m</td>
                                                            <td class="px-6 py-4">1</td>
                                                            <td class="px-6 py-4">Buah</td>
                                                            <td class="px-6 py-4"></td>
                                                        </tr>
                                                        <tr
                                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                            <td class="px-6 py-4">3101</td>
                                                            <td class="px-6 py-4">Kertas HVS F 70 gr</td>
                                                            <td class="px-6 py-4">Uk. 32 x21 cm, putih polos</td>
                                                            <td class="px-6 py-4">1</td>
                                                            <td class="px-6 py-4">Rim</td>
                                                            <td class="px-6 py-4"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex items-center p-3 md:p-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <a href="#" data-modal-hide="default-modal" type="button"
                                                class="flex text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Export
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
