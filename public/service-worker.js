//// SERVICE WORKER. Siempre a la escucha en segundo plano,
//// aunque el usuario no esté en la página web.


// Nombre de la caché
const CACHE_NAME = 'fp-resultados-v1';

// Archivos necesarios para el funcionamiento offline
const CACHE_ASSETS = [
  '/',
  '/login',
  '/inicio',
  '/informacion',
  '/modulos',
  '/profesores',
  '/alummos',
  'css/added.css',
  'css/bootstrap.css',
  'css/bootstrap.css.map',
  'css/bootstrap.min.css',
  'css/bootstrap-select.css',
  'css/bootstrap-theme.css',
  'css/bootstrap-theme.css.map',
  'css/bootstrap-theme.min.css',
  'img/alumnos.png',
  'img/app-logo.png',
  'img/buttons/checked.gif',
  'img/buttons/checked_highlighted.gif',
  'img/buttons/intermediate.gif',
  'img/buttons/intermediate_highlighted.gif',
  'img/buttons/unchecked.gif',
  'img/buttons/unchecked_highlighted.gif',
  'img/favicon.png',
  'img/fondo.jpg',
  'img/info.png',
  'img/informes.png',
  'img/logo.png',
  'img/modulos.png',
  'img/profesores.png',
  'img/resultados.png',
  'js/added.js',
  'js/bootstrap.js',
  'js/bootstrap.min.js',
  'js/bootstrap-select.js',
  'js/jquery.min.js',
  'js/npm.js',
  'fonts/glyphicons-halflings-regular.eot',
  'fonts/glyphicons-halflings-regular.ttf',
  'fonts/Montserrat-Regular.ttf',
  'fonts/glyphicons-halflings-regular.svg',
  'fonts/glyphicons-halflings-regular.woff',
  'fonts/Ubuntu-Condensed.ttf'
];

// INSTALL
// Realizamos el cacheo de la APP SHELL
self.addEventListener('install', function (e) {
  console.log("[Service Worker] * Instalado.");

  e.waitUntil(
    caches
      .open(CACHE_NAME)
      .then(function (cache) {
        console.log('[ServiceWorker] Cacheando app shell');
        return cache.addAll(CACHE_ASSETS);
      })
      .then(function () {
        console.log('[ServiceWorker] Todos los recursos han sido cacheados');
        return self.skipWaiting();
      })
  );

});


// ACTIVATE
// Eliminamos cachés antiguas.
self.addEventListener('activate', function (e) {
  console.log("[Service Worker] * Activado.");

  e.waitUntil(
    caches
      .keys()
      .then(function (cacheNames) {
        return Promise.all(
          cacheNames.map(function (cacheName) {
            if (cacheName !== CACHE_NAME) {
              console.log("[Service Worker] Borrando caché antigua: ", cacheName);
              return caches.delete(cacheName);
            }
          })
        )
      })
  );
});


// FETCH
// Hacemos peticiones a recursos.
self.addEventListener('fetch', function (e) {
  console.log("[Service Worker] * Fetch.");

  // Hacemos petición a la red y si no está disponible obtenemos desde la caché
  e.respondWith(fetch(e.request)
    .catch(function () { return caches.match(e.request) }));

});


/*
// PUSH
self.addEventListener('push', function (e) {
  // Mantener el service worker a la espera hasta que la notificación sea creada.
  e.waitUntil(
    // Mostrar una notification con título 'Notificación importante' y cuerpo 'Alea iacta est'.
    self.registration.showNotification('Notificación importante', {
      body: 'Alea iacta est',
    })
  );
});
*/
