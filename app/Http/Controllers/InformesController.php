<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Alumno;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class InformesController extends Controller
{
     /**
     * generate PDF file from blade view.
     *
     * @return \Illuminate\Http\Response
     */
    public function htmlPdf()
    {
        // selecting PDF view
        $pdf = PDF::loadView('htmlView');

        // download pdf file
        return $pdf->download('pdfview.pdf');
    }


    public function index()
	{
		$alumnos = Alumno::where('curso', '=', Auth::user()->tutoria)->get();
		$cursos  = '';
		return view('informes.index')->with('alumnos', $alumnos)->with('cursos', $cursos);
	}


	public function show($id)
	{
		// get the modulo
		$alumno = Alumno::find($id);
		
		if ((strpos($alumno->curso,'1FPGM A') !== false)) 
		    return view('informes.gmacalificaciones')->with('alumno', $alumno);
		elseif (strpos($alumno->curso,'1FPGM B') !== false)
		    return view('informes.gmbcalificaciones')->with('alumno', $alumno);
		elseif (strpos($alumno->curso,'2FPGM') !== false){
		    if ($alumno->modulos->contains(1) or $alumno->modulos->contains(2) 
		     or $alumno->modulos->contains(3) or $alumno->modulos->contains(4) or $alumno->modulos->contains(5))
		       return view('informes.gmacalificaciones')->with('alumno', $alumno);
		    else
		       return view('informes.gmbcalificaciones')->with('alumno', $alumno);
		}
		elseif (strpos($alumno->curso,'FPGS') !== false)
		    return view('informes.gscalificaciones')->with('alumno', $alumno);
		else
		    return view('informes.error');
		
	}
	
	public function evaluacion($curso, $medio) {
	    $modulos_id = Modulo::distinct()->select('id')->where('curso', '=', $curso)->get()->toArray();
	    $modulos    = Modulo::whereIn('id', $modulos_id)->get();
	    $a = DB::table('modulos_alumnos')->whereIn('modulo_id', $modulos_id)->pluck('alumno_id'); 
	    $alumnos = Alumno::whereIn('id', $a)->orderBy('apellido1')->orderBy('apellido2')->orderBy('nombre')->get();
	    //$alumnos  = Alumno::where('curso', $curso)->get();	   	    

	    $datos    = Modulo::select('modulos.id as modulo_id', 'profesor_id', 'siglas', 'modulos.nombre as modulo_nombre'
	              , 'num_resultados', 'ciclo', 'curso', 'profesores.nombre as profesor_nombre', 'apellido1', 'apellido2')
	              ->where('curso', $curso)->join('profesores', 'modulos.profesor_id', '=', 'profesores.id')->get(); 

	    $informe  = "informes.evaluacion";	          
	    if ($medio == 'pdf') {
		    // $pdf = PDF::make();
            // $html = view($informe)->with('alumnos', $alumnos)->with('datos',$datos);
            // $options = array('orientation' => 'portrait');
            $data = [
                'alumnos' => $alumnos,
                'datos' => $datos
            ];
            $pdf = PDF::loadView('informes.evaluacion', $data);

            // $pdf->setOptions($options);
            // $pdf->addPage($html);
            // $pdf->send('Evaluación -'.$curso.'.pdf');
            return $pdf->download('Evaluación-'.$curso.'.pdf');
	    }
	    else
		return view($informe)->with('alumnos', $alumnos)->with('datos',$datos);
		    
	}
	
	public function evaluaciones(Request $request) {
	    $cursos=$request->all();                         // Recogemos los datos de todo el formulario 
	    $informe  = "informes.evaluacion";
	    // $pdf = PDF::make();
	    // $options = array('orientation' => 'portrait');
	    // $pdf->setOptions($options);	    
	    foreach ($cursos as $curso => $value) if ($value === 's') {	
	          $curso = strtr ($curso, array ('_' => ' '));
		  
		  $modulos_id = Modulo::distinct()->select('id')->where('curso', '=', $curso)->get()->toArray();
		  $modulos    = Modulo::whereIn('id', $modulos_id)->get();
		  $a = DB::table('modulos_alumnos')->whereIn('modulo_id', $modulos_id)->pluck('alumno_id'); 
		  $alumnos = Alumno::whereIn('id', $a)->orderBy('apellido1')->orderBy('apellido2')->orderBy('nombre')->get();

		  $datos    = Modulo::select('modulos.id as modulo_id', 'profesor_id', 'siglas', 'modulos.nombre as modulo_nombre'
			    , 'num_resultados', 'ciclo', 'curso', 'profesores.nombre as profesor_nombre', 'apellido1', 'apellido2')
			    ->where('curso', $curso)->join('profesores', 'modulos.profesor_id', '=', 'profesores.id')->get(); 

		  $html = view($informe)->with('alumnos', $alumnos)->with('datos',$datos);
		//   $pdf->addPage($html);	
	    }  
	    // $pdf->send('Evaluación - Informática y Comunicaciones.pdf');
		      
	}

	public function calificaciones($id)
	{
	    $pdf = PDF::make();
 
	    $alumno = Alumno::find($id);
		if ((strpos($alumno->curso,'1FPGM A') !== false)) 
		    $html = view('informes.gmacalificaciones')->with('alumno', $alumno);
		elseif (strpos($alumno->curso,'1FPGM B') !== false)
		    $html = view('informes.gmbcalificaciones')->with('alumno', $alumno);
		elseif (strpos($alumno->curso,'2FPGM') !== false){
		    if ($alumno->modulos->contains(1) or $alumno->modulos->contains(2) 
		     or $alumno->modulos->contains(3) or $alumno->modulos->contains(4) or $alumno->modulos->contains(5))
		       $html = view('informes.gmacalificaciones')->with('alumno', $alumno);
		    else
		       $html = view('informes.gmbcalificaciones')->with('alumno', $alumno);
		}
		elseif (strpos($alumno->curso,'FPGS') !== false)
		    $html = view('informes.gscalificaciones')->with('alumno', $alumno);
		else
		    $html = view('informes.error');
	    
	    //$html = view('informes.gmcalificaciones')->with('alumno', $alumno);

	    $options = array('orientation' => 'landscape');
	    $pdf->setOptions($options);
	    $pdf->addPage($html);
	    $pdf->send('Calificaciones - '.$alumno->apellido1.' '.$alumno->apellido2.', '.$alumno->nombre.'.pdf');
	}
	
	
	public function calificacionesvarias($curso)
	{
	
	    $pdf = PDF::make();
	    $options = array('orientation' => 'landscape');
	    
	
	    $datos=$request->all();                         // Recogemos los datos de todo el formulario
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
		
		
		$html = view($informe)->with('alumno', $alumno);
		$pdf->setOptions($options);
		$pdf->addPage($html);
	    }
	
	    $pdf->send('Calificaciones - '.$curso.'.pdf');
	
	}



}
