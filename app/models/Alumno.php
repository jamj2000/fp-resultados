<?php

class Alumno extends Eloquent
{

    public function modulos() {
        return $this->belongsToMany('Modulo', 'modulos_alumnos','alumno_id', 'modulo_id')
               ->withPivot('r1', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'r8', 'r9');
    }

    
    
}
