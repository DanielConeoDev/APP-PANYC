<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemComponente extends Model
{
    use HasFactory;

    protected $fillable = ['alimento_id', 'analisis_id', 'componente_id', 'valor'];

    public function alimento()
    {
        return $this->belongsTo(Alimento::class);
    }

    public function analisis()
    {
        return $this->belongsTo(Analisis::class);
    }

    public function componente()
    {
        return $this->belongsTo(Componente::class);
    }
}
