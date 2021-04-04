<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;

class Profesor extends Authenticatable
{
    use HasFactory; 

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
    //protected $hidden = array('password', 'remember_token');


    public function modulos() {
            return $this->hasMany(Modulo::class);
    }


}
