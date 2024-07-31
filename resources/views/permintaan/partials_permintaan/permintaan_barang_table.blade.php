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
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">{{ $item->nama_barang }}</td>
            <td class="px-6 py-4">{{ $item->spesifikasi_nama_barang }}</td>
            <td class="px-6 py-4">{{ $item->jumlah }}</td>
            <td class="px-6 py-4">
                @if ($item->jumlah > 0)
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline add-to-cart"
                        data-id="{{ $item->id_barang }}" data-nama="{{ $item->nama_barang }}"
                        data-spesifikasi="{{ $item->spesifikasi_nama_barang }}" data-jumlah="{{ $item->jumlah }}">
                        Pilih
                    </a>
                @else
                    <span class="font-medium text-gray-400 cursor-not-allowed">
                        Pilih
                    </span>
                @endif
            </td>
        </tr>
    @endforeach
@endif
<tr id="no-results-row" style="display: none;">
    <td colspan="7" class="text-center p-4 text-gray-500 dark:text-gray-400">
        Data tidak ditemukan.
    </td>
</tr>
