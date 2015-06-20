@extends('plantilla')


@section('contenido')
<!-- mostramos mensajes -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- si hay errores, los mostramos aquí -->
{{ HTML::ul($errors->all(), array('class' => 'alert alert-danger' ))}}

<script>  
  $(document).ready(function () {
     // Ocultamos mensaje de alert tras unos segundos
     setTimeout(function(){$(".alert").animate({fontSize: "0px", opacity: "0", padding: "0" });  }, 3000);
  });
</script>

<script type="text/javascript" >
/* 
 --- Tristate Checkbox ---
v 0.9.2 19th Dec 2008
By Shams Mahmood
http://shamsmi.blogspot.com 
*/
var STATE_NONE=0;var STATE_SOME=1;var STATE_ALL=2;var UNCHECKED_NORM="UNCHECKED_NORM";var UNCHECKED_HILI="UNCHECKED_HILI";var INTERMEDIATE_NORM="INTERMEDIATE_NORM";var INTERMEDIATE_HILI="INTERMEDIATE_HILI";var CHECKED_NORM="CHECKED_NORM";var CHECKED_HILI="CHECKED_HILI";var DEFAULT_CONFIG={UNCHECKED_NORM:"{{URL::asset('img/buttons/unchecked.gif')}}",UNCHECKED_HILI:"{{URL::asset('img/buttons/unchecked_highlighted.gif')}}",INTERMEDIATE_NORM:"{{URL::asset('img/buttons/intermediate.gif')}}",INTERMEDIATE_HILI:"{{URL::asset('img/buttons/intermediate_highlighted.gif')}}",CHECKED_NORM:"{{URL::asset('img/buttons/checked.gif')}}",CHECKED_HILI:"{{URL::asset('img/buttons/checked_highlighted.gif')}}"};function getNextStateFromValue(A){if(A==STATE_SOME){return STATE_ALL}if(A==STATE_ALL){return STATE_NONE}return STATE_SOME}function getStateFromValue(B,A){if(B==STATE_SOME){return(!A)?INTERMEDIATE_NORM:INTERMEDIATE_HILI}if(B==STATE_ALL){return(!A)?CHECKED_NORM:CHECKED_HILI}return(!A)?UNCHECKED_NORM:UNCHECKED_HILI}function getFieldAndContainerIds(D){var E=D.substring(0,D.length-".Img".length);var C=document.getElementById(E+".Field").value;var A=document.getElementById(E+".Container");var B="";if(A){B=A.value}return[C,B]}function getAllCheckboxesInContainer(C){if(C==""){return[]}var B=document.getElementById(C);var G=B.getElementsByTagName("input");var F=new Array();var E=0;for(var A=0;A<G.length;A++){var D=G[A];if(D.type=="checkbox"){F[E++]=D}}return F}function selectOrUnselectBoxes(C,B){for(var A in C){C[A].checked=B}}function areAllBoxesInGivenCheckedState(C,D){var B=true;for(var A=0;A<C.length;A++){if(C[A].checked!=D){B=false;break}}return B}function replaceImage(A,C){var B=document.getElementById(A);if(B.src!=C){B.src=C}}function mouseOverOutOfImage(C,A){var E=getFieldAndContainerIds(C);var B=document.getElementById(E[0]);var D=getStateFromValue(B.value,A);return DEFAULT_CONFIG[D]}function onMouseOverImage(A){return function(){var B=mouseOverOutOfImage(A,true);replaceImage(A,B)}}function onMouseOutImage(A){return function(){var B=mouseOverOutOfImage(A,false);replaceImage(A,B)}}function onTristateImageClick(A,B){return function(){var F=getFieldAndContainerIds(A);var E=document.getElementById(F[0]);var D=getNextStateFromValue(E.value);if(!B&&D==STATE_SOME){D=getNextStateFromValue(D)}E.value=D;if(F[1]!=""){var C=getAllCheckboxesInContainer(F[1]);selectOrUnselectBoxes(C,D==STATE_ALL)}var G=mouseOverOutOfImage(A,true);replaceImage(A,G)}}function onCheckboxClick(A,B){return function(){var E=getFieldAndContainerIds(A);var C=getAllCheckboxesInContainer(E[1]);var D=document.getElementById(E[0]);updateStateAndImage(C,D,A)}}function updateStateAndImage(B,D,C){if(B.length>0){var A=areAllBoxesInGivenCheckedState(B,true);var E=areAllBoxesInGivenCheckedState(B,false);if(A){D.value=STATE_ALL}else{if(E){D.value=STATE_NONE}else{D.value=STATE_SOME}}}var F=mouseOverOutOfImage(C,false);replaceImage(C,F)}function createHiddenStateField(C,A){var B=document.createElement("input");B.id=A;B.type="hidden";B.value=STATE_NONE;C.appendChild(B);return B}function createTriStateImageNode(D,C,A){var B=new Image();B.id=C;B.src=DEFAULT_CONFIG[UNCHECKED_NORM];D.appendChild(B);if(D.addEventListener){D.addEventListener("mouseover",onMouseOverImage(B.id),false);D.addEventListener("mouseout",onMouseOutImage(B.id),false);D.addEventListener("click",onTristateImageClick(B.id,A),false)}else{if(D.attachEvent){D.attachEvent("onmouseover",onMouseOverImage(B.id));D.attachEvent("onmouseout",onMouseOutImage(B.id));D.attachEvent("onclick",onTristateImageClick(B.id,A))}}}function createFieldNameHiddenField(D,C,B){var A=document.createElement("input");A.id=C;A.type="hidden";A.value=B;D.appendChild(A)}function createContainerNameHiddenField(D,B,C){var A=document.createElement("input");A.id=B;A.type="hidden";A.value=C;D.appendChild(A)}function attachOnclickEventsToDependentBoxes(E,D){var B=getAllCheckboxesInContainer(E);for(var A in B){var C=B[A];if(C.addEventListener){C.addEventListener("click",onCheckboxClick(D,C.id),false)}else{if(C.attachEvent){C.attachEvent("onclick",onCheckboxClick(D,C.id))}}}return B}function initTriStateCheckBox(A,G,F){var D=document.getElementById(A);var C=G;var B=A+".Value";if(F){C="";B=G}var I=D.childNodes[0];D.removeChild(I);var J=document.getElementById(B);if(!F){J=createHiddenStateField(D,B)}var K=A+".Img";createTriStateImageNode(D,K,F);var L=A+".Field";createFieldNameHiddenField(D,L,B);if(!F){var H=A+".Container";createContainerNameHiddenField(D,H,C)}D.appendChild(I);var E=attachOnclickEventsToDependentBoxes(C,K);updateStateAndImage(E,J,K)};
</script>


