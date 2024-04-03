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
  `gruposanguineo` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `persona_id` int NOT NULL,
  `carrera_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `relapersona` (`persona_id`),
  CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `alumno` */

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `importe_inicio` decimal(8,2) DEFAULT NULL,
  `fecha_apertura` datetime DEFAULT NULL,
  `importe_cierre` decimal(8,2) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL COMMENT 'Abierto o Cerrado',
  `saldo` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

/*Data for the table `caja` */

insert  into `caja`(`id`,`importe_inicio`,`fecha_apertura`,`importe_cierre`,`fecha_cierre`,`estado`,`saldo`) values (1,6.00,'2024-04-01 04:57:22',0.00,'2024-01-01 00:00:00','Abierta',0.00);

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
  `nombre` varchar(90) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `carrera` */

insert  into `carrera`(`id`,`nombre`) values (1,'Asistente '),(2,'Tecnico');

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
  `nombre` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ingreso_tipo` */

insert  into `ingreso_tipo`(`id`,`nombre`,`monto`) values (1,'Inscripción',6500.00),(2,'Cuota 1',8000.00),(3,'Cuota 2',8000.00),(4,'Cuota 3',8000.00);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
