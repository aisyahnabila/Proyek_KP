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
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
            </td>
        </tr>
    @endforeach
@endif
<tr id="no-results-row" style="display: none;">
    <td colspan="7" class="text-center p-4 text-gray-500 dark:text-gray-400">
        Data tidak ditemukan.
    </td>
</tr>
