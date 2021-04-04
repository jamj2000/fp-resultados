@extends('plantilla')


@section('contenido')

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<img src="/img/logo.png" alt="logo" class="img-responsive">

<div class="row">

<a class="btn btn-default" href="profesores/{{ Auth::user()->id }}">	        	       
    {{ Auth::user()->nombre }}  {{ Auth::user()->apellido1 }} {{ Auth::user()->apellido2 }}
</a>

<a class="btn btn-default pull-right" href="{{ URL::to('logout') }}">	        	       
      <span class="glyphicon glyphicon-remove-circle"></span>
</a>
</div>

<br>
<div class="row">
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('resultados') }}">
<b>Resultados</b> <br> 
<img src="img/resultados.png" alt="resultados" class="img-responsive">
</a>
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('informes') }}">
<b>Informes</b> <br> 
<img src="img/informes.png" alt="informes" class="img-responsive">
</a>
<a class="btn btn-small btn-default col-xs-4 centrado" href="/info">
<b>Información</b> <br>
<img src="img/info.png" alt="info" class="img-responsive">
</a>
</div>
<div class="row">
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('modulos') }}">
<b>Módulos</b> <br>
<img src="img/modulos.png" alt="modulos" class="img-responsive">
</a>
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('profesores') }}">
<b>Profesores</b> <br>
<img src="img/profesores.png" alt="profesores" class="img-responsive">
</a>
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('alumnos') }}">
<b>Alumnos</b> <br>
<img src="img/alumnos.png" alt="alumnos" class="img-responsive">
</a>
</div>

<br><b><em>Departamento de Informática y Comunicaciones</em></b>

<br>
<br>
<br>


@stop