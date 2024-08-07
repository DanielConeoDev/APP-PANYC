<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['fuente_id', 'grupo', 'detalles'];

    public function fuente() {
        return $this->belongsTo(Fuente::class);
    }
}
