<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $table = 'log_activity';
    protected $primaryKey = 'id_log_barang';

    protected $fillable = [
        'id_barang',
        'timestamp',
        'sisa',
        'status',
        'permintaan_ID',
    ];

    // Relasi dengan Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // Relasi dengan Permintaan
    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'permintaan_ID');
    }
}
