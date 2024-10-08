<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'alimento', 'grupo_id', 'parte_id'];

    public function itemComponentes()
    {
        return $this->hasMany(ItemComponente::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function parte()
    {
        return $this->belongsTo(ParteAnalizada::class);
    }

}
