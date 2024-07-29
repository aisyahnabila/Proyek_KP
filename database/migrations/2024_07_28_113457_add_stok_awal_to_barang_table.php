<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStokAwalToBarangTable extends Migration
{
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
        });
    }
}
