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
        Schema::create('kalibrasis', function (Blueprint $table) {
            $table->id();
            $table->string('ItemID')->nullable();
            $table->string('NamaDokumen')->nullable();
            $table->date('TanggalBerlaku')->nullable();
            $table->date('TanggalBerakhir')->nullable();
            $table->string('Dokumen')->nullable();
            $table->string('Keterangan')->nullable();
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
        Schema::dropIfExists('kalibrasis');
    }
};
