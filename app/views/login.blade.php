<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Centro educativo - Dpto. de Informática y Comunicaciones</title>
  <link rel="icon" type="image/png" href="{{ URL::asset('img/favicon.png')}}"  />
  
  {{HTML::style('css/bootstrap.css')}}
  <script src="http://code.jquery.com/jquery.js"></script>
  {{HTML::script('js/bootstrap.min.js')}}


</head>
<body style="padding-top: 60px; background-image: url({{ URL::asset('img/fondo.jpg')}})">
<div class="container" style="padding-top: 1em;">


{{ HTML::image('img/logo.png', 'logo', array('class' => 'img-responsive')) }}


<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('email') }}
    {{ $errors->first('password') }}
</p>

{{ Form::open(array('url' => 'login')) }}
<p>
    {{ Form::text('email', Input::old('email'), array('placeholder' => 'correo@sitio.com')) }}

    {{ Form::password('password', array('placeholder' => 'contraseña')) }}
    
    {{ Form::submit('Entrar', array('class' => 'btn btn-primary')) }}
</p>
<div class="form-group">
  <input type="checkbox" id="recuerdame" name="recuerdame">
  <label for="recuerdame">Recuérdame  </label>
</div>

{{ Form::token() }}
{{ Form::close() }}

</div>
</body>
</html>
