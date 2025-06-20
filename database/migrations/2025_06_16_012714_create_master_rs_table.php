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
        Schema::create('master_rs', function (Blueprint $table) {
            $table->id();
            $table->string('Nama', 255);
            $table->string('JenisRs', 100)->nullable();
            $table->string('KelasRs', 50)->nullable();
            $table->string('NamaDirektur', 255)->nullable();
            $table->string('Telepon', 50)->nullable();
            $table->string('Email', 100)->nullable();
            $table->text('Alamat')->nullable();
            $table->string('Provinsi', 100)->nullable();
            $table->string('Kota', 100)->nullable();
            $table->string('Kecamatan', 100)->nullable();
            $table->string('KodePos', 10)->nullable();
            $table->string('Website', 255)->nullable();
            $table->string('StatusPenyelenggara', 100)->nullable();
            $table->date('TanggalBerdiri')->nullable();
            $table->string('NomorIzin', 100)->nullable();
            $table->date('TanggalIzin')->nullable();
            $table->string('Logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_rs');
    }
};
