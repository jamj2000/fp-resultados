<?php

class AlumnoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the alumnos
		$alumnos = Alumno::all();

		// load the view and pass the alumnos
		return View::make('alumnos.index')->with('alumnos', $alumnos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    if (Auth::user()->admin == 's'){
		// load the create form (app/views/alumnos/create.blade.php)
		return View::make('alumnos.create');
	    }
	    else 
		return Redirect::to('alumnos');  
		   
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
			'apellido1'   => 'required',
			'nombre'      => 'required'			
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('alumnos/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$alumno = new Alumno;
			$alumno->apellido1    = Input::get('apellido1');
			$alumno->apellido2    = Input::get('apellido2');
			$alumno->nombre       = Input::get('nombre');
			$alumno->curso        = Input::get('curso');
			$alumno->id_escolar   = Input::get('id_escolar');
			$alumno->fecha_nac    = Input::get('fecha_nac');
			$alumno->save();

			// redirect
			Session::flash('message', 'Añadido con éxito');
			return Redirect::to('alumnos');
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
		// get the alumno
		$alumno = Alumno::find($id);
	      
			
		// show the view and pass the alumno to it
		return View::make('alumnos.show')->with('alumno', $alumno);
			
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the alumno
		$alumno = Alumno::find($id);

		$modulos = Modulo::all();  // --
		// show the edit form and pass the alumno
		// return View::make('alumnos.edit')->with('alumno', $alumno);
		return View::make('alumnos.edit')->with('alumno', $alumno)->with('modulos', $modulos); // --
		
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
			'apellido1'      => 'required',
			'nombre'         => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('alumnos/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$alumno = Alumno::find($id);
			$alumno->apellido1    = Input::get('apellido1');
			$alumno->apellido2    = Input::get('apellido2');
			$alumno->nombre       = Input::get('nombre');
			$alumno->curso        = Input::get('curso');
			$alumno->id_escolar   = Input::get('id_escolar');
			$alumno->fecha_nac    = Input::get('fecha_nac');
			$alumno->save();

			//// Relación de Alumnos y Módulos
			$datos=Input::all();                            // Recogemos los datos de todo el formulario
			$ids = array(); 
			foreach ($datos as $key => $value)
			      if (is_numeric($key) && $value === 's')   // Escogemos los campos del checkbox que están pulsados
				    $ids[] = intval($key);              // Añadimos al array ids             
			  
			$alumno->modulos()->sync($ids);               // Sincronizamos información en la base de datos
    
			// redirect
			Session::flash('message', 'Actualizado con éxito');
			return Redirect::to('alumnos/'.$id);
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
		$alumno = Alumno::find($id);
		$alumno->delete();

		// redirect
		Session::flash('message', 'Borrado con éxito');
		return Redirect::to('alumnos');
	    }
	    else 
		return Redirect::to('alumnos');    
	}


}
