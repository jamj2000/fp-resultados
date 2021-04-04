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

		<!-- delete (uses the destroy method DESTROY /profesores/{id} -->
		<!-- we will add this later since its a little more complicated than the first two buttons -->
        @if (Auth::user()->admin == 's')
		<form action="/profesores/{{$profesor->id}}" method="post" accept-charset="utf-8" class="pull-right">
			@csrf	
			<input type="hidden" name="_method" value="DELETE">	
			<input type="submit" value="Borrar" class="btn btn-danger">
		</form>
		@endif
		
		<!-- edit this nerd (uses the edit method found at GET /profesores/{id}/edit -->
		@if (Auth::user()->id == $profesor->id or Auth::user()->admin == 's')
		<a class="btn btn-small btn-primary" 
		@if (Auth::user()->admin != 's') {{ 'disabled="disabled"' }} @endif
			href="/profesores/{{$profesor->id}}/edit">Editar</a>
		@endif
	

		<h3>{{ $profesor->nombre }} {{$profesor->apellido1 }} {{$profesor->apellido2 }}</h3>
	    <dl class="dl-horizontal">
		<dt>Correo electrónico         </dt>  <dd>{{ $profesor->email }}</dd>
		@if ($profesor->tutoria)    
		   <dt>Tutoría</dt> <dd> {{ $profesor->tutoria }} </dd> 
		@endif
		@if ($profesor->admin=='s')
		    <dt>Administrador</dt> <dd><dd>
		@endif
		</dl>
		<h3>Módulos impartidos</h3>

		@foreach ($profesor->modulos as $modulo) 
		   <a href="/modulos/{{$modulo->id}}">{{$modulo->curso.' - '.$modulo->nombre}}</a><br>
		@endforeach   

	</div>

@stop