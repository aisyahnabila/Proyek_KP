<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['kode_barang' => 3101, 'nama_kode_barang' => 'ATK', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 3201, 'nama_kode_barang' => 'Alat Listrik', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 3103, 'nama_kode_barang' => 'Alat Perabotan Kantor', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 3115, 'nama_kode_barang' => 'Cetak', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 3117, 'nama_kode_barang' => 'Bahan Komputer', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 3120, 'nama_kode_barang' => 'Perlengkapan Olahraga', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 3205, 'nama_kode_barang' => 'Obat-obatan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 3114, 'nama_kode_barang' => 'Kertas Cover', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 3110, 'nama_kode_barang' => 'Souvenir', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
