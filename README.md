# fp-resultados
![Logo de ejemplo](https://github.com/jamj2000/fp-resultados.capturas/blob/master/logo.png "Logo de ejemplo")

## Repositorios relacionados
[App para android](https://github.com/jamj2000/fp-resultados.apk)
[Datos de ejemplo](https://github.com/jamj2000/fp-resultados.datos)
[Capturas](https://github.com/jamj2000/fp-resultados.capturas)


## Introducción
__fp-resultados__ es una aplicación web destinada al profesorado de Formación Profesional en España. Realizada en mi tiempo libre para seguir aprendiendo sobre distintas tecnologías web. La pongo a disposición de toda la comunidad por si alguien la considera interesante por motivos didácticos o de producción.

![Captura web](https://github.com/jamj2000/fp-resultados.capturas/blob/master/captura-web.png "Captura web")

Existe una aplicación funcional alojada en [rhcloud.com](http://fp-resultados.rhcloud.com) para fines demostrativos. La primera vez que se accede a ella suele tardar algún tiempo en cargar. Supongo que OpenShift debe lanzar la instancia de la máquina virtual. Si esto ocurre volver a intentar pasado un pequeño tiempo. 

![Código QR de la aplicación](https://github.com/jamj2000/fp-resultados.capturas/blob/master/fp-resultados.qr.mini.png "Logo de ejemplo")

La aplicación es funcional y dispone de numerosas características.


### Características
- Permite calificar por resultados de aprendizaje.
- Genera actas de evaluación y boletines de calificaciones en HTML y PDF.
- Se ha diseñado pensando en los ciclos formativos de la familia profesional de Informática y Comunicaciones, sin embargo es posible adaptarla a otras familias profesionales.
- Permite las operaciones CRUD (Create, Read, Update, Delete) a base de datos MySQL a través de interfaz web.


### Probar la aplicación de demostración
Si deseas comprobar las funcionalidades que ofrece esta aplicación, abre en el navegador la dirección [http://fp-resultados.rhcloud.com](http://fp-resultados.rhcloud.com).

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


## Instalación en equipo local
Si estás interesado en probar la aplicación en tu equipo local, aquí tienes los pasos a seguir para PC con distro Ubuntu o similar:

1) Instala los paquetes necesarios para tener un servidor Apache+PHP+MySQL
```bash
apt-get install apache2 mysql-server php5 php5-mysql php5-mcrypt mcrypt curl git
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
```
a2enmod rewrite
php5enmod mcrypt

service apache2 restart/reload
```
 
4) Descarga código del repositorio [fp-resultados](https://github.com/jamj2000/fp-resultados)
```
cd /var/www/html
git clone https://github.com/jamj2000/fp-resultados.git
```

5) Prueba en el navegador [http://localhost/fp-resultados/public](http://localhost/fp-resultados/public)

6) Descarga datos de ejemplo del repositorio [fp-resultados.datos](https://github.com/jamj2000/fp-resultados.datos)
```
git clone https://github.com/jamj2000/fp-resultados.datos.git
```

7) Revisa el script ```database.sh``` para modificar tu usuario y clave de mysql
```
cd fp-resultados.datos
nano database.sh
```

8) Ejecuta el script ```database.sh```
```
chmod +x database.sh
./database.sh
```

9) Recuerda que los valores previos también deben hallarse en el archivo ```/var/www/html/fp-resultados/app/config/database.php```. Por ejemplo para usuario root y clave root 
```
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




## Instalación en Openshift
OpenshSift es un sitio, perteneciente a Red Hat Inc, para alojamiento en la nube que proporciona una Plataforma como Servicio (PaaS). Existe una versión gratuita para aplicaciones que requieren pocos cartridges (máximo 3).

Si deseas crear tu propia aplicación en Openshift, estos son los pasos que debes seguir:

1) Create una cuenta en [OpenShift](https://www.openshift.com/)

2) Añade un cartridge PHP 5.4

3) Crea un nombre de aplicación y dominio

![App en OpenShift](https://github.com/jamj2000/fp-resultados.capturas/blob/master/openshift-app.png "App en OpenShift")

4) Crea una base de datos MySQL

![Database en OpenShift](https://github.com/jamj2000/fp-resultados.capturas/blob/master/openshift-database.png "Database en OpenShift")

5) En tu equipo local genera un par de claves pública/privada
```
ssh-keygen
```

6) Copia el contenido de la clave pública ```~/.ssh/id_rsa.pub``` a OpenShift 

![Key en OpenShift](https://github.com/jamj2000/fp-resultados.capturas/blob/master/openshift-key.png "Key en OpenShift")

7) Comprueba el resultado y copia la dirección ssh para trabajar con git

![Resultado en OpenShift](https://github.com/jamj2000/fp-resultados.capturas/blob/master/openshift-resultado.png "Resultado en OpenShift")

8) Descarga tu repositorio vacío a tu equipo local
```
cd /var/www/html
git clone ssh://<usuario en forma de número>@<app-dominio>.rhcloud.com/~/git/<app>.git/
```


# Licencia

* [GPL-3](http://www.gnu.org/licenses/gpl-3.0.html)..... <https://github.com/jamj2000/fp-resultados>
* [CC BY-SA 4.0](https://creativecommons.org/licenses/by-sa/4.0/)..... <https://github.com/alecive/FlatWoken>

```
- Código            GPL-3         José Antonio Muñoz Jiménez
- Iconos FlatWoken  CC BY-SA 4.0  Alessandro Roncone         
```
