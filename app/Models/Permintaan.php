<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';
    protected $primaryKey = 'id_permintaan';

    protected $fillable = [
        'kode_permintaan',
        'tanggal_permintaan',
        'keperluan',
        'nama_pemohon',
        'id_unitkerja',
    ];

    // Relasi dengan Unit Kerja
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'id_unitkerja');
    }

    // Relasi dengan Detail Permintaan
    public function detailPermintaans()
    {
        return $this->hasMany(DetailPermintaan::class, 'id_permintaan');
    }

    // Relasi dengan Log Activity
    public function logActivities()
    {
        return $this->hasMany(LogActivity::class, 'permintaan_ID');
    }
}
