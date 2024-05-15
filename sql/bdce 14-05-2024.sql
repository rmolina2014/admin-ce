/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.32-MariaDB : Database - bdce
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdce` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bdce`;

/*Table structure for table `alumno` */

DROP TABLE IF EXISTS `alumno`;

CREATE TABLE `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edad` int(11) NOT NULL,
  `gruposanguineo` varchar(10) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `estado` varchar(80) DEFAULT NULL COMMENT 'Activo, Inactivo',
  `observacion` varchar(100) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `relapersonacurso` (`persona_id`,`carrera_id`) USING BTREE,
  CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `alumno` */

insert  into `alumno`(`id`,`edad`,`gruposanguineo`,`persona_id`,`carrera_id`,`estado`,`observacion`,`fecha_ingreso`) values (1,1,'rh+',1,1,'Activo','aportes','2024-04-15'),(12,3,'3',36,1,'Activo','prueba','2024-04-14'),(14,18,'rh+',2,2,'Activo','inscirpcion','2024-04-15'),(16,18,'rh+',36,3,'Activo','es el segundo curso','2024-05-01');

/*Table structure for table `alumno_carrera_cuotas` */

DROP TABLE IF EXISTS `alumno_carrera_cuotas`;

CREATE TABLE `alumno_carrera_cuotas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) DEFAULT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `cuota_numero` int(11) DEFAULT NULL,
  `monto` decimal(18,2) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL COMMENT 'Pagado - Impago',
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL COMMENT 'Inscripcion - CuotaNº',
  `descuento_tipo_pago` decimal(18,2) DEFAULT NULL,
  `descuento_antes_dia_10` decimal(18,2) DEFAULT NULL,
  `apagar` decimal(18,2) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL COMMENT 'nombre de usuario',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

/*Data for the table `alumno_carrera_cuotas` */

insert  into `alumno_carrera_cuotas`(`id`,`alumno_id`,`carrera_id`,`cuota_numero`,`monto`,`estado`,`fecha_vencimiento`,`fecha_pago`,`detalle`,`descuento_tipo_pago`,`descuento_antes_dia_10`,`apagar`,`usuario`) values (16,12,1,0,222.00,'PAGADO','0001-01-01','2024-05-14 14:58:41','Inscripción',22.20,19.98,0.00,NULL),(17,12,1,1,20000.00,'PAGADO','0001-01-01','2024-05-14 15:23:54','Cuota Nº 1',2000.00,1800.00,0.00,'0'),(18,12,1,2,20000.00,'PAGADO','0001-01-01','2024-05-14 15:44:01','Cuota Nº 2',2000.00,1800.00,16200.00,'0'),(19,12,1,3,20000.00,'PAGADO','0001-01-01','2024-05-14 16:19:44','Cuota Nº 3',2000.00,1800.00,16200.00,'0'),(20,12,1,4,20000.00,'PAGADO','0001-01-01','2024-05-14 16:33:59','Cuota Nº 4',2000.00,1800.00,16200.00,'admin'),(21,12,1,5,20000.00,'PAGADO','0001-01-01','2024-05-14 19:48:51','Cuota Nº 5',2000.00,1800.00,16200.00,'admin'),(22,12,1,6,20000.00,'PAGADO','0001-01-01','2024-05-14 19:48:59','Cuota Nº 6',2000.00,1800.00,16200.00,'admin'),(23,12,1,7,20000.00,'IMPAGA','0001-01-01','2024-04-25 00:00:00','Cuota Nº 7',NULL,NULL,NULL,NULL),(24,12,1,8,20000.00,'IMPAGA','0001-01-01','2024-04-25 00:00:00','Cuota Nº 8',NULL,NULL,NULL,NULL),(25,12,1,9,20000.00,'IMPAGA','0001-01-01','2024-04-25 00:00:00','Cuota Nº 9',NULL,NULL,NULL,NULL),(26,12,1,10,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 10',NULL,NULL,NULL,NULL),(27,13,1,0,222.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Inscripción',NULL,NULL,NULL,NULL),(28,13,1,1,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 1',NULL,NULL,NULL,NULL),(29,13,1,2,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 2',NULL,NULL,NULL,NULL),(30,13,1,3,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 3',NULL,NULL,NULL,NULL),(31,13,1,4,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 4',NULL,NULL,NULL,NULL),(32,13,1,5,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 5',NULL,NULL,NULL,NULL),(33,13,1,6,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 6',NULL,NULL,NULL,NULL),(34,13,1,7,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 7',NULL,NULL,NULL,NULL),(35,13,1,8,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 8',NULL,NULL,NULL,NULL),(36,13,1,9,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 9',NULL,NULL,NULL,NULL),(37,13,1,10,20000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 10',NULL,NULL,NULL,NULL),(38,14,2,0,333.00,'PAGADO','0001-01-01','2024-04-18 00:00:00','Inscripción',NULL,NULL,NULL,NULL),(39,14,2,1,25000.00,'PAGADO','0001-01-01','2024-04-18 00:00:00','Cuota Nº 1',NULL,NULL,NULL,NULL),(40,14,2,2,25000.00,'PAGADO','0001-01-01','2024-04-18 00:00:00','Cuota Nº 2',NULL,NULL,NULL,NULL),(41,14,2,3,25000.00,'PAGADO','0001-01-01','2024-04-18 00:00:00','Cuota Nº 3',NULL,NULL,NULL,NULL),(42,14,2,4,25000.00,'PAGADO','0001-01-01','2024-04-18 00:00:00','Cuota Nº 4',NULL,NULL,NULL,NULL),(43,14,2,5,25000.00,'PAGADO','0001-01-01','2024-04-30 17:24:59','Cuota Nº 5',NULL,NULL,NULL,NULL),(44,14,2,6,25000.00,'PAGADO','0001-01-01','2024-04-30 17:26:40','Cuota Nº 6',NULL,NULL,NULL,NULL),(45,14,2,7,25000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 7',NULL,NULL,NULL,NULL),(46,14,2,8,25000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 8',NULL,NULL,NULL,NULL),(47,14,2,9,25000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 9',NULL,NULL,NULL,NULL),(48,14,2,10,25000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 10',NULL,NULL,NULL,NULL),(49,14,2,11,25000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 11',NULL,NULL,NULL,NULL),(50,14,2,12,25000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 12',NULL,NULL,NULL,NULL),(51,16,3,0,444.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Inscripción',NULL,NULL,NULL,NULL),(52,16,3,1,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 1',NULL,NULL,NULL,NULL),(53,16,3,2,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 2',NULL,NULL,NULL,NULL),(54,16,3,3,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 3',NULL,NULL,NULL,NULL),(55,16,3,4,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 4',NULL,NULL,NULL,NULL),(56,16,3,5,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 5',NULL,NULL,NULL,NULL),(57,16,3,6,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 6',NULL,NULL,NULL,NULL),(58,16,3,7,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 7',NULL,NULL,NULL,NULL),(59,16,3,8,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 8',NULL,NULL,NULL,NULL),(60,16,3,9,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 9',NULL,NULL,NULL,NULL),(61,16,3,10,10000.00,'IMPAGA','0001-01-01','0001-01-01 00:00:00','Cuota Nº 10',NULL,NULL,NULL,NULL);

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_apertura` datetime DEFAULT NULL,
  `ingreso_total` decimal(8,2) DEFAULT NULL,
  `egreso_total` decimal(8,2) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL COMMENT 'Abierto o Cerrado',
  `saldo` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `caja` */

