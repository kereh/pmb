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
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('jurusan');
            $table->string('tanggal_lahir');
            $table->string('no_telp_pribadi');
            $table->string('no_telp_orang_tua');
            $table->string('asal_daerah_provinsi');
            $table->string('asal_daerah_kabupaten_kota');
            $table->string('asal_sekolah');
            $table->string('rekomendasi')->nullable();


            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('agama', ['Kristen Protestan', 'Kristen Katolik', 'Islam', 'Hindu', 'Buddha']);

            $table->string('pas_foto');
            $table->string('ijazah_skl')->nullable();
            $table->string('ktp_akte');
            $table->string('kartu_keluarga');
            $table->string('kip')->nullable();

            $table->foreignId('program_studi_pertama')->nullable()->references('id')->on('program_studi')->onDelete('cascade');
            $table->foreignId('program_studi_kedua')->nullable()->references('id')->on('program_studi')->onDelete('cascade');

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
