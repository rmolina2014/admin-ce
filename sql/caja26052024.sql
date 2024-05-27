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

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_apertura` datetime DEFAULT NULL,
  `ingreso_total` decimal(16,2) DEFAULT NULL,
  `egreso_total` decimal(16,2) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL COMMENT 'Abierto o Cerrado',
  `saldo` decimal(16,2) DEFAULT NULL,
  `saldo_efectivo` decimal(16,2) DEFAULT NULL,
  `saldo_virtual` decimal(16,2) DEFAULT NULL,
  `dep_caja_fuerte` decimal(16,2) DEFAULT NULL,
  `dep_banco` decimal(16,2) DEFAULT NULL,
  `dep_mp` decimal(16,2) DEFAULT NULL,
  `dep_proxima_caja` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

/*Data for the table `caja` */

insert  into `caja`(`id`,`fecha_apertura`,`ingreso_total`,`egreso_total`,`fecha_cierre`,`estado`,`saldo`,`saldo_efectivo`,`saldo_virtual`,`dep_caja_fuerte`,`dep_banco`,`dep_mp`,`dep_proxima_caja`) values (1,'2024-04-01 04:57:22',5506.33,1160.00,'2024-01-01 00:00:00','Abierta',4346.33,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
