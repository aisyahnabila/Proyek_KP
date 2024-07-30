{{-- resources/views/barang/tambah_jumlah.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Tambah Jumlah Barang</div>

        {{-- Content --}}
        <form action="{{ route('barang.tambahJumlah', $barang->id_barang) }}" method="POST"
            class="mx-auto p-5 border bg-white shadow-xl rounded space-y-4">
            @csrf
            <!-- First Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kode Barang -->
                <div>
                    <label for="kode-barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                        Barang</label>
                    <input type="text" id="kode-barang" value="{{ $barang->kategori->kode_barang }}" disabled
                        class="text-sm block w-full md:w-72 p-2 bg-gray-100 border border-gray-800 rounded text-gray-900 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="jumlah"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="text" id="jumlah" name="jumlah"
                        class="block w-full md:w-72 p-2 border border-gray-800 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Tambah Stok Barang">
                </div>
            </div>

            <!-- Second Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Barang -->
                <div>
                    <label for="nama-barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Barang</label>
                    <input type="text" id="nama-barang" value="{{ $barang->nama_barang }}" disabled
                        class="text-sm block w-full md:w-72 p-2 bg-gray-100 border border-gray-800 rounded text-gray-900 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <!-- Satuan -->
                <div>
                    <label for="satuan"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                    <input type="text" id="satuan" value="{{ $barang->satuan }}" disabled
                        class="text-sm block w-full md:w-72 p-2 bg-gray-100 border border-gray-800 rounded text-gray-900 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>

            <!-- Third Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Spesifikasi Barang -->
                <div>
                    <label for="spesifikasi-barang"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spesifikasi Barang</label>
                    <textarea id="spesifikasi-barang" disabled
                        class="text-sm block w-full md:w-72 p-2 bg-gray-100 border border-gray-800 rounded text-gray-900 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $barang->spesifikasi_nama_barang }}</textarea>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('kelola.index') }}"
                    class="font-semibold text-black bg-white border border-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Kembali</a>
                <button type="submit"
                    class="font-semibold text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan
                    Data</button>
            </div>
        </form>
    </div>
@endsection
