<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Centro educativo - Dpto. de Informática y Comunicaciones</title>
  <link rel="icon" type="image/png" href="/img/favicon.png"  />

  <!-- PWA: Para habilitar Progressive Web Application -->
  <link rel="manifest" href="/manifest.json">

  <!-- PWA: Añadir a pantalla de inicio para Safari en iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="FP Resultados">
  <link rel="apple-touch-icon" href="/img/icons/icon-152x152.png">
  <meta name="msapplication-TileImage" content="/img/icons/icon-144x144.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">

  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>
<body style="padding-top: 60px; background-image: url('img/fondo.jpg')">
<div class="container" style="padding-top: 1em;">


<img src="/img/logo.png" alt="logo" class="img-responsive">

<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('email') }}
    {{ $errors->first('password') }}
</p>


<form action="/login" method="post">
@csrf 

<p>
<input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="correo@sitio.com">
<input type="password" name="password" id="password" placeholder="contraseña">
<input type="submit" value="Entrar" class="btn btn-primary">
</p>

<div class="form-group">
  <input type="checkbox" id="recuerdame" name="recuerdame">
  <label for="recuerdame">Recuérdame  </label>
</div>

</form>

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