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
        Schema::create('master_merks', function (Blueprint $table) {
            $table->id();
            $table->string('Merk', 255)->nullable();
            $table->string('KodeRS', 255)->nullable();
            $table->string('IdUser', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_merks');
    }
};
