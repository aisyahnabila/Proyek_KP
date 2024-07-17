@extends('layouts.app')

@section('content')
    {{-- content --}}
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Kelola Barang</div>

        <div class="p-4 overflow-x-auto flex justify-end items-center pb-4 bg-white dark:bg-gray-900 space-x-4">
            <!-- Search Feature -->
            <div class="relative w-full lg:w-auto lg:px-0 mt-5 lg:mt-0 lg:ml-4">
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

            <!-- Button Tambah Data -->
            <div>
                <a href="{{ route('kelola.create') }}"
                    class="focus:outline-none text-black font-semibold bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900">Tambah</a>
            </div>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a.5.5 0 010 .707L10.707 10l3.641 3.641a.5.5 0 11-.707.707L10 10.707l-3.641 3.641a.5.5 0 11-.707-.707L9.293 10 5.652 6.359a.5.5 0 01.707-.707L10 9.293l3.641-3.641a.5.5 0 01.707 0z" />
                    </svg>
                </span>
            </div>
        @endif
        {{-- Flash Message End --}}

        {{-- Content --}}
        <div class="border relative overflow-x-auto shadow-xl sm:rounded">
            <table id="barang-table" class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Kode Barang</th>
                        <th scope="col" class="px-6 py-3">Nama Barang</th>
                        <th scope="col" class="px-6 py-3">Spesifikasi Barang</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Satuan</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @include('barang.partials.barang_table')
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('table-search-users').addEventListener('keyup', function() {
            let searchQuery = this.value.toLowerCase();
            let allRows = document.querySelectorAll('#barang-table tbody tr');
            let noResultsRow = document.getElementById('no-results-row');
            let noDataRow = document.getElementById('no-data-row');
            let rowFound = false;

            allRows.forEach(row => {
                if (row !== noResultsRow && row !== noDataRow) {
                    let rowText = row.innerText.toLowerCase();
                    if (rowText.includes(searchQuery)) {
                        row.style.display = '';
                        rowFound = true;
                    } else {
                        row.style.display = 'none';
                    }
                }
            });

            if (!rowFound && searchQuery !== '') {
                noResultsRow.style.display = '';
            } else {
                noResultsRow.style.display = 'none';
            }

            // Hide "no data" row if there's a search query
            if (searchQuery !== '') {
                noDataRow.style.display = 'none';
            } else {
                // Show "no data" row if there are no rows and no search query
                if (!rowFound && !searchQuery) {
                    noDataRow.style.display = '';
                }
            }
        });
    </script>
@endsection
