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
        Schema::create('data_inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('NoInventaris')->nullable();
            $table->string('ItemID')->nullable();
            $table->string('SerialNumber')->nullable();
            $table->string('Merk')->nullable();
            $table->string('Tipe')->nullable();
            $table->string('TanggalBeli')->nullable();
            $table->string('Departemen')->nullable();
            $table->string('Unit')->nullable();
            $table->enum('Jenis', ['MEDIS', 'NON-MEDIS'])->nullable();
            $table->string('ManualBook')->nullable();
            $table->enum('Klasifikasi', ['HIGH-RISK', 'MEDIUM-RISK', 'LOW-RISK'])->nullable();
            $table->string('Keterangan')->nullable();
            $table->string('Gambar')->nullable();
            $table->string('KodeRS')->nullable();
            $table->string('IdUser')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_inventaris');
    }
};
