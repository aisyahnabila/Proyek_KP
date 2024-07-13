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
        Schema::create('detail_permintaan', function (Blueprint $table) {
            $table->id('id'); // Primary key
            $table->unsignedBigInteger('id_permintaan'); // Foreign key referencing permintaan table
            $table->unsignedBigInteger('id_barang'); // Foreign key referencing barang table
            $table->integer('jumlah_permintaan');
            $table->timestamps();

            // Definisi foreign key constraint
            $table->foreign('id_permintaan')
                ->references('id_permintaan')->on('permintaan')
                ->onDelete('cascade');

            $table->foreign('id_barang')
                ->references('id_barang')->on('barang')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_permintaan');
    }
};
