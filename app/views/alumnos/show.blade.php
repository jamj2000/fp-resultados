<!-- app/views/alumnos/show.blade.php -->
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

	<div class="jumbotron">

		<!-- delete the nerd (uses the destroy method DESTROY /alumnos/{id} -->
		<!-- we will add this later since its a little more complicated than the first two buttons -->
		@if (Auth::user()->admin == 's')		
		{{ Form::open(array('url' => 'alumnos/' . $alumno->id, 'class' => 'pull-right')) }}
			{{ Form::hidden('_method', 'DELETE') }}
			{{ Form::submit('Borrar', array('class' => 'btn btn-danger')) }}
		{{ Form::close() }}
		@endif		

		<!-- edit this nerd (uses the edit method found at GET /alumnos/{id}/edit -->
		@if (Auth::user()->admin == 's')
		<a class="btn btn-small btn-primary" 
		   {{-- @if (Auth::user()->admin != 's') {{ 'disabled="disabled"' }} @endif --}}
		   href="{{ URL::to('alumnos/' . $alumno->id . '/edit') }}">Editar</a>
		@endif
		
		   
		<h3>{{ $alumno->nombre }} {{$alumno->apellido1 }} {{$alumno->apellido2 }}</h3>
		<dl class="dl-horizontal">
		<dt>Curso</dt>                <dd>{{ $alumno->curso }}</dd>
		<dt>Correo electrónico</dt>   <dd>{{ $alumno->email }}</dd>
		<dt>Fecha de nacimiento</dt>  <dd>{{ $alumno->fecha_nac }}</dd>
		</dl>

		<h3>Módulos con matrícula</h3>
		@foreach ($alumno->modulos as $modulo) 
		   {{ HTML::link('modulos/'.$modulo->id, $modulo->curso.' - '.$modulo->nombre)}} <br>
		@endforeach   

	</div>

@stop