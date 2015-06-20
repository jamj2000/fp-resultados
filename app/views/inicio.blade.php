@extends('plantilla')


@section('contenido')

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ HTML::image('img/logo.png', 'logo', array('class' => 'img-responsive')) }}

<div class="row">
<a class="btn btn-default" href="{{ URL::to('profesores/'.Auth::user()->id) }}">	        	       
    {{ Auth::user()->nombre }}  {{ Auth::user()->apellido1 }} {{ Auth::user()->apellido2 }}
</a>
<a class="btn btn-default pull-right" href="{{ URL::to('logout') }}">	        	       
      <span class="glyphicon glyphicon-remove-circle"></span>
</a>
</div>

<br>
<div class="row">
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('resultados') }}">
<b>Resultados</b> <br> {{ HTML::image('img/resultados.png','resultados', array('class' => 'img-responsive')) }}
</a>
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('informes') }}">
<b>Informes</b> <br> {{ HTML::image('img/informes.png', 'informes', array('class' => 'img-responsive')) }}
</a>
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('informacion') }}">
<b>Información</b> <br> {{ HTML::image('img/info.png', 'informacion', array('class' => 'img-responsive')) }}
</a>
</div>
<div class="row">
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('modulos') }}">
<b>Módulos</b> <br> {{ HTML::image('img/modulos.png', 'modulos', array('class' => 'img-responsive')) }}
</a>
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('profesores') }}">
<b>Profesores</b> <br> {{ HTML::image('img/profesores.png', 'profesores', array('class' => 'img-responsive')) }}
</a>
<a class="btn btn-small btn-default col-xs-4 centrado" href="{{ URL::to('alumnos') }}">
<b>Alumnos</b> <br> {{ HTML::image('img/alumnos.png', 'alumnos', array('class' => 'img-responsive')) }}
</a>
</div>

<br><b><em>Departamento de Informática y Comunicaciones</em></b>

<br>
<br>
<br>



@stop
