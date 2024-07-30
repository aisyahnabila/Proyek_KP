@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Form Tambah Barang</div>

        {{-- Content --}}
        <form class="mx-auto p-5 border bg-white shadow-xl rounded space-y-4" action="{{ route('barang.store') }}"
            method="POST">
            @csrf <!-- Token CSRF -->
            <!-- First Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kode Barang -->
                <div>
                    <label for="id_kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Barang</label>
                    <select id="id_kategori" name="id_kategori"
                        class="text-sm block w-full md:w-72 p-2 border @error('id_kategori') border-red-500 @else border-gray-800 @enderror rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Pilih Kode Barang</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}"
                                {{ old('id_kategori') == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->kode_barang }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="jumlah"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah"
                        class="block w-full md:w-72 p-2 border @error('jumlah') border-red-500 @else border-gray-800 @enderror text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Jumlah Barang" value="{{ old('jumlah') }}">
                    @error('jumlah')
                        <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Second Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Barang -->
                <div>
                    <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang"
                        class="block w-full md:w-72 p-2 border @error('nama_barang') border-red-500 @else border-gray-800 @enderror text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Nama Barang" value="{{ old('nama_barang') }}">
                    @error('nama_barang')
                        <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Satuan -->
                <div>
                    <label for="satuan"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                    <input type="text" id="satuan" name="satuan"
                        class="block w-full md:w-72 p-2 border @error('satuan') border-red-500 @else border-gray-800 @enderror text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Satuan Barang" value="{{ old('satuan') }}">
                    @error('satuan')
                        <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Third Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Spesifikasi Barang -->
                <div>
                    <label for="spesifikasi_nama_barang"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spesifikasi Barang</label>
                    <textarea id="spesifikasi_nama_barang" name="spesifikasi_nama_barang"
                        class="block w-full md:w-72 p-2 border @error('spesifikasi_nama_barang') border-red-500 @else border-gray-800 @enderror text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Spesifikasi Barang">{{ old('spesifikasi_nama_barang') }}</textarea>
                    @error('spesifikasi_nama_barang')
                        <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('kelola.index') }}"
                    class="font-semibold text-black bg-white border border-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Kembali</a>
                <button type="submit"
                    class="font-semibold text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan</button>
            </div>

        </form>

    </div>
@endsection
