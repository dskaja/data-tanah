<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mushola extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mushola';

    protected $fillable = [
        'tanah_id', // ← TAMBAHAN BARU
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

    // ========== RELATIONSHIPS ==========
    
    // RELASI KE TANAH (BARU)
    public function tanah()
    {
        return $this->belongsTo(Tanah::class, 'tanah_id');
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // ========== ACCESSORS ==========
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset(config('filesystem_path.url.mushola') . '/' . $this->foto) : null;
    }
}