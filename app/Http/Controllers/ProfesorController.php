<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the profesores
		$profesores = Profesor::all();

		// load the view and pass the profesores
		return view('profesores.index')->with('profesores', $profesores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->admin == 's') 
            return view('profesores.create');
        else 
            return redirect()->route('profesores'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
	    $request->validate([
			'apellido1'      => 'required',
			'nombre'         => 'required',
			'email'          => 'required|email',
			'password'       => 'required|min:6'
        ]);

        // store
        $profesor = new Profesor;
        $profesor->apellido1    = $request->apellido1;
        $profesor->apellido2    = $request->apellido2;
        $profesor->nombre       = $request->nombre;
        $profesor->email        = $request->email;
        $profesor->password     = Hash::make($request->password);
        $profesor->admin        = $request->admin;
        $profesor->save();

        // redirect
        return redirect('/profesores')->with('message', 'Añadido con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor)
    {
		return view('profesores.show')->with('profesor', $profesor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor $profesor)
    {
        $modulos = Modulo::all(); 
        return view('profesores.edit')->with('profesor', $profesor)->with('modulos', $modulos);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profesor $profesor)
    {
       // validate
       $request->validate([
            'apellido1'      => 'required',
            'nombre'         => 'required',
            // 'tutoria'        => 'unique:profesores,tutoria',
            'email'          => 'required|email',
            'password'       => 'required|min:6'
        ]);

        // store
        $profesor->apellido1    = $request->apellido1;
        $profesor->apellido2    = $request->apellido2;
        $profesor->nombre       = $request->nombre;
        $profesor->tutoria      = $request->tutoria;
        $profesor->email        = $request->email;
        if ($request->password !=  "(No cambiar)") {
            $profesor->password = Hash::make($request->password);
        }
        if (Auth::user()->admin == 's' and $profesor->id != Auth::user()->id) {
            $profesor->admin    = $request->admin;
        }
        $profesor->save();

        $datos=$request->all();                         // Recogemos los datos de todo el formulario
        $ids = []; 
        foreach ($datos as $key => $value)
            if (is_numeric($key) && $value === 's')     // Escogemos los campos del checkbox que están pulsados
                $ids[] = intval($key);                  // Añadimos al array ids 
        
 
        // Des-asociamos todos los modulos del profesor
        DB::table('modulos')->where('profesor_id', '=', $profesor->id)->update(['profesor_id' => '']);
        
        // Asociamos módulos dados de alta
        DB::table('modulos')->whereIn('id', $ids)->update(['profesor_id' => $profesor->id]);
            
        // redirect
        return redirect('/profesores')->with('message', 'Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesor $profesor)
    {
	    if (Auth::user()->admin == 's'){
            // delete
            $profesor->delete();

            // redirect
            return redirect('/profesores')->with('message', 'Borrado con éxito');

        }
        else  return redirect()->route('profesores');  
    }
}
