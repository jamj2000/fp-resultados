<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ResultadosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$modulos = Modulo::where('profesor_id', '=', Auth::user()->id)->get();
		return view('resultados.index')->with('modulos', $modulos);
	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  edit(int $id)
	{
        $modulo = Modulo::find($id);
		return view('resultados.edit')->with('modulo', $modulo);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, int $id)
	{
        $modulo = Modulo::find($id);
        foreach($modulo->alumnos as $alumno) { 
            for ($i=1; $i <= 9; $i++) {
                $r  = '$alumno->pivot->r'.$i;  
                $rr = '$request->r'.$i.'_'.$alumno->id;  
                eval ("return $r = $rr;");
            } 
            // $alumno->pivot->r1 = $request->r1_.$alumno->id;
            // $alumno->pivot->r2 = $request->r2_.$alumno->id;
            // $alumno->pivot->r3 = $request->r3_.$alumno->id;
            // $alumno->pivot->r4 = $request->r4_.$alumno->id;
            // $alumno->pivot->r5 = $request->r5_.$alumno->id;
            // $alumno->pivot->r6 = $request->r6_.$alumno->id;
            // $alumno->pivot->r7 = $request->r7_.$alumno->id;
            // $alumno->pivot->r8 = $request->r8_.$alumno->id;
            // $alumno->pivot->r9 = $request->r9_.$alumno->id;

            $alumno->push();  // Debemos utilizar PUSH (SAVE no se aplica aquí)
        }
	
        // redirect
       return redirect('/resultados/'.$modulo->id.'/edit')->with('message', 'Actualizado con éxito');

    }

        
}