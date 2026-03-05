<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kantor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kantor';

    protected $fillable = [
        'tanah_id', // ← TAMBAHAN BARU
        'kategori',
        'polsek_nama',
        'nama',
        'luas_bangunan',
        'bangunan_di_atas',
        'alamat',
        'foto',
        'keterangan',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'luas_bangunan' => 'decimal:2'
    ];

    // Accessor otomatis tersedia
    protected $appends = ['foto_url', 'kategori_label'];

    // ========== RELATIONSHIPS ==========
    
    // RELASI KE TANAH (BARU)
    public function tanah()
    {
        return $this->belongsTo(Tanah::class, 'tanah_id');
    }
    
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    // ========== ACCESSORS ==========
    
    /**
     * Get Foto URL - Support Cloud & Local Storage
     */
    public function getFotoUrlAttribute()
    {
        if (!$this->foto) {
            return null;
        }
        
        return asset(config('filesystem_path.url.kantor') . '/' . $this->foto);
    }

    /**
     * Get Kategori Label
     */
    public function getKategoriLabelAttribute()
    {
        return $this->kategori === 'kantor_polres' 
            ? 'Kantor Polres' 
            : 'Kantor Polsek';
    }
}