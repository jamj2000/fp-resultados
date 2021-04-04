<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Centro Educativo - Dpto. de Informática y Comunicaciones</title>
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
  
  <link rel="stylesheet" href="/css/bootstrap.css">
  <link rel="stylesheet" href="/css/bootstrap-select.css">
  <link rel="stylesheet" href="/css/added.css">

  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/bootstrap-select.js"></script>
  

  <!--
  
   <script>
   $(document).ready(function () {
        $('.menu').click ( function(){                     
            $('.menu').removeClass('active');  //borrar item activo previo
            $(this).addClass('active');    
        });
       
    });
    </script>
-->

</head>
<body style="padding-top: 60px; background-image: url('/img/fondo.jpg')">


<div class="container" style="padding-top: 1em;">
@auth
<nav class="navbar navbar-default  navbar-fixed-top"  role="navigation">
	<div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex6-collapse">
		<span class="sr-only">Desplegar navegación</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	    </button>
	<a class="navbar-brand" href="/inicio">
	    <img style="max-width:100px; margin-top: -7px;" src="/img/favicon.png">
	</a>
	</div>
	<div class="collapse navbar-collapse navbar-ex6-collapse">
	    <ul class="nav navbar-nav">
	        <li class="menu"><a href="/resultados">Resultados</a></li>
	        <!-- <li class="menu"><a href="/informes">Informes</a></li> -->
	        <li class="menu"><a href="/info">Información</a></li>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		    Datos <b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
		    <li class="menu"><a href="/modulos">Módulos</a></li>
		    <li class="menu"><a href="/profesores">Profesores</a></li>
		    <li class="menu"><a href="/alumnos">Alumnos</a></li>		    
		  </ul>		  
		</li>		
	    </ul>
	    <div class="navbar-form navbar-right" >

	        <a class="btn btn-default" style="margin-right: 5px" href="/profesores/{{ Auth::user()->id }}">	        	       
	        {{ Auth::user()->nombre }}  {{ Auth::user()->apellido1 }} {{ Auth::user()->apellido2 }}
	        </a>          
	        <a class="btn btn-default" style="margin-right: 5px" href="/logout">	        	       
	           <span class="glyphicon glyphicon-remove-circle"></span>
	        </a>

	    </div>

	</div>
</nav>
@endauth

@yield('contenido')


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
