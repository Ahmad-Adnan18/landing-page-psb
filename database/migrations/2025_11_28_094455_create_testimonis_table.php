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
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pesantren');
            $table->string('nama_pemberi_testimoni');
            $table->string('jabatan')->nullable();
            $table->text('isi_testimoni');
            $table->integer('rating')->default(5); // 1-5 stars
            $table->string('foto_url')->nullable();
            $table->date('tanggal_testimoni');
            $table->boolean('is_verified')->default(true);
            $table->integer('urutan')->default(0);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonis');
    }
};
