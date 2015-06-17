<!-- app/views/nerds/create.blade.php -->
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

{{ Form::open(array('url' => 'alumnos')) }}

{{ Form::submit('Crear', array('class' => 'btn btn-success')) }}

<div class="panel panel-primary">

<div class="panel-heading"><b>Nuevo alumno</b></div>

<div class="panel-body">


<div class="row">
	<div class="form-group col-md-4">
		{{ Form::label('apellido1', 'Primer apellido') }}
		{{ Form::text('apellido1', Input::old('apellido1'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('apellido2', 'Segundo apellido') }}
		{{ Form::text('apellido2', Input::old('apellido2'), array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group col-md-4">
		{{ Form::label('nombre', 'Nombre') }}
		{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
	</div>
</div>

<div class="row">
	<div class="form-group col-md-4">
		{{ Form::label('curso', 'Curso') }}
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
		{{ Form::label('id_escolar', 'Identificador escolar') }}
		{{ Form::text('id_escolar', Input::old('id_escolar'), array('class' => 'form-control text-right')) }}
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('fecha_nac', 'Fecha de nacimiento') }}
		{{ Form::text('fecha_nac', Input::old('apellido2'), array('class' => 'form-control text-right')) }}
	</div>
</div>


<div class="row">
	<div class="form-group col-md-6">
		{{ Form::label('email', 'Correo electrónico') }}
		{{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
	</div>
</div>


</div>
</div>



{{ Form::close() }}

@stop

