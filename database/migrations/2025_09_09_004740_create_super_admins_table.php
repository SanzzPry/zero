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
        Schema::create('super_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('nama_lengkap')->nullable();
            $table->string('img_profile')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->string('provinsi')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('kota')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('detail_alamat')->nullable();
            $table->string('kode_pos', 10)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('super_admins');
    }
};
