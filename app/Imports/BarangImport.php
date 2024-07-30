<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\LogActivity;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class BarangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        if (!isset($row['kode_barang'])) {
            Log::error('Kolom kode_barang tidak ditemukan dalam baris: ', $row);
            return null;
        }

        // Temukan kategori berdasarkan kode_barang
        $kategori = Kategori::where('kode_barang', $row['kode_barang'])->firstOrFail();

        // Update or create the Barang model
        $barang = Barang::updateOrCreate(
            ['id_kategori' => $kategori->id_kategori, 'nama_barang' => $row['nama_barang']],
            [
                'spesifikasi_nama_barang' => $row['spesifikasi_nama_barang'],
                'jumlah' => $row['jumlah'],
                'satuan' => $row['satuan'],
            ]
        );

        if ($kategori) {
            Log::info('Kategori ditemukan: ', ['kode_barang' => $row['kode_barang'], 'kategori' => $kategori]);
        } else {
            Log::error('Kategori tidak ditemukan untuk kode_barang: ' . $row['kode_barang']);
            return null;
        }

        // Log the incoming quantity
        LogActivity::create([
            'id_barang' => $barang->id_barang,
            'timestamp' => now(),
            'jumlah_masuk' => $row['jumlah'],
            'jumlah_keluar' => 0,
            'sisa' => $barang->jumlah,
        ]);
        return $barang;
    }
}
