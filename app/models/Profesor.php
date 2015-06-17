<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Profesor extends Eloquent implements UserInterface, RemindableInterface {

        use UserTrait, RemindableTrait;

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'profesores';

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = array('password', 'remember_token');

    //protected $fillable = array('name', 'taste_level');

 public function modulos() {
        return $this->hasMany('Modulo');
 }


        
}

