<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang'); // Primary key
            $table->unsignedBigInteger('id_kategori'); // Foreign key referencing kategori table
            $table->string('nama_barang');
            $table->string('spesifikasi_nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->timestamps();

            // Definisi foreign key constraint
            $table->foreign('id_kategori')
                ->references('id_kategori')->on('kategori') // Pastikan kolom yang dirujuk sesuai
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
