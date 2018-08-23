# fp-resultados
![Logo de ejemplo](https://github.com/jamj2000/fp-resultados.capturas/blob/master/logo.png "Logo de ejemplo")

## Repositorios relacionados
- [App para android](https://github.com/jamj2000/fp-resultados.apk)
- [Datos de ejemplo](https://github.com/jamj2000/fp-resultados.datos)
- [Capturas](https://github.com/jamj2000/fp-resultados.capturas)


## Introducción
__fp-resultados__ es una aplicación web destinada al profesorado de Formación Profesional en España. Realizada en mi tiempo libre para seguir aprendiendo sobre distintas tecnologías web. La pongo a disposición de toda la comunidad por si alguien la considera interesante por motivos didácticos o de producción.

![Captura web](https://github.com/jamj2000/fp-resultados.capturas/blob/master/captura-web.png "Captura web")

Existe una aplicación funcional alojada en [heroku.com](http://fp-resultados.herokuapp.com) para fines demostrativos. La primera vez que se accede a ella suele tardar algún tiempo en cargar. Si esto ocurre volver a intentar de nuevo. 

![Código QR de la aplicación](https://github.com/jamj2000/fp-resultados.capturas/blob/master/fp-resultados.qr.mini.png "Logo de ejemplo")

La aplicación es funcional y dispone de numerosas características.


### Características
- Permite calificar por resultados de aprendizaje.
- Genera actas de evaluación y boletines de calificaciones en HTML y PDF.
- Se ha diseñado pensando en los ciclos formativos de la familia profesional de Informática y Comunicaciones, sin embargo es posible adaptarla a otras familias profesionales.
- Permite las operaciones CRUD (Create, Read, Update, Delete) a base de datos MySQL a través de interfaz web.


### Probar la aplicación de demostración
Si deseas comprobar las funcionalidades que ofrece esta aplicación, abre en el navegador la dirección [http://fp-resultados.herokuapp.com](http://fp-resultados.herokuapp.com).

Para entrar debes introducir un correo y contraseña.
Puedes utilizar cualquiera de los siguientes (correos ficticios):

```
email                  contraseña  
=================================
profe1@gmail.com       profe1
profe2@gmail.com       profe2
profe3@gmail.com       profe3
profe4@gmail.com       profe4
profe5@gmail.com       profe5
profe6@gmail.com       profe6
profe7@gmail.com       profe7
profe8@gmail.com       profe8
profe9@gmail.com       profe9
```
Cada proferor puede calificar los resultados de aprendizaje de los módulos que imparte.
Algunos de ellos son tutores de algún curso, otros no. Los que son tutores pueden ver y generar los boletines de notas de su tutoría. Existe un administrador (yo, con correo real jamj2000@gmail.com) que puede ver y generar las actas de evaluación así como realizar diversas tareas administrativas.

Si deseas comprobar las posibilidades para el/los usuarios administradores deberás instalarte la aplicación en tu equipo local y probarla ahí.


## Despliegue en equipo local

Este proyecto se desarrolló durante el año 2015, por lo tanto tiene ya algunos años. Es un proyecto realizado en **PHP** con el **Framework Laravel 4.2**. Debido a esto es requisito usar la versión **PHP5** en lugar de la versión PHP 7 actual. La mayoría de las distribuciones modernas ya vienen con PHP 7. Así que si deseamos instalar la versión 5 deberemos añadir los repositorios adecuados. 

Si estás interesado en probar la aplicación en tu equipo local, aquí tienes los pasos a seguir para PC con distro Ubuntu o similar:

0) Prerrequisito de PHP 5.

Para instalar la versión 5 de PHP, debemos añadir los repositorios adecuados. Por ejemplo, para Ubuntu 18.04 hacemos:

```bash
sudo add-apt-repository -y ppa:ondrej/php
sudo apt update
```

1) Instala los paquetes necesarios para tener un servidor Apache+PHP+MySQL

```bash
sudo apt-get install apache2 mysql-server php5.6 php5.6-mysql php5.6-mcrypt mcrypt curl git
```

2) Configura el archivo /etc/apache2/apache2.conf, para que aparezca

```apache
<Directory /var/www/>
  Options Indexes FollowSymLinks
  AllowOverride All
  Require all granted
</Directory>
```
 
3) Activa módulos de Apache y reinicia servidor

```bash
a2enmod rewrite
php5enmod mcrypt
service apache2 restart/reload
``` 
 
4) Descarga código del repositorio [fp-resultados](https://github.com/jamj2000/fp-resultados)

```bash
cd /var/www/html
git clone https://github.com/jamj2000/fp-resultados.git
```

5) Entra en el directorio donde se ha descargado el código y da permisos de escritura al subdirectorio app/storage

```bash
cd /var/www/html/fp-resultados
chmod -R 777 app/storage
```

6) Prueba en el navegador [http://localhost/fp-resultados/public](http://localhost/fp-resultados/public)

7) Descarga datos de ejemplo del repositorio [fp-resultados.datos](https://github.com/jamj2000/fp-resultados.datos)

```bash
cd /var/www/html
git clone https://github.com/jamj2000/fp-resultados.datos.git
```

8) Revisa el script ```database.sh``` para modificar tu usuario y clave de mysql

```bash
cd /var/www/html/fp-resultados.datos
nano database.sh
```

9) Ejecuta el script ```database.sh```

```bash
chmod +x database.sh
./database.sh
```

10) Recuerda que los valores previos también deben hallarse en el archivo ```/var/www/html/fp-resultados/app/config/local/database.php```. Por ejemplo para usuario root y clave root. Modifica los valores según hayas hecho en ```database.sh```.

