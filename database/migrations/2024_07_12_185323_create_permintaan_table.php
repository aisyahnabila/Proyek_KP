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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id('id_permintaan'); // Primary key
            $table->unsignedBigInteger('id_unitkerja'); // Foreign key referencing unit_kerja table
            $table->unsignedBigInteger('id_barang'); // Foreign key referencing barang table
            $table->string('kode_permintaan');
            $table->date('tanggal_permintaan');
            $table->string('nama_pemohon');
            $table->text('keperluan');
            $table->string('evidance')->nullable();
            $table->timestamps();

            // Definisi foreign key constraint
            $table->foreign('id_unitkerja')
                ->references('id_unitkerja')->on('unit_kerja') // Pastikan kolom yang dirujuk sesuai
                ->onDelete('cascade');

            $table->foreign('id_barang')
                ->references('id_barang')->on('barang') // Pastikan kolom yang dirujuk sesuai
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
};
