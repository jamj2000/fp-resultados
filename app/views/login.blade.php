<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Centro educativo - Dpto. de Informática y Comunicaciones</title>
  <link rel="icon" type="image/png" href="{{ URL::asset('img/favicon.png')}}"  />

  <!-- PWA: Para habilitar Progressive Web Application -->
  <link rel="manifest" href="/manifest.json">

  <!-- PWA: Añadir a pantalla de inicio para Safari en iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Tienda">
  <link rel="apple-touch-icon" href="/icons/icon-152x152.png">
  <meta name="msapplication-TileImage" content="/icons/icon-144x144.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">

  
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

  <script>
// Si está soportado serviceWorker por el navegador
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register('./service-worker.js')
            .then(reg => console.log('[Service Worker] * Registrado.'))
            .catch(err => console.log(`[Service Worker] * Error: ${err}`));
    });
}
  </script>

  <!-- Gestión de eventos del ServiceWorker -->
  <script src="service-worker.js"></script>


</body>
</html>
