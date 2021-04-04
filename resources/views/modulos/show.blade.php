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

		<!-- delete (uses the destroy method DESTROY /modulos/{id} -->
		<!-- we will add this later since its a little more complicated than the first two buttons -->
        
		@if (Auth::user()->admin == 's')
		<form action="/modulos/{{$modulo->id}}" method="post" accept-charset="utf-8" class="pull-right">
			@csrf	
			<input type="hidden" name="_method" value="DELETE">	
			<input type="submit" value="Borrar" class="btn btn-danger">
		</form>
		@endif 

		<!-- edit (uses the edit method found at GET /modulos/{id}/edit -->
		@if (Auth::user()->id == $modulo->profesor->id or Auth::user()->admin == 's')
 		<a class="btn btn-small btn-primary" 
		   @if (Auth::user()->admin != 's') {{ 'disabled="disabled"' }} @endif
		   href="/modulos/{{$modulo->id}}/edit">Editar</a>
		@endif
		   
		
		<h3>{{ $modulo->curso }} - {{$modulo->nombre }}</h3>
		<dl class="dl-horizontal">
		  <dt>Ciclo</dt> 	            <dd>{{ $modulo->ciclo }}</dd>
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
			<a href="/profesores/{{$modulo->profesor->id}}">{{$modulo->profesor->nombre.' '.$modulo->profesor->apellido1.' '.$modulo->profesor->apellido2 }}</a>
		@endif

		<h3>Alumnos matriculados</h3>
		@foreach ($modulo->alumnos as $alumno) 
		   <a href="/alumnos/{{$alumno->id}}">{{$alumno->nombre.' '.$alumno->apellido1.' '.$alumno->apellido2}}</a><br>
		@endforeach   
	</div>

	
@stop