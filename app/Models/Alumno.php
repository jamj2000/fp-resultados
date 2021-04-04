<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    public function modulos() {
        return $this->belongsToMany(Modulo::class, 'modulos_alumnos','alumno_id', 'modulo_id')
               ->withPivot('r1', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'r8', 'r9');
    }

}
