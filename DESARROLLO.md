Desarrollo de aplicación con Laravel 4.2



Introducción
============

En este tutorial se explicará paso a paso (pero sin entrar en demasiados detalles) como he desarrollado una aplicación web real con el Framework PHP Laravel 4.2. Es imprescindible que poseas conocimientos previos de uso de terminal de texto en Linux, principalmente la parte de gestión de archivos y directorios, puesto que la aplicación se desarrolla sobre Linux. También es aconsejable conocer HTML, CSS, PHP y Javascript, al menos a nivel básico.

El código fuente de la aplicación puedes bajarlo desde <https://github.com/jamj2000/fp-resultados> . La demo está en [http://fp-resultados.rhcloud.com](http://fp-resultados.rhcloud.com/) .

Laravel se ajusta a MVC (Modelo-Vista-Controlador), lo que permite trabajar de forma relativamente independiente cada una de estas partes de la aplicación. En el Modelo se define el esquema de datos utilizado para la base de datos. En la Vista o más frecuentemente varias Vistas definimos la forma de mostrar esos datos. El Controlador se encarga la lógica de la aplicación, recuperando datos desde el modelo e invocando a las vistas deseadas.



>__NOTA IMPORTANTE__: A partir de la versión 5 de Laravel la distribución de los archivos es diferente, por lo que este tutorial no es válido para la versión 5.



Instalación en local
====================

Instalación de paquetes necesarios
----------------------------------

```sh
apt install apache2 mysql-server php5 php5-mysql php5-mcrypt php5-gd mcrypt curl
```

Configuración de apache
-----------------------

/etc/apache2/apache2.conf

```apache2
<Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

Habilitamos módulos rewrite y mcrypt y reiniciamos servidor Apache2.

```sh
a2enmod rewrite
php5enmod mcrypt

service apache2 restart
```


Descarga de composer
--------------------

```sh
curl -sS  https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

Creación de proyecto
--------------------

En carpeta /var/www/html

Podemos instalar la versión 4.2, que es la utilizada para este tutorial, con el comando:

```sh
composer  create-project  laravel/laravel=4.2  nombre-proyecto  --prefer-dist
```


Podría instalarse la última versión (actualmente -Julio 2015- la versión 5), con el siguiente comando (aunque se desaconseja para seguir este tutorial puesto que existen muchos cambios en cuanto a la organización de los archivos):


```bash
composer  create-project  laravel/laravel  nombre-proyecto  --prefer-dist
``` 


> __NOTAS__:
 -   Debes de sustituir _nombre-proyecto_ por el nombre que tú quieras dar a tu proyecto, por ejemplo prueba, miproyecto, app-demo o similar.
 -   A partir de ahora trabajaremos con rutas relativas a /var/www/html/_nombre-proyecto_


Permisos
--------

```sh
cd /var/www/html/__nombre-proyecto__
chmod -R 777 app/storage
```

> __NOTA__: Es imprescindible que el subdirectorio __app/storage__ y todos sus subdirectorios tengan permisos de escritura.

Configuración
=============

Para entorno local o entorno de producción
------------------------------------------

Existen 2 configuraciones distintas según estemos en entorno local o en entorno de producción. Como entorno de producción para este tutorial se utiliza <https://www.openshift.com/> . En este servidor existen numeroras variables de entorno con la forma OPENSHIFT_*lo_que_sea*. Compruebamos una de estas variables para saber si estamos en el entorno de producción o no.

En el archivo __bootstrap/start.php__

```php
//$env = $app->detectEnvironment(array(
//        'local' => array('homestead'),
//));


$env = $app->detectEnvironment(function(){
        return getenv('OPENSHIFT_APP_DNS') ?: 'local';
});
```


Si NO se detecta la variable de entorno OPENSHIFT_APP_DNS pasamos a modo local, de lo contrario a modo producción.
En modo production (modo por defecto) se leen los archivos app/config/app.php y app/config/database.php.
En modo local se leen los archivos app/config/local/app.php y app/config/local/database.php.



