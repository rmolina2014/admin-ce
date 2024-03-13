

/*Table structure for table `t_formularios` */

DROP TABLE IF EXISTS `t_formularios`;

CREATE TABLE `t_formularios` (
  `id_formulario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_formulario` varchar(100) DEFAULT NULL,
  `descripcion_formulario` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_formulario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `t_formularios` */

/*Table structure for table `t_perfiles` */

DROP TABLE IF EXISTS `t_perfiles`;

CREATE TABLE `t_perfiles` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(100) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `t_perfiles` */

insert  into `t_perfiles`(`id_perfil`,`perfil`) values (1,'Administrador'),(2,'Operador');

/*Table structure for table `t_permisos` */

DROP TABLE IF EXISTS `t_permisos`;

CREATE TABLE `t_permisos` (
  `id_perfil` int(11) NOT NULL,
  `id_formulario` int(11) NOT NULL,
  PRIMARY KEY (`id_perfil`,`id_formulario`),
  KEY `id_formulario` (`id_formulario`),
  CONSTRAINT `t_permisos_ibfk_1` FOREIGN KEY (`id_formulario`) REFERENCES `t_formularios` (`id_formulario`) ON UPDATE CASCADE,
  CONSTRAINT `t_permisos_ibfk_2` FOREIGN KEY (`id_perfil`) REFERENCES `t_perfiles` (`id_perfil`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `t_permisos` */

/*Table structure for table `t_usuarios` */

DROP TABLE IF EXISTS `t_usuarios`;

CREATE TABLE `t_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `dni_nro` int(11) NOT NULL,
  `apellido_nombre` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bloqueado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  KEY `id_perfil` (`id_perfil`),
  CONSTRAINT `t_usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `t_perfiles` (`id_perfil`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `t_usuarios` */

insert  into `t_usuarios`(`id_usuario`,`codigo`,`usuario`,`dni_nro`,`apellido_nombre`,`password`,`id_perfil`,`email`,`bloqueado`) values (4,12,'admin',2147483647,'sssssssssssss ','bbc85d211ad7b90b46b74dfd7e73e508',1,'molinaroberto.cgp@gmail.com',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
