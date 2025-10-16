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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_pelamar')->nullable();
            $table->string('deskripsi_diri')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('gender', [
                'laki-laki',
                'perempuan',
            ])->nullable();
            $table->string('teleponPelamar', 13)->nullable();
            $table->string('divisi')->nullable();
            $table->date('mulai_pelatihan')->nullable();
            $table->date('selesai_pelatihan')->nullable();
            $table->string('img_profile')->nullable();
            $table->enum('kategori', [
                'pelamar',
                'calon kandidat',
                'kandidat aktif',
                'kandidat nonaktif',
            ])->default('kandidat aktif');
            $table->enum('status', [
                'banned',
                'unbanned',
            ])->default('unbanned');
            $table->string('alasan_freeze')->nullable();
            $table->string('gaji_minimal')->nullable();
            $table->string('gaji_maksimal')->nullable();
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
