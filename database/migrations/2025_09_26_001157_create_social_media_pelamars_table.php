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
        Schema::create('social_media_pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')
                ->constrained('pelamars')
                ->onDelete('cascade');
            $table->string('instagram');
            $table->string('linkedin');
            $table->string('website');
            $table->string('twitter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media_pelamars');
    }
};