<div class="panel panel-info"><img src="{{ URL::asset('img/informes.png')}}" >
@if (Auth::user()->admin!='s' and !Auth::user()->tutoria ) 
<div class="panel-heading alto55"><b>No puedes generar informes</b></div>
<div class="panel-body">

{{ "<br><h3>No eres <b>administrador/a</b> ni <b>tutor/a</b>.</h3><br><br>" }} 
</div>
</div>
@endif


@if (Auth::user()->admin=='s')
{{ Form::open(array('url' => 'informes/evaluaciones')) }} 
{{-- Form::submit('Generar PDF', array('class' => 'btn btn-primary')) --}}
<div class="panel panel-info">
<div class="panel-heading alto55">{{ Form::submit('Generar PDF', array('class' => 'btn btn-primary ', 'style' => 'float: right !important;')) }}<b> {{ 'Informes de Evaluación - Actas'  }} </b></div>

<div class="panel-body">
<div class="row">  
<div class="col-md-6">	
	<div class="form-group" id="tristateBoxContainer2">
 
	<span id="tristateBox2" style="cursor: default;"><b>&nbsp; Cursos</b></span>
	<input type="hidden" id="tristateBoxInput" name="tristateBoxInput" value="0" />

	<div class="checkbox">
	    <label> <input type="checkbox" name="1FPGM A" value="s"  checked >
	      <a href="{{URL::to('informes/evaluacion/1FPGM A/pdf') }}"> <img src="{{ URL::asset('img/iconos/pdf.png')}}"  width=16 ></a>
	      {{ HTML::link( 'informes/evaluacion/1FPGM A/html', '1FPGM_A') }}	
	    </label><br>
	    <label> <input type="checkbox" name="1FPGM B" value="s"  checked >
	      <a href="{{URL::to('informes/evaluacion/1FPGM B/pdf') }}"> <img src="{{ URL::asset('img/iconos/pdf.png')}}"  width=16 ></a>
	      {{ HTML::link( 'informes/evaluacion/1FPGM B/html', '1FPGM_B') }}	
	    </label><br>	
	    <label> <input type="checkbox" name="2FPGM"   value="s"  checked >
	      <a href="{{URL::to('informes/evaluacion/2FPGM/pdf') }}"> <img src="{{ URL::asset('img/iconos/pdf.png')}}"  width=16 ></a>
	      {{ HTML::link( 'informes/evaluacion/2FPGM/html', '2FPGM') }}	
	    </label><br>	
	    <label> <input type="checkbox" name="1FPGS"   value="s"  checked >
	      <a href="{{URL::to('informes/evaluacion/1FPGS/pdf') }}"> <img src="{{ URL::asset('img/iconos/pdf.png')}}"  width=16 ></a>
	      {{ HTML::link( 'informes/evaluacion/1FPGS/html', '1FPGS') }}	
	    </label><br>
	    <label> <input type="checkbox" name="2FPGS"   value="s"  checked >
	      <a href="{{URL::to('informes/evaluacion/2FPGS/pdf') }}"> <img src="{{ URL::asset('img/iconos/pdf.png')}}"  width=16 ></a>
	      {{ HTML::link( 'informes/evaluacion/2FPGS/html', '2FPGS') }}	
	    </label><br>
	</div> 
	</div>

