<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerja';
    protected $primaryKey = 'id_unitkerja';

    protected $fillable = [
        'nama_unit_kerja',
    ];

    // Relasi dengan Permintaan
    public function permintaans()
    {
        return $this->hasMany(Permintaan::class, 'id_unitkerja');
    }

}
