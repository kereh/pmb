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
        Schema::create('data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nik')->unique();
            $table->string('nisn')->unique();
            $table->string('pas_foto');
            $table->string('nama');
            $table->string('nama_ibu_kandung');
            $table->string('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('alamat');
            $table->string('nomor_hp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('agama', ['Kristen Protestan', 'Kristen Katolik', 'Islam', 'Hindu', 'Buddha']);
            $table->enum('pendidikan_terakhir', ['SMA', 'SMK', 'MA', 'MAK']);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->foreignId('program_studi_id')->nullable()->references('id')->on('program_studi')->onDelete('cascade');
            $table->string('ijazah_atau_skl');
            $table->string('kip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
