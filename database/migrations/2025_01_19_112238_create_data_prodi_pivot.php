<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_prodi_pivot', function (Blueprint $table) {
            $table->foreignUuid('data_id')->references('id')->on('data')->cascadeOnDelete();
            $table->foreignId('program_studi_id')->references('id')->on('program_studi')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_prodi_pivot');
    }
};
