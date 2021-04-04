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

<form action="/modulos" method="post" accept-charset="utf-8">
@csrf

<input type="submit" value="Crear" class="btn btn-success">

<div class="panel panel-primary">

<div class="panel-heading"><b>Nuevo módulo</b></div>

<div class="panel-body">
		
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
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
	</div>

	<div class="form-group col-md-4">
        <label for="ciclo">Ciclo</label>
        <input type="text" name="ciclo" id="ciclo" class="form-control" value="{{ old('ciclo') }}">
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-4">
        <label for="horas_totales">Horas totales</label>
        <input type="text" name="horas_totales" id="horas_totales" class="form-control text-right" value="{{ old('horas_totales') }}">
	</div>

	<div class="form-group col-md-4">
        <label for="horas_semanales">Horas semanales</label>
        <input type="text" name="horas_semanales" id="horas_semanales" class="form-control text-right" value="{{ old('horas_semanales') }}">
	</div>
	
	<div class="form-group col-md-4">
        <label for="num_resultados">Número de resultados</label>
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

</form>

@stop