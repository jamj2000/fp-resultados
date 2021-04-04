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

<form action="/alumnos" method="post" accept-charset="utf-8">
@csrf

<input type="submit" value="Crear" class="btn btn-success">

<div class="panel panel-primary">

<div class="panel-heading"><b>Nuevo alumno</b></div>

<div class="panel-body">

<div class="row">
	<div class="form-group col-md-4">
        <label for="apellido1">Primer apellido</label>
        <input type="text" name="apellido1" id="apellido1" class="form-control" value="{{ old('apellido1') }}">
	</div>

	<div class="form-group col-md-4">
        <label for="apellido2">Segundo apellido</label>
        <input type="text" name="apellido2" id="apellido2" class="form-control" value="{{ old('apellido2') }}">
	</div>
	
	<div class="form-group col-md-4">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
	</div>
</div>

<div class="row">
	<div class="form-group col-md-4">
        <label for="curso">Curso</label>
		{{-- Form::text('curso', Input::old('curso'), array('class' => 'form-control')) --}}
		<select class="form-control text-right" name='curso'>
		  <option value='1FPGM A'>1FPGM A</option>
		  <option value='1FPGM B'>1FPGM B</option>
		  <option value='2FPGM'>  2FPGM  </option>
		  <option value='1FPGS'>  1FPGS  </option>
		  <option value='2FPGS'>  2FPGS  </option>
		</select>
	</div>
	
	<div class="form-group col-md-4">
        <label for="id_escolar">Identificador escolar</label>
        <input type="text" name="id_escolar" id="id_escolar" class="form-control text-right" value="{{ old('id_escolar') }}">
	</div>

	<div class="form-group col-md-4">
        <label for="fecha_nac">Fecha de nacimiento</label>
        <input type="text" name="fecha_nac" id="fecha_nac" class="form-control text-right" value="{{ old('fecha_nac') }}">
   	</div>
</div>


<div class="row">
	<div class="form-group col-md-6">
        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
	</div>
</div>


</div>
</div>

</form>

@stop