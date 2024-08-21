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
<<<<<<< HEAD
        'keterangan'
=======
        'keterangan',
        'stok_awal',
        'saldo_akhir'
>>>>>>> 94c9f7ef75db53ef6dff63cf4b8e6bdf805dbcd0
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
