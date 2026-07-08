<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katsudo extends Model
{
    use HasFactory;

    protected $table = 'katsudos';

    protected $fillable = [
        'id',
        'nama',
        'ranah',
        'pj',
        'periode',
        'id_rekomendasi',
        'divisi_undangan',
        'tgl_laksana',
        'deskripsi',
        'token',
        'token_at',
        'absensi',
        'absensi_fase',
        'khusus',
        'approve',
    ];

    protected $casts = [
        'divisi_undangan' => 'array',
        'tgl_laksana'     => 'datetime',
        'token_at'        => 'datetime',
        'absensi'         => 'boolean',
    ];

    public function dpt(){
        return $this->belongsTo(Departemen::class, 'ranah');
    }

    public function pj(){
        return $this->belongsTo(Pendaftar::class, 'pj');
    }

    public function kehadirans(){
        return $this->hasMany(Kehadiran::class, 'id_katsudo');
    }

    public function rekomendasi(){
        return $this->belongsTo(Rekomendasi::class, 'id_rekomendasi');
    }

    public function periodeRel(){
        return $this->belongsTo(Periode::class, 'periode');
    }

    /** Cek apakah divisi member diundang dalam katsudo ini */
    public function isDivisiBerlaku(int $departemenId): bool
    {
        // null = semua diundang
        if ($this->divisi_undangan === null) {
            return true;
        }
        return in_array($departemenId, $this->divisi_undangan);
    }
}
