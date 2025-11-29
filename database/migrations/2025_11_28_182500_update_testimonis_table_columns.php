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
        Schema::table('testimonis', function (Blueprint $table) {
            // Rename columns to match new convention
            $table->renameColumn('nama_pemberi_testimoni', 'nama');
            $table->renameColumn('nama_pesantren', 'perusahaan');
            $table->renameColumn('isi_testimoni', 'konten');
            
            // Make unused columns nullable or drop them if not needed
            // For safety, we'll just make them nullable for now in case rollback is needed
            $table->string('foto_url')->nullable()->change();
            $table->date('tanggal_testimoni')->nullable()->change();
            $table->boolean('is_verified')->default(true)->change();
            $table->integer('urutan')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonis', function (Blueprint $table) {
            $table->renameColumn('nama', 'nama_pemberi_testimoni');
            $table->renameColumn('perusahaan', 'nama_pesantren');
            $table->renameColumn('konten', 'isi_testimoni');
        });
    }
};
