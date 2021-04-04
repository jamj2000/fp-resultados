<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Alumno;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the modulos
        $modulos = Modulo::all();

        // load the view and pass the modulos
        return view('modulos.index')->with('modulos', $modulos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->admin == 's') 
            return view('modulos.create');
        else 
            return redirect()->route('modulos');  
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
            'nombre'           =>  'required|max:100',
			'curso'            =>  'required|max:100',
			'num_resultados'   =>  'required|numeric'
        ]);

        // store
        $modulo = new Modulo;
        $modulo->nombre          = $request->nombre;
        $modulo->curso           = $request->curso;
        $modulo->ciclo           = $request->ciclo;
        $modulo->horas_totales   = $request->horas_totales;
        $modulo->horas_semanales = $request->horas_semanales;
        $modulo->num_resultados  = $request->num_resultados;
        $modulo->r1_peso         = '10';
        $modulo->r2_peso         = '10';
        $modulo->r3_peso         = '10';
        $modulo->r4_peso         = '10';
        $modulo->r5_peso         = '10';
        $modulo->r6_peso         = '10';
        $modulo->r7_peso         = '10';
        $modulo->r8_peso         = '10';
        $modulo->r9_peso         = '10';
        $modulo->save();

        // redirect
        return redirect('/modulos')->with('message', 'Añadido con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $modulo)
    {
		return view('modulos.show')->with('modulo', $modulo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $modulo)
    {
		$nivel = "%".substr($modulo->curso,1,4)."%";		
		
		$alumnos_curso = Alumno::where('curso', '=', $modulo->curso)
                                ->orderBy('apellido1', 'asc')
                                ->get();
		$alumnos_otros = Alumno::where('curso', 'LIKE', $nivel)
		                         ->where('curso', 'NOT LIKE', $modulo->curso)
                                 ->orderBy('apellido1', 'asc')
		                         ->get();
		                         
		$profesores = Profesor::all();
		// show view
		return view('modulos.edit')
			->with('modulo', $modulo)
			->with('profesores', $profesores)
			->with('alumnos_curso', $alumnos_curso)
			->with('alumnos_otros', $alumnos_otros);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulo $modulo)
    {
        // validate
        $request->validate([
            // 'nombre'           =>  'required|max:100',
			// 'curso'            =>  'required|max:100',
			// 'num_resultados'   =>  'required|numeric'
        ]);

        // store
        //$modulo->nombre          = $request->nombre;
        //$modulo->curso           = $request->curso;
        //$modulo->ciclo           = $request->ciclo;
        //$modulo->horas_totales   = $request->horas_totales;
        //$modulo->horas_semanales = $request->horas_semanales;
        //$modulo->num_resultados  = $request->num_resultados;
        for ($i=1; $i <= 9; $i++) {
            $r  = '$modulo->r'.$i.'_peso';  
            $rr = '$request->r'.$i.'_peso';  
            eval ("return $r = $rr;");
        } 
        /*
        $modulo->r1_peso         = $request->r1_peso;
        $modulo->r2_peso         = $request->r2_peso;
        $modulo->r3_peso         = $request->r3_peso;
        $modulo->r4_peso         = $request->r4_peso;
        $modulo->r5_peso         = $request->r5_peso;
        $modulo->r6_peso         = $request->r6_peso;
        $modulo->r7_peso         = $request->r7_peso;
        $modulo->r8_peso         = $request->r8_peso;
        $modulo->r9_peso         = $request->r9_peso;
        */
        $modulo->profesor_id     = $request->profesor;
        $modulo->save();

        /* PARA RELACIONES MUCHOS A MUCHOS UTILIZAMOS FUNCIÓN SYNC */
        //// Relación de Alumnos y Módulos
        $datos=$request->all();                        // Recogemos los datos de todo el formulario
        $ids = array(); 
        foreach ($datos as $key => $value)
            if (is_numeric($key) && $value === 's')    // Escogemos los campos del checkbox que están pulsados
                $ids[] = intval($key);                 // Añadimos al array ids             
            
        $modulo->alumnos()->sync($ids);                //// Sincronizamos información en la base de datos
			
        // redirect
        return redirect('/modulos')->with('message', 'Actualizado con éxito');			
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulo $modulo)
    {
	    if (Auth::user()->admin == 's'){
            // delete
            $modulo->delete();

            // redirect
            return redirect('/modulos')->with('message', 'Borrado con éxito');

        }
        else return redirect()->route('modulos');   
    }
}
