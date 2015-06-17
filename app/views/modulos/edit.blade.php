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

     {{-- Deshabilitamos formulario para no administradores y profesores no titular--}}  
     @if (Auth::user()->admin != 's' and (Auth::user()->id != $modulo->profesor->id))
	var form = document.getElementById("formulario");
	var elements = form.elements;
	for (var i = 0, len = elements.length; i < len; ++i) {
	    elements[i].disabled = true;
	}
     @endif
 
     
     
     
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





{{ Form::model($modulo, array('action' => array('ModuloController@update', $modulo->id), 'method' => 'PUT', 'id' => 'formulario')) }}


<div class="panel panel-info">
<div class="panel-heading alto55"><b>Datos del módulo</b>
 {{ Form::submit('Actualizar', array('class' => 'btn btn-primary ', 'style' => 'float: right !important;')) }}</div>

<div class="panel-body">
		
<div class="row">
	<div class="form-group col-md-4">
		{{ Form::label('curso', 'Curso') }}
		{{-- Form::text('curso', Input::old('curso'), array('class' => 'form-control')) --}}
		<select class="form-control text-right" name='curso' disabled='disabled'>
		  <option value='1FPGM A' @if ($modulo->curso == '1FPGM A') {{ 'selected' }} @endif>1FPGM A</option>
		  <option value='1FPGM B' @if ($modulo->curso == '1FPGM B') {{ 'selected' }} @endif>1FPGM B</option>
		  <option value='2FPGM'   @if ($modulo->curso == '2FPGM')   {{ 'selected' }} @endif>2FPGM  </option>
		  <option value='1FPGS'   @if ($modulo->curso == '1FPGS')   {{ 'selected' }} @endif>1FPGS  </option>
		  <option value='2FPGS'   @if ($modulo->curso == '2FPGS')   {{ 'selected' }} @endif>2FPGS  </option>
		</select>
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('nombre', 'Nombre') }}
		{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control', 'disabled' => 'disabled')) }}
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('ciclo', 'Ciclo') }}
		{{ Form::text('ciclo', Input::old('ciclo'), array('class' => 'form-control', 'disabled' => 'disabled')) }}
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-4">
		{{ Form::label('horas_totales', 'Horas totales') }}
		{{ Form::text('horas_totales', Input::old('horas_totales'), array('class' => 'form-control  text-right', 'disabled' => 'disabled')) }}
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('horas_semanales', 'Horas semanales') }}
		{{ Form::text('horas_semanales', Input::old('horas_semanales'), array('class' => 'form-control  text-right', 'disabled' => 'disabled')) }}
	</div>
	
	<div class="form-group col-md-4">
		{{ Form::label('num_resultados', 'Número de resultados') }}
		{{-- Form::text('num_resultados', Input::old('num_resultados'), array('class' => 'form-control')) --}}
		<select class="form-control  text-right" name="num_resultados" disabled="disabled">
		  <option value="1" @if ($modulo->num_resultados == '1') {{ 'selected' }} @endif>1</option>
		  <option value="2" @if ($modulo->num_resultados == '2') {{ 'selected' }} @endif>2</option>
		  <option value="3" @if ($modulo->num_resultados == '3') {{ 'selected' }} @endif>3</option>
		  <option value="4" @if ($modulo->num_resultados == '4') {{ 'selected' }} @endif>4</option>
		  <option value="5" @if ($modulo->num_resultados == '5') {{ 'selected' }} @endif>5</option>
		  <option value="6" @if ($modulo->num_resultados == '6') {{ 'selected' }} @endif>6</option>
		  <option value="7" @if ($modulo->num_resultados == '7') {{ 'selected' }} @endif>7</option>
		  <option value="8" @if ($modulo->num_resultados == '8') {{ 'selected' }} @endif>8</option>
		  <option value="9" @if ($modulo->num_resultados == '9') {{ 'selected' }} @endif>9</option>
		</select>
	</div>
</div>

<div class="row">

      <div class="panel panel-warning">
      <div class="panel-heading"><b>Pesos de los resultados</b></div>
      <div class="panel-body">
	
        @for ($i = 1; $i <= $modulo->num_resultados; $i++)
	<div class="col-md-1">
		{{ Form::label('r'.$i.'_peso', 'R'.$i) }}
		{{ Form::text('r'.$i.'_peso', Input::old('r'.$i.'_peso'), array('class' => 'form-control')) }}
	</div>
	@endfor
     </div>       
     </div> 
</div>


<div class="row">
      <div class="panel panel-warning">
      <div class="panel-heading"><b>Profesor titular</b></div>
      <div class="panel-body">
	      
	      <div class="radio">
	      @foreach($profesores as $profesor)
		  <label> <input type="radio" name="profesor" value="{{$profesor->id}}"  @if ($profesor->id == $modulo->profesor_id)) {{ "checked" }} @endif > 
			    {{ $profesor->nombre }} {{ $profesor->apellido1 }} {{ $profesor->apellido2 }} 
		  </label><br>	
	      @endforeach
	      </div> 

	      </div>
      </div>
</div>


<div class="row">
      <div class="panel panel-warning">
      <div class="panel-heading"><b>Alumnos matriculados</b></div>
      <div class="panel-body">

      <div class="row">  
      <div class="col-md-6">	
	      <div class="form-group" id="tristateBoxContainer">
	      <span id="tristateBox" style="cursor: default;"><b>&nbsp; {{ $modulo->curso }}</b></span>
	      <input type="hidden" id="tristateBoxInput" name="tristateBoxInput" value="0" />

	      <div class="checkbox">
	      @foreach($alumnos_curso as $alumno)
		  <label> <input type="checkbox" name="{{$alumno->id}}" value="s"  @if ($alumno->modulos->contains($modulo->id)) {{ "checked" }} @endif > 
			    {{ $alumno->apellido1 }} {{ $alumno->apellido2 }}, {{ $alumno->nombre }} 
		  </label><br>	
	      @endforeach
	      </div> 
	      </div>
      </div>

      <div class="col-md-6">
	      <div class="form-group" id="tristateBoxContainer2">
	      <span id="tristateBox2" style="cursor: default;"><b>&nbsp;Otros</b></span>
	      <input type="hidden" id="tristateBoxInput" name="tristateBoxInput" value="0" />
	      
	      <div class="checkbox ">
	      @foreach($alumnos_otros as $alumno)
		  <label> <input type="checkbox" name="{{$alumno->id}}" value="s"  @if ($alumno->modulos->contains($modulo->id)) {{ "checked" }} @endif > 
			    {{ $alumno->apellido1 }} {{ $alumno->apellido2 }}, {{ $alumno->nombre }} 
		  </label><br>	
	      @endforeach
	      </div> 
	      </div>
      </div>
      </div>
</div>



</div>
</div>
  


</div>
</div>	

		
	
{{ Form::close() }}
<script type="text/javascript">
	initTriStateCheckBox('tristateBox', 'tristateBoxContainer', false);
	initTriStateCheckBox('tristateBox2', 'tristateBoxContainer2', false);
</script>


@stop
