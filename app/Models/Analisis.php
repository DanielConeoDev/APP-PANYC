<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    use HasFactory;

    protected $fillable = ['analisis', 'detalles'];

    public function componentes()
    {
        return $this->hasMany(Componente::class);
    }

    public function itemComponentes()
    {
        return $this->hasMany(ItemComponente::class);
    }

}
