@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Laporan Per Permintaan</div>

        <div class="p-3 overflow-x-auto flex justify-end items-center pb-4 bg-white dark:bg-gray-900 space-x-4">
            <!-- Search Feature -->
            <!-- ... (bagian search feature) -->
        </div>

        {{-- Content --}}
        <div class="border relative overflow-x-auto shadow-xl sm:rounded">
            <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
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
                    @foreach ($permintaans as $permintaan)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $permintaan->tanggal_permintaan }}</td>
                            <td class="px-6 py-4">{{ $permintaan->kode_permintaan }}</td>
                            <td class="px-6 py-4">{{ $permintaan->unitKerja->nama_unitkerja }}</td>
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
                                <div id="detail-modal-{{ $permintaan->id_permintaan }}" tabindex="-1" aria-hidden="true"
                                    class="p-4 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-4xl h-full max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <!-- ... (bagian header modal) -->

                                            <!-- Modal body -->
                                            <div class="p-6 overflow-y-auto max-h-[70vh]">
                                                <div
                                                    class="border overflow-x-auto flex flex-col lg:flex-row justify-between pb-4 bg-white dark:bg-gray-900 space-y-4 lg:space-y-0 lg:space-x-4">
                                                    <!-- Tulisan Detail Barang -->
                                                    <div class="ms-4 mt-3">
                                                        <span
                                                            class="font-medium text-gray-900 dark:text-white">{{ $permintaan->unitKerja->nama_unitkerja }}</span>
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
                                                                <th scope="col" class="px-6 py-3">Spesifikasi Barang</th>
                                                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                                                <th scope="col" class="px-6 py-3">Satuan</th>
                                                                <th scope="col" class="px-6 py-3">Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($permintaan->detailPermintaans as $detail)
                                                                <tr
                                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                                    <td class="px-6 py-4">{{ $detail->barang->kode_barang }}
                                                                    </td>
                                                                    <td class="px-6 py-4">{{ $detail->barang->nama_barang }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $detail->barang->spesifikasi }}</td>
                                                                    <td class="px-6 py-4">{{ $detail->jumlah_permintaan }}
                                                                    </td>
                                                                    <td class="px-6 py-4">{{ $detail->barang->satuan }}
                                                                    </td>
                                                                    <td class="px-6 py-4">{{ $detail->keterangan }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <!-- ... (bagian footer modal) -->
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
