<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'penguruses';

    protected $fillable = [
        'id',
        'Posisi',
        'NamaLengkap',
        'ImagePath',
        'LinkedIn',
        'Discord',
        'Instagram',
    ];
}
