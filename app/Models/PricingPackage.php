<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPackage extends Model
{
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'harga_diskon',
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
        'harga_diskon' => 'decimal:2',
        'fitur' => 'array',
        'is_populer' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    protected $appends = ['formatted_harga', 'formatted_harga_diskon', 'has_discount'];

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true)->orderBy('urutan');
    }

    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getFormattedHargaDiskonAttribute()
    {
        if ($this->harga_diskon === null) {
            return null;
        }

        return 'Rp ' . number_format($this->harga_diskon, 0, ',', '.');
    }

    public function getHasDiscountAttribute()
    {
        if ($this->harga_diskon === null) {
            return false;
        }

        $diskon = (float) $this->harga_diskon;
        $harga = (float) $this->harga;

        return $diskon > 0 && ($harga === 0.0 || $diskon < $harga);
    }

    public function scopePopuler($query)
    {
        return $query->where('is_populer', true);
    }
}
