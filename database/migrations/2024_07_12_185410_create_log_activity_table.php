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
            $table->integer('jumlah_masuk')->default(0);
            $table->integer('jumlah_keluar')->default(0);
            $table->integer('sisa');
            $table->unsignedBigInteger('id_permintaan')->nullable();
            $table->timestamps();

            // Definisi foreign key constraint
            $table->foreign('id_barang')
                ->references('id_barang')->on('barang')
                ->onDelete('cascade');

            $table->foreign('id_permintaan')
                ->references('id_permintaan')->on('permintaan')
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
