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

{{ Form::open(array('url' => 'modulos')) }}

{{ Form::submit('Crear', array('class' => 'btn btn-success')) }}

<div class="panel panel-primary">

<div class="panel-heading"><b>Datos del módulo</b></div>

<div class="panel-body">
		
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
		{{ Form::label('nombre', 'Nombre') }}
		{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('ciclo', 'Ciclo') }}
		{{ Form::text('ciclo', Input::old('ciclo'), array('class' => 'form-control')) }}
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-4">
		{{ Form::label('horas_totales', 'Horas totales') }}
		{{ Form::text('horas_totales', Input::old('horas_totales'), array('class' => 'form-control text-right')) }}
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('horas_semanales', 'Horas semanales') }}
		{{ Form::text('horas_semanales', Input::old('horas_semanales'), array('class' => 'form-control text-right')) }}
	</div>
	
	<div class="form-group col-md-4">
		{{ Form::label('num_resultados', 'Número de resultados') }}
		{{-- Form::text('num_resultados', Input::old('num_resultados'), array('class' => 'form-control')) --}}
		<select class="form-control  text-right" name="num_resultados">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		  <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
		</select>
	</div>
</div>


{{ Form::close() }}

@stop