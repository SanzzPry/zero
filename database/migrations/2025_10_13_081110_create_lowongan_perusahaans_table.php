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
        Schema::create('lowongan_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')->constrained('perusahaans')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->string('slug')->nullable();
            $table->string('jenis')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->string('gaji_awal')->nullable();
            $table->string('gaji_akhir')->nullable();
            $table->string('label_gaji')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kategori')->nullable();
            $table->date('batas_lamaran')->nullable();
            $table->string('syarat_pekerjaan')->nullable();
            $table->string('tanggung_jawab')->nullable();
            $table->string('benefit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_perusahaans');
    }
};
