<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'spesifikasi_nama_barang',
        'jumlah',
        'satuan',
        'id_kategori',
    ];

    // Relasi dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi dengan Detail Permintaan
    public function detailPermintaans()
    {
        return $this->hasMany(DetailPermintaan::class, 'id_barang');
    }

    // Relasi dengan Log Activity
    public function logActivities()
    {
        return $this->hasMany(LogActivity::class, 'id_barang');
    }
}
