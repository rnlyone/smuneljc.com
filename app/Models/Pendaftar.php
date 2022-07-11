<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'NamaLengkap',
        'NISN',
        'Kelas',
        'JK',
        'NoWA',
        'Instagram',
        'PIN'
    ];
}
