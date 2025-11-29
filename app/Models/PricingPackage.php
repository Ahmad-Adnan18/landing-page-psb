<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPackage extends Model
{
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'periode',
        'fitur',
        'is_populer',
        'cta_text',
        'cta_link',
        'urutan',
        'is_aktif',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'fitur' => 'array',
        'is_populer' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    protected $appends = ['formatted_harga'];

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true)->orderBy('urutan');
    }

    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function scopePopuler($query)
    {
        return $query->where('is_populer', true);
    }
}
