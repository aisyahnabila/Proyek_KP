@if ($barangs->isEmpty())
    <tr id="no-data-row">
        <td colspan="7" class="text-center p-4 text-gray-500 dark:text-gray-400">
            Data tidak tersedia.
        </td>
    </tr>
@else
    @php
        $index = 0;
    @endphp
    @foreach ($barangs as $barang)
        @php
            $index++;
        @endphp
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-3">{{ $index }}</td>
            <td class="px-6 py-4">{{ $barang->kategori->kode_barang }}</td>
            <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
            <td class="px-6 py-4">{{ $barang->spesifikasi_nama_barang }}</td>
            <td class="px-6 py-4">{{ $barang->jumlah }}</td>
            <td class="px-6 py-4">{{ $barang->satuan }}</td>
            <td class="px-6 py-4">
                <a href="{{ route('barang.tambahJumlahForm', $barang->id_barang) }}"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tambah Jumlah</a> |
                <a href="{{ route('barang.show', $barang->id_barang) }}"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a> |
                <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                    onclick="openModal({{ $barang->id_barang }})">Hapus Data</button>
            </td>
        </tr>
    @endforeach
@endif

<tr id="no-results-row" style="display: none;">
    <td colspan="7" class="text-center p-4 text-gray-500 dark:text-gray-400">
        Data tidak ditemukan.
    </td>
</tr>

<!-- Modal konfirmasi -->
<div id="confirmModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-20"></div>
        </div>

        <!-- Modal content -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Penghapusan</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus barang ini?</p>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button"
                    class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm mr-2"
                    id="confirmDeleteButton">
                    Hapus
                </button>
                <button type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                    onclick="closeModal()">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(barangId) {
        document.getElementById('confirmModal').classList.remove('hidden');
        document.getElementById('confirmDeleteButton').setAttribute('onclick', `confirmDelete(${barangId})`);
    }

    function closeModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function confirmDelete(barangId) {
        console.log('Attempting to delete item with ID:', barangId); // Log ID untuk memastikan fungsi dipanggil
        fetch(`/barang/${barangId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            return response.json().then(data => {
                if (response.ok) {
                    console.log('Item successfully deleted', data); // Log jika delete berhasil
                    return new Promise((resolve) => {
                        closeModal(); // Tutup modal terlebih dahulu
                        setTimeout(() => resolve(),
                            300); // Delay 300ms untuk memastikan modal ditutup sepenuhnya
                    });
                } else {
                    console.error('Failed to delete item', response.status,
                        data); // Log status jika gagal
                    return Promise.reject(data);
                }
            });
        }).then(() => {
            window.location.reload(); // Reload halaman setelah menutup modal
        }).catch(error => {
            console.error('Error:', error);
        });
    }
</script>
