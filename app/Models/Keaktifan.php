<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keaktifan extends Model
{
    use HasFactory;

    protected $table = 'keaktifans';

    protected $fillable = [
        'id',
        'id_anggota',
        'id_periode',
        'jumlah_absen',
        'jumlah_izin',
        'jumlah_th',
        'jumlah_absen_berturut',
        'jumlah_izin_berturut',
        'jumlah_th_berturut',
    ];

    public function periode(){
        return $this->belongsTo(Periode::class, 'id_periode');
    }

    public function anggota(){
        return $this->belongsTo(Pendaftar::class, 'id_anggota');
    }
}
