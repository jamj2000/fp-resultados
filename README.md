# fp-resultados

## Introducción
fp-resultados es una aplicación web destinada al profesorado de Formación Profesional en España. La he realizado en mi poco tiempo libre para seguir aprendiendo sobre distintas tecnologías web. La pongo a disposición de toda la comunidad por si alguien la considera interesante por motivos didácticos o de producción.

La aplicación es funcional y dispone de numerosas características.
Existe una aplicación funcional alojada en [rhcloud.com](http://fp-resultados.rhcloud.com) para fines demostrativos.  

### Características
- Permite calificar por resultados de aprendizaje.
- Genera actas de evaluación y boletines de calificaciones en HTML y PDF.
- Se ha diseñado pensando en los ciclos formativos de la familia profesional de Informática y Comunicaciones, sin embargo es posible adaptarla a otras familias profesionales.
- Permite las operaciones CRUD (Create, Read, Update, Delete) a base de datos MySQL a través de interfaz web.


## Instalación en equipo local
Si estás interesado en probar la aplicación en tu equipo local, aquí tienes los pasos a seguir para PC con distro Ubuntu o similar:

Instala los paquetes necesarios para tener un servidor Apache+PHP+MySQL
```bash
apache2 mysql-server php5 php5-mysql php5-mcrypt mcrypt curl git
```

Configura el archivo /etc/apache2/apache2.conf, para que aparezca
```apache
<Directory /var/www/>
  Options Indexes FollowSymLinks
  AllowOverride All
  Require all granted
</Directory>
```
 
Activa módulos de Apache y reinicia servidor
```
a2enmod rewrite
php5enmod mcrypt

service apache2 restart/reload
```
 
Descarga código del repositorio [fp-resultados](https://github.com/jamj2000/fp-resultados)
```
cd /var/www/html
git clone https://github.com/jamj2000/fp-resultados.git
```

Prueba en el navegador [http://localhost/fp-resultados/public](http://localhost/fp-resultados/public)

Descarga datos de ejemplo del repositorio [fp-resultados.datos](https://github.com/jamj2000/fp-resultados.datos)
```
git clone https://github.com/jamj2000/fp-resultados.datos.git
```

Revisa el script database.sh para modificar tu usuario y clave de mysql
```
cd fp-resultados.datos
nano database.sh
```

Recuerda que estos valores también deben hallarse en el archivo _/var/www/html/fp-resultados/app/config/database.php_. Por ejemplo para usuario root y clave root es
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

Ejecuta el script database.sh
```
chmod +x database.sh
./database.sh
```




## Instalación en Openshift
OpenshSift es un sitio, perteneciente a Red Hat Inc, para alojamiento en la nube que proporciona una Plataforma como Servicio (PaaS). Existe una versión gratuita para aplicaciones que requieren pocos cartridges (máximo 3).

Si deseas crear tu propia aplicación en Openshift, estos son los pasos que debes seguir:

Create una cuenta en [OpenShift](https://www.openshift.com/)
Añade un cartridge PHP 5.4.

</ol>

# Licencia

- Código: GPL-3. José Antonio Muñoz Jiménez.  [Repositorio en GitHub](https://github.com/jamj2000/fp-resultados) 
- Iconos FlatWoken: CC BY-SA 4.0. Alessandro Roncone. [Repositorio en GitHub](https://github.com/alecive/FlatWoken) 
