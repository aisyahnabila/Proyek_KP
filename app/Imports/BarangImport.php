<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class BarangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Log::info('Row content: ', $row);

        if (!isset($row['kode_barang'])) {
            Log::error('Kolom kode_barang tidak ditemukan dalam baris: ', $row);
            return null;
        }

        $kategori = Kategori::where('kode_barang', $row['kode_barang'])->first();

        if ($kategori) {
            Log::info('Kategori ditemukan: ', ['kode_barang' => $row['kode_barang'], 'kategori' => $kategori]);
        } else {
            Log::error('Kategori tidak ditemukan untuk kode_barang: ' . $row['kode_barang']);
            return null;
        }

        // Log the id_kategori value to ensure it is not null
        // Log::info('id_kategori value: ' . $kategori->id_kategori);

        return new Barang([
            'nama_barang' => $row['nama_barang'],
            'spesifikasi_nama_barang' => $row['spesifikasi_nama_barang'],
            'jumlah' => $row['jumlah'],
            'satuan' => $row['satuan'],
            'id_kategori' => $kategori->id_kategori, // Use the retrieved id_kategori
        ]);
    }
}
