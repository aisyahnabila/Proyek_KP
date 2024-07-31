@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Form Permintaan Barang</div>

        {{-- Content --}}
        <form id="permintaan-form" method="POST" action="{{ route('permintaan.store') }}"
            class="mx-auto p-5 border bg-white shadow-xl rounded space-y-4" enctype="multipart/form-data">
            @csrf
            <div class="md:flex md:space-x-4">
                <!-- Sebelah Kiri -->
                <div class="w-full md:w-1/2">
                    <!-- Kategori Barang -->
                    <div class="mb-4">
                        <label for="unit_kerja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit
                            Kerja</label>
                        <select id="unit_kerja" name="unit_kerja" @class([
                            'text-sm block w-full md:w-72 p-2 rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                            'border-red-500' => $errors->has('unit_kerja'),
                            'border-gray-800' => !$errors->has('unit_kerja'),
                        ])>
                            <option value="">Pilih Unit Kerja</option>
                            @foreach ($unit_kerja as $unit)
                                <option value="{{ $unit->id_unitkerja }}"
                                    {{ old('unit_kerja') == $unit->id_unitkerja ? 'selected' : '' }}>
                                    {{ $unit->nama_unit_kerja }}
                                </option>
                            @endforeach
                        </select>
                        @error('unit_kerja')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Nama Pemohon -->
                    <div class="mb-4">
                        <label for="nama-pemohon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Pemohon</label>
                        <input type="text" id="nama_pemohon" name="nama_pemohon" @class([
                            'block w-full p-2 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                            'border-red-500' => $errors->has('nama_pemohon'),
                            'border-gray-800' => !$errors->has('nama_pemohon'),
                        ])
                            placeholder="Masukkan Nama Pemohon" value="{{ old('nama_pemohon') }}">
                        @error('nama_pemohon')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Keperluan -->
                    <div class="mb-4">
                        <label for="keperluan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keperluan</label>
                        <textarea id="keperluan" name="keperluan" @class([
                            'block w-full md:w-72 p-2 text-sm rounded bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                            'border-red-500' => $errors->has('keperluan'),
                            'border-gray-800' => !$errors->has('keperluan'),
                        ]) placeholder="Masukkan Spesifikasi Barang">{{ old('keperluan') }}</textarea>
                        @error('keperluan')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Evidence -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Evidence (Opsional)</label>
                        <input
                            class="text-xs block w-full cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:placeholder-gray-400 @class([
                                'border-red-500' => $errors->has('evidence'),
                                'border-gray-800' => !$errors->has('evidence'),
                            ])"
                            id="file_input" name="evidence" type="file">
                        @error('evidence')
                            <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Flash Messages --}}
                    {{-- @if ($errors->any())
                        <div class="mb-4 mt-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif --}}

                    @if (session('success'))
                        <div class="mb-4">
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif


                </div>

                <!-- Sebelah Kanan -->
                <div class="w-full md:w-1/2">
                    <div class="md:mt-0 mt-8">
                        <p class="mb-2">Informasi Barang yang Diminta</p>
                    </div>
                    <div class="relative overflow-x-auto sm:rounded-xs">
                        <table id="cart-items-table"
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama Barang</th>
                                    <th scope="col" class="px-6 py-3">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Baris-baris tabel akan ditambahkan secara dinamis oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Hidden Input untuk Menyimpan Data Keranjang -->
            <input type="hidden" id="cart-items-input" name="cartItems" value="{{ old('cartItems') }}">

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('permintaan.index') }}"
                    class=" text-black bg-white border border-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Kembali</a>
                <button type="submit"
                    class=" text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-400 font-medium rounded-lg text-sm px-5 py-2.5">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cartItemsTable = document.getElementById('cart-items-table');
            const cartItemsInput = document.getElementById('cart-items-input');

            // Fungsi untuk menampilkan barang yang ada di keranjang dalam tabel
            function displayCartItemsInTable() {
                // Ambil data barang dari input hidden atau localStorage
                let cartItems = JSON.parse(cartItemsInput.value || localStorage.getItem('cartItems')) || [];

                // Kosongkan konten tabel sebelum menambahkan kembali
                cartItemsTable.querySelector('tbody').innerHTML = '';

                // Loop untuk setiap barang dalam keranjang
                cartItems.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.classList.add(index % 2 === 0 ? 'even:bg-gray-50' : 'odd:bg-white', 'border-b');

                    row.innerHTML = `
                        <td class="px-6 py-4">${index + 1}</td>
                        <td class="px-6 py-4">${item.nama}</td>
                        <td class="px-6 py-4">${item.jumlahDiKeranjang}</td>
                    `;

                    cartItemsTable.querySelector('tbody').appendChild(row);
                });

                // Simpan data ke input hidden
                cartItemsInput.value = JSON.stringify(cartItems);
            }

            // Panggil fungsi displayCartItemsInTable saat halaman dimuat untuk pertama kali
            displayCartItemsInTable();

            // Tambahkan script untuk mengosongkan keranjang setelah formulir dikirim
            const permintaanForm = document.getElementById('permintaan-form');

            permintaanForm.addEventListener('submit', function() {
                // Hapus data keranjang dari localStorage
                localStorage.removeItem('cartItems');
            });
        });
    </script>
@endsection
