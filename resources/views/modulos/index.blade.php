@extends('plantilla')


@section('contenido')
<!-- mostramos mensajes -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- si hay errores, los mostramos aquí -->
@include('errores')


<script>	
$(document).ready(function() {
    // Ocultamos mensaje de alert tras unos segundos
     setTimeout(function(){$(".alert").animate({fontSize: "0px", opacity: "0", padding: "0" });  }, 3000);
     
    // hide all the events
    $("#cursos a").hide();
    $(".1gma").show();
    $(".event button").click(function(evt) {
        evt.preventDefault();
        $("#cursos a").hide();
        var id = $(this).attr('id');
        $("." + id).show();
    });
});
</script>

<div class="event btn-group">
  <button  id="1gma"  class="btn btn-default">1FPGM A</button>
  <button  id="1gmb"  class="btn btn-default">1FPGM B</button>
  <button  id="1gs"   class="btn btn-default">1FPGS</button>
  <button  id="2gm"   class="btn btn-default">2FPGM</button>
  <button  id="2gs"   class="btn btn-default">2FPGS</button>
  <button  id="otros" class="btn btn-default">Otros</button>
  <button  id="todos" class="btn btn-default">Todos</button>
</div>



<div class="panel panel-info"><img src="/img/modulos.png" >
  <div class="panel-heading alto55">
    @if (Auth::user()->admin == 's')
    <a class="btn btn-small btn-primary" style="float: right !important;" href="modulos/create">Nuevo</a>
    @endif
    <b>Módulos</b>
  </div>
	<div id="cursos" class="list-group">
  @php $clase=''; @endphp
	@foreach($modulos as $key => $value)
	    @if (strpos($value->curso,'1FPGM A') !== false)
		    @php $clase='todos 1gma list-group-item';  @endphp
	    @elseif (strpos($value->curso,'1FPGM B') !== false)
		    @php $clase='todos 1gmb list-group-item';  @endphp
	    @elseif (strpos($value->curso,'1FPGS') !== false)
		    @php $clase='todos 1gs list-group-item';  @endphp
	    @elseif (strpos($value->curso,'2FPGM') !== false)
		    @php $clase='todos 2gm list-group-item';  @endphp
	    @elseif (strpos($value->curso,'2FPGS') !== false)
		    @php $clase='todos 2gs list-group-item';  @endphp
	    @else
		    @php $clase='todos otros list-group-item';  @endphp
	    @endif

        <a href="modulos/{{$value->id}}" class="{{$clase}}"> {{ $value->nombre }}</a>
	@endforeach
	</div>
</div>



@stop