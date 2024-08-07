<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParteAnalizada extends Model
{
    use HasFactory;

    protected $fillable = ['parte', 'detalles'];

    public function alimentos() {
        return $this->hasMany(Alimento::class);
    }

}
