<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'perusahaan',
        'konten',
        'rating',
        'foto_url',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
        'rating' => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true)->orderBy('created_at', 'desc');
    }
}
