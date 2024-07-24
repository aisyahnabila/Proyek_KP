@extends('layouts.app')

@section('content')
    {{-- content --}}
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Laporan Bulanan</div>

        <div class="p-5 border border-black overflow-x-auto flex justify-between items-center pb-4 bg-white dark:bg-gray-900 space-x-4">
            <!-- Container for dropdowns and filter unit kerja -->
            <div class="flex space-x-4">
                <!-- Filter unit kerja -->
                <div class="flex-1">
                    <!-- Option Unit Kerja -->
                    <select id="unit-kerja" name="id_kategori"
                        class="text-sm block w-full md:w-72 p-2 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Semua Unit Kerja</option>
                        <option value="">Sub.Bag.Umum dan Kepegawaian</option>
                        <option value="">Sub.Bag.Penyusunan Program dan Anggaran</option>
                    </select>
                </div>
                <!-- Filter Bulan -->
                <div>
                    <select id="unit-kerja" name="id_kategori"
                        class="text-sm block w-full md:w-72 p-2 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Bulan</option>
                        <option value="">Januari</option>
                        <option value="">Februari</option>
                        <option value="">Maret</option>
                    </select>
                </div>
            </div>

            <div class="mr-4">
                <a href="#" class="flex items-center justify-center font-semibold focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900">
                    <i class="fa-solid fa-download mt-1 mr-2"></i>
                    Export
                </a>
            </div>
        </div>

        {{-- Content --}}
        <div class="border relative overflow-x-auto shadow-xl sm:rounded">
            <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-5 py-3">Tanggal Permintaan</th>
                        <th scope="col" class="px-5 py-3">Unit Kerja</th>
                        <th scope="col" class="px-5 py-3">Kode Barang</th>
                        <th scope="col" class="px-5 py-3">Nama Barang</th>
                        <th scope="col" class="px-5 py-3">Spesifikasi Nama Barang</th>
                        <th scope="col" class="px-5 py-3">Pengajuan Permintaan</th>
                        <th scope="col" class="px-5 py-3">Informasi Sisa</th>
                        <th scope="col" class="px-5 py-3">Satuan</th>
                        <th scope="col" class="px-5 py-3">Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-5 py-4">01 Juli 2024</td>
                        <td class="px-5 py-4">Sub Bag Umum dan Kepegawaian</td>
                        <td class="px-5 py-4">3101</td>
                        <td class="px-5 py-4">Cutter Kecil</td>
                        <td class="px-5 py-4">A-300, Joyko</td>
                        <td class="px-5 py-4">1</td>
                        <td class="px-5 py-4">1</td>
                        <td class="px-5 py-4">Buah</td>
                        <td class="px-5 py-4">Dinas</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
