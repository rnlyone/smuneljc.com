<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $table = 'rekomendasis';

    protected $fillable = [
        'id_departemen',
        'id_kaicho',
        'id_periode',
        'catatan',
        'status',
        'used_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen');
    }

    public function kaicho()
    {
        return $this->belongsTo(Pendaftar::class, 'id_kaicho');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }

    public function katsudos()
    {
        return $this->hasMany(Katsudo::class, 'id_rekomendasi');
    }

    /** Cek apakah masih bisa digunakan */
    public function isAktif(): bool
    {
        return $this->status === 'aktif';
    }
}
