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

<div class="panel panel-info"><img src="/img/resultados.png" >
  <div class="panel-heading alto55">
  {{-- Auth::user()->nombre.' '.Auth::user()->apellido1.' '.Auth::user()->apellido2 --}}
  <b>Resultados de aprendizaje</b>
  </div>
	<div class="list-group">	
	@foreach($modulos as $key => $value)
      <a href="/resultados/{{$value->id}}/edit" class="list-group-item"> {{$value->curso.' - '.$value->nombre}} </a>
	@endforeach
	</div>
</div>
	

@stop