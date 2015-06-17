@extends('plantilla')


@section('contenido')

<div class="panel panel-info">
<div class="panel-heading alto55"><b>Información</b></div>

<div class="panel-body">
 

Esta sección está desarrolladonse. Perdone las molestias.
<br><br>
El siguiente archivo PDF está disponible para hacer pruebas de descarga desde un móvil Android.<br><br>
<a class="col-md-4" href="{{URL::asset('pdf/Info.pdf') }}">  <img src="{{ URL::asset('img/iconos/pdf.png')}}" >  </a>
<br>




</div>
</div>

@stop