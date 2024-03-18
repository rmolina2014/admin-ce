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

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `id` int NOT NULL AUTO_INCREMENT,
  `apellidonombre` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `dni` int NOT NULL,
  `domicilio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cel1` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `cel2` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apellidonombre` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persona` */

insert  into `persona`(`id`,`apellidonombre`,`dni`,`domicilio`,`cel1`,`cel2`,`mail`) values (1,'super',12345678,'ddd','1111','11111','dddd'),(2,'prueba',12345677,'fff','1111','11111','rrrr');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rela_persona` int NOT NULL,
  `usuario` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 inactivo y 1 activo',
  `fechaingreso` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rela_persona` (`rela_persona`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rela_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`rela_persona`,`usuario`,`pass`,`estado`,`fechaingreso`) values (1,1,'admin','202cb962ac59075b964b07152d234b70',1,NULL),(3,2,'27041182','827ccb0eea8a706c4c34a16891f84e7b',1,'2024-03-18');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
