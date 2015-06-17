<!-- app/views/profesores/show.blade.php -->
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

		<!-- delete the nerd (uses the destroy method DESTROY /profesores/{id} -->
		<!-- we will add this later since its a little more complicated than the first two buttons -->
		@if (Auth::user()->admin == 's')
		{{ Form::open(array('url' => 'modulos/' . $modulo->id, 'class' => 'pull-right')) }}
			{{ Form::hidden('_method', 'DELETE') }}
			{{ Form::submit('Borrar', array('class' => 'btn btn-danger', 'disabled' => 'disabled')) }}
		{{ Form::close() }}
		@endif		

		<!-- edit this nerd (uses the edit method found at GET /profesores/{id}/edit -->
		@if (Auth::user()->id == $modulo->profesor->id or Auth::user()->admin == 's')
		<a class="btn btn-small btn-primary" 
		   {{-- @if (Auth::user()->admin != 's') {{ 'disabled="disabled"' }} @endif --}}
		   href="{{ URL::to('modulos/' . $modulo->id . '/edit') }}">Editar</a>
		@endif
		   
		
		<h3>{{ $modulo->curso }} - {{$modulo->nombre }}</h3>
		<dl class="dl-horizontal">
		  <dt>Ciclo</dt> 	        <dd>{{ $modulo->ciclo }}</dd>
		  <dt>Horas totales</dt>        <dd>{{ $modulo->horas_totales }}</dd>
		  <dt>Horas semanales</dt>      <dd>{{ $modulo->horas_semanales }}</dd>
		  <dt>Número de resultados:</dt><dd> {{ $modulo->num_resultados }}</dd>
		  <dt>Pesos:</dt>
		  <dd>
		  <div class="row">
		  @for ($i = 1; $i <= $modulo->num_resultados; $i++)	
		    <div class="col-xs-1">{{ 'R'.$i }}</div>
		  @endfor
		  </div>
  		  <div class="row">
		  @for ($i = 1; $i <= $modulo->num_resultados; $i++)	
		    <div class="col-xs-1"><?php $str="$"."modulo->r".$i."_peso"; eval ("echo $str;"); ?></div>
		  @endfor
		  </div>
		  </dd>

		</dl>
		
		<h3>Profesor titular</h3>
		@if ($modulo->profesor_id ) 
		   {{ HTML::link('profesores/'.$modulo->profesor->id, $modulo->profesor->nombre.' '.$modulo->profesor->apellido1.' '.$modulo->profesor->apellido2  )}} <br>
		@endif

		<h3>Alumnos matriculados</h3>
		@foreach ($modulo->alumnos as $alumno) 
		   {{ HTML::link('alumnos/'.$alumno->id, $alumno->nombre.' '.$alumno->apellido1.' '.$alumno->apellido2)}} <br>
		@endforeach   
		
	</div>


	   
	
	
@stop