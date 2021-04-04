<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    public function profesor() {
        return $this->belongsTo(Profesor::class);
    }

    public function alumnos() {
        return $this->belongsToMany(Alumno::class, 'modulos_alumnos', 'modulo_id', 'alumno_id')
               ->withPivot('r1', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'r8', 'r9');
    }



}
