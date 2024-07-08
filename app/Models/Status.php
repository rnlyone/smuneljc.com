<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'id',
        'status',
        'level',
        'img'
    ];

    public function anggotas(){
        return $this->hasMany(Pendaftar::class, 'status');
    }
}
