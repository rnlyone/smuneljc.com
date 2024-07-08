<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'id',
        'id_anggota',
        'judul_pesan',
        'isi_pesan',
        'icon',
        'color',
        'status_read'
    ];


    public function anggota(){
        return $this->belongsTo(Pendaftar::class, 'id_anggota');
    }
}
