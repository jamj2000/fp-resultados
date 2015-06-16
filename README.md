# fp-resultados

## Introducción
fp-resultados es una aplicación web para el sector de la educación de Formación Profesional en España.

### Características
- Permite calificar por resultados de aprendizaje.
- Genera actas de evaluación y boletines de calificaciones en HTML y PDF.
- Se ha diseñado pensando en los ciclos formativos de la familia profesional de Informática y Comunicaciones, sin embargo es posible adaptarla a otras familias profesionales.
- Existe una aplicación funcional alojada en [rhcloud.com](http://fp-resultados.rhcloud.com).  

## Instalación en equipo local
Si estás interesado en probar la aplicación en tu equipo local, aquí tienes los pasos a seguir para PC con distro Ubuntu o similar:

Instala los paquetes necesarios para tener un servidor Apache+PHP+MySQL.
```bash
apache2 mysql-server php5 php5-mysql php5-mcrypt mcrypt curl git
```

Configura el servidor apache2. En el archivo /etc/apache2/apache2.conf debe aparecer:
```apache
<Directory /var/www/>
  Options Indexes FollowSymLinks
  AllowOverride All
  Require all granted
</Directory>
```
 
Activa módulos de Apache y reinicia servidor:
```
a2enmod rewrite
php5enmod mcrypt

service apache2 restart/reload
```
 
Descarga código del repositorio.
```
cd /var/www/html
git clone https://github.com/jamj2000/fp-resultados.git

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