insert  into `caja`(`id`,`fecha_apertura`,`ingreso_total`,`egreso_total`,`fecha_cierre`,`estado`,`saldo`) values (1,'2024-04-01 04:57:22',3019.33,0.00,'2024-01-01 00:00:00','Abierta',3019.33);

/*Table structure for table `caja_operacion` */

DROP TABLE IF EXISTS `caja_operacion`;

CREATE TABLE `caja_operacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caja_id` int(11) DEFAULT NULL,
  `operacion` varchar(30) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `monto` decimal(8,2) DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `caja_operacion` */

/*Table structure for table `carrera` */

DROP TABLE IF EXISTS `carrera`;

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) DEFAULT NULL,
  `cantidad_cuotas` int(11) DEFAULT NULL,
  `costo_carrera` decimal(18,2) DEFAULT NULL,
  `inscripcion` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `carrera` */

insert  into `carrera`(`id`,`nombre`,`cantidad_cuotas`,`costo_carrera`,`inscripcion`) values (1,'Asistente ',10,200000.00,222.00),(2,'Tecnico',12,300000.00,333.00),(3,'Farmacia',10,100000.00,444.00);

/*Table structure for table `carrera_precios` */

DROP TABLE IF EXISTS `carrera_precios`;

CREATE TABLE `carrera_precios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `detalle` varchar(90) DEFAULT NULL,
  `costo` decimal(18,2) DEFAULT NULL,
  `observacion` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `carrera_precios` */

insert  into `carrera_precios`(`id`,`carrera_id`,`detalle`,`costo`,`observacion`) values (1,1,'Inscripcion',5000.00,NULL),(2,1,'Cuota Mensual',18000.00,NULL),(3,1,'Certificado',18000.00,NULL),(4,1,'Otros Costos',0.00,NULL),(5,2,'Inscripcion',300.00,NULL),(6,2,'Cuota Mensual',5000.00,NULL);

/*Table structure for table `detalle_permiso` */

DROP TABLE IF EXISTS `detalle_permiso`;

CREATE TABLE `detalle_permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rela_permiso` int(11) NOT NULL,
  `rela_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relapermiso` (`rela_permiso`),
  KEY `relausuario` (`rela_usuario`),
  CONSTRAINT `detalle_permiso_ibfk_1` FOREIGN KEY (`rela_permiso`) REFERENCES `permiso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_permiso_ibfk_2` FOREIGN KEY (`rela_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detalle_permiso` */

insert  into `detalle_permiso`(`id`,`rela_permiso`,`rela_usuario`) values (23,1,1);

/*Table structure for table `docente` */

DROP TABLE IF EXISTS `docente`;

CREATE TABLE `docente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rela_persona` int(11) NOT NULL,
  `edad` int(11) NOT NULL,
  `titulacion` varchar(200) NOT NULL,
  `materias` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `relapersona` (`rela_persona`),
  CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`rela_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `docente` */

