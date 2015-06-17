<?php

class InformesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$alumnos = Alumno::where('curso', '=', Auth::user()->tutoria)->get();
		$cursos  = '';
		return View::make('informes.index')->with('alumnos', $alumnos)->with('cursos', $cursos);
	}


	public function show($id)
	{
		// get the modulo
		$alumno = Alumno::find($id);
		
		if ((strpos($alumno->curso,'1FPGM A') !== false)) 
		    return View::make('informes.gmacalificaciones')->with('alumno', $alumno);
		elseif (strpos($alumno->curso,'1FPGM B') !== false)
		    return View::make('informes.gmbcalificaciones')->with('alumno', $alumno);
		elseif (strpos($alumno->curso,'2FPGM') !== false){
		    if ($alumno->modulos->contains(1) or $alumno->modulos->contains(2) 
		     or $alumno->modulos->contains(3) or $alumno->modulos->contains(4) or $alumno->modulos->contains(5))
		       return View::make('informes.gmacalificaciones')->with('alumno', $alumno);
		    else
		       return View::make('informes.gmbcalificaciones')->with('alumno', $alumno);
		}
		elseif (strpos($alumno->curso,'FPGS') !== false)
		    return View::make('informes.gscalificaciones')->with('alumno', $alumno);
		else
		    return View::make('informes.error');
		
	}
	
	public function evaluacion($curso, $medio) {
	    //
	    $modulos_id = Modulo::distinct()->select('id')->where('curso', '=', $curso)->get()->toArray();
	    $modulos    = Modulo::whereIn('id', $modulos_id)->get();
	    $a = DB::table('modulos_alumnos')->whereIn('modulo_id', $modulos_id)->lists('alumno_id'); 
	    $alumnos = Alumno::whereIn('id', $a)->orderBy('apellido1')->orderBy('apellido2')->orderBy('nombre')->get();
	    //$alumnos  = Alumno::where('curso', $curso)->get();	   	    

	    $datos    = Modulo::select('modulos.id as modulo_id', 'profesor_id', 'siglas', 'modulos.nombre as modulo_nombre'
	              , 'num_resultados', 'ciclo', 'curso', 'profesores.nombre as profesor_nombre', 'apellido1', 'apellido2')
	              ->where('curso', $curso)->join('profesores', 'modulos.profesor_id', '=', 'profesores.id')->get(); 

	    $informe  = "informes.evaluacion";	          
	    if ($medio == 'pdf') {
		$pdf = PDF::make();
		$html = View::make($informe)->with('alumnos', $alumnos)->with('datos',$datos);

		$options = array('orientation' => 'portrait');
		$pdf->setOptions($options);
		$pdf->addPage($html);
		$pdf->send('Evaluación -'.$curso.'.pdf');
	    }
	    else
		return View::make($informe)->with('alumnos', $alumnos)->with('datos',$datos);
		    
	}
	
	public function evaluaciones() {
	    $cursos=Input::all();                         // Recogemos los datos de todo el formulario 
	    $informe  = "informes.evaluacion";
	    $pdf = PDF::make();
	    $options = array('orientation' => 'portrait');
	    $pdf->setOptions($options);	    
	    foreach ($cursos as $curso => $value) if ($value === 's') {	
	          $curso = strtr ($curso, array ('_' => ' '));
		  
		  $modulos_id = Modulo::distinct()->select('id')->where('curso', '=', $curso)->get()->toArray();
		  $modulos    = Modulo::whereIn('id', $modulos_id)->get();
		  $a = DB::table('modulos_alumnos')->whereIn('modulo_id', $modulos_id)->lists('alumno_id'); 
		  $alumnos = Alumno::whereIn('id', $a)->orderBy('apellido1')->orderBy('apellido2')->orderBy('nombre')->get();

		  $datos    = Modulo::select('modulos.id as modulo_id', 'profesor_id', 'siglas', 'modulos.nombre as modulo_nombre'
			    , 'num_resultados', 'ciclo', 'curso', 'profesores.nombre as profesor_nombre', 'apellido1', 'apellido2')
			    ->where('curso', $curso)->join('profesores', 'modulos.profesor_id', '=', 'profesores.id')->get(); 

		  $html = View::make($informe)->with('alumnos', $alumnos)->with('datos',$datos);
		  $pdf->addPage($html);	
	    }  
	    $pdf->send('Evaluación - Informática y Comunicaciones.pdf');
		      
	}

	public function calificaciones($id)
	{
	    $pdf = PDF::make();
 
	    $alumno = Alumno::find($id);
		if ((strpos($alumno->curso,'1FPGM A') !== false)) 
		    $html = View::make('informes.gmacalificaciones')->with('alumno', $alumno);
		elseif (strpos($alumno->curso,'1FPGM B') !== false)
		    $html = View::make('informes.gmbcalificaciones')->with('alumno', $alumno);
		elseif (strpos($alumno->curso,'2FPGM') !== false){
		    if ($alumno->modulos->contains(1) or $alumno->modulos->contains(2) 
		     or $alumno->modulos->contains(3) or $alumno->modulos->contains(4) or $alumno->modulos->contains(5))
		       $html = View::make('informes.gmacalificaciones')->with('alumno', $alumno);
		    else
		       $html = View::make('informes.gmbcalificaciones')->with('alumno', $alumno);
		}
		elseif (strpos($alumno->curso,'FPGS') !== false)
		    $html = View::make('informes.gscalificaciones')->with('alumno', $alumno);
		else
		    $html = View::make('informes.error');
	    
	    //$html = View::make('informes.gmcalificaciones')->with('alumno', $alumno);

	    $options = array('orientation' => 'landscape');
	    $pdf->setOptions($options);
	    $pdf->addPage($html);
	    $pdf->send('Calificaciones - '.$alumno->apellido1.' '.$alumno->apellido2.', '.$alumno->nombre.'.pdf');
	}
	
	
	public function calificacionesvarias($curso)
	{
	
	    $pdf = PDF::make();
	    $options = array('orientation' => 'landscape');
	    
	
	    $datos=Input::all();                         // Recogemos los datos de todo el formulario
	    $ids = array(); 
	    foreach ($datos as $key => $value)
	       if (is_numeric($key) && $value === 's')   // Escogemos los campos del checkbox que están pulsados
		    $ids[] = intval($key);  
		    
	    foreach ($ids as $id) {
		$alumno = Alumno::find($id);
		
		if ((strpos($alumno->curso,'1FPGM A') !== false)) 
		    $informe = 'informes.gmacalificaciones';
		elseif (strpos($alumno->curso,'1FPGM B') !== false)
		    $informe = 'informes.gmbcalificaciones';
		elseif (strpos($alumno->curso,'2FPGM') !== false){
		    if ($alumno->modulos->contains(1) or $alumno->modulos->contains(2) 
		     or $alumno->modulos->contains(3) or $alumno->modulos->contains(4) or $alumno->modulos->contains(5))
		       $informe = 'informes.gmacalificaciones';
		    else
		       $informe = 'informes.gmbcalificaciones';
		}
		elseif (strpos($alumno->curso,'FPGS') !== false)
		    $informe = 'informes.gscalificaciones';
		else
		    $informe = 'informes.error';
		
		
		$html = View::make($informe)->with('alumno', $alumno);
		$pdf->setOptions($options);
		$pdf->addPage($html);
	    }
	
	    $pdf->send('Calificaciones - '.$curso.'.pdf');
	
	}

}