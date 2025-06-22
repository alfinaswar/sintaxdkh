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
        Schema::create('pm', function (Blueprint $table) {
            $table->id();
            $table->date('Tanggal')->nullable();
            $table->string('ItemID')->nullable();
            $table->enum('Status', ['Baik', 'Kurang Baik', 'Rusak'])->default('Baik');
            $table->string('DikerjakanOleh')->nullable();
            $table->dateTime('DiselesaikanTanggal')->nullable();
            $table->text('Keterangan')->nullable();
            $table->string('KodeRS')->nullable();
            $table->string('Before')->nullable();
            $table->string('After')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pms');
    }
};
