<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanWeb extends Model
{
    protected $fillable = [
        'nama_lembaga',
        'slogan',
        'deskripsi',
        'alamat_lengkap',
        'kota',
        'provinsi',
        'kode_pos',
        'telepon',
        'email',
        'website',
        'logo_url',
        'hero_image_url',
        'cta_text',
        'cta_link',
        'is_aktif',
        'slider_images',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
        'slider_images' => 'array',
    ];

    public static function cacheKey()
    {
        return 'pengaturan_web_global';
    }
}
