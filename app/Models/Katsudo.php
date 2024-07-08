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
        'tgl_laksana',
        'deskripsi',
        'token',
        'absensi',
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
}
