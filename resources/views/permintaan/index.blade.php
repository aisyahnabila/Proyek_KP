@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Permintaan Barang</div>

        {{-- button cart --}}
        <div class="flex justify-end my-4">
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="relative block text-black bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                <i class="text-black fa-solid fa-cart-shopping"></i>
                <!-- Elemen untuk jumlah item -->
                <span id="cart-item-count"
                    class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white rounded-full text-xs px-2 py-1">
                    0
                </span>
            </button>
        </div>

        <!-- Main Modal List Barang -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="p-4 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl h-full max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-3 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            List Barang yang Diminta
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div id="cart-items" class="space-y-4">
                            <!-- Cart items will be dynamically added here -->
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 md:p-3 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <a href="#"
                            class="font-semibold text-black bg-white border border-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Kembali</a>
                        <a href="{{ route('permintaan.create') }}" data-modal-hide="default-modal" type="button"
                            class="flex text-black bg-yellow-400 ml-3 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Buat Permintaan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            <!-- Left Section: List of Items -->
            <div class="flex-1 border overflow-x-auto shadow-xl sm:rounded">
                <div class="flex justify-end items-center p-4 bg-white dark:bg-gray-900 space-x-4">
                    <!-- Search Feature -->
                    <div class="relative w-full lg:w-auto lg:px-0">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-users"
                                class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Cari">
                        </div>
                    </div>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Barang</th>
                            <th scope="col" class="px-6 py-3">Spesifikasi</th>
                            <th scope="col" class="px-6 py-3">Stok</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody id="item-table-body">
                        @if ($items->isEmpty())
                            <tr id="no-data-row">
                                <td colspan="7" class="text-center p-4 text-gray-500 dark:text-gray-400">
                                    Data tidak tersedia.
                                </td>
                            </tr>
                        @else
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($items as $item)
                                @php
                                    $index++;
                                @endphp
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $item->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $item->spesifikasi_nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $item->jumlah }}</td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline add-to-cart"
                                            data-id="{{ $item->id_barang }}" data-nama="{{ $item->nama_barang }}"
                                            data-spesifikasi="{{ $item->spesifikasi_nama_barang }}"
                                            data-jumlah="{{ $item->jumlah }}">Pilih</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr id="no-results-row" style="display: none;">
                            <td colspan="7" class="text-center p-4 text-gray-500 dark:text-gray-400">
                                Data tidak ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- No Data Found Message -->
                <div id="no-data-message" class="hidden p-4 text-center text-gray-500 dark:text-gray-400">
                    Data Not Found
                </div>
            </div>
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

        // Fungsi Keranjang
        document.addEventListener("DOMContentLoaded", function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            const modalCartItems = document.getElementById('cart-items');
            const cartItemCount = document.getElementById('cart-item-count');

            // Fungsi untuk menampilkan barang yang ada di keranjang
            function displayCartItems() {
                // Ambil data barang dari localStorage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Kosongkan konten sebelum menambahkan kembali
                modalCartItems.innerHTML = '';

                // Loop untuk setiap barang dalam keranjang
                cartItems.forEach(item => {
                    const cartItemElement = document.createElement('div');
                    cartItemElement.classList.add('flex', 'items-center', 'justify-between', 'h-12',
                        'rounded', 'bg-white', 'dark:bg-gray-800', 'p-2');

                    cartItemElement.innerHTML = `
                <span class="text-black dark:text-gray-500">${item.nama}</span>
                <div class="flex items-center space-x-2">
                    <button class="text-black border border-gray-700 px-3 py-1 rounded addToCart">+</button>
                    <span class="text-black text-xl p-2">${item.jumlahDiKeranjang}</span>
                    <button class="text-black border border-gray-700 px-3 py-1 rounded removeFromCart">-</button>
                    <button class="text-black p-2 bg-gray-300 rounded deleteCartItem">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            `;

                    // Tambahkan event listener untuk tombol tambah barang
                    const addButton = cartItemElement.querySelector('.addToCart');
                    addButton.addEventListener('click', function() {
                        addToCart(item, false); // false indicates not a fresh add
                    });

                    // Tambahkan event listener untuk tombol kurang barang
                    const removeButton = cartItemElement.querySelector('.removeFromCart');
                    removeButton.addEventListener('click', function() {
                        removeFromCart(item);
                    });

                    // Tambahkan event listener untuk tombol hapus barang
                    const deleteButton = cartItemElement.querySelector('.deleteCartItem');
                    deleteButton.addEventListener('click', function() {
                        deleteCartItem(item.id);
                    });

                    modalCartItems.appendChild(cartItemElement);
                });

                // Update jumlah jenis barang di keranjang
                updateCartItemCount();
            }

            // Fungsi untuk menambah barang ke dalam keranjang
            function addToCart(item, isNew = true) {
                // Ambil data barang dari localStorage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Cek apakah barang sudah ada di keranjang berdasarkan id
                const existingItem = cartItems.find(i => i.id === item.id);
                if (existingItem) {
                    // Jika barang sudah ada, tambahkan jumlahnya
                    if (existingItem.jumlahDiKeranjang + 1 > parseInt(existingItem.jumlah)) {
                        alert(`Jumlah ${item.nama} melebihi stok yang tersedia (${existingItem.jumlah}).`);
                        return;
                    }
                    existingItem.jumlahDiKeranjang++;
                } else {
                    // Jika barang belum ada, tambahkan ke keranjang
                    item.jumlahDiKeranjang = 1; // Initialize jumlah di keranjang
                    if (isNew) {
                        item.jumlahDiKeranjang = 1;
                    }
                    cartItems.push(item);
                }

                // Simpan kembali ke localStorage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));

                // Tampilkan pesan sukses atau perubahan yang sesuai di UI jika diperlukan
                // alert(`Barang ${item.nama} telah ditambahkan ke keranjang`);

                // Update tampilan UI seperti jumlah barang di keranjang di modal
                displayCartItems();
            }

            // Fungsi untuk mengurangi jumlah barang di keranjang
            function removeFromCart(item) {
                // Ambil data barang dari localStorage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Cari barang yang sesuai berdasarkan id
                const existingItem = cartItems.find(i => i.id === item.id);
                if (existingItem) {
                    // Kurangi jumlah barang jika lebih dari 1
                    if (existingItem.jumlahDiKeranjang > 1) {
                        existingItem.jumlahDiKeranjang--;

                        // Simpan kembali ke localStorage
                        localStorage.setItem('cartItems', JSON.stringify(cartItems));

                        // Update tampilan UI seperti jumlah barang di keranjang di modal
                        displayCartItems();
                    }
                }
            }

            // Fungsi untuk menghapus barang dari keranjang berdasarkan id
            function deleteCartItem(itemId) {
                // Ambil data barang dari localStorage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Filter barang berdasarkan id yang akan dihapus
                cartItems = cartItems.filter(item => item.id !== itemId);

                // Simpan kembali ke localStorage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));

                // Tampilkan kembali daftar barang yang tersisa di keranjang
                displayCartItems();
            }

            // Fungsi untuk mengupdate jumlah jenis barang di keranjang
            function updateCartItemCount() {
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                let uniqueItemCount = cartItems.length; // Jumlah jenis barang unik
                cartItemCount.textContent = uniqueItemCount;
            }

            // Event listener untuk tombol "Tambah ke Keranjang"
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    const spesifikasi = this.getAttribute('data-spesifikasi');
                    const jumlah = this.getAttribute('data-jumlah');

                    // Buat objek untuk barang yang akan ditambahkan ke keranjang
                    const item = {
                        id: id,
                        nama: nama,
                        spesifikasi: spesifikasi,
                        jumlah: parseInt(jumlah), // Jumlah stok barang
                        jumlahDiKeranjang: 0 // Initialize jumlah di keranjang
                    };

                    // Panggil fungsi untuk menambah barang ke keranjang
                    addToCart(item);
                });
            });

            // Panggil fungsi displayCartItems saat halaman dimuat untuk pertama kali
            displayCartItems();
        });
    </script>
@endsection
