<html>
<!--This file was converted to xhtml by LibreOffice - see http://cgit.freedesktop.org/libreoffice/core/tree/filter/source/xslt for the code.-->
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<title>Calificaciones</title>
<style type="text/css">
	@page { }
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

	body { 
	  max-width:29.7cm;
	  padding-top:1.5cm; 
	  margin-bottom:1cm; margin-left:2cm; margin-right:2cm; writing-mode:lr-tb; 
	}
	
	.H { 
          margin-bottom:0cm; margin-top:0cm;
	  font-size:14pt; font-family:Arial; writing-mode:page; font-style:normal; font-weight:bold;
	}
	
	.T_25cm  {  width:25.7cm; float:none; }
	
	.T_12cm  { width:12.85cm; padding:0.097cm; text-align:left;
	border-left-style:none; border-right-style:none;
	border-top-width:thin; border-top-style:solid; border-top-color:#000000; 
	border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; 
	}

	.T_cursos, .T_leyenda { 
	background-color:#eeeeee; padding:0.097cm; 
	border-left-style:none; border-right-style:none; 
	border-top-width:thin; border-top-style:solid; border-top-color:#000000; 
	border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; 
	vertical-align: middle;
	}
	
	.T_resultados {  width:12.654cm; float:none; }

	
	.celda { 
	  padding:0.097cm; text-align:center;width:1.406cm;
	  border-width:thin; border-style:solid; border-color:#000000;  
	 }
	.gris  { background-color:#808080; }	
	.datos { font-size:12pt; font-family:Arial; writing-mode:page; font-style:normal; font-weight:bold; }

	.P_orden, .P_cursos, .P_alumno  { 
	  margin-bottom:0.212cm; margin-top:0cm;
	  font-family:Arial; writing-mode:page;  
	 }
	.P_orden {  font-size:10pt; } 
	
	.P_cursos, .P_alumno { font-size:12pt; font-weight:bold; margin-bottom:0cm; }
	
	.P_modulo   { font-size:11pt; font-family:Arial;  writing-mode:page; font-weight:bold; }
	.P_leyenda  { font-size:12pt; font-family:Arial;  writing-mode:page; display: inline-block; }
	
	img  {  vertical-align: middle; }
	
	span {  vertical-align: middle;   display: inline-block; }
	
	
</style>




<script>

function rellenar_datos() {

@foreach($alumno->modulos as $modulo) 	     

      @for ($i = 1; $i <= $modulo->num_resultados; $i++)
        <?php /* Obtenemos nota con el siguiente código PHP. No encontre mejor manera de hacerlo. */ ?>
	<?php $str="$"."modulo->pivot->r".$i; $nota = eval ("return $str;"); ?>
        @if ($nota == '-2')  
        document.getElementById("m{{$modulo->id}}-r{{$i}}").innerHTML = "<img src={{URL::to('img/iconos/punto.png')}} width=16>"
        @elseif ($nota == '-1')
        document.getElementById("m{{$modulo->id}}-r{{$i}}").innerHTML = "<img src={{URL::to('img/iconos/asterisco.png')}} width=16>"
        @else
            @if ($nota < 5)
            document.getElementById("m{{$modulo->id}}-r{{$i}}").innerHTML = "<img src={{URL::to('img/iconos/menos.png')}} width=16>"
            @else
            document.getElementById("m{{$modulo->id}}-r{{$i}}").innerHTML = "<img src={{URL::to('img/iconos/mas.png')}} width=16>"
            @endif
        @endif
      @endfor
  
@endforeach

           
}
</script>


</head>
	
	
<body dir="ltr" onload="rellenar_datos()">
	

	
	<table class="T_25cm">
	<tr>
	<td> {{ HTML::image('img/logo.png', 'IES Guadalpeña', array('style' => 'width:7cm')) }} </td>
	<td class="H" style="text-align: right; vertical-align: bottom;">INFORME DE RESULTADOS DE APRENDIZAJE</td>
	</tr>
	</table>
	
	<table class="T_25cm">
	<tr><td><h2 class="H">CICLO FORMATIVO DE GRADO MEDIO - SISTEMAS MICROINFORMÁTICOS Y REDES</h2></td></tr>
	<tr><td><p class="P_orden">ORDEN de 7 de julio de 2009</p></td></tr>
	</table>
	
	<table class="T_25cm">
	<tr>
	<td style="text-align:left;width:16.997cm; ">
	<p class="P_alumno">Alumno/a: {{ $alumno->apellido1.' '.$alumno->apellido2.', '.$alumno->nombre}}</p>
	</td>
	<td style="text-align:right;width:8.703cm; " >
	<p class="P_alumno">Fecha: {{gmdate("j-m-Y,  G:i", time() + 3600*('+1'+date("I"))); }}</p>
	</td>
	</tr>
	</table>
	<table class="T_25cm">
	<colgroup><col width="562"/><col width="562"/></colgroup>
	<tr>
	<td class="T_cursos"><p class="P_cursos">1º CURSO</p></td>
	<td class="T_cursos"><p class="P_cursos">2º CURSO</p></td>
	</tr>
	
	<tr>
	<td class="T_12cm">
	<p class="P_modulo">Montaje y mantenimiento de equipos.</p> {{-- 6 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m6-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m6-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m6-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m6-r4"> </p></td>
	<td class="celda">     <p class="datos" id="m6-r5"> </p></td>
	<td class="celda">     <p class="datos" id="m6-r6"> </p></td>
	<td class="celda">     <p class="datos" id="m6-r7"> </p></td>
	<td class="celda">     <p class="datos" id="m6-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m6-r9"> </p></td>
	</tr>
	</table>
	</td>
	<td class="T_12cm"><p class="P_modulo"> </p></td>
	</tr>
	
	
	<tr>
	<td class="T_12cm">
	<p class="P_modulo">Sistemas operativos monopuesto.</p> {{-- 7 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m7-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m7-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m7-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m7-r4"> </p></td>
	<td class="celda">     <p class="datos" id="m7-r5"> </p></td>
	<td class="celda gris"><p class="datos" id="m7-r6"> </p></td>
	<td class="celda gris"><p class="datos" id="m7-r7"> </p></td>
	<td class="celda gris"><p class="datos" id="m7-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m7-r9"> </p></td>
	</tr>
	</table>
	</td>
	<td class="T_12cm">
	<p class="P_modulo">Sistemas operativos en red.</p> {{-- 17 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m17-r1"></p></td>
	<td class="celda">     <p class="datos" id="m17-r2"></p></td>
	<td class="celda">     <p class="datos" id="m17-r3"></p></td>
	<td class="celda">     <p class="datos" id="m17-r4"></p></td>
	<td class="celda">     <p class="datos" id="m17-r5"></p></td>
	<td class="celda">     <p class="datos" id="m17-r6"></p></td>
	<td class="celda gris"><p class="datos" id="m17-r7"></p></td>
	<td class="celda gris"><p class="datos" id="m17-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m17-r9"> </p></td>
	</tr>
	</table>
	</td>
	</tr>
	
	
	<tr>
	<td class="T_12cm">
	<p class="P_modulo">Redes locales.</p> {{-- 9 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m9-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m9-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m9-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m9-r4"> </p></td>
	<td class="celda">     <p class="datos" id="m9-r5"> </p></td>
	<td class="celda">     <p class="datos" id="m9-r6"> </p></td>
	<td class="celda gris"><p class="datos" id="m9-r7"> </p></td>
	<td class="celda gris"><p class="datos" id="m9-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m9-r9"> </p></td>
	</tr>
	</table>
	</td>
	<td class="T_12cm">
	<p class="P_modulo">Servicios en red.</p>{{-- 19 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m19-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m19-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m19-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m19-r4"> </p></td>
	<td class="celda">     <p class="datos" id="m19-r5"> </p></td>
	<td class="celda">     <p class="datos" id="m19-r6"> </p></td>
	<td class="celda">     <p class="datos" id="m19-r7"> </p></td>
	<td class="celda">     <p class="datos" id="m19-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m19-r9"> </p></td>
	</tr>
	</table>
	</td>
	</tr>
	
	<tr>
	<td class="T_12cm">
	<p class="P_modulo">Aplicaciones ofimáticas.</p>{{-- 8 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda"><p class="datos" id="m8-r1"> </p></td>
	<td class="celda"><p class="datos" id="m8-r2"> </p></td>
	<td class="celda"><p class="datos" id="m8-r3"> </p></td>
	<td class="celda"><p class="datos" id="m8-r4"> </p></td>
	<td class="celda"><p class="datos" id="m8-r5"> </p></td>
	<td class="celda"><p class="datos" id="m8-r6"> </p></td>
	<td class="celda"><p class="datos" id="m8-r7"> </p></td>
	<td class="celda"><p class="datos" id="m8-r8"> </p></td>
	<td class="celda"><p class="datos" id="m8-r9"> </p></td>
	</tr>
	</table>
	</td>
	<td class="T_12cm">
	<p class="P_modulo">Aplicaciones web.</p> {{-- 20 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m20-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m20-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m20-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m20-r4"> </p></td>
	<td class="celda">     <p class="datos" id="m20-r5"> </p></td>
	<td class="celda gris"><p class="datos" id="m20-r6"> </p></td>
	<td class="celda gris"><p class="datos" id="m20-r7"> </p></td>
	<td class="celda gris"><p class="datos" id="m20-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m20-r9"> </p></td>
	</tr>
	</table>
	</td>
	</tr>
	
	
	<tr>
	<td class="T_12cm">
	<p class="P_modulo"> </p>
	</td>
	<td class="T_12cm">
	<p class="P_modulo">Seguridad informática.</p>{{-- 18 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m18-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m18-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m18-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m18-r4"> </p></td>
	<td class="celda">     <p class="datos" id="m18-r5"> </p></td>
	<td class="celda gris"><p class="datos" id="m18-r6"> </p></td>
	<td class="celda gris"><p class="datos" id="m18-r7"> </p></td>
	<td class="celda gris"><p class="datos" id="m18-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m18-r9"> </p></td>
	</tr>
	</table>
	</td>
	</tr>
	
	
	<tr>
	<td class="T_12cm">
	<p class="P_modulo">Formación y orientación laboral.</p>{{-- 10 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m10-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m10-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m10-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m10-r4"> </p></td>
	<td class="celda">     <p class="datos" id="m10-r5"> </p></td>
	<td class="celda">     <p class="datos" id="m10-r6"> </p></td>
	<td class="celda">     <p class="datos" id="m10-r7"> </p></td>
	<td class="celda gris"><p class="datos" id="m10-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m10-r9"> </p></td>
	</tr>
	</table>
	</td>
	<td class="T_12cm">
	<p class="P_modulo"> </p>
	</td>
	</tr>
	
	
	<tr>
	<td class="T_12cm">
	<p class="P_modulo"> </p>
	</td>
	<td class="T_12cm">
	<p class="P_modulo">Empresa e iniciativa empresarial.</p> {{-- 21 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m21-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m21-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m21-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m21-r4"> </p></td>
	<td class="celda gris"><p class="datos" id="m21-r5"> </p></td>
	<td class="celda gris"><p class="datos" id="m21-r6"> </p></td>
	<td class="celda gris"><p class="datos" id="m21-r7"> </p></td>
	<td class="celda gris"><p class="datos" id="m21-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m21-r9"> </p></td>
	</tr>
	</table>
	</td>
	</tr>
	
	
	<tr>
	<td class="T_12cm">
	<p class="P_modulo"> </p>
	</td>
	<td class="T_12cm">
	<p class="P_modulo">Formación en centros de trabajo</p>{{-- 22 --}}
	<table class="T_resultados">
	<tr>
	<td class="celda">     <p class="datos" id="m22-r1"> </p></td>
	<td class="celda">     <p class="datos" id="m22-r2"> </p></td>
	<td class="celda">     <p class="datos" id="m22-r3"> </p></td>
	<td class="celda">     <p class="datos" id="m22-r4"> </p></td>
	<td class="celda">     <p class="datos" id="m22-r5"> </p></td>
	<td class="celda">     <p class="datos" id="m22-r6"> </p></td>
	<td class="celda">     <p class="datos" id="m22-r7"> </p></td>
	<td class="celda">     <p class="datos" id="m22-r8"> </p></td>
	<td class="celda gris"><p class="datos" id="m22-r9"> </p></td>
	</tr>
	</table>
	</td>
	</tr>
	
	</table>
	
	
	<table class="T_leyenda" style="width:25.7cm;"><tr>
	<td style="text-align:left;width:6.426cm; " >
	<div class="P_leyenda">{{ HTML::image('img/iconos/punto.png', 'No evaluado', array('style' => 'height:24px')) }}
	&nbsp;&nbsp;<span>No evaluado</span></div>
	</td>
	<td style="text-align:left;width:6.426cm; " >
	<div class="P_leyenda">{{ HTML::image('img/iconos/asterisco.png', 'En proceso', array('style' => 'height:24px')) }}
	&nbsp;&nbsp;<span>En proceso</span></div>
	</td>
	<td style="text-align:left;width:6.426cm; " >
	<div class="P_leyenda">{{ HTML::image('img/iconos/menos.png', 'No superado', array('style' => 'height:24px')) }}
	&nbsp;&nbsp;<span>No superado</span></div>
	</td>
	<td style="text-align:left;width:6.426cm; "> 
	<div class="P_leyenda">{{ HTML::image('img/iconos/mas.png', 'Superado', array('style' => 'height:24px')) }}
	&nbsp;&nbsp;<span>Superado</span></div>
	</td></tr>
	</table>
	
</body>
</html>