/*Table structure for table `egreso` */

DROP TABLE IF EXISTS `egreso`;

CREATE TABLE `egreso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(18,2) DEFAULT NULL,
  `fecha_egreso` datetime DEFAULT NULL,
  `caja_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `egreso_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `egreso` */

insert  into `egreso`(`id`,`monto`,`fecha_egreso`,`caja_id`,`usuario_id`,`egreso_tipo`) values (1,1000.00,'2024-04-21 00:36:37',1,1,2),(2,1500.00,'2024-04-21 00:37:17',1,1,1),(3,1000.00,'2024-04-21 01:01:11',1,1,3),(4,1000.00,'2024-04-21 03:18:08',1,1,2);

/*Table structure for table `egreso_tipo` */

DROP TABLE IF EXISTS `egreso_tipo`;

CREATE TABLE `egreso_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `egreso_tipo` */

insert  into `egreso_tipo`(`id`,`nombre`) values (1,'Alquiler'),(2,'Pago de propagandas'),(3,'pago sistema');

/*Table structure for table `ingreso` */

DROP TABLE IF EXISTS `ingreso`;

CREATE TABLE `ingreso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(16,2) DEFAULT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `caja_id` int(11) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL COMMENT 'nombre del usuario',
  `ingreso_tipo_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `tipo_pago` varchar(20) DEFAULT NULL COMMENT 'Efectivo - Debito',
  `descuento` decimal(10,2) DEFAULT NULL COMMENT 'por pago efectivo y',
  `recargo` decimal(10,2) DEFAULT NULL COMMENT 'pago despues del 10',
  `origen` varchar(50) DEFAULT NULL COMMENT 'Alumno - Propio',
  `detalle` varchar(100) DEFAULT NULL COMMENT 'detalle del pago',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ingreso` */

insert  into `ingreso`(`id`,`monto`,`fecha_ingreso`,`caja_id`,`usuario`,`ingreso_tipo_id`,`alumno_id`,`tipo_pago`,`descuento`,`recargo`,`origen`,`detalle`) values (40,0.00,'2024-05-14 00:00:00',1,'999',6,12,'EFECTIVO',3800.00,0.00,'Alumno','Cuota Nï¿½ 1'),(41,16200.00,'2024-05-14 00:00:00',1,'999',6,12,'EFECTIVO',3800.00,0.00,'Alumno','Cuota Nï¿½ 2'),(42,16200.00,'2024-05-14 00:00:00',1,'0',6,12,'EFECTIVO',3800.00,0.00,'Alumno','Cuota Nï¿½ 3-Alumno'),(43,16200.00,'2024-05-14 00:00:00',1,'admin',6,12,'EFECTIVO',3800.00,0.00,'Alumno','Cuota Nï¿½ 4-Alumno'),(44,16200.00,'2024-05-14 00:00:00',1,'admin',6,12,'EFECTIVO',3800.00,0.00,'Alumno','Cuota Nï¿½ 5'),(45,16200.00,'2024-05-14 00:00:00',1,'admin',6,12,'EFECTIVO',3800.00,0.00,'Alumno','Cuota Nï¿½ 6');

/*Table structure for table `ingreso_tipo` */

DROP TABLE IF EXISTS `ingreso_tipo`;

CREATE TABLE `ingreso_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ingreso_tipo` */

insert  into `ingreso_tipo`(`id`,`nombre`) values (1,'Aporte externo de socios'),(2,'Otros Ingresos'),(6,'Cuotas'),(7,'Recargo');

/*Table structure for table `permiso` */

DROP TABLE IF EXISTS `permiso`;

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_permiso` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `permiso` */

