<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit_kerja')->insert([
            ['nama_unit_kerja' => 'Divisi Sub.Bag.Umum dan Kepegawaian', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Divisi Sumber Daya dan Sosial', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Divisi Sub.Bag.Keuangan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
