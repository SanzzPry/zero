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
        Schema::create('catatan_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_referensi')->nullable();
            $table->string('dari')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('tunai')->nullable();
            $table->string('koin')->nullable();
            $table->string('pesanan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_transaksis');
    }
};
