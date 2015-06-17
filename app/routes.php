<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/




Route::get('/', function()
{  
    return Redirect::to('login');
});


Route::get('hola', function()
{  
       $pdf = PDF::make();
//       $html = View::make('login');
       $options = array('orientation' => 'landscape');
       $pdf->setOptions($options);
//       $pdf->addPage($html);
       $pdf->addPage('<html><head></head><body><b>Hola Mundo</b></body></html>');
       $pdf->send('Hola.pdf');
	
});




// route to show the login form
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));




// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function()
{
   Route::get('inicio', function()
   {
   	return View::make("inicio");
   });

   Route::get('logout', array('uses' => 'HomeController@doLogout'));
   
   Route::get('informacion',  function() { return View::make("informacion.index"); });

   Route::get('informes/evaluacion/{curso}/{medio}', array('uses' => 'InformesController@evaluacion'));
   Route::post('informes/evaluaciones', array('uses' => 'InformesController@evaluaciones'));
   
   Route::get('informes/calificaciones/{id}', array('uses' => 'InformesController@calificaciones'));
   Route::post('informes/calificacionesvarias/{curso}', array('uses' => 'InformesController@calificacionesvarias'));

   Route::resource('alumnos',    'AlumnoController');
   Route::resource('modulos',    'ModuloController');
   Route::resource('profesores', 'ProfesorController');
   Route::resource('resultados', 'ResultadosController');
   Route::resource('informes',   'InformesController');

   
});
