<!-- app/views/profesores/create.blade.php -->
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

{{ Form::open(array('url' => 'profesores')) }}

{{ Form::submit('Crear', array('class' => 'btn btn-success')) }}

<div class="panel panel-primary">

<div class="panel-heading"><b>Nuevo profesor</b></div>

<div class="panel-body">

	
<div class="row">
	<div class="form-group col-md-4">
		{{ Form::label('apellido1', 'Primer apellido') }}
		{{ Form::text('apellido1', null, array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group col-md-4">
		{{ Form::label('apellido2', 'Segundo apellido') }}
		{{ Form::text('apellido2', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('nombre', 'Nombre') }}
		{{ Form::text('nombre', null, array('class' => 'form-control')) }}
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-6">
		{{ Form::label('email', 'Correo electrónico') }}
		{{ Form::text('email', null, array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group col-md-6">
		{{ Form::label('password', 'Clave') }}
		{{ Form::text('password', null, array('class' => 'form-control')) }}
	</div>
</div>
  <div class="row col-md-6">
  <label> <input type="checkbox" name="admin" value="s"> 
	      Administrador 
  </label>
  </div>

</div>
</div>


{{ Form::close() }}

@stop

