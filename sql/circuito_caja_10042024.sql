/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 8.0.30 : Database - bdce
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdce` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `bdce`;

/*Table structure for table `alumno` */

DROP TABLE IF EXISTS `alumno`;

CREATE TABLE `alumno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `edad` int NOT NULL,
  `gruposanguineo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `persona_id` int NOT NULL,
  `carrera_id` int DEFAULT NULL,
  `estado` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Activo, Inactivo',
  `observacion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `relapersona` (`persona_id`),
  CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `alumno` */

insert  into `alumno`(`id`,`edad`,`gruposanguineo`,`persona_id`,`carrera_id`,`estado`,`observacion`) values (1,8,'++',36,1,'Inactivo',NULL);

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_apertura` datetime DEFAULT NULL,
  `ingreso_total` decimal(8,2) DEFAULT NULL,
  `egreso_total` decimal(8,2) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL COMMENT 'Abierto o Cerrado',
  `saldo` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

/*Data for the table `caja` */

insert  into `caja`(`id`,`fecha_apertura`,`ingreso_total`,`egreso_total`,`fecha_cierre`,`estado`,`saldo`) values (1,'2024-04-01 04:57:22',6.00,0.00,'2024-01-01 00:00:00','Abierta',0.00);

/*Table structure for table `caja_operacion` */

DROP TABLE IF EXISTS `caja_operacion`;

CREATE TABLE `caja_operacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `caja_id` int DEFAULT NULL,
  `operacion` varchar(30) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `monto` decimal(8,2) DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

/*Data for the table `caja_operacion` */

/*Table structure for table `carrera` */

DROP TABLE IF EXISTS `carrera`;

CREATE TABLE `carrera` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `costo` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `carrera` */

insert  into `carrera`(`id`,`nombre`,`costo`) values (1,'Asistente ',120000.00),(2,'Tecnico',150000.00),(3,'Farmacia',130000.00);

/*Table structure for table `cuota` */

DROP TABLE IF EXISTS `cuota`;

CREATE TABLE `cuota` (
  `id` int NOT NULL AUTO_INCREMENT,
  `carrera_id` int DEFAULT NULL,
  `detalle` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `costo` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `cuota` */

insert  into `cuota`(`id`,`carrera_id`,`detalle`,`costo`) values (1,1,'Inscripcion',5000.00),(2,1,'Cuota 1',18000.00),(3,1,'Cuota 2',18000.00),(4,2,'Inscripcion',7000.00);

/*Table structure for table `detalle_permiso` */

DROP TABLE IF EXISTS `detalle_permiso`;

CREATE TABLE `detalle_permiso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rela_permiso` int NOT NULL,
  `rela_usuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relapermiso` (`rela_permiso`),
  KEY `relausuario` (`rela_usuario`),
  CONSTRAINT `detalle_permiso_ibfk_1` FOREIGN KEY (`rela_permiso`) REFERENCES `permiso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_permiso_ibfk_2` FOREIGN KEY (`rela_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detalle_permiso` */

insert  into `detalle_permiso`(`id`,`rela_permiso`,`rela_usuario`) values (23,1,1);

/*Table structure for table `docente` */

DROP TABLE IF EXISTS `docente`;

CREATE TABLE `docente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rela_persona` int NOT NULL,
  `edad` int NOT NULL,
  `titulacion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `materias` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `relapersona` (`rela_persona`),
  CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`rela_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `docente` */

/*Table structure for table `egreso` */

DROP TABLE IF EXISTS `egreso`;

CREATE TABLE `egreso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `monto` decimal(18,2) DEFAULT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `caja_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `egreso_tipo` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `egreso` */

/*Table structure for table `egreso_tipo` */

DROP TABLE IF EXISTS `egreso_tipo`;

CREATE TABLE `egreso_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `egreso_tipo` */

/*Table structure for table `ingreso` */

DROP TABLE IF EXISTS `ingreso`;

CREATE TABLE `ingreso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `monto` decimal(16,2) DEFAULT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `caja_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `ingreso_tipo_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ingreso` */

insert  into `ingreso`(`id`,`monto`,`fecha_ingreso`,`caja_id`,`usuario_id`,`ingreso_tipo_id`) values (1,56.00,'2024-04-03 02:45:10',1,1,3);

/*Table structure for table `ingreso_tipo` */

DROP TABLE IF EXISTS `ingreso_tipo`;

CREATE TABLE `ingreso_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ingreso_tipo` */

insert  into `ingreso_tipo`(`id`,`nombre`,`monto`) values (1,'Inscripción',6500.00),(2,'Cuota 1',8000.00),(3,'Cuota 2',8000.00),(4,'Cuota 3',8000.00);

/*Table structure for table `permiso` */

DROP TABLE IF EXISTS `permiso`;

CREATE TABLE `permiso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_permiso` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `permiso` */

insert  into `permiso`(`id`,`nombre`) values (2,'PERSONAS'),(1,'USUARIOS');

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `id` int NOT NULL AUTO_INCREMENT,
  `apellidonombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dni` int NOT NULL,
  `domicilio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cel1` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cel2` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apellidonombre` (`apellidonombre`) USING BTREE,
  UNIQUE KEY `dniunico` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persona` */

insert  into `persona`(`id`,`apellidonombre`,`dni`,`domicilio`,`cel1`,`cel2`,`mail`) values (1,'yanzon mauricio',22705501,'b ucc','2645056361','5555555','mauricioyan@hotmail.com'),(2,'perez jose',22705502,'sdfdsf','324234324','11','gfdg@sdasd'),(20,'Yalardo Juan',22708505,'san juan- rivadavia','24646546556','',''),(30,'rtret',22705506,'retert','','',''),(34,'asdasdewrewr',227055088,'asdsad','','',''),(36,'alumno nuevo',22705503,'sdfsdf','','','');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rela_persona` int NOT NULL,
  `usuario` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 inactivo y 1 activo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rela_persona` (`rela_persona`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rela_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`rela_persona`,`usuario`,`pass`,`estado`) values (1,1,'admin','202cb962ac59075b964b07152d234b70',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
