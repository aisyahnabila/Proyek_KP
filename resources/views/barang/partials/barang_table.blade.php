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
                    onclick="confirmDeletion({{ $barang->id_barang }})">Hapus Data</button>
            </td>
        </tr>
    @endforeach
@endif

<tr id="no-results-row" style="display: none;">
    <td colspan="7" class="text-center p-4 text-gray-500 dark:text-gray-400">
        Data tidak ditemukan.
    </td>
</tr>

<script>
    function confirmDeletion(barangId) {
        Swal.fire({
            title: 'Konfirmasi Penghapusan',
            text: "Apakah Anda yakin ingin menghapus barang ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/barang/${barangId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Dihapus!',
                            'Barang telah dihapus.',
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    } else {
                        response.json().then(data => {
                            Swal.fire(
                                'Gagal!',
                                'Barang gagal dihapus.',
                                'error'
                            );
                            console.error('Failed to delete item', response.status, data);
                        });
                    }
                }).catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus barang.',
                        'error'
                    );
                });
            }
        })
    }
</script>