```php
               'mysql' => array(
                        'driver'    => 'mysql',
                        'host'      => 'localhost',
                        'port'      => '3306',
                        'database'  => 'fp',
                        'username'  => 'root',
                        'password'  => 'root',
                        'charset'   => 'utf8',
                        'charset'   => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix'    => '',
                ),

```

11) Instala el software `composer`.

```bash
curl -sS  https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

12) Actualiza e instala las dependencias necesarias 

```bash
composer update
composer install
```

Cuando ejecutamos `composer update`, el compositor genera un archivo llamado `composer.lock` que enumera todos sus paquetes y las versiones instaladas actualmente. Esto nos permite ejecutar más tarde `composer install`, que instalará los paquetes enumerados en ese archivo, recreando el entorno que se estaba utilizando por última vez.

Si todo ha ido bien, se creará una carpeta llamada `vendor` con todos los paquetes que necesita la aplicación como dependencias.

## Despliegue en Internet

Actualmente la aplicación está desplegada en [HEROKU](https://www.heroku.com). Como base de datos utiliza DBaaS MySQL proporcionado por [GEARHOST](https://gearhost.com).


## Despliegue en Openshift (Desactualizado)

Si quieres conocer los detalles técnicos acerca de cómo desplegué esta aplicación en OPENSHIFT puedes seguir [este tutorial](https://github.com/jamj2000/fp-resultados/blob/master/INSTALACION.md) explicando los pasos principales. **Actualmente la guía no es correcta, puesto que la plataforma actualizó toda su infraestructura.**


## Desarrollo de la aplicación con Laravel 4.2

Si quieres conocer los detalles técnicos acerca de cómo he creado está aplicación puedes seguir [este tutorial](https://github.com/jamj2000/fp-resultados/blob/master/DESARROLLO.md) explicando los conceptos principales. Te ayudará a entender el código fuente.


# Licencia

* [GPL-3](http://www.gnu.org/licenses/gpl-3.0.html) / <https://github.com/jamj2000/fp-resultados>
* [CC BY-SA 4.0](https://creativecommons.org/licenses/by-sa/4.0/) / <https://github.com/alecive/FlatWoken>

```
- Código            GPL-3         José Antonio Muñoz Jiménez
- Iconos FlatWoken  CC BY-SA 4.0  Alessandro Roncone         
```
