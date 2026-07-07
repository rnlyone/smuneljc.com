<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inovasi extends Model
{
    use HasFactory;

    protected $table = 'inovasis';

    protected $fillable = [
        'judul',
        'subjudul',
        'link',
        'image_path',
        'video_link',
        'urutan',
    ];
}
