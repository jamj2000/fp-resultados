<html>
<!--This file was converted to xhtml by LibreOffice - see http://cgit.freedesktop.org/libreoffice/core/tree/filter/source/xslt for the code.-->
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<title>Evaluación</title>
<style type="text/css">
	@page {  }
	table { border-collapse:collapse; border-spacing:0; empty-cells:show }
	td, th { vertical-align:top; font-size:12pt;}
	h1, h2, h3, h4, h5, h6 { clear:both }
	ol, ul { margin:0; padding:0;}
	li { list-style: none; margin:0; padding:0;}
	<!-- "li span.odfLiEnd" - IE 7 issue-->
	li span. { clear: both; line-height:0; width:0; height:0; margin:0; padding:0; }
	span.footnodeNumber { padding-right:1em; }
	span.annotation_style_by_filter { font-size:95%; font-family:Arial; background-color:#fff000;  margin:0; border:0; padding:0;  }
	* { margin:0;}
	
	@font-face {
	   font-family: "Ubuntu Condensed";
	   src: url("{{URL::asset('fonts/Ubuntu-Condensed.ttf')}}") /* TTF file for CSS3 browsers */
	}	
	
	#pag2 {
	  position: absolute;
	  top: 31cm;
	} 

	body { 
	  max-width:21.001cm;
	  padding-top:1.5cm; 
	  margin-top:2cm; margin-bottom:2cm; margin-left:2cm; margin-right:2cm; writing-mode:lr-tb;
	}
	
	.H { 
          margin-bottom:0cm; margin-top:0cm;
	  font-size:14pt; font-family:Arial; writing-mode:page; font-style:normal; font-weight:bold;
	}
	
	.T_17cm  {  width:17cm; float:none; }
	
	.T_evaluacion { width:17cm; margin-left:0cm; margin-right:auto;}		
	.Table_20_Contents { font-size:12pt; font-family:Liberation Serif; writing-mode:page; }	
	
	.P_fecha  { 
	  margin-bottom:0.212cm; margin-top:0cm;
	  font-family:Arial; writing-mode:page;  
	  font-size:12pt; font-weight:bold; margin-bottom:0cm; 
	 }

	.celda { padding:0.097cm; 
	    border-left-width:thin; border-left-style:solid; border-left-color:#000000; 
	    border-right-width:thin; border-right-style:solid; border-right-color:#000000; 
	    border-top-width:thin; border-top-style:solid; border-top-color:#000000;
	    border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000;
	}
	
	.gris  { background-color:#bbbbbb; }

	.alumno { text-align:left;   width:9.5cm;}           
	.res    { text-align:center; width:1.5cm;}           
	
	.firma { 
	      text-align:right;width:8.5cm; 
	      height: 2.5cm; display: table-cell; vertical-align: middle;
	}
		
	.normal  { font-size:10pt; font-family:Ubuntu Condensed; writing-mode:page; }
	.negrita { font-size:10pt; font-family:Ubuntu Condensed;  writing-mode:page; font-weight:bold;}
	

	
</style>

<script>

function rellenar_datos() {

@foreach($datos as $dato)
document.getElementById("pm{{$dato->modulo_id}}").innerHTML 
  = "{{$dato->profesor_nombre.' '.$dato->apellido1.' '.$dato->apellido2}}<br>{{ $dato->siglas.': '.$dato->modulo_nombre }}";
<?php $modulos_id[] = $dato->modulo_id; ?>
@endforeach

<?php 
$curso = $dato->curso; 
$ciclo = $dato->ciclo;
?>


@foreach($alumnos as $alumno)

@foreach($alumno->modulos as $mod) 	     
@if (in_array($mod->id, $modulos_id))
      document.getElementById("a{{$alumno->id}}-m{{$mod->id}}").style.background = "white"; 
      <?php 
      $resultados_suspensos=""; 
      for ($i = 1; $i <= $mod->num_resultados; $i++){
	/* Obtenemos nota con el siguiente código PHP. No encontre mejor manera de hacerlo. */
	$str="$"."mod->pivot->r".$i; $nota = eval ("return $str;"); 
	if ($nota=='0' or $nota=='1' or $nota=='2' or $nota=='3' or $nota=='4')  $resultados_suspensos .= "$i";	
      }
      echo "document.getElementById(\"a$alumno->id-m$mod->id\").innerHTML = \"$resultados_suspensos\";";
      ?>

@endif  
@endforeach


@endforeach

}
</script>

</head>

<body dir="ltr" onload="rellenar_datos()">

        <div id="pag1">
	<table class="T_17cm">
	<tr>
	<td> {{ HTML::image('img/logo.png', 'IES Guadalpeña', array('style' => 'width:7cm')) }} </td>
	<td class="H" style="text-align: right; vertical-align: bottom;">INFORME DE EVALUACIÓN - Pág. 1/2</td>
	</tr>
	</table>
	
	<table class="T_17cm">
	<tr><td><h2 class="H">{{ $ciclo }}</h2></td></tr>
	</table>
	<p class="P_fecha">Resultados no superados</p> 
	<br><br>

	<table class="T_17cm">
	<tr>
	<td style="text-align:left;width:7.997cm; ">
	<p class="P_fecha">{{ $curso }}</p>
	</td>
	<td style="text-align:right;width:8.703cm; " >
	<p class="P_fecha">Fecha: {{gmdate("j-m-Y,  G:i", time() + 3600*('+1'+date("I"))); }}</p>
	</td>
	</tr>
	</table>

	<table class="T_evaluacion">
	
	<tr>
	<td class="celda alumno"><p class="negrita">Alumno/a</p></td>
	@foreach($datos as $dato)
	<td class="celda"><p class="negrita">{{ $dato->siglas.' ('.$dato->num_resultados.')'}}</p></td>
	@endforeach
	</tr>

	
	@foreach ($alumnos as $alumno) 
	<tr>
	
	<td class="celda alumno"><p class="normal">{{ $alumno->apellido1.' '.$alumno->apellido2.', '.$alumno->nombre }}</p></td>
	@foreach($datos as $dato)
	<td class="celda res gris normal" id="a{{$alumno->id}}-m{{$dato->modulo_id}}"></td>
	@endforeach
	
	</tr>
	@endforeach


	</table>
	</div>

		
	<div  id="pag2">
	<table class="T_17cm">
	<tr>
	<td> {{ HTML::image('img/logo.png', 'IES Guadalpeña', array('style' => 'width:7cm')) }} </td>
	<td class="H" style="text-align: right; vertical-align: bottom;">INFORME DE EVALUACIÓN - Pág. 2/2</td>
	</tr>
	</table>
	
	<table class="T_17cm">
	<tr><td><h2 class="H">{{ $ciclo }}</h2></td></tr>
	</table>
	<p class="P_fecha">Profesorado</p>
	<br><br>
	
	<table class="T_17cm">
	<tr>
	<td style="text-align:left;width:7.997cm; ">
	<p class="P_fecha">Curso: {{ $curso }}</p>
	</td>
	<td style="text-align:right;width:8.703cm; " >
	<p class="P_fecha">Fecha: {{gmdate("j-m-Y,  G:i", time() + 3600*('+1'+date("I"))); }}</p>
	</td>
	</tr>
	</table>

	

	<table class="T_17cm">
	@foreach($datos as $dato)
	<tr>
	<td class="celda firma"><p class="negrita" id="pm{{$dato->modulo_id}}"></p></td><td class="celda"></td>
	</tr>
	@endforeach
	</table>

	<br><br><br><br>
	</div>

</body>
</html>