<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the alumnos
		$alumnos = Alumno::all();

		// load the view and pass the alumnos
		return view('alumnos.index')->with('alumnos', $alumnos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->admin == 's') 
            return view('alumnos.create');
        else 
            return redirect()->route('alumnos');  
        // return redirect()->action([AlumnoController::class, 'index']);
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
            'apellido1' => 'required',
            'nombre' => 'required',
        ]);

        // store
        $alumno = new Alumno;
        $alumno->apellido1    = $request->apellido1;
        $alumno->apellido2    = $request->apellido2;
        $alumno->nombre       = $request->nombre;
        $alumno->curso        = $request->curso;
        $alumno->id_escolar   = $request->id_escolar;
        $alumno->fecha_nac    = $request->fecha_nac;
        $alumno->save();

        // redirect
        return redirect('/alumnos')->with('message', 'Añadido con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        return view('alumnos.show')->with('alumno', $alumno);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        $modulos = Modulo::all(); 

        return view('alumnos.edit')->with('alumno', $alumno)->with('modulos', $modulos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        // validate
		$request->validate([
            'apellido1' => 'required',
            'nombre' => 'required',
        ]);

        // store
        $alumno->apellido1    = $request->apellido1;
        $alumno->apellido2    = $request->apellido2;
        $alumno->nombre       = $request->nombre;
        $alumno->curso        = $request->curso;
        $alumno->id_escolar   = $request->id_escolar;
        $alumno->fecha_nac    = $request->fecha_nac;
        $alumno->save();

        //// Relación de Alumnos y Módulos
        $datos=$request->all();                        // Recogemos los datos de todo el formulario
        $ids = array(); 
        foreach ($datos as $key => $value)
            if (is_numeric($key) && $value === 's')    // Escogemos los campos del checkbox que están pulsados
                $ids[] = intval($key);                 // Añadimos al array ids             
            
        $alumno->modulos()->sync($ids);                // Sincronizamos información en la base de datos

        // redirect
        return redirect('/alumnos/'.$alumno->id)->with('message', 'Actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        if (Auth::user()->admin == 's'){
            // delete
            $alumno->delete();
    
            // redirect
            return redirect('/alumnos')->with('message', 'Borrado con éxito');

        }
        else return redirect()->route('alumnos');    
    }
}
