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


{{ Form::model($alumno, array('action' => array('AlumnoController@update', $alumno->id), 'method' => 'PUT' )) }}

<div class="panel panel-info">

<div class="panel-heading alto55"><b>Datos del alumno</b>
  {{ Form::submit('Actualizar', array('class' => 'btn btn-primary ', 'style' => 'float: right !important;')) }}</div>

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
	<div class="form-group col-md-4">
		{{ Form::label('curso', 'Curso') }}
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
		{{ Form::text('email', null, array('class' => 'form-control')) }}
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




{{ Form::close() }}

@stop
