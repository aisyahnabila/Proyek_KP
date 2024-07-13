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
        Schema::create('log_activity', function (Blueprint $table) {
            $table->id('id_log'); // Primary key
            $table->unsignedBigInteger('id_barang'); // Foreign key referencing barang table
            $table->timestamp('timestamp');
            $table->string('status');
            $table->integer('sisa');
            $table->unsignedBigInteger('id_permintaan');
            $table->timestamps();

            // Definisi foreign key constraint
            $table->foreign('id_barang')
                ->references('id_barang')->on('barang')
                ->onDelete('cascade');

            $table->foreign('id_permintaan')
                ->references('id_permintaan')->on('permintaan') // Pastikan kolom yang dirujuk sesuai
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_activity');
    }
};
