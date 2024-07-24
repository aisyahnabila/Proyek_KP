<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unit_kerja')->insert([
            ['nama_unit_kerja' => 'Divisi IT', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Divisi HRD', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Divisi Keuangan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Divisi Pemasaran', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Divisi Produksi', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
