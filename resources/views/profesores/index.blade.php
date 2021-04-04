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


<div class="panel panel-info"><img src="/img/profesores.png" >
  <div class="panel-heading alto55">

    @if (Auth::user()->admin == 's')
    <a class="btn btn-small btn-primary" style="float: right !important;"  href="/profesores/create">Nuevo</a>
    @endif 

    <b>Profesores</b>
  </div>
	<div class="list-group">	
	@foreach($profesores as $key => $value)
        <a href="profesores/{{$value->id}}" class="list-group-item"> {{ $value->nombre.' '.$value->apellido1.' '.$value->apellido2 }} </a>
	@endforeach
	</div>
</div>
	

@stop