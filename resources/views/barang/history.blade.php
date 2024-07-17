@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Detail Kartu Barang</div>

        <div class="flex justify-end items-center mb-4">
            <a href="{{ route('kelola.index') }}"
                class="shadow-lg focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900 ml-auto">
                Kembali
            </a>
        </div>

        <div
            class="border shadow-lg overflow-x-auto flex flex-col lg:flex-row justify-between pb-4 bg-white dark:bg-gray-900 space-y-4 lg:space-y-0 lg:space-x-4">
            <div class="ms-6 mt-6 flex space-x-3">
                <span class="text-gray-900 dark:text-white">{{ $barang->kode_barang }}</span>
                <span>-</span>
                <span class="text-gray-900 dark:text-white">{{ $barang->nama_barang }}</span>
            </div>
        </div>

        <div class="border relative overflow-x-auto shadow-xl sm:rounded">
            <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Masuk</th>
                        <th scope="col" class="px-6 py-3">Keluar</th>
                        <th scope="col" class="px-6 py-3">Sisa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($log_activities as $index => $log)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $log->timestamp }}</td>
                            <td class="px-6 py-4">{{ $log->jumlah_masuk }}</td>
                            <td class="px-6 py-4">{{ $log->jumlah_keluar }}</td>
                            <td class="px-6 py-4">{{ $log->sisa }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
