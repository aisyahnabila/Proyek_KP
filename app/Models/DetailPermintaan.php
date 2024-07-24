<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    use HasFactory;

    protected $table = 'detail_permintaan';
    // protected $primaryKey = 'id_log';

    protected $primaryKey = 'id_detail_permintaan';

    protected $fillable = [
        'id_barang',
        'id_permintaan',
        'jumlah_permintaan',
        'keterangan'
    ];

    // Relasi dengan Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // Relasi dengan Permintaan
    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'id_permintaan');
    }
}
