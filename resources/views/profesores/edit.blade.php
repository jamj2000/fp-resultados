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


<form action="/profesores/{{$profesor->id}}"  method="post"  accept-charset="utf-8"">
@csrf
<input type="hidden" name="_method" value="PUT">


<div class="panel panel-info">

<div class="panel-heading alto55"><b>Datos del profesor</b>
<input type="submit" value="Actualizar" class="btn btn-success" style="float: right !important;">
</div>

<div class="panel-body">

	
<div class="row">
	<div class="form-group col-md-4">
        <label for="apellido1">Primer apellido</label>
        <input type="text" name="apellido1" id="apellido1" class="form-control" value="{{ $profesor->apellido1 }}">
	</div>
	
	<div class="form-group col-md-4">
        <label for="apellido2">Segundo apellido</label>
        <input type="text" name="apellido2" id="apellido2" class="form-control" value="{{ $profesor->apellido2 }}">
	</div>

	<div class="form-group col-md-4">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $profesor->nombre }}">
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-4">
        <label for="tutoria">Tutoría</label>
		{{-- Form::text('tutoria', Input::old('tutoria'), array('class' => 'form-control')) --}}
		<select class="form-control text-right" name="tutoria" id="tutoria">
		  <option value=''        @if ($profesor->tutoria == '')        {{ 'selected' }} @endif>       </option> 
		  <option value='1FPGM A' @if ($profesor->tutoria == '1FPGM A') {{ 'selected' }} @endif>1FPGM A</option>
		  <option value='1FPGM B' @if ($profesor->tutoria == '1FPGM B') {{ 'selected' }} @endif>1FPGM B</option>
		  <option value='2FPGM'   @if ($profesor->tutoria == '2FPGM')   {{ 'selected' }} @endif>2FPGM  </option>
		  <option value='1FPGS'   @if ($profesor->tutoria == '1FPGS')   {{ 'selected' }} @endif>1FPGS  </option>
		  <option value='2FPGS'   @if ($profesor->tutoria == '2FPGS')   {{ 'selected' }} @endif>2FPGS  </option>
		</select>
	</div>
	
	<div class="form-group col-md-4">
        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" class="form-control" value="{{ $profesor->email }}">
	</div>
	
	<div class="form-group col-md-4">
        <label for="password">Clave</label>
        <input type="text" name="password" id="password" class="form-control" value="(No cambiar)">
	</div>
</div>

@if (Auth::user()->admin == 's' and $profesor->id != Auth::user()->id)
<div class="row col-md-6">
	<label> <input type="checkbox" name="admin" value="s" 
		    @if ($profesor->admin == 's') {{ "checked" }} @endif > 
		    Administrador 
	</label>
</div>
@endif

<br><br>

<div class="row">
	<div class="panel panel-warning">
	<div class="panel-heading"><b>Módulos que imparte</b></div>
	<div class="panel-body">

	<div class="checkbox">
	@foreach($modulos as $key => $value)
	    <label> <input type="checkbox" name="{{$value->id}}" value="s"  @if ($profesor->modulos->contains($value->id)) {{ "checked" }} @endif > 
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