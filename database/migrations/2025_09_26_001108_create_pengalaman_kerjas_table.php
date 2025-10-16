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
        Schema::create('pengalaman_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')
                ->constrained('pelamars')
                ->onDelete('cascade');
            $table->string('posisi_pekerjaan');
            $table->string('jabatan_pekerjaan');
            $table->string('nama_perusahaan');
            $table->string('tahun_awal');
            $table->string('tahun_akhir');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalaman_kerjas');
    }
};
