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
            ['nama_unit_kerja' => 'Sub Bagian Penyusunan Program dan Anggaran', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Sub Bagian Keuangan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Sub Bagian Umum dan Kepegawaian', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Pengelolaan Data Fakir Miskin', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Pendataan Fakir Miskin', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Penyelenggaran & Perlindungan Jaminan Sosial', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Bencana Alam', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Bencana Sosial', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Penanganan Khusus Bagi Kelompok Rentan dan Layanan Dukungan Psikososial', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Kepahlawanan, Keperintisan dan Kesetiakawanan Sosial', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Partisipasi Sosial Masyarakat, Pengelolaan Sumber Dana Kesejahteraan Sosial', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Kewirausahaan Sosial dan Penyuluhan Sosial', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Rehabilitasi Sosial Tuna Sosial', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Rehabilitasi Sosial Disabilitas', 'created_at' => now(), 'updated_at' => now()],
            ['nama_unit_kerja' => 'Seksi Rehabilitasi Sosial Anak dan Lanjut Usia', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
