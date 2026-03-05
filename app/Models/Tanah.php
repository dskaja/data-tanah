<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanah extends Model
{
    use HasFactory;

    protected $table = 'tanah';

    protected $fillable = [
        'kategori',
        'polsek_nama',
        'nama',
        'luas_seluruhnya',
        'luas_tanah_bangunan',
        'luas_tanah_sarana',
        'status',
        'alamat',
        'foto',
        'keterangan',
        'jenis_lokasi',
        'created_by',
        'updated_by'
    ];

    // 🔥 RELASI KE USER (PEMBUAT)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // 🔥 RELASI KE USER (PENGUPDATE)
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relasi ke Kantor
    public function kantors()
    {
        return $this->hasMany(Kantor::class, 'tanah_id');
    }

    // Relasi ke Rumdin
    public function rumdins()
    {
        return $this->hasMany(Rumdin::class, 'tanah_id');
    }

    // Relasi ke Barak
    public function baraks()
    {
        return $this->hasMany(Barak::class, 'tanah_id');
    }

    // Relasi ke Mushola
    public function musholas()
    {
        return $this->hasMany(Mushola::class, 'tanah_id');
    }

    // Relasi ke Garasi
    public function garasis()
    {
        return $this->hasMany(Garasi::class, 'tanah_id');
    }
}