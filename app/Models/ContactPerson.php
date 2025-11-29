<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'telepon',
        'email',
        'whatsapp',
        'bio',
        'foto_url',
        'urutan',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true)->orderBy('urutan');
    }
}
