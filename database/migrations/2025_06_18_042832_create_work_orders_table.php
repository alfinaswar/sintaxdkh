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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->date('Tanggal')->nullable();
            $table->string('ItemID')->nullable();
            $table->string('Departemen')->nullable();
            $table->string('Unit')->nullable();
            $table->string('Judul')->nullable();
            $table->text('Kasus')->nullable();
            $table->enum('KategoriKasus', ['HARDWARE', 'SOFTWARE'])->nullable();
            $table->enum('Prioritas', ['Rendah', 'Sedang', 'Tinggi', 'Kritis']);
            $table->string('DitugaskanKe')->nullable();
            $table->string('DitugaskanOleh')->nullable();
            $table->dateTime('DitugaskanTanggal')->nullable();
            $table->dateTime('TanggalResponse')->nullable();
            $table->enum('StatusID', ['Open', 'In Progress', 'Pending', 'Closed', 'Cancelled'])->default('Open');
            $table->string('DiselesaikanOleh')->nullable();
            $table->dateTime('DiselesaikanTanggal')->nullable();
            $table->text('Keterangan')->nullable();
            $table->integer('Penilaian')->nullable();
            $table->string('PenilaianOleh')->nullable();
            $table->string('KodeRS')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
