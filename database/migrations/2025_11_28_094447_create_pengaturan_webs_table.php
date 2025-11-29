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
        Schema::create('pengaturan_webs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga');
            $table->string('slogan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('alamat_lengkap');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->string('telepon');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('hero_image_url')->nullable();
            $table->string('cta_text')->default('Hubungi Sales');
            $table->string('cta_link'); // WhatsApp link
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_webs');
    }
};
