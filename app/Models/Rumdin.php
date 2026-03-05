<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User; 

class Rumdin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rumdin';

    protected $fillable = [
        'tanah_id', // ← TAMBAHAN BARU
        'kategori',
        'polsek_nama',
        'nama_bangunan',
        'type',
        'penghuni',
        'luas',
        'status',
        'kondisi',
        'alamat',
        'keterangan',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'luas' => 'decimal:2',
    ];

    // ========== APPENDS ==========
    protected $appends = ['foto_url', 'kondisi_label', 'kondisi_badge_class', 'status_badge_class', 'kategori_label'];

    // ========== RELATIONSHIPS ==========
    
    // RELASI KE TANAH (BARU)
    public function tanah()
    {
        return $this->belongsTo(Tanah::class, 'tanah_id');
    }
    
    // Relasi ke User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // ========== ACCESSORS ==========
    
    // Foto URL Accessor
    public function getFotoUrlAttribute()
    {
        return $this->foto ? config('filesystem_path.url.rumdin') . '/' . $this->foto : null;
    }

    // Helper method untuk mendapatkan label kondisi
    public function getKondisiLabelAttribute()
    {
        $labels = [
            'B' => 'Baik',
            'RR' => 'Rusak Ringan',
            'RB' => 'Rusak Berat'
        ];
        return $labels[$this->kondisi] ?? $this->kondisi;
    }

    // Helper method untuk mendapatkan badge class kondisi
    public function getKondisiBadgeClassAttribute()
    {
        $classes = [
            'B' => 'bg-success',
            'RR' => 'bg-warning',
            'RB' => 'bg-danger'
        ];
        return $classes[$this->kondisi] ?? 'bg-secondary';
    }

    // Helper method untuk mendapatkan badge class status
    public function getStatusBadgeClassAttribute()
    {
        return $this->status === 'Dihuni' ? 'bg-info' : 'bg-secondary';
    }

    // Helper method untuk mendapatkan kategori label
    public function getKategoriLabelAttribute()
    {
        $labels = [
            'polres_rusus' => 'Polres - Rusus',
            'polres_satpolairud' => 'Polres - Satpolairud',
            'polsek_rumdin' => 'Polsek'
        ];
        
        if ($this->kategori === 'polsek_rumdin' && $this->polsek_nama) {
            return 'Polsek - ' . $this->polsek_nama;
        }
        
        return $labels[$this->kategori] ?? $this->kategori;
    }

    // ========== SCOPES ==========
    
    // Scope untuk filter Polres
    public function scopePolres($query)
    {
        return $query->whereIn('kategori', ['polres_rusus', 'polres_satpolairud']);
    }

    // Scope untuk filter Polsek
    public function scopePolsek($query)
    {
        return $query->where('kategori', 'polsek_rumdin');
    }

    // Scope untuk filter berdasarkan kategori spesifik
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope untuk filter berdasarkan polsek
    public function scopeByPolsek($query, $polsekNama)
    {
        return $query->where('kategori', 'polsek_rumdin')
                     ->where('polsek_nama', $polsekNama);
    }
}