<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'angkatan',
        'tahun_mulai'
    ];

    public function keaktifans(){
        return $this->hasMany(Keaktifan::class, 'id_periode');
    }
}
