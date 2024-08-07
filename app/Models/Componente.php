<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;

    protected $fillable = ['analisis_id', 'componente', 'detalles'];

    public function analisis()
    {
        return $this->belongsTo(Analisis::class);
    }

    public function itemComponentes()
    {
        return $this->hasMany(ItemComponente::class);
    }
}
