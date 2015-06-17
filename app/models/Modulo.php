<?php

class Modulo extends Eloquent
{





   //protected $fillable = array('name', 'taste_level');

    public function profesor() {
        return $this->belongsTo('Profesor');
    }


    public function alumnos() {
        return $this->belongsToMany('Alumno', 'modulos_alumnos', 'modulo_id', 'alumno_id')
               ->withPivot('r1', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'r8', 'r9');
    }





}
