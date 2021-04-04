@extends('plantilla')


@section('contenido')
<!-- mostramos mensajes -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- si hay errores, los mostramos aquí -->
@include('errores')

<script>  
  $(document).ready(function () {
     // Ocultamos mensaje de alert tras unos segundos
     setTimeout(function(){$(".alert").animate({fontSize: "0px", opacity: "0", padding: "0" });  }, 3000);
  });
</script>


<form action="/alumnos/{{$alumno->id}}"  method="post"  accept-charset="utf-8"">
@csrf
<input type="hidden" name="_method" value="PUT">

<div class="panel panel-info">

<div class="panel-heading alto55">
  <b>Datos del alumno</b>
  <input type="submit" value="Actualizar" class="btn btn-success" style="float: right !important;">
</div>

<div class="panel-body">

	
<div class="row">
	<div class="form-group col-md-4">
        <label for="apellido1">Primer apellido</label>
        <input type="text" name="apellido1" id="apellido1" class="form-control" value="{{ $alumno->apellido1 }}">
	</div>
	
	<div class="form-group col-md-4">
        <label for="apellido2">Segundo apellido</label>
        <input type="text" name="apellido2" id="apellido2" class="form-control" value="{{ $alumno->apellido2 }}">
	</div>

	<div class="form-group col-md-4">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $alumno->nombre }}">
	</div>
</div>

<div class="row">
	<div class="form-group col-md-4">
        <label for="curso">Curso</label>		
		{{-- Form::text('curso', Input::old('curso'), array('class' => 'form-control')) --}}
		<select class="form-control text-right" name='curso'>
		  <option value='1FPGM A' @if ($alumno->curso == '1FPGM A') {{ 'selected' }} @endif>1FPGM A</option>
		  <option value='1FPGM B' @if ($alumno->curso == '1FPGM B') {{ 'selected' }} @endif>1FPGM B</option>
		  <option value='2FPGM'   @if ($alumno->curso == '2FPGM')   {{ 'selected' }} @endif>2FPGM  </option>
		  <option value='1FPGS'   @if ($alumno->curso == '1FPGS')   {{ 'selected' }} @endif>1FPGS  </option>
		  <option value='2FPGS'   @if ($alumno->curso == '2FPGS')   {{ 'selected' }} @endif>2FPGS  </option>
		</select>
	</div>
	
	<div class="form-group col-md-4">
        <label for="id_escolar">Identificador escolar</label>
        <input type="text" name="id_escolar" id="id_escolar" class="form-control text-right" value="{{ $alumno->id_escolar }}">
	</div>

	<div class="form-group col-md-4">
        <label for="fecha_nac">Fecha de nacimiento</label>
        <input type="text" name="fecha_nac" id="fecha_nac" class="form-control text-right" value="{{ $alumno->fecha_nac }}">
	</div>
</div>


<div class="row">
	<div class="form-group col-md-6">
        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" class="form-control" value="{{ $alumno->email }}">    
	</div>
</div>


<div class="row">
	<div class="panel panel-warning">
	<div class="panel-heading"><b>Módulos con matrícula</b></div>
	<div class="panel-body">

	<div class="checkbox">
	@foreach($modulos as $key => $value)
	    <label> <input type="checkbox" name="{{$value->id}}" value="s"  @if ($alumno->modulos->contains($value->id)) {{ "checked" }} @endif > 
		      {{ $value->curso }}  {{ $value->nombre }} 
	    </label><br>	
	@endforeach
	</div> 

	</div>
	</div>
</div>


</div>
</div>

</form>

@stop