insert  into `permiso`(`id`,`nombre`) values (2,'PERSONAS'),(1,'USUARIOS');

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellidonombre` varchar(30) NOT NULL,
  `dni` int(11) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `cel1` varchar(11) NOT NULL,
  `cel2` varchar(11) NOT NULL,
  `mail` varchar(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apellidonombre` (`apellidonombre`) USING BTREE,
  UNIQUE KEY `dniunico` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=2147483648 DEFAULT CHARSET=utf8mb4;

/*Data for the table `persona` */

insert  into `persona`(`id`,`apellidonombre`,`dni`,`domicilio`,`cel1`,`cel2`,`mail`) values (1,'Instituto CE',999,'mendoza','','',''),(2,'perez jose',22705502,'sdfdsf','324234324','11','gfdg@sdasd'),(20,'Yalardo Juan',22708505,'san juan- rivadavia','24646546556','',''),(21,'yanzon mauricio',22705501,'b ucc','2645056361','5555555','mauricioyan@hotmail.com'),(34,'asdasdewrewr',227055088,'asdsad','','',''),(36,'alumno nuevo',22705503,'sdfsdf','','','');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rela_persona` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 inactivo y 1 activo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rela_persona` (`rela_persona`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rela_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`rela_persona`,`usuario`,`pass`,`estado`) values (1,21,'admin','202cb962ac59075b964b07152d234b70',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
