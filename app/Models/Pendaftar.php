<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pendaftar extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'pendaftar';


    protected $fillable = [
        'id',
        'NamaLengkap',
        'NISN',
        'Kelas',
        'JK',
        'NoWA',
        'Instagram',
        'PIN',
        'tahun_daftar',
        'departemen',
        'status',
        'nomor_anggota',
        'foto_anggota'
    ];

    protected $hidden = ['PIN'];

    public $timestamps = false;


    public function dpt(){
        return $this->belongsTo(Departemen::class, 'departemen');
    }

    public function sts(){
        return $this->belongsTo(Status::class, 'status');
    }

    public function activities(){
        return $this->hasMany(Activity::class, 'id_anggota');
    }

    public function katsudos(){
        return $this->hasMany(Katsudo::class, 'pj');
    }

    public function keaktifans(){
        return $this->hasMany(Keaktifan::class, 'id_anggota');
    }

    public function kehadirans(){
        return $this->hasMany(Kehadiran::class, 'id_anggota');
    }
}
