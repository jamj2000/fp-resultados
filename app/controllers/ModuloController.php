<?php

class ModuloController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the modulos
		$modulos = Modulo::all();

		// load the view and pass the modulos
		return View::make('modulos.index')->with('modulos', $modulos);
	}


	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    if (Auth::user()->admin == 's'){		
		// load the create form (app/views/modulos/create.blade.php)
		return View::make('modulos.create');
	    }
	    else
		 return Redirect::to('modulos');	   
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'nombre'           =>  array('required', 'max:100'),
			'curso'            =>  array('required', 'max:100'),
			'num_resultados'   =>  array('required', 'numeric')
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('modulos/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$modulo = new Modulo;
			$modulo->nombre          = Input::get('nombre');
			$modulo->curso           = Input::get('curso');
			$modulo->ciclo           = Input::get('ciclo');
			$modulo->horas_totales   = Input::get('horas_totales');
			$modulo->horas_semanales = Input::get('horas_semanales');
			$modulo->num_resultados  = Input::get('num_resultados');
			$modulo->r1_peso	 = '10';
			$modulo->r2_peso	 = '10';
			$modulo->r3_peso	 = '10';
			$modulo->r4_peso	 = '10';
			$modulo->r5_peso	 = '10';
			$modulo->r6_peso	 = '10';
			$modulo->r7_peso	 = '10';
			$modulo->r8_peso	 = '10';
			$modulo->r9_peso	 = '10';
			$modulo->save();

			// redirect
			Session::flash('message', 'Añadido con éxito');
			return Redirect::to('modulos');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the modulo
		$modulo = Modulo::find($id);

		// show the view and pass the modulo to it
		return View::make('modulos.show')
			->with('modulo', $modulo);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the modulo
		$modulo = Modulo::find($id);

		$nivel = "%".substr($modulo->curso,1,4)."%";		
		
		$alumnos_curso = Alumno::where('curso', '=', $modulo->curso)->get();
		$alumnos_otros = Alumno::where('curso', 'LIKE', $nivel)
		                         ->where('curso', 'NOT LIKE', $modulo->curso)
		                         ->get();
		                         
		$profesores = Profesor::all();
		// show the edit form and pass the modulo
		return View::make('modulos.edit')
			->with('modulo', $modulo)
			->with('profesores', $profesores)
			->with('alumnos_curso', $alumnos_curso)
			->with('alumnos_otros', $alumnos_otros);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			//'nombre'           =>  array('required', 'max:100'),
			//'curso'            =>  array('required', 'max:100'),
			//'num_resultados'   =>  array('required', 'numeric')
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('modulos/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$modulo = Modulo::find($id);
			//$modulo->nombre          = Input::get('nombre');
			//$modulo->curso           = Input::get('curso');
			//$modulo->ciclo           = Input::get('ciclo');
			//$modulo->horas_totales   = Input::get('horas_totales');
			//$modulo->horas_semanales = Input::get('horas_semanales');
			//$modulo->num_resultados  = Input::get('num_resultados');
			$modulo->r1_peso         = Input::get('r1_peso');
			$modulo->r2_peso         = Input::get('r2_peso');
			$modulo->r3_peso         = Input::get('r3_peso');
			$modulo->r4_peso         = Input::get('r4_peso');
			$modulo->r5_peso         = Input::get('r5_peso');
			$modulo->r6_peso         = Input::get('r6_peso');
			$modulo->r7_peso         = Input::get('r7_peso');
			$modulo->r8_peso         = Input::get('r8_peso');
			$modulo->r9_peso         = Input::get('r9_peso');
			$modulo->profesor_id     = Input::get('profesor');
			$modulo->save();

			/* PARA RELACIONES MUCHOS A MUCHOS UTILIZAMOS FUNCIÓN SYNC */
			//// Relación de Alumnos y Módulos
			$datos=Input::all();                            // Recogemos los datos de todo el formulario
			$ids = array(); 
			foreach ($datos as $key => $value)
			      if (is_numeric($key) && $value === 's')   // Escogemos los campos del checkbox que están pulsados
				    $ids[] = intval($key);              // Añadimos al array ids             
			  
			$modulo->alumnos()->sync($ids);                 //// Sincronizamos información en la base de datos
			
						
			// redirect
			Session::flash('message', 'Actualizado con éxito');
			return Redirect::to('modulos/'.$id);
			
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    if (Auth::user()->admin == 's'){
		// delete
		$modulo = Modulo::find($id);
		$modulo->delete();

		// redirect
		Session::flash('message', 'Borrado con éxito');
		return Redirect::to('modulos');
	    }
	    else
	    	return Redirect::to('modulos');
	    
	}

}
