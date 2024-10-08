@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Laporan Per Permintaan</div>

        <div class="p-4 overflow-x-auto flex justify-end items-center pb-4 bg-white dark:bg-gray-900 space-x-4">
            <div class="relative w-full lg:w-auto lg:px-0 lg:mt-0 lg:ml-4">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    {{-- fitur search --}}
                    <input type="text" id="table-search-users"
                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-800 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cari">
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="border relative overflow-x-auto shadow-xl sm:rounded">
            <table id="history-table" class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal Permintaan</th>
                        <th scope="col" class="px-6 py-3">Kode Permintaan</th>
                        <th scope="col" class="px-6 py-3">Unit Kerja</th>
                        <th scope="col" class="px-6 py-3">Nama Pemohon</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($permintaans->isEmpty())
                        <tr id="no-data-row">
                            <td colspan="5" class="text-center p-4 text-gray-500 dark:text-gray-400">
                                Data tidak tersedia
                            </td>
                        </tr>
                    @else
                        @php
                            $index = 0;
                        @endphp
                        @foreach ($permintaans as $permintaan)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $permintaan->tanggal_permintaan }}</td>
                                <td class="px-6 py-4">{{ $permintaan->kode_permintaan }}</td>
                                <td class="px-6 py-4">{{ $permintaan->unitkerja->nama_unit_kerja }}</td>
                                <td class="px-6 py-4">{{ $permintaan->nama_pemohon }}</td>
                                <td class="px-6 py-4">
                                    <!-- Button untuk detail -->
                                    <button data-modal-target="detail-modal-{{ $permintaan->id_permintaan }}"
                                        data-modal-toggle="detail-modal-{{ $permintaan->id_permintaan }}"
                                        class="block text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">
                                        Detail
                                    </button>

                                    <!-- Modal detail -->
                                    <div id="detail-modal-{{ $permintaan->id_permintaan }}" tabindex="-1"
                                        aria-hidden="true"
                                        class="p-4 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-4xl h-full max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex justify-between items-start p-4 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Detail Permintaan
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="detail-modal-{{ $permintaan->id_permintaan }}">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="p-6 overflow-y-auto max-h-[70vh]">
                                                    <div
                                                        class="border overflow-x-auto flex flex-col lg:flex-row justify-between pb-4 bg-white dark:bg-gray-900 space-y-4 lg:space-y-0 lg:space-x-4">
                                                        <!-- Tulisan Detail Barang -->
                                                        <div class="ms-4 mt-3">
                                                            <span
                                                                class="font-medium text-gray-900 dark:text-white">{{ $permintaan->unitkerja->nama_unit_kerja }}</span>
                                                        </div>
                                                    </div>

                                                    {{-- Tabel detail barang --}}
                                                    <div class="border relative overflow-x-auto sm:rounded">
                                                        <table
                                                            class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                                                            <thead
                                                                class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3">Kode Barang</th>
                                                                    <th scope="col" class="px-6 py-3">Nama Barang</th>
                                                                    <th scope="col" class="px-6 py-3">Spesifikasi Barang
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3">Jumlah</th>
                                                                    <th scope="col" class="px-6 py-3">Satuan</th>
                                                                    <th scope="col" class="px-6 py-3">Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($permintaan->detailPermintaan as $detail)
                                                                    <tr
                                                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                                        <td class="px-6 py-4">
                                                                            {{ $detail->barang->kategori->kode_barang }}
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            {{ $detail->barang->nama_barang }}</td>
                                                                        <td class="px-6 py-4">
                                                                            {{ $detail->barang->spesifikasi_nama_barang }}
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            {{ $detail->jumlah_permintaan }}
                                                                        </td>
                                                                        <td class="px-6 py-4">{{ $detail->barang->satuan }}
                                                                        </td>
                                                                        <td class="px-6 py-4">{{ $detail->keterangan }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div
                                                    class="flex justify-end items-center p-3 md:p-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <a href="{{ route('historypermintaan.exportWord', ['id' => $permintaan->id_permintaan, 'type' => 'nota_permintaan']) }}"
                                                        class="flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">
                                                        <i class="fa-regular fa-file-word mt-1 mr-2"></i>
                                                        Export Nota
                                                    </a>
                                                    <a href="{{ route('historypermintaan.exportWord', ['id' => $permintaan->id_permintaan, 'type' => 'penyaluran']) }}"
                                                        class="flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">
                                                        <i class="fa-regular fa-file-word mt-1 mr-2"></i>
                                                        Export Penyaluran
                                                    </a>
                                                    <a href="{{ route('historypermintaan.exportWord', ['id' => $permintaan->id_permintaan, 'type' => 'spb']) }}"
                                                        class="flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        <i class="fa-regular fa-file-word mt-1 mr-2"></i>
                                                        Export SPB
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr id="no-results-row" style="display: none;">
                        <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">
                            Tidak ada hasil ditemukan
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('table-search-users').addEventListener('keyup', function() {
            let searchQuery = this.value.toLowerCase();
            let allRows = document.querySelectorAll('#history-table tbody tr');
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

            if (searchQuery !== '') {
                noDataRow.style.display = 'none';
            } else {
                if (!rowFound && !searchQuery) {
                    noDataRow.style.display = '';
                }
            }
        });
    </script>
@endsection
