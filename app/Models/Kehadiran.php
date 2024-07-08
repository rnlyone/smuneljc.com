<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadirans';

    protected $fillable = [
        'id',
        'id_katsudo',
        'id_anggota',
        'status_absen',
    ];

    public function anggota(){
        return $this->belongsTo(Pendaftar::class, 'id_anggota');
    }

    public function katsudo(){
        return $this->belongsTo(Katsudo::class, 'id_katsudo');
    }
}
