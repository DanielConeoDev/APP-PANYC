<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuente extends Model
{
    use HasFactory;

    protected $fillable = [
        'fuente',
        'pais',
        'fecha_publicacion',
        'url',
        'detalles',
    ];

    public function grupos() {
        return $this->hasMany(Grupo::class);
    }
}
