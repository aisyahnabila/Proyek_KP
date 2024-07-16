@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Form Permintaan Barang</div>

        {{-- Content --}}
        <form class="mx-auto p-5 border bg-white shadow-xl rounded space-y-4">

            <div class="md:flex md:space-x-4">
                <!-- Sebelah Kiri -->
                <div class="md:w-1/2">
                    <!-- Kategori Barang -->
                    <div class="mb-4">
                        <label for="kategori-barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Barang</label>
                        <select id="kategori-barang" class="text-sm block w-full md:w-72 p-2 border border-gray-800 rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Unit Kerja</option>
                            <!-- Add other options here -->
                        </select>
                    </div>
                    <!-- Nama Pemohon -->
                    <div class="mb-4">
                        <label for="nama-pemohon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemohon</label>
                        <input type="text" id="nama-pemohon" class="block w-full p-2 border border-gray-800 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Nama Pemohon">
                    </div>
                    <!-- Spesifikasi Barang -->
                    <div class="mb-4">
                        <label for="keperluan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spesifikasi Barang</label>
                        <textarea id="keperluan" class="block w-full p-2 border border-gray-800 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <!-- Evidence -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Evidence</label>
                        <input class="text-xs block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                    </div>
                </div>

                <!-- Sebelah Kanan -->
                <div class="md:w-1/2">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <p class="mb-2">Informasi Barang yang Diminta</p>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3"></th>
                                    <th scope="col" class="px-6 py-3">Nama Barang</th>
                                    <th scope="col" class="px-6 py-3">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-semibold odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4">1</td>
                                    <td class="px-6 py-4">Cutter Kecil</td>
                                    <td class="px-6 py-4">2</td>
                                </tr>
                                <tr class="font-semibold odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4">2</td>
                                    <td class="px-6 py-4">Tipex / tape</td>
                                    <td class="px-6 py-4">6</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('permintaan.index') }}" class="text-black bg-white border border-black hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Kembali</a>
                <button type="submit" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-600 font-medium rounded-lg text-sm px-5 py-2.5">Simpan Permintaan</button>
            </div>

        </form>

    </div>
@endsection
