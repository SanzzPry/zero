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
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_pelamar');
            $table->string('deskripsi_diri');
            $table->date('tanggal_lahir');
            $table->enum('gender', [
                'laki-laki',
                'perempuan',
            ])->nullable();
            $table->string('teleponPelamar', 13);
            $table->string('divisi');
            $table->date('mulai_pelatihan');
            $table->date('selesai_pelatihan');
            $table->string('img_profile');
            $table->enum('kategori', [
                'pelamar',
                'calon kandidat',
                'kandidat aktif',
                'kandidat nonaktif',
            ])->nullable();
            $table->string('gaji_minimal');
            $table->string('gaji_maksimal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamars');
    }
};
