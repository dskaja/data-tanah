<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',        // 🔥 TAMBAHKAN INI
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // 🔥 RELASI: User yang membuat data tanah
    public function createdTanahs()
    {
        return $this->hasMany(Tanah::class, 'created_by');
    }

    // 🔥 RELASI: User yang update data tanah
    public function updatedTanahs()
    {
        return $this->hasMany(Tanah::class, 'updated_by');
    }
}