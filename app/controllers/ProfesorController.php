<?php

class ProfesorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the profesores
		$profesores = Profesor::all();

		// load the view and pass the profesores
		return View::make('profesores.index')->with('profesores', $profesores);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Auth::user()->admin == 's'){
		  // load the create form (app/views/profesores/create.blade.php)
		  return View::make('profesores.create');
		}
		else 
		  return Redirect::to('profesores');
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
			'apellido1'      => 'required',
			'nombre'         => 'required',
			'email'          => 'required|email',
			'password'       => 'required|min:6'
			);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('profesores/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$profesor = new Profesor;
			$profesor->apellido1    = Input::get('apellido1');
			$profesor->apellido2    = Input::get('apellido2');
			$profesor->nombre       = Input::get('nombre');
			$profesor->email        = Input::get('email');
			$profesor->password     = Hash::make(Input::get('password'));
			$profesor->admin        = Input::get('admin');
			$profesor->save();

			// redirect
			Session::flash('message', 'Añadido con éxito');
			return Redirect::to('profesores');
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
		// get the profesor
		$profesor = Profesor::find($id);
	      
			
		// show the view and pass the profesor to it
		return View::make('profesores.show')->with('profesor', $profesor);
			
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the profesor
		$profesor = Profesor::find($id);

		$modulos = Modulo::all();  // --
		// show the edit form and pass the profesor
		// return View::make('profesores.edit')->with('profesor', $profesor);
		return View::make('profesores.edit')->with('profesor', $profesor)->with('modulos', $modulos); // --
		
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
			'nombre'         => 'required',
			'email'          => 'required|email',
			'password'       => 'required|min:6'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('profesores/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$profesor = Profesor::find($id);
			$profesor->apellido1    = Input::get('apellido1');
			$profesor->apellido2    = Input::get('apellido2');
			$profesor->nombre       = Input::get('nombre');
			$profesor->tutoria      = Input::get('tutoria');
			$profesor->email        = Input::get('email');
			if (Input::get('password') !=  "(No cambiar)") {
			    $profesor->password = Hash::make(Input::get('password'));
			}
			if (Auth::user()->admin == 's' and $profesor->id != Auth::user()->id) {
			    $profesor->admin    = Input::get('admin');
			}
			$profesor->save();

			/* PARA RELACIONES MUCHOS A MUCHOS UTILIZAMOS FUNCIÓN SYNC
			//// Relación de Profesores y Módulos
			$datos=Input::all();                            // Recogemos los datos de todo el formulario
			$ids = array(); 
			foreach ($datos as $key => $value)
			      if (is_numeric($key) && $value === 's')   // Escogemos los campos del checkbox que están pulsados
				    $ids[] = intval($key);              // Añadimos al array ids             
			  
			$profesor->modulos()->sync($ids);               //// Sincronizamos información en la base de datos
			*/
			
			/* PARA RELACIONES UNO A MUCHOS NO PUEDE USARSE FUNCIÓN SYNC */
			$datos=Input::all();                            // Recogemos los datos de todo el formulario
			$ids = array(); 
			foreach ($datos as $key => $value)
			      if (is_numeric($key) && $value === 's')   // Escogemos los campos del checkbox que están pulsados
				    $ids[] = intval($key);              // Añadimos al array ids 
			
			
			// Des-asociamos todos los modulos del profesor
			DB::table('modulos')->where('profesor_id', '=', $profesor->id)->update(array('profesor_id' => ''));
			
			// Asociamos módulos dados de alta
			DB::table('modulos')->whereIn('id', $ids)->update(array('profesor_id' => $profesor->id));
				
					
		      
			/***  Redirección final ***/
			Session::flash('message', 'Actualizado con éxito');
			return Redirect::to('profesores/'.$id);
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
		    $profesor = Profesor::find($id);
		    $profesor->delete();

		    // redirect
		    Session::flash('message', 'Borrado con éxito');
		    return Redirect::to('profesores');
	  	}
		else 
		    return Redirect::to('profesores');
		
		
	}

}
