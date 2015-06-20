@extends('plantilla')


@section('contenido')

{{-- mostramos mensajes --}}
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{-- si hay errores, los mostramos aquí --}}
{{ HTML::ul($errors->all(), array('class' => 'alert alert-danger' ))}}


<script>  
  var colorear = function (){
	switch(this.value) {
	    case '-2': this.style.backgroundColor = '#888888'; break;
	    case '-1': this.style.backgroundColor = '#5555ff'; break;
	    case '0' : this.style.backgroundColor = '#E80000'; break;
	    case '1' : this.style.backgroundColor = '#FF2200'; break;
	    case '2' : this.style.backgroundColor = '#FF7700'; break;
	    case '3' : this.style.backgroundColor = '#FFBB00'; break;
	    case '4' : this.style.backgroundColor = '#FFD900'; break;
	    case '5' : this.style.backgroundColor = '#BCFF00'; break;
	    case '6' : this.style.backgroundColor = '#6FFF00'; break;
	    case '7' : this.style.backgroundColor = '#31D009'; break;
	    case '8' : this.style.backgroundColor = '#2EC109'; break;
	    case '9' : this.style.backgroundColor = '#23A204'; break;
	    case '10': this.style.backgroundColor = '#1D8104'; break;
	    default:   this.style.backgroundColor = '#aaaaaa';
	} 
  }
  

  $(document).ready(function () {
     {{-- Ocultamos mensaje de alert tras unos segundos --}}
     setTimeout(function(){$(".alert").animate({fontSize: "0px", opacity: "0", padding: "0" });  }, 3000);

     var x = document.getElementsByTagName("select");
    
     for (var i = 0; i < x.length; i++) {   
        x[i].addEventListener('change', colorear, false);

	switch(x[i].value) {
	    case '-2': x[i].style.backgroundColor = '#888888'; break;
	    case '-1': x[i].style.backgroundColor = '#5555ff'; break;
	    case '0' : x[i].style.backgroundColor = '#E80000'; break;
	    case '1' : x[i].style.backgroundColor = '#FF2200'; break;
	    case '2' : x[i].style.backgroundColor = '#FF7700'; break;
	    case '3' : x[i].style.backgroundColor = '#FFBB00'; break;
	    case '4' : x[i].style.backgroundColor = '#FFD900'; break;
	    case '5' : x[i].style.backgroundColor = '#BCFF00'; break;
	    case '6' : x[i].style.backgroundColor = '#6FFF00'; break;
	    case '7' : x[i].style.backgroundColor = '#31D009'; break;
	    case '8' : x[i].style.backgroundColor = '#2EC109'; break;
	    case '9' : x[i].style.backgroundColor = '#23A204'; break;
	    case '10': x[i].style.backgroundColor = '#1D8104'; break;
	    default:   x[i].style.backgroundColor = '#aaaaaa';
	} 
     }
     
   
     
  });
</script>

<style type="text/css">

	@font-face {
	   font-family: "Montserrat Regular";
	   src: url("{{URL::asset('fonts/Montserrat-Regular.ttf')}}") 
	}
	
</style>

         

{{ Form::model($modulo, array('action' => array('ResultadosController@update', $modulo->id), 'method' => 'PUT')) }}

        <div class="panel panel-info">
        <div class="panel-heading alto55">{{ Form::submit('Actualizar', array('class' => 'btn btn-primary', 'style' => 'float: right !important;')) }}
           <b>{{ $modulo->curso.' - '.$modulo->nombre }}</b></div>
	<div class="list-group">
        @foreach($modulo->alumnos as $alumno)
          <div class="container"><br>
	  <div class="dl-vertical">
	      <div class="row"><b>{{ $alumno->nombre.' '.$alumno->apellido1.' '.$alumno->apellido2 }}</b></div>
	      
	      <div class="row show-grid">
	      @for ($i = 1; $i <= $modulo->num_resultados; $i++)
                {{-- Obtenemos nota con el siguiente código PHP. No encontre mejor manera de hacerlo. --}}
	        <?php $str="$"."alumno->pivot->r".$i; $nota = eval ("return $str;"); ?>
	        
		 <div class="col-md-1 col-sm-1 col-xs-2">
		   <select class="nota outline"  id="{{'r'.$i.'_'.$alumno->id}}" name="{{'r'.$i.'_'.$alumno->id}}" >
		      <option value="-2">·</option>
		      <option value="-1">*</option>
		      <option value="0">0</option>
		      <option value="1">1</option>
		      <option value="2">2</option>
		      <option value="3">3</option>
		      <option value="4">4</option>
		      <option value="5">5</option>
		      <option value="6">6</option>
		      <option value="7">7</option>
		      <option value="8">8</option>
		      <option value="9">9</option>
		      <option value="10">10</option>
		    </select>
		    <script>
		       {{'r'.$i.'_'.$alumno->id}}.value = "{{ $nota }}";		       
		    </script>
		 </div>
	      
         
	      @endfor
	      
	      </div>
	 
	</div>
	  
	  </div>
	@endforeach
	</div>
</div>


	
{{ Form::close() }}

@stop
