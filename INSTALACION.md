--------------
# Instalación en Openshift
--------------

**NOTA IMPORTANTE:**

**Esta guía está desactualizada. La plataforma Openshift se ha renovado y los pasos indicados a continuación no son aplicables actualmente.**

**Esta guía se mantiene on-line con fines de documentación.**


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
