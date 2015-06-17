<?php

class ResultadosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$modulos = Modulo::where('profesor_id', '=', Auth::user()->id)->get();;
		return View::make('resultados.index')->with('modulos', $modulos);
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modulo = Modulo::find($id);
		return View::make('resultados.edit')->with('modulo', $modulo);
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	     $modulo = Modulo::find($id);
	     
	     foreach($modulo->alumnos as $alumno) {
	         $alumno->pivot->r1 = Input::get('r1_'.$alumno->id);
	         $alumno->pivot->r2 = Input::get('r2_'.$alumno->id);
	         $alumno->pivot->r3 = Input::get('r3_'.$alumno->id);
	         $alumno->pivot->r4 = Input::get('r4_'.$alumno->id);
	         $alumno->pivot->r5 = Input::get('r5_'.$alumno->id);
	         $alumno->pivot->r6 = Input::get('r6_'.$alumno->id);
	         $alumno->pivot->r7 = Input::get('r7_'.$alumno->id);
	         $alumno->pivot->r8 = Input::get('r8_'.$alumno->id);
	         $alumno->pivot->r9 = Input::get('r9_'.$alumno->id);

	         $alumno->push();  // Debemos utilizar PUSH (SAVE no se aplica aquí)
	     }
	
	    /***  Redirección final ***/
	    Session::flash('message', 'Actualizado con éxito');
	    return Redirect::to('resultados/'.$id.'/edit');

        }

        
}