#!/bin/bash


####################################################
# Modificar las siguientes constantes
# antes de ejecutar este script
# según el sitio donde se encuentre la BD.

     HOST="localhost"
   PUERTO="3306"
  USUARIO="root"
    CLAVE="root"
BASEDATOS="fp"

#     HOST="den1.mysql2.gear.host"
#   PUERTO="3306"
#  USUARIO="fourimages"
#    CLAVE="Eureka!"
#BASEDATOS="fourimages"

#####################################################


TABLAS="tablas.sql"
ALUMNOS="alumnos.csv"
PROFESORES="profesores.csv"
MODULOS="modulos.csv"
MODULOS_ALUMNOS="modulos_alumnos.csv"



echo "Creando base de datos $BASEDATOS desde cero"
echo "drop   database if exists     $BASEDATOS;" | mysql -u $USUARIO -p$CLAVE -h$HOST -P$PUERTO
echo "create database if not exists $BASEDATOS\
             default character set utf8 \
             default collate utf8_general_ci;"   | mysql -u $USUARIO -p$CLAVE -h$HOST -P$PUERTO

echo "Creando tablas desde archivo $TABLAS"
mysql -u$USUARIO -p$CLAVE -h$HOST -P$PUERTO $BASEDATOS < $TABLAS

echo "Importando datos desde archivo $PROFESORES"
mysqlimport  --ignore-lines=1 \
             --fields-terminated-by=, \
             --columns='apellido1,apellido2,nombre,tutoria,email,alias,password,remember_token,admin' \
             --local -u$USUARIO -h$HOST -P$PUERTO -p$CLAVE $BASEDATOS $PROFESORES 2&> /dev/null

echo "Importando datos desde archivo $ALUMNOS"
mysqlimport  --ignore-lines=1 \
             --fields-terminated-by=, \
             --columns='apellido1,apellido2,nombre,curso,fecha_nac,email,id_escolar' \
             --local -u$USUARIO -p$CLAVE -h$HOST -P$PUERTO $BASEDATOS $ALUMNOS 2&> /dev/null

echo "Importando datos desde archivo $MODULOS"
mysqlimport  --ignore-lines=1 \
             --fields-terminated-by=, \
             --columns='profesor_id,siglas,nombre,curso,ciclo,horas_totales,horas_semanales,num_resultados,r1_peso,r2_peso,r3_peso,r4_peso,r5_peso,r6_peso,r7_peso,r8_peso,r9_peso' \
             --local -u$USUARIO -p$CLAVE -h$HOST -P$PUERTO $BASEDATOS $MODULOS  2&> /dev/null
 
echo "Importando datos desde archivo $MODULOS_ALUMNOS"
mysqlimport  --ignore-lines=1 \
             --fields-terminated-by=, \
             --columns='modulo_id,alumno_id,r1,r2,r3,r4,r5,r6,r7,r8,r9' \
             --local -u$USUARIO -p$CLAVE -h$HOST -P$PUERTO $BASEDATOS $MODULOS_ALUMNOS 2&> /dev/null