</div>
</div>
</div>

</div>
{{Form::close() }}
@endif







@if (Auth::user()->tutoria)
{{ Form::open(array('action' => array('InformesController@calificacionesvarias', Auth::user()->tutoria))) }}                  

<div class="panel panel-info"> 
<div class="panel-heading alto55">{{ Form::submit('Generar PDF', array('class' => 'btn btn-primary', 'style' => 'float: right !important;')) }}<b>  {{ 'Informes de Calificaciones - Boletines'  }} </b></div>

<div class="panel-body">
<div class="row">  
<div class="col-md-6">	
	<div class="form-group" id="tristateBoxContainer">
	
	<span id="tristateBox" style="cursor: default;"><b>&nbsp; {{ Auth::user()->tutoria }}</b></span>
	<input type="hidden" id="tristateBoxInput" name="tristateBoxInput" value="0" />

	<div class="checkbox">
	@foreach($alumnos as $alumno)
	    <label> <input type="checkbox" name="{{$alumno->id}}" value="s"  checked > 
	      <a href="{{URL::to('informes/calificaciones/'.$alumno->id) }}"> <img src="{{ URL::asset('img/iconos/pdf.png')}}"  width=16 ></a>
	      {{ HTML::link( 'informes/'.$alumno->id , $alumno->apellido1.' '.$alumno->apellido2.', '.$alumno->nombre) }}	
	    </label><br>	
	@endforeach
	</div> 
	</div>

</div>
</div>
</div>

</div>
{{ Form::close() }}
@endif	

</div>

{{-- En scripts separados, porque son independientes. En el mismo script, cuando el primero no existe tampoco se muestra el segundo --}}
<script type="text/javascript">	initTriStateCheckBox('tristateBox2', 'tristateBoxContainer2', false); </script>
<script type="text/javascript">	initTriStateCheckBox('tristateBox', 'tristateBoxContainer', false); </script>

@stop