Configuración de depuración
---------------------------

Cuando estamos en modo local es aconsejable tener activados los mensajes de depuración para obtener información detallada de los errores produccidos durante el desarrollo de la aplicación.

En archivo app/config/local/app.php

'debug' =\> true,

'locale' =\> 'es',

'fallback\_locale' =\> 'es',



NOTAS IMPORTANTES:

La opción 'debug' =\> true es adecuada cuando trabajamos en el equipo local y deseamos ver información de depuración. Es muy peligroso tener esta opción a true en un sitio en producción en Internet puesto que contiene mucha información sensible y nuestro sitio podría ser fácilmente atacado.

-   •Configuración local en app/config/local/app.php y app/config/local/database.php

-   •Configuración en producción en app/config/app.php y app/config/database.php

Comprobación de resultado en local
==================================

Abrimos el navegador y escribimos [http://](http://localhost/nombre-proyecto/public)[localhost/](http://localhost/nombre-proyecto/public)[nombre-proyecto](http://localhost/nombre-proyecto/public)[/](http://localhost/nombre-proyecto/public)[public](http://localhost/nombre-proyecto/public) en el campo de dirección. Debe aparecer una página de inicio con el logotipo de laravel. Sustituye nombre-proyecto por el nombre que le hayas dado.


Base de datos
=============

Introducción
------------

NOTA: Todo el proceso se ha automatizado mediante un script bash (Ver más abajo). En este apartado sólo se indican los pasos que vamos a seguir. No es necesario hacer nada con la base de datos.

Se hará uso de MySQL. Se creará una base de datos llamada fp.

Dentro de esta base de datos crearemos las siguientes tablas:

-   •alumnos

-   •modulos

-   •profesores

-   •modulos\_alumnos

Tenemos los datos en varios archivos .csv. Los archivos son:

-   •alumnos.csv

-   •modulos.csv

-   •profesores.csv

-   •modulos\_alumnos.csv



Los archivos .csv (Comma Separated Values) son archivos de texto plano que pueden abrirse con un editor de texto normal y corriente. También pueden abrirse, modificarse y tratarse con cualquier hoja de cálculo.



El esquema Entidad-Relación es el siguiente:

![Diagrama E-R](https://github.com/jamj2000/fp-resultados.capturas/blob/master/E-R.png "Diagrama E-R")



Cada tabla tiene un campo id númerico con autoincremento que es clave primaria. No se indica en el esquema previo. Para más detalles consultar más abajo el script tablas.sql.

Cada módulo admitirá un máximo de 9 resultados de aprendizaje. La cantidad concreta se almacena en el campo Número de resultados.

Para cada resultado de aprendizaje existirá su peso correspondiente (por defecto todos con el mismo peso -10-), por si en el futuro se desea poner calificación numérica y ponderar cada resultado de forma distinta.

La nota de cada alumno en cada módulo se almacena en los campos R1, R2, ..., R9, para cada uno de los resultados de aprendizaje. Estos campos tendrán valor:

-   •-2:     si el resultado no ha sido impartido. 

-   •-1:     si el módulo no ha terminado de impartirse y no existe aún nota definitiva.

-   •0 - 10: si el módulo se ha impartido y evaluado.



Para automatizar el proceso se hace uso de un script bash (database.sh) y de otro sql (tablas.sql)

El script database.sh crea la base de datos llamada fp, invoca al script tablas.sql para crear las tablas y después las rellena con el contenido de los archivos .csv. Los scripts y los archivos .csv deben hallarse todos en el mismo directorio.

### Script database.sh

\#!/bin/bash

if  [ \$OPENSHIFT\_APP\_DNS ] ;then

  HOST=\$OPENSHIFT\_MYSQL\_DB\_HOST

 PUERTO=\$OPENSHIFT\_MYSQL\_DB\_PORT

USUARIO=\$OPENSHIFT\_MYSQL\_DB\_USERNAME

 CLAVE=\$OPENSHIFT\_MYSQL\_DB\_PASSWORD

else

  HOST="localhost"

 PUERTO="3306"

USUARIO="root"

 CLAVE="root"

fi

BASEDATOS="fp"

TABLAS="tablas.sql"

ALUMNOS="alumnos.csv"

PROFESORES="profesores.csv"

MODULOS="modulos.csv"

MODULOS\_ALUMNOS="modulos\_alumnos.csv"

echo "Creando base de datos \$BASEDATOS desde cero"

echo "drop  database if exists   \$BASEDATOS;" | mysql -u \$USUARIO -p\$CLAVE -h\$HOST -P\$PUERTO

echo "create database if not exists \$BASEDATOS\\

      default character set utf8 \\

      default collate utf8\_general\_ci;"  | mysql -u \$USUARIO -p\$CLAVE -h\$HOST -P\$PUERTO

echo "Creando tablas desde archivo \$TABLAS"

mysql -u\$USUARIO -p\$CLAVE -h\$HOST -P\$PUERTO \$BASEDATOS \< \$TABLAS

echo "Importando datos desde archivo \$PROFESORES"

mysqlimport --ignore-lines=1 \\

      --fields-terminated-by=, \\

      --columns='apellido1,apellido2,nombre,tutoria,email,alias,password,remember\_token,admin' \\

      --local -u\$USUARIO -h\$HOST -P\$PUERTO -p\$CLAVE \$BASEDATOS \$PROFESORES 2&\> /dev/null

echo "Importando datos desde archivo \$ALUMNOS"

mysqlimport --ignore-lines=1 \\

      --fields-terminated-by=, \\

      --columns='apellido1,apellido2,nombre,curso,fecha\_nac,email,id\_escolar' \\

      --local -u\$USUARIO -p\$CLAVE -h\$HOST -P\$PUERTO \$BASEDATOS \$ALUMNOS 2&\> /dev/null

echo "Importando datos desde archivo \$MODULOS"

mysqlimport --ignore-lines=1 \\

      --fields-terminated-by=, \\

      --columns='profesor\_id,siglas,nombre,curso,ciclo,horas\_totales,horas\_semanales,num\_resultados,r1\_peso,r2\_peso,r3\_peso,r4\_peso,r5\_peso,r6\_peso,r7\_peso,r8\_peso,r9\_peso' \\

      --local -u\$USUARIO -p\$CLAVE -h\$HOST -P\$PUERTO \$BASEDATOS \$MODULOS 2&\> /dev/null

      

echo "Importando datos desde archivo \$MODULOS\_ALUMNOS"

mysqlimport --ignore-lines=1 \\

      --fields-terminated-by=, \\

      --columns='modulo\_id,alumno\_id,r1,r2,r3,r4,r5,r6,r7,r8,r9' \\

      --local -u\$USUARIO -p\$CLAVE -h\$HOST -P\$PUERTO \$BASEDATOS \$MODULOS\_ALUMNOS 2&\> /dev/null





### Script tablas.sql

drop table if exists modulos\_alumnos, alumnos, modulos, profesores;



CREATE TABLE \`alumnos\` (

 \`id\` integer NOT NULL AUTO\_INCREMENT,

 \`apellido1\` varchar(100),

 \`apellido2\` varchar(100),

 \`nombre\` varchar(100),

 \`curso\` varchar(100),

 \`fecha\_nac\` date DEFAULT '0000-00-00',

 \`email\` varchar(100),

 \`id\_escolar\` integer, 

 \`created\_at\` timestamp NOT NULL DEFAULT NOW(),

 \`updated\_at\` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',

 PRIMARY KEY (\`id\`)

) ENGINE=INNODB AUTO\_INCREMENT=1;

CREATE TABLE \`modulos\` (

 \`id\` integer NOT NULL AUTO\_INCREMENT,

 \`profesor\_id\` integer,

 \`siglas\` varchar(100),

 \`nombre\` varchar(100),

 \`curso\` varchar(100),

 \`ciclo\` varchar(100),

 \`horas\_totales\` integer,

 \`horas\_semanales\` integer,

 \`num\_resultados\` integer,

 \`r1\_peso\` integer,

 \`r2\_peso\` integer,

 \`r3\_peso\` integer,

 \`r4\_peso\` integer,

 \`r5\_peso\` integer,

 \`r6\_peso\` integer,

 \`r7\_peso\` integer,

 \`r8\_peso\` integer,

 \`r9\_peso\` integer,

 \`created\_at\` timestamp NOT NULL DEFAULT NOW(),

 \`updated\_at\` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',

 PRIMARY KEY (\`id\`)

) ENGINE=INNODB AUTO\_INCREMENT=1;

CREATE TABLE \`profesores\` (

 \`id\` integer NOT NULL AUTO\_INCREMENT,

 \`apellido1\` varchar(100),

 \`apellido2\` varchar(100),

 \`nombre\` varchar(100),

 \`tutoria\` varchar(100),

 \`email\` varchar(100),

 \`alias\` varchar(100),

 \`password\` varchar(100),

 \`remember\_token\` varchar(100) DEFAULT NULL,

 \`admin\` char(1),

 \`created\_at\` timestamp NOT NULL DEFAULT NOW(),

 \`updated\_at\` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',

 PRIMARY KEY (\`id\`)

) ENGINE=INNODB AUTO\_INCREMENT=1;

CREATE TABLE \`modulos\_alumnos\` (

 \`id\` integer NOT NULL AUTO\_INCREMENT,

 \`modulo\_id\` integer NOT NULL,

 \`alumno\_id\` integer NOT NULL,

 \`r1\` integer DEFAULT '-2',

 \`r2\` integer DEFAULT '-2',

 \`r3\` integer DEFAULT '-2',

 \`r4\` integer DEFAULT '-2',

 \`r5\` integer DEFAULT '-2',

 \`r6\` integer DEFAULT '-2',

 \`r7\` integer DEFAULT '-2',

 \`r8\` integer DEFAULT '-2',

 \`r9\` integer DEFAULT '-2',

 PRIMARY KEY (\`id\`)

) ENGINE=INNODB AUTO\_INCREMENT=1;





Archivos de configuración
-------------------------

Editamos archivo app/config/local/database.php

       'mysql' =\> array(

            'driver'  =\> 'mysql',

            'host'   =\> 'localhost',

            'database' =\> 'fp',// Nombre de la base de datos

            'username' =\> 'root',    // Usuario de la base de datos   

            'password' =\> 'root',    // Clave del usuario

            'charset'  =\> 'utf8',

            'collation' =\> 'utf8\_unicode\_ci',

            'prefix'  =\> '',

        ),



Editamos archivo app/config/database.php

       'mysql' =\> array(

            'driver'  =\> 'mysql',

            'host'   =\> getenv('OPENSHIFT\_MYSQL\_DB\_HOST'),

            'port'   =\> getenv('OPENSHIFT\_MYSQL\_DB\_PORT'),

            'database' =\> 'fp',

            'username' =\> getenv('OPENSHIFT\_MYSQL\_DB\_USERNAME'),

            'password' =\> getenv('OPENSHIFT\_MYSQL\_DB\_PASSWORD'),

            'charset'  =\> 'utf8',

            'collation' =\> 'utf8\_unicode\_ci',

            'prefix'  =\> '',

        ),



Creación de la base de datos en sitio local
-------------------------------------------

Simplemente ejecutamos script database.sh.

./database.sh





Creación de la base de datos en sitio de producción
---------------------------------------------------

NOTA: Para poder seguir los pasos indicados a continuación debe poseerse una cuenta en Openshift y tener dada de alta una aplicación.

1.  1.Subimos archivos a carpeta app-root/data del equipo remoto.

scp database.sh tablas.sql modulos.csv profesores.csv alumnos.csv modulos\_alumnos.csv usuario\_numero@app-domain.rhcloud.com:app-root/data

Donde:

-   •usuario\_numero debe sustituirse por el nombre de nuestro usuario en Openshift en forma de número.

-   •app-domain debe sustituirse por el nombre de nuestra apliación en Openshift.



1.  2.En equipo remoto ejecutamos script database.sh.

ssh usuario\_numero@app-domain.rhcloud.com

cd app-root/data

chmod +x database.sh

./database.sh



Consejos para exportar e importar datos
---------------------------------------

### Si tenemos los datos en MySQL y queremos exportar a archivo:

-   •A archivo .csv:    

mysqldump [-u uname] -p[pass] -t -T/tmp db\_name [db\_table1] [db\_table2] --fields-terminated-by=','

Ésto crea un archivo /tmp/db\_table1.txt (es un archivo CSV). El directorio destino (en este caso /tmp) debe ser escribible por el usuario mysql.

-   •A archivo .sql:

mysqldump [-u uname] -p[pass] db\_name [db\_table1] [db\_table2] \> db\_backup.sql



### Si tenemos un archivo .sql y queremos importar a MySQL:

mysql [-u uname] -p[pass] db\_name \< db\_backup.sql

NOTA: Sustituir con los valores adecuados uname, pass, db\_name, db\_table1, db\_table2.



Migrations and Seeds
--------------------

NOTA: Esta forma de trabajar NO se ha utilizado. Solo la comento como una posibilidad. Considero más manejable para grandes cantidades de datos el importar directamente dentro de mysql el contenido de archivos .csv con los datos.

Es posible trabajar con la BD de forma indirecta. Para ello laravel utiliza un sistema de migraciones y sembrado.

Las migraciones corresponden a la creación de la estructura de las tablas.

El sembrado corresponde al rellenado de datos de estas tablas.

Para utilizar este método debemos usar el comando artisan y seguir los pasos siguientes:

1.  1.Crear la base de datos con MySQL u otro gestor.

2.  2.Darla de alta en el archivo app/config/database.php

3.  3.MIGRATIONS. Crear las tablas. Por ejemplo para crear una tabla llamada users:

php artisan migrate:make CreateUsersTable –create=users --table=users

Editar los archivos necesarios en app/database/migrations/\* . Y ejecutar:

php artisan migrate

1.  4.SEEDS. Rellenar las tablas. Para ello editar los archivos app/database/seeds/\* . Y ejecutar: 

php artisan db:seed





Modelos
=======

En el directorio app/models tenemos tres archivos (Alumno.php, Modulo.php y Profesor.php)





app/models/Alumno.php

\<?php

class Alumno extends Eloquent

{

  public function modulos() {

    return \$this-\>belongsToMany('Modulo', 'modulos\_alumnos','alumno\_id', 'modulo\_id')

       -\>withPivot('r1', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'r8', 'r9');

  }



}



app/models/Modulo.php

\<?php

class Modulo extends Eloquent

{

 //protected \$fillable = array('name', 'taste\_level');

  public function profesor() {

    return \$this-\>belongsTo('Profesor');

  }

  public function alumnos() {

    return \$this-\>belongsToMany('Alumno', 'modulos\_alumnos', 'modulo\_id', 'alumno\_id')

       -\>withPivot('r1', 'r2', 'r3', 'r4', 'r5', 'r6', 'r7', 'r8', 'r9');

  }

}



app/models/Profesor.php

\<?php

use Illuminate\\Auth\\UserTrait;

use Illuminate\\Auth\\UserInterface;

use Illuminate\\Auth\\Reminders\\RemindableTrait;

use Illuminate\\Auth\\Reminders\\RemindableInterface;

class Profesor extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /\*\*

    \* The database table used by the model.

    \*

    \* @var string

    \*/

    protected \$table = 'profesores';

    /\*\*

    \* The attributes excluded from the model's JSON form.

    \*

    \* @var array

    \*/

    protected \$hidden = array('password', 'remember\_token');

    public function modulos() {

       return \$this-\>hasMany('Modulo');

    }

   

}



Por convenio, Laravel asocia automáticamente cada clase (Alumno, Modulo y Profesor) con las tablas MySQL alumnos, modulos y profesors. Observa que la clase empieza por mayúscula y está en sigular y la tabla mysql asociada está en minúsculas y plural añadiendo únicamente la letra 's'. Para la clase Profesor la tabla que busca Laravel es profesors. Por tanto debemos indicar dentro de la clase Profesor que la tabla asociada es profesores.

protected \$table = 'profesores';

Observa también como indicamos el tipo de relación (1:N o N:N). entre las tablas.

Vistas
======

Existen numerosas vistas.

-   •plantilla.blade.php 

-   •inicio.blade.php 

-   •login.blade.php 

-   •alumnos (carpeta) 

-   •modulos (carpeta) 

-   •profesores (carpeta) 

-   •resultados (carpeta)

-   •informes (carpeta)

-   •informacion (carpeta) 

Se hace uso de extensiones blade ( código entre dobles llaves {{ }} )

Controladores
=============

La lógica de la aplicación se halla en varios archivos en la carpeta app/controllers:

-   •BaseController.php 

-   •HomeController.php 

-   •AlumnoController.php 

-   •ModuloController.php 

-   •ProfesorController.php 

-   •InformesController.php 

-   •ResultadosController.php

### Controladores de recursos RESTful

Podemos crear fácilmente el esqueleto de un controlador haciendo uso de artisan. En /var/www/html/app-domain ejecutamos:

php artisan controller:make ResultadosController --only=index,edit,update



Añadimos a app/routes.php

 Route::resource('resultados', 'ResultadosController');





app/controllers/ResultadosController.php

\<?php

class ResultadosController extends \\BaseController {

    public function index()

    {

        //

    }

  

    public function edit(\$id)

    {

        //

    }

  

    public function update(\$id)

    {

        //

    }

}

Rutas
=====

Para poder acceder a las distintas rutas de la aplicación, debemos darlas de alta.

Editar archivo app/routes.php

\<?php

Route::get('/', function()

{ 

  return Redirect::to('login');

});

// route to show the login form

Route::get('login', array('uses' =\> 'HomeController@showLogin'));

// route to process the form

Route::post('login', array('uses' =\> 'HomeController@doLogin'));

// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.

Route::group(array('before' =\> 'auth'), function()

{

 Route::get('inicio', function()

 {

    return View::make("inicio");

 });

 Route::get('logout', array('uses' =\> 'HomeController@doLogout'));

 

 Route::get('informacion', function() { return View::make("informacion.index"); });

 Route::get('informes/evaluacion/{curso}/{medio}', array('uses' =\> 'InformesController@evaluacion'));

 Route::post('informes/evaluaciones', array('uses' =\> 'InformesController@evaluaciones'));

 

 Route::get('informes/calificaciones/{id}', array('uses' =\> 'InformesController@calificaciones'));

 Route::post('informes/calificacionesvarias/{curso}', array('uses' =\> 'InformesController@calificacionesvarias'));

 Route::resource('alumnos',  'AlumnoController');

 Route::resource('modulos',  'ModuloController');

 Route::resource('profesores', 'ProfesorController');

 Route::resource('resultados', 'ResultadosController');

 Route::resource('informes',  'InformesController');

 

});





Autenticación
=============

Indicamos en app/config/auth.php que la tabla profesores es donde se almacenarán las claves, en lugar de la tabla users.

\<?php

return array(

  'driver' =\> 'eloquent',

  'model' =\> 'Profesor',          

  'table' =\> 'profesores',   //tabla que queremos utilizar para autenticar

...

);



Generando passwords Blowfish
----------------------------

En /var/www/html/nombre-proyecto ejecutamos:

php artisan tinker

echo Hash::make('password');



Se general claves de la forma

\$2y\$10\$wZuOP5EdJ1f3caU0ShknTOpqKv78d79Gc3ChEj33mnbu41GaRniNm

Explicación en

<https://mnshankar.wordpress.com/2014/03/29/laravel-hash-make-explained/>



Quizás sea posible hacer uso del comando mcrypt de Linux para ello, aunque no lo he comprobado.



Contenido de la tabla profesores
--------------------------------

profesores.csv (simplificado)



|:--|
|Primer apellido

Segundo apellido

Nombre

Contraseña|Muñoz

Jiménez

José Antonio

\$2y\$10\$LefyK9fMkSV8n1y0Uz1E1e3/Xdcq5tAPdbrGun6ItZ8rLfnrkGDca|Pareja

Delgado

Ana María

\$2y\$10\$smeD8XAmcxpiHfURbc0uqOvXG9pK4EhNfDy6Ip3oqsctNTBz5i9I.|Merino

Fernández

Fernando

\$2y\$10\$IvU9okb2W/8lPvPWGMHd/.exYlAG3Z.VNimwszB6mP2Rw.043iW7y|Pérez

Fuentes

Isaías

\$2y\$10\$OfqbfoMmY7mnP.XRX1Lx4uAA1zjXgI5jSIbmLS3Emb65f97u8rnPK|Antolino

García

Jacinto

\$2y\$10\$MlwoQq.4LH3SBRT6Dz6hTuR314IxzSJnQXbc4Pq8EqmWwGyTdAyEK|Lozano

Ortega

José María

\$2y\$10\$XLsFZ8NRsdWMwvKqBPWU2OhAcUbI2WQK1YlqNLgzDxcGElM8qldwa|Molina

Polo

María Eugenia

\$2y\$10\$ZbhCfvimFrfUR3PSGJR/fejRqkEJt7Br0fdnERN/uFnPyP8ayFQJ6|Siles

Rosado

María Inmaculada

\$2y\$10\$viS3TmBpQbxJOZWEwcrvye2WCkLDK1nPjBcZkkeXI5EMzXEZkLw8C|Conde

Silva

Marta Teresa

\$2y\$10\$fF91W.6nQGkfR/XR0rRa2Oh./BahV2WMMaVVi2BSeQ.jD9ixB97FG|García

Viera

Miguel Ángel

\$2y\$10\$9tkQHZCEDnWaMfSEBKtS4uK4lrEOkLKefNaI/e7zlLawNNTRPptgi|













Generación de PDFs con Laravel
==============================

ignited con wkhtmltopdf
-----------------------

<https://github.com/mikehaertl/phpwkhtmltopdf>

<https://github.com/ignited/laravel-pdf>

<http://stackoverflow.com/questions/19649276/laravel-4-wkhtmltopdf-routes-post-and-get-issue>



Editar el archivo composer.json insertando las siguientes líneas:

{

  "require": {

    // ...

   "ignited/laravel-pdf": "1.\*",

    "h4cc/wkhtmltopdf-i386": "\*",

    "h4cc/wkhtmltopdf-amd64": "\*"

  }

}



Para descargar paquetes ejecutar

composer update



Publicar el paquete usando artisan

php artisan config:publish ignited/laravel-pdf



Se habrán creado 2directorios:

-•vendor/h4cc

-•vendor/ignited



Enarchivoapp/config/app.phpinsertarlassiguienteslíneas:

'providers'=\>array(

//...

'Ignited\\Pdf\\PdfServiceProvider',

)

//...

'aliases'=\>array(

//...

'PDF'=\>'Ignited\\Pdf\\Facades\\Pdf'

)





Enarchivoapp/config/packages/ignited/laravel-pdf/config.phpdescomentarunadelassiguienteslíneassegúnSOde32bitso64bits:



###Sistemasde32-bits

returnarray(

\#Uncommentfor32-bitsystems

'bin'=\>base\_path().'/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386',

###Sistemasde64-bits

returnarray(

\#Uncommentfor64-bitsystems

'bin'=\>base\_path().'/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64',





Instalaciónenremoto
=====================

NOTA:ParapoderseguirlospasosindicadosacontinuacióndebesposeerunacuentaenOpenshiftytenerdadadealtaunaaplicación.

Requisitos
----------

-•Tenemosunaaplicaciónlaravelfuncionandocorrectamenteennuestroequipolocalen/var/www/html/pruebaosimilar.

-•HemoscreadounacuentayunaaplicaciónenOpenshift.

-•HemossubidolabasededatosaOpenshift.

Pasosaseguir
--------------

1.1.Enlocal,vamosa/var/www/htmlybajamoslospocosarchivosqueexistenenOpenshift

cd/var/www/html

gitclonessh://usuario\_numero@app-domain.rhcloud.com/\~/git/app.git/



1.2.Copiamosarchivosde/var/www/html/pruebaa/var/www/html/app-domain

rsync-avprueba/app-domain/--exclude=.git--exclude=.openshift



1.3.Subimosarchivosasitioremoto.

cdapp-domain

gitadd.

gitcommit-m"Archivosdelaravellocalessubidosporprimeravez"

gitpush



1.4.ConectamosmedianteSSHyhusmeamosunpocoaverquetalhaquedado.



sshusuario\_numero@app-domain.rhcloud.com

tree-L6



Nosquedaunaestructuradedirectoriostalcomolamostradaacontinuación.Sehasuprimidolavistadelosarchivosmenosimportantes.Losarchivossesubenautomáticamentealdirectoriorepo,queseráconelquetrabajaremos.Ennegritalosarchivosmásimportantes.

.

├──app-deployments

├──app-root

│├──build-dependencies-\>runtime/build-dependencies

│├──data

│├──dependencies-\>runtime/dependencies

│├──logs

│├──repo-\>runtime/repo

│└──runtime

│├──build-dependencies

│├──data-\>../data

│├──dependencies

│├──logshifter-haproxy

│└──repo

│├──app

││├──commands

││├──config

│││├──app.php

│││├──database.php

│││└──local

│││├──app.php

│││└──database.php

││├──controllers

││├──database

││├──filters.php

││├──lang

│││└──en

││├──models

││├──routes.php

││├──start

││├──storage

││├──tests

││└──views

│├──artisan

│├──bootstrap

│├──composer.json

│├──composer.lock

│├──CONTRIBUTING.md

│├──index.php

│├──phpunit.xml

│├──public

│├──readme.md

│├──server.php

│├──tree.txt

│├──usuarios.sql

│└──vendor

├──gear-registry

├──git

├──haproxy

└──php



ANEXOI:Archivosmodificadosoañadidos
========================================

-•composer.json

-•bootstrap/start.php

-•app/routes.php

-•app/config/local/database.php

-•app/config/local/app.php

-•app/config/database.php

-•app/config/auth.php

-•app/models/\*

-•app/controllers/\*

-•app/views/\*

-•public/

-•public/css/\*

-•public/js/\*

-•public/fonts/\*

-•public/img/\*

-•vendor/ignited/\*(Instaladoconcomposer)

-•vendor/h4cc/\*(Instaladoconcomposer)









ANEXOII:Referencias
=====================

Laravel
-------

Tutorialbase:<http://codehero.co/series/laravel-4-desde-cero/>

Documentaciónoficial:<http://laravel.com/docs/4.2>



Openshift
---------

CreacióndeaplicaciónenOpenshift:<http://www.deploy2cloud.com/laravel/Install-Custom-laravel-4-Application-to-OpenShift>



Ejemplos
--------

Frameworkforauthorizationandauthentication:<https://cartalyst.com/manual/sentry/2.1#installation>

CRUDoperations:<https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers>

DBRelations:<https://scotch.io/tutorials/a-guide-to-using-eloquent-orm-in-laravel>

SimpleLogin:<https://scotch.io/tutorials/simple-and-easy-laravel-login-authentication>

Otrostutosdescotch.iosobreLaravel:<https://scotch.io/tag/laravel>

EjemploconSentry:<https://github.com/brunogaspar/laravel-starter-kit>

Ejemplobasadoenelanterior:<https://github.com/andrewelkins/Laravel-4-Bootstrap-Starter-Site>

