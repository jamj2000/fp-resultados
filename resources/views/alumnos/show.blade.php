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

	<div class="jumbotron">

		<!-- delete (uses the destroy method DESTROY /alumnos/{id} -->
		<!-- we will add this later since its a little more complicated than the first two buttons -->
	

		@if (Auth::user()->admin == 's')
		<form action="/alumnos/{{$alumno->id}}" method="post" accept-charset="utf-8" class="pull-right">
			@csrf	
			<input type="hidden" name="_method" value="DELETE">	
			<input type="submit" value="Borrar" class="btn btn-danger">
		</form>
		@endif 
	

		<!-- edit (uses the edit method found at GET /alumnos/{id}/edit -->
		@if (Auth::user()->admin == 's')
		<a class="btn btn-small btn-primary" 
		   @if (Auth::user()->admin != 's') {{ 'disabled="disabled"' }} @endif
		   href="/alumnos/{{$alumno->id}}/edit">Editar</a>
		@endif 

		   
		<h3>{{ $alumno->nombre }} {{$alumno->apellido1 }} {{$alumno->apellido2 }}</h3>
		<dl class="dl-horizontal">
		<dt>Curso</dt>                <dd>{{ $alumno->curso }}</dd>
		<dt>Correo electrónico</dt>   <dd>{{ $alumno->email }}</dd>
		<dt>Fecha de nacimiento</dt>  <dd>{{ $alumno->fecha_nac }}</dd>
		</dl>

		<h3>Módulos con matrícula</h3>

		@foreach ($alumno->modulos as $modulo) 
           <a href="/modulos/{{$modulo->id}}"> {{ $modulo->curso.' - '.$modulo->nombre }} </a><br>
		@endforeach   


	</div>

@stop