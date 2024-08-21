<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStokAwalToBarangTable extends Migration
{
<<<<<<< HEAD
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->integer('stok_awal')->nullable()->after('jumlah');
        });
    }

    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('stok_awal');
=======
    public function up(): void
    {
        Schema::table('detail_permintaan', function (Blueprint $table) {
            $table->integer('stok_awal')->after('jumlah_permintaan');
            $table->integer('saldo_akhir')->after('stok_awal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_permintaan', function (Blueprint $table) {
            $table->dropColumn('stok_awal');
            $table->dropColumn('saldo_akhir');
>>>>>>> 94c9f7ef75db53ef6dff63cf4b8e6bdf805dbcd0
        });
    }
}
