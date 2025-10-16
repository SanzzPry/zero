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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('namaPerusahaan')->nullable();
            $table->string('jenisPerusahaan')->nullable();
            $table->string('websitePerusahaan')->nullable();
            $table->string('teleponPerusahaan')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('legalitas')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('visi')->nullable();
            $table->string('misi')->nullable();
            $table->integer('koinPerusahaan')->nullable();
            $table->string('is_berlangganan')->nullable();
            $table->string('img_profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
