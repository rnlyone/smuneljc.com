<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemens';

    protected $fillable = [
        'id',
        'nama',
        'level',
        'kyokucho',
        'icon',
        'img',
    ];

    public function anggotas(){
        return $this->hasMany(Pendaftar::class, 'departemen');
    }

    public function koor(){
        return $this->belongsTo(Pendaftar::class, 'kyokucho');
    }

    public function katsudos(){
        return $this->hasMany(Katsudo::class, 'ranah');
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->attributes['nama']);
    }
}
