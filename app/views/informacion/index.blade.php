@extends('plantilla')


@section('contenido')

<div class="panel panel-info"><img src="{{ URL::asset('img/info.png')}}" >
<div class="panel-heading alto55"><b>Información</b></div>

<div class="panel-body">

<h3>Introducción</h3>

Esta aplicación web sólo es accesible para el profesorado dado de alta en ella. <br>El alumnado no tiene acceso a ella.<br>
Está desarrollada sobre una base de datos, que contiene los datos de los profesores, los alumnos y los módulos profesionales.<br>
Si algún datos está incorrecto o ausente, por favor contacta con un usuario que sea administrador.<br><br>


<h3>Perfiles de usuarios</h3>

Existen dos tipos de usuarios: 
<ul>
<li><b>Profesor/a administrador</b>. Puede ser tutor/a también.</li>
<li><b>Profesor/a normal</b>. Puede ser tutor/a también.</li>
</ul>


Como <b>usuario administrador</b>, un profesor/a podrá:
<ul>
<li>Dar de alta, modificar o borrar cualquier tipo de dato.</li>
<li>Generar INFORMES DE EVALUACIÓN, es decir <b>Actas de evaluación</b>.</li>
<li>Generar INFORMES DE CALIFICACIONES, es decir <b>Boletines de notas</b> de su tutoría, <b>en el caso de ser tutor/a</b>.</li>
</ul>

Como <b>usuario normal</b>, un profesor/a podrá:
<ul>
<li>Ver datos de profesores, alumnos y módulos.</li>
<li>Modificar su información personal, información de los módulos que imparte y alumnos matriculados en sus módulos.</li>
<li>Los resultados de aprendizaje de cada módulo tienen un peso por defecto de 10. Este dato no se tiene en cuenta actualmente. Está disponible por si en un futuro se actualiza la aplicación para dar la opción de proporcionar calificaciones númericas con distinta ponderarión para cada resultado de aprendizaje.</li>
<li>Generar INFORMES DE CALIFICACIONES, es decir <b>Boletines de notas</b> de su tutoría, <b>en el caso de ser tutor/a</b>.</li>
</ul>

Por motivos de comodidad, la aplicación permite que un profesor pueda ponerse como tutor de cualquier curso. Esto da posibilidad de generar boletines de calificaciones. El antiguo tutor sigue activo.<br><br>

Por motivos de seguridad, un profesor/a administrador no puede darse de baja a sí mismo. De esta forma siempre existirá al menos un administrador/a.<br><br>


<h3>Calificaciones</h3> 

Por cada resultado de aprendizaje se reserva una casilla en el INFORME DE CALIFICACIONES.<br>
Actualmente esta aplicación indica por cada resultado de aprendizaje su calificación de la siguiente forma:<br><br>
<img src="{{ URL::asset('img/iconos/mas.png')}}" > <b>SUPERADO</b>. El alumno/a tiene aprobado este resultado de aprendizaje.<br>
<img src="{{ URL::asset('img/iconos/menos.png')}}" > <b>NO SUPERADO</b>. El alumno/a tiene pendiente este resultado de aprendizaje.<br>
<img src="{{ URL::asset('img/iconos/asterisco.png')}}" > <b>EN PROCESO</b>. El resultado de aprendizaje no se ha impartido en su totalidad.<br>
<img src="{{ URL::asset('img/iconos/punto.png')}}" >  <b>NO EVALUADO</b>. El resultado de aprendizaje no se ha impartido. <br>
 
<br>
Por defecto aparecerá un punto en todos los resultados de aprendizaje de los módulos en los que se haya matriculado el alumno/a.<br>
En los módulos en los que el alumno/a no se haya matriculado las casillas aparecen en blanco.<br>
La aplicación tiene un límite máximo de 9 casillas para otros tantos resultados de aprendizaje por módulo. Si algún módulo tiene más de 9 resultados de aprendizaje deberá expresarse la calificación conjunta de varios de ellos en una única casilla.<br><br> 
 

<h3>Aplicación para Android</h3>
Existe una aplicación para Android que puedes descargar en el siguiente enlace.<br><br>
<a class="col-md-4" href="https://drive.google.com/open?id=0B1RxM5nsBsp3S0l0NUF6a0ZaOWs&authuser=0">  <img src="{{ URL::asset('img/app-logo.png')}}" >  </a>
<br><br>


</div>
</div>

@stop