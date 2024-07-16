@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Form Tambah Barang</div>

        {{-- Content --}}
        <form class="mx-auto p-5 border bg-white shadow-xl rounded space-y-4">
            <!-- First Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kode Barang -->
                <div>
                    <label for="kode-barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Kode Barang
                    </label>
                    <select id="kode-barang" name="id_kode"
                        class="text-sm block w-full md:w-72 p-2 border border-gray-800 rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Pilih Kode Barang</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}">{{ $item->kode_barang }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="jumlah"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="text" id="jumlah"
                        class="block w-full md:w-72 p-2 border border-gray-800 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Jumlah Barang">
                </div>
            </div>

            <!-- Second Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Barang -->
                <div>
                    <label for="nama-barang"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Barang</label>
                    <input type="text" id="nama_barang"
                        class="block w-full md:w-72 p-2 border border-gray-800 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Nama Barang">
                </div>
                <!-- Satuan -->
                <div>
                    <label for="satuan"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                    <input type="text" id="satuan"
                        class="block w-full md:w-72 p-2 border border-gray-800 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Satuan Barang">
                </div>
            </div>

            <!-- Third Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Spesifikasi Barang -->
                <div>
                    <label for="spesifikasi-barang"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spesifikasi Barang</label>
                    <textarea id="spesifikasi-barang"
                        class="block w-full md:w-72 p-2 border border-gray-800 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('kelola.index') }}"
                    class="font-semibold text-black bg-white border border-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Kembali</a>
                <button type="submit"
                    class="font-semibold text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-600 font-medium rounded-lg text-sm px-5 py-2.5">Simpan
                    Data</button>
            </div>

        </form>

    </div>
@endsection
