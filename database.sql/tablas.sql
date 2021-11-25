drop table if exists modulos_alumnos, alumnos, modulos, profesores;

 
CREATE TABLE `alumnos` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `apellido1` varchar(100),
  `apellido2` varchar(100),
  `nombre` varchar(100),
  `curso` varchar(100),
  `fecha_nac` date,
  `email` varchar(100), 
  `id_escolar` integer,  
  `created_at` timestamp NOT NULL DEFAULT NOW(),
  `updated_at` timestamp NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1;


CREATE TABLE `modulos` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `profesor_id` integer,
  `siglas` varchar(100),
  `nombre` varchar(100),
  `curso` varchar(100),
  `ciclo` varchar(100),
  `horas_totales` integer,
  `horas_semanales` integer,
  `num_resultados` integer,
  `r1_peso` integer,
  `r2_peso` integer,
  `r3_peso` integer,
  `r4_peso` integer,
  `r5_peso` integer,
  `r6_peso` integer,
  `r7_peso` integer,
  `r8_peso` integer,
  `r9_peso` integer,
  `created_at` timestamp NOT NULL DEFAULT NOW(),
  `updated_at` timestamp NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1;


CREATE TABLE `profesores` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `apellido1` varchar(100),
  `apellido2` varchar(100),
  `nombre` varchar(100),
  `tutoria` varchar(100),
  `email` varchar(100),
  `alias` varchar(100),
  `password` varchar(100),
  `remember_token` varchar(100) DEFAULT NULL,
  `admin` char(1),
  `created_at` timestamp NOT NULL DEFAULT NOW(),
  `updated_at` timestamp NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1;


CREATE TABLE `modulos_alumnos` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `modulo_id` integer NOT NULL,
  `alumno_id` integer NOT NULL,
  `r1` integer DEFAULT '-2',
  `r2` integer DEFAULT '-2',
  `r3` integer DEFAULT '-2',
  `r4` integer DEFAULT '-2',
  `r5` integer DEFAULT '-2',
  `r6` integer DEFAULT '-2',
  `r7` integer DEFAULT '-2',
  `r8` integer DEFAULT '-2',
  `r9` integer DEFAULT '-2',
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1;

