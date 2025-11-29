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
        Schema::create('pricing_packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->text('deskripsi');
            $table->decimal('harga', 12, 2);
            $table->string('periode'); // bulanan, tahunan, lifetime
            $table->json('fitur'); // JSON array of features
            $table->boolean('is_populer')->default(false);
            $table->string('cta_text')->default('Pilih Paket');
            $table->string('cta_link')->nullable(); // WhatsApp or payment link
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
        Schema::dropIfExists('pricing_packages');
    }
};
