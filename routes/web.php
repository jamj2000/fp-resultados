<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ResultadosController;
use App\Http\Controllers\InformesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Rutas públicas
Route::get('info',  function() { 
    return view("info.index"); 
});

Route::get('/', function() {  
    return redirect('/login');
});


Route::get('login',   [LoginController::class, 'show'] );
Route::post('login',  [LoginController::class, 'login'] );

Route::get('informes', [InformesController::class, 'htmlPdf'] );

// Ruta protegidas
// Route::get('logout',  [LoginController::class, 'logout'] )->middleware('auth');
// Route::get('inicio', function(){
//     return view("inicio");
// })->middleware('auth');

// Route::resource('alumnos', AlumnoController::class)->middleware('auth');
// Route::resource('modulos', ModuloController::class)->middleware('auth');
// Route::resource('profesores', ProfesorController::class)->parameters([
//     // IMPORTANTE para el controlador
//     // la instancia no es profesore sino profesor
//     'profesores' => 'profesor' 
// ])->middleware('auth');

// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(['middleware' => ['auth']], function () {
    Route::get('logout',  [LoginController::class, 'logout'] );
    Route::get('inicio', function(){
        return view("inicio");
    });
    
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('modulos', ModuloController::class);
    Route::resource('profesores', ProfesorController::class)->parameters([
        // IMPORTANTE para el controlador
        // la instancia no es profesore sino profesor
        'profesores' => 'profesor' 
    ]);

    Route::resource('resultados', ResultadosController::class)->only([
        'index', 'edit', 'update'
    ]);

    // Route::resource('informes',   InformesController::class)->only([
    //     'htmlPdf'
    // ]);

});


