/*
SQLyog Ultimate v9.20 
MySQL - 5.5.13 : Database - codisola2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`codisola2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `codisola2`;

/*Table structure for table `ahorro` */

DROP TABLE IF EXISTS `ahorro`;

CREATE TABLE `ahorro` (
  `cuenta_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cuenta_numero` int(20) NOT NULL,
  `socio_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`cuenta_id`),
  UNIQUE KEY `FK_ahorro` (`socio_id`),
  CONSTRAINT `FK_ahorro` FOREIGN KEY (`socio_id`) REFERENCES `socio` (`socio_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `ahorro` */

insert  into `ahorro`(`cuenta_id`,`cuenta_numero`,`socio_id`) values (18,1,14),(19,28,15),(22,29,16),(23,32,17),(24,33,18),(30,34,19);

/*Table structure for table `aplicaciones` */

DROP TABLE IF EXISTS `aplicaciones`;

CREATE TABLE `aplicaciones` (
  `app_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `app_nombre` varchar(100) NOT NULL,
  `app_descripcion` varchar(100) NOT NULL,
  `app_url` varchar(50) NOT NULL,
  `app_estado` enum('Activo','Inactivo') NOT NULL,
  `suite_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`app_id`),
  KEY `FK_reportes_aplicaciones` (`suite_id`),
  CONSTRAINT `FK_reportes_aplicaciones` FOREIGN KEY (`suite_id`) REFERENCES `suites` (`suite_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `aplicaciones` */

insert  into `aplicaciones`(`app_id`,`app_nombre`,`app_descripcion`,`app_url`,`app_estado`,`suite_id`) values (1,'Index','Index','index.php','Activo',1),(2,'Asignación Perfiles','Asigna perfiles a los usuarios','asignacion_perfiles.php','Activo',1),(3,'Administrador Usuarios','Administra todos los usuarios','administrador_usuarios.php','Activo',1),(4,'Administrador Perfiles','Administra todos los perfiles','administrador_perfiles.php','Activo',1),(5,'Solicitud Ingreso Socio','Solicitud Ingreso Socio','solicitud_ingreso_socio.php','Activo',2),(6,'Validación Ingreso Socio','Validación Ingreso Socio','validacion_socio.php','Activo',3),(7,'Solicitud Pendiente de Socio','Solicitud Pendiente de Socio','solicitudes_socio_pendientes.php','Activo',2),(8,'Solicitudes Cuenta de Ahorro','Solicitudes Cuenta de Ahorro','solicitudes_ahorro.php','Activo',2),(9,'Solicitud Ingreso Prestamo','Solicitud Ingreso Prestamo','solicitud_ingreso_prestamo.php','Activo',2),(10,'Solicitud Liquidacion Socio','Solicitud Liquidacion Socio','solicitud_liquidacion_socio.php','Activo',2),(11,'Solicitud Prestamo Fiador','Solicitud Prestamo Fiador','solicitud_prestamo_fiador.php','Activo',2),(13,'Consulta Cuenta','Consulta Cuenta','consulta_cuenta.php','Activo',4),(14,'Consulta Prestamo','Consulta Prestamo','consulta_prestamo.php','Activo',4),(15,'Solicitud de Amento o Disminución de Cuota','Solicitud de Aumento o Disminución de Cuota','Solicitud_Aumento_Disminucion_Cuota.php','Activo',2),(16,'Validacion Prestamo','Validacion Prestamo','validacion_prestamo.php','Activo',3),(17,'Validacion Retiro','Validacion Retiro','validacion_retiro.php','Activo',3),(18,'Validaacion Aumento o Disminicion Cuota','Validaacion Aumento o Disminicion Cuota','Validacion_aumento_disminucion_cuota.php','Activo',3),(19,'Solicitud Pendiente de Retiro','Solicitud Pendiente de Retiro','solicitudes_retiro_pendientes.php','Activo',2),(20,'Solicitud Pendiente de Prestamo','Solicitud Pendiente de Prestamo','solicitudes_prestamo_pendientes.php','Activo',2),(21,'Solicitud Pendiente Aumento o Disminucion Cuotaa','Solicitud Pendiente Aumento o Disminucion Cuotaa','solicitudes_aumento_dismision_pendientes.php','Activo',2),(22,'Generar Transacciones','Generar Transacciones','transacciones_periodo.php','Activo',2),(23,'Inicio Operador','Inicio Operador','inicio_operador.php','Activo',2),(24,'Carga de Transacciones','Carga de Transacciones','carga_transacciones_periodo.php','Activo',2);

/*Table structure for table `aportacion` */

DROP TABLE IF EXISTS `aportacion`;

CREATE TABLE `aportacion` (
  `aportacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aportacion_cantidad` decimal(5,3) NOT NULL,
  `cuenta_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`aportacion_id`),
  UNIQUE KEY `FK_aportacion` (`cuenta_id`),
  CONSTRAINT `FK_aportacion` FOREIGN KEY (`cuenta_id`) REFERENCES `ahorro` (`cuenta_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `aportacion` */

insert  into `aportacion`(`aportacion_id`,`aportacion_cantidad`,`cuenta_id`) values (2,'41.250',18),(3,'25.000',19),(5,'20.000',22),(6,'20.000',23),(13,'40.000',30);

/*Table structure for table `beneficiario` */

DROP TABLE IF EXISTS `beneficiario`;

CREATE TABLE `beneficiario` (
  `bene_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bene_nombre1` varchar(25) NOT NULL,
  `bene_nombre2` varchar(25) DEFAULT NULL,
  `bene_apellido1` varchar(25) NOT NULL,
  `bene_apellido2` varchar(25) DEFAULT NULL,
  `bene_porcentaje` double NOT NULL,
  `bene_telefono` varchar(15) NOT NULL,
  `socio_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bene_id`),
  KEY `FK_beneficiario` (`socio_id`),
  CONSTRAINT `FK_beneficiario` FOREIGN KEY (`socio_id`) REFERENCES `socio` (`socio_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `beneficiario` */

insert  into `beneficiario`(`bene_id`,`bene_nombre1`,`bene_nombre2`,`bene_apellido1`,`bene_apellido2`,`bene_porcentaje`,`bene_telefono`,`socio_id`) values (5,'Rodrigo','Adolfo','Hittler','Guzman',9.99,'23123',14),(6,'David','Rigoberto','Silva','Ramos',9.99,'12345678',15),(7,'123','123','123','123',23,'23232',16),(8,'Christian','Josue','Angel','Romero',50,'72524015',17),(9,'Rodrigo','Andres','Majano ','Garcia',12,'123123',18),(10,'Manuel','de Jesus','Peña','Guzman',20,'123123',19);

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `departamento_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departamento_nombre` varchar(25) NOT NULL,
  `pais_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`departamento_id`),
  KEY `FK_departamento_pais` (`pais_id`),
  CONSTRAINT `FK_departamento_pais` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`pais_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `departamento` */

insert  into `departamento`(`departamento_id`,`departamento_nombre`,`pais_id`) values (1,'San Salvador',1),(2,'La Libertad',1),(3,'Sonsonate',1);

/*Table structure for table `det_prestamo` */

DROP TABLE IF EXISTS `det_prestamo`;

CREATE TABLE `det_prestamo` (
  `det_prestamo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `det_prestamo_monto` int(20) NOT NULL,
  `det_prestamo_fecha` datetime NOT NULL,
  `det_prestamo_tipo` enum('Abono','Retiro','Retiro total','Reintegro') NOT NULL,
  PRIMARY KEY (`det_prestamo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `det_prestamo` */

/*Table structure for table `estado_civil` */

DROP TABLE IF EXISTS `estado_civil`;

CREATE TABLE `estado_civil` (
  `est_civil_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `est_civil_nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`est_civil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `estado_civil` */

insert  into `estado_civil`(`est_civil_id`,`est_civil_nombre`) values (1,'Soltero'),(2,'Casado'),(3,'Viudo'),(4,'Acompañado');

/*Table structure for table `fiador` */

DROP TABLE IF EXISTS `fiador`;

CREATE TABLE `fiador` (
  `fiador_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fiador_nombre1` varchar(25) NOT NULL,
  `fiador_nombre2` varchar(25) DEFAULT NULL,
  `fiador_apellido1` varchar(25) NOT NULL,
  `fiador_apellido2` varchar(25) DEFAULT NULL,
  `fiador_telefono` varchar(15) DEFAULT NULL,
  `fiador_direcion` varchar(75) DEFAULT NULL,
  `solicitud_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fiador_id`),
  KEY `FK_fiador_solicitud` (`solicitud_id`),
  CONSTRAINT `FK_fiador_solicitud` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`solicitud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fiador` */

/*Table structure for table `membresia` */

DROP TABLE IF EXISTS `membresia`;

CREATE TABLE `membresia` (
  `membresia_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membresia_plan_pago` double NOT NULL,
  `membresia_abono` double NOT NULL,
  `socio_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`membresia_id`),
  KEY `FK_membresia` (`socio_id`),
  CONSTRAINT `FK_membresia` FOREIGN KEY (`socio_id`) REFERENCES `socio` (`socio_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `membresia` */

insert  into `membresia`(`membresia_id`,`membresia_plan_pago`,`membresia_abono`,`socio_id`) values (1,1,150,19);

/*Table structure for table `mov_ahorro` */

DROP TABLE IF EXISTS `mov_ahorro`;

CREATE TABLE `mov_ahorro` (
  `mov_ahorro_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mov_ahorro_monto` varchar(20) NOT NULL DEFAULT '0',
  `mov_ahorro_descripcion` varchar(200) DEFAULT NULL,
  `mov_ahorro_tipo` enum('Abono','Retiro parcial','Retiro total') DEFAULT NULL,
  `mov_ahorro_fecha` date DEFAULT NULL,
  `cuenta_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`mov_ahorro_id`),
  KEY `FK_mov_ahorro` (`cuenta_id`),
  CONSTRAINT `FK_mov_ahorro` FOREIGN KEY (`cuenta_id`) REFERENCES `ahorro` (`cuenta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mov_ahorro` */

/*Table structure for table `mov_prestamo` */

DROP TABLE IF EXISTS `mov_prestamo`;

CREATE TABLE `mov_prestamo` (
  `mov_prestamo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mov_prestamo_numero` varchar(20) NOT NULL,
  `mov_prestamo_monto` int(20) NOT NULL,
  `mov_prestamo_descripcion` text,
  `prestamo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`mov_prestamo_id`),
  KEY `FK_mov_prestamo` (`prestamo_id`),
  CONSTRAINT `FK_mov_prestamo` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamo` (`prestamo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mov_prestamo` */

/*Table structure for table `movimiento` */

DROP TABLE IF EXISTS `movimiento`;

CREATE TABLE `movimiento` (
  `movimiento_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `operacion_fecha` date DEFAULT NULL,
  `socio_id` int(10) DEFAULT NULL,
  `cuenta_ahorro` int(10) DEFAULT NULL,
  `tipo_movimiento` enum('Ahorro','Aportacion','Membresia','Retiro','Prestamo') DEFAULT NULL,
  `movimiento_monto` double DEFAULT NULL,
  PRIMARY KEY (`movimiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=latin1;

/*Data for the table `movimiento` */

insert  into `movimiento`(`movimiento_id`,`operacion_fecha`,`socio_id`,`cuenta_ahorro`,`tipo_movimiento`,`movimiento_monto`) values (179,'2012-05-22',14,1,'Prestamo',250),(180,'2012-05-22',18,33,'Prestamo',200),(181,'2012-05-25',19,34,'Membresia',150),(182,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `op_ahorro` */

DROP TABLE IF EXISTS `op_ahorro`;

CREATE TABLE `op_ahorro` (
  `op_ahorro_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `op_ahorro_monto` varchar(20) NOT NULL,
  `op_ahorro_fecha` datetime NOT NULL,
  `op_ahorro_descripcion` varchar(200) DEFAULT NULL,
  `op_ahorro_tipo` enum('Abono','Retiro','Reintegro','Retiro Total') NOT NULL,
  `solicitud_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`op_ahorro_id`),
  KEY `FK_op_ahorro` (`solicitud_id`),
  CONSTRAINT `FK_op_ahorro` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud_socio` (`solicitud_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `op_ahorro` */

insert  into `op_ahorro`(`op_ahorro_id`,`op_ahorro_monto`,`op_ahorro_fecha`,`op_ahorro_descripcion`,`op_ahorro_tipo`,`solicitud_id`) values (2,'23','2012-05-22 00:00:00','asdasd','Retiro',54);

/*Table structure for table `operacion` */

DROP TABLE IF EXISTS `operacion`;

CREATE TABLE `operacion` (
  `operacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operacion_fecha` date DEFAULT NULL,
  `socio_id` int(10) DEFAULT NULL,
  `cuenta_ahorro` int(10) DEFAULT NULL,
  `usuario_id` int(10) DEFAULT NULL,
  `tipo_operacion` enum('Ahorro','Prestamo','Retiro','Aportacion','Membresia') DEFAULT NULL,
  `operacion_monto` double DEFAULT NULL,
  `solicitud_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`operacion_id`),
  UNIQUE KEY `operacion_id_UNIQUE` (`operacion_id`),
  KEY `FK_operacion` (`solicitud_id`),
  CONSTRAINT `FK_operacion` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`solicitud_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `operacion` */

insert  into `operacion`(`operacion_id`,`operacion_fecha`,`socio_id`,`cuenta_ahorro`,`usuario_id`,`tipo_operacion`,`operacion_monto`,`solicitud_id`) values (7,'2012-05-22',14,1,1,'Prestamo',250,50),(8,'2012-05-22',18,33,1,'Prestamo',200,60),(10,'2012-05-25',19,34,1,'Membresia',150,61);

/*Table structure for table `pais` */

DROP TABLE IF EXISTS `pais`;

CREATE TABLE `pais` (
  `pais_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pais_codigo` char(2) NOT NULL,
  `pais_nombre` varchar(25) NOT NULL,
  `pais_descripcion` text,
  PRIMARY KEY (`pais_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `pais` */

insert  into `pais`(`pais_id`,`pais_codigo`,`pais_nombre`,`pais_descripcion`) values (1,'sv','El Salvador','El Salvador');

/*Table structure for table `perfiles` */

DROP TABLE IF EXISTS `perfiles`;

CREATE TABLE `perfiles` (
  `perfil_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `perfil_nombre` varchar(25) NOT NULL,
  `perfil_estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `perfiles` */

insert  into `perfiles`(`perfil_id`,`perfil_nombre`,`perfil_estado`) values (1,'ROOT','Activo'),(2,'Administrador','Activo'),(3,'Usuario','Activo'),(4,'Gerente','Activo'),(5,'Operador','Activo');

/*Table structure for table `perfiles_aplicaciones` */

DROP TABLE IF EXISTS `perfiles_aplicaciones`;

CREATE TABLE `perfiles_aplicaciones` (
  `perapp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `perapp_estado` enum('Activo','Inactivo') NOT NULL,
  `app_id` int(11) unsigned NOT NULL,
  `perfil_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perapp_id`),
  KEY `FK_perfiles_aplicaciones` (`app_id`),
  KEY `FK_perfiles_aplicacionesx` (`perfil_id`),
  CONSTRAINT `FK_perfiles_aplicaciones` FOREIGN KEY (`app_id`) REFERENCES `aplicaciones` (`app_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_perfiles_aplicacionesx` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`perfil_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Data for the table `perfiles_aplicaciones` */

insert  into `perfiles_aplicaciones`(`perapp_id`,`perapp_estado`,`app_id`,`perfil_id`) values (1,'Inactivo',1,1),(2,'Activo',2,1),(3,'Activo',3,1),(4,'Activo',1,2),(5,'Inactivo',2,2),(6,'Activo',3,2),(7,'Activo',4,1),(8,'Activo',4,2),(9,'Activo',5,1),(10,'Activo',6,1),(11,'Inactivo',4,3),(12,'Inactivo',5,3),(13,'Inactivo',6,3),(14,'Activo',7,1),(15,'Activo',8,1),(16,'Activo',9,1),(17,'Activo',10,1),(18,'Activo',11,1),(20,'Activo',13,1),(21,'Activo',14,1),(22,'Activo',15,1),(23,'Activo',13,3),(24,'Activo',14,3),(25,'Activo',6,4),(26,'Activo',15,5),(27,'Activo',8,5),(28,'Activo',9,5),(29,'Activo',5,5),(30,'Activo',10,5),(31,'Activo',7,5),(32,'Activo',11,5),(33,'Activo',16,4),(34,'Activo',17,4),(35,'Activo',18,4),(36,'Activo',16,1),(37,'Activo',17,1),(38,'Activo',18,1),(39,'Activo',19,5),(40,'Activo',20,5),(41,'Activo',21,5),(42,'Activo',19,1),(43,'Activo',20,1),(44,'Activo',21,1),(45,'Activo',22,1),(46,'Activo',23,1),(47,'Activo',24,1);

/*Table structure for table `prestamo` */

DROP TABLE IF EXISTS `prestamo`;

CREATE TABLE `prestamo` (
  `prestamo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prestamo_numero` varchar(20) NOT NULL,
  `prestamo_cuota` int(20) NOT NULL,
  `prestamo_plazo` int(10) NOT NULL,
  `prestamo_interes` double NOT NULL,
  `prestamo_monto` decimal(10,3) NOT NULL,
  `prestamo_tpagar` double DEFAULT NULL,
  `prestamo_observacion` varchar(200) DEFAULT NULL,
  `solicitud_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`prestamo_id`),
  UNIQUE KEY `FK_prestamo_solicitud` (`solicitud_id`),
  CONSTRAINT `FK_prestamo_solicitud` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`solicitud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `prestamo` */

insert  into `prestamo`(`prestamo_id`,`prestamo_numero`,`prestamo_cuota`,`prestamo_plazo`,`prestamo_interes`,`prestamo_monto`,`prestamo_tpagar`,`prestamo_observacion`,`solicitud_id`) values (15,'0',2,80,232,'123.000',159.72,'asdsa asdsa das das da',43),(16,'0',22,22,20,'400.000',481.09,'El osito es buena paga :D',46),(17,'0',36,10,15,'300.000',374.39,'Manuel es buena paga',48),(18,'0',2,128,20,'250.000',256.27,'adsd',50),(19,'0',2,118,23,'230.000',236.63,'123213',51),(20,'0',24,31,20,'600.000',732.9,'Alexis es buena paga',56),(21,'0',2,309,23,'600.000',617.3,'adasdasd',57),(22,'0',2,154,20,'300.000',307.52,'asdasd',58),(23,'0',2,205,20,'400.000',410.03,'Comisiones',59),(24,'0',2,130,232,'200.000',259.7,'adsadas',60),(25,'0',2,231,23,'450.000',462.98,'adasd',66),(26,'0',2,205,20,'400.000',410.03,'asdasdas',73),(27,'0',2,12,23,'233.000',23.66,'asdsadasd',83),(28,'0',2,12,23,'233.000',23.66,'asdsadasd',84),(29,'1',2,12,23,'232.000',23.66,'adsads',85),(30,'0',2,119,23,'232.000',238.69,'asdasdasd',86),(31,'0',2,118,23,'230.000',236.63,'asdasdasd',87);

/*Table structure for table `socio` */

DROP TABLE IF EXISTS `socio`;

CREATE TABLE `socio` (
  `socio_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `socio_nombre1` varchar(25) NOT NULL,
  `socio_nombre2` varchar(25) DEFAULT NULL,
  `socio_apellido1` varchar(25) NOT NULL,
  `socio_apellido2` varchar(25) DEFAULT NULL,
  `socio_apellidoc` varchar(25) DEFAULT NULL,
  `socio_fecha_nacimiento` date NOT NULL,
  `socio_sexo` enum('M','F') NOT NULL,
  `socio_salario` double NOT NULL,
  `socio_direccion` tinytext NOT NULL,
  `socio_fecha_ingreso` datetime NOT NULL,
  `socio_tel_casa` varchar(15) DEFAULT NULL,
  `socio_tel_oficina` varchar(15) DEFAULT NULL,
  `socio_tel_celular` varchar(15) DEFAULT NULL,
  `socio_dui` varchar(10) NOT NULL,
  `socio_nit` varchar(17) NOT NULL,
  `socio_isss` varchar(10) DEFAULT NULL,
  `socio_email` varchar(150) DEFAULT NULL,
  `socio_estado` enum('Inactivo','Activo') DEFAULT NULL,
  `est_civil_id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) DEFAULT '0',
  `solicitud_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`socio_id`),
  KEY `FK_socio_estadocivil` (`est_civil_id`),
  CONSTRAINT `FK_socio_estadocivil` FOREIGN KEY (`est_civil_id`) REFERENCES `estado_civil` (`est_civil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `socio` */

insert  into `socio`(`socio_id`,`socio_nombre1`,`socio_nombre2`,`socio_apellido1`,`socio_apellido2`,`socio_apellidoc`,`socio_fecha_nacimiento`,`socio_sexo`,`socio_salario`,`socio_direccion`,`socio_fecha_ingreso`,`socio_tel_casa`,`socio_tel_oficina`,`socio_tel_celular`,`socio_dui`,`socio_nit`,`socio_isss`,`socio_email`,`socio_estado`,`est_civil_id`,`usuario_id`,`solicitud_id`) values (14,'Manuel','de Jesus','Peña','Guzman','','2012-05-24','M',925.15,'kmaldkmaskld','2012-05-15 23:15:07','(156) 0156-1065','(106) 5105-6105','(516) 0651-0651','12312312-3','1231-231231-231-2','016501561','manuel.pena@hotmail.com','Activo',1,14,14),(15,'RODRIGO','ANDRES','SILVA','RAMOS','','1984-10-07','M',500,'casa codisola ','2012-05-17 00:07:45','(677) 6676-7676','(677) 6677-6676','(676) 7766-7677','09876543-2','0614-071084-103-7','876543322','rodrigo@codisola.com','Activo',1,15,15),(16,'Mario','Jose','Recinos','Ruano','','2012-05-18','M',825,'Por su casa :D','2012-05-21 22:35:44','(123) 2131-2312','(566) 0156-1056','(156) 1065-1056','12321312-3','1232-132132-132-1','123123213','mariorecinos@gmail.com','Activo',1,16,45),(17,'Jorge','NOrvaldo','Mario','cAmpos','','2012-05-30','M',1234,'Porsu casa','2012-05-21 23:40:07','(123) 2132-1312','(123) 2132-1321','(123) 2132-1321','12321321-3','4450-450146-501-6','106510650','123213@hotmail.com','Activo',1,17,47),(18,'Jose','Alexis','Chacón','Melendez','','2012-05-18','M',800,'en su casa','2012-05-22 22:26:13','(123) 1231-2321','(156) 0156-0651','(510) 5610-6510','12312321-3','2321-321321-321-3','123213213','chacon@gmail.com','Activo',1,18,55),(19,'Jorge','Jose','Aquino','Valladares','','2012-05-24','M',250,'Su casa','2012-05-25 02:02:29','(123) 2321-3123','(123) 1231-2321','(132) 1321-3213','13123213-2','1321-321321-312-3','123123213','123213@gmail.com','Activo',1,19,61),(20,'Manuel','de Jesus','Peña','Guzman','','1992-05-28','M',250,'','2012-05-25 04:36:04','(156) 0156-0156','(561) 0561-0561','(510) 6510-6510','12321312-3','1232-132132-132-1','123213213','123213@gmail.s123s','Inactivo',1,0,63),(21,'Manuel','de Jesus','Peña','Guzman','','1992-05-15','M',2500,'Casa','2012-05-25 04:39:49','(501) 5610-5610','(105) 0560-5610','(510) 6510-6510','12321321-3','6105-610651-056-1','510651065','magnetovt@hotmail.com','Inactivo',1,0,64),(22,'Manuel','de Jesus','Peña','Guzman','','1992-05-15','M',2500,'Casa','2012-05-25 04:39:50','(501) 5610-5610','(105) 0560-5610','(510) 6510-6510','12321321-3','6105-610651-056-1','510651065','magnetovt@hotmail.com','Inactivo',1,0,65);

/*Table structure for table `solicitud` */

DROP TABLE IF EXISTS `solicitud`;

CREATE TABLE `solicitud` (
  `solicitud_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `solicitud_estado` enum('Ingresada','Aprobada','Rechazada','Ejecutada') NOT NULL,
  `solicitud_fecha` datetime NOT NULL,
  `tipo_soli_id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `sucursal_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`solicitud_id`),
  KEY `FK_solicitud_tipo` (`tipo_soli_id`),
  KEY `FK_solicitud_usuario` (`usuario_id`),
  KEY `FK_solicitud_sucursal` (`sucursal_id`),
  CONSTRAINT `FK_solicitud_sucursal` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`sucursal_id`),
  CONSTRAINT `FK_solicitud_tipo` FOREIGN KEY (`tipo_soli_id`) REFERENCES `tipo_solicitud` (`tipo_soli_id`),
  CONSTRAINT `FK_solicitud_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

/*Data for the table `solicitud` */

insert  into `solicitud`(`solicitud_id`,`solicitud_estado`,`solicitud_fecha`,`tipo_soli_id`,`usuario_id`,`sucursal_id`) values (14,'Ingresada','2012-05-15 23:15:07',1,1,1),(15,'Aprobada','2012-05-17 00:07:45',1,1,1),(16,'Aprobada','2012-05-20 00:13:40',2,1,1),(41,'Ingresada','2012-05-20 11:47:47',2,1,1),(42,'Ejecutada','2012-05-20 11:48:19',2,1,1),(43,'Ejecutada','2012-05-20 18:57:46',2,1,1),(44,'Ejecutada','2012-05-21 22:06:03',2,1,1),(45,'Aprobada','2012-05-21 22:35:44',1,1,1),(46,'Ejecutada','2012-05-21 22:45:29',2,1,1),(47,'Aprobada','2012-05-21 23:40:07',1,1,1),(48,'Ejecutada','2012-05-21 23:44:19',2,1,1),(49,'Ejecutada','2012-05-21 23:52:23',2,1,1),(50,'Ejecutada','2012-05-22 01:26:48',2,1,1),(51,'Aprobada','2012-05-22 20:55:33',2,1,1),(52,'Ingresada','2012-05-22 21:38:55',2,1,1),(53,'Ingresada','2012-05-22 21:40:29',2,1,1),(54,'Ingresada','2012-05-22 21:42:01',2,1,1),(55,'Aprobada','2012-05-22 22:26:13',1,1,1),(56,'Ejecutada','2012-05-22 22:39:05',2,1,1),(57,'Ingresada','2012-05-22 22:49:47',2,1,1),(58,'Ingresada','2012-05-22 22:57:02',2,1,1),(59,'Ingresada','2012-05-22 22:57:46',2,1,1),(60,'Ejecutada','2012-05-22 22:58:41',2,1,1),(61,'Aprobada','2012-05-25 02:02:29',1,1,1),(62,'Ingresada','2012-05-25 04:01:37',1,1,1),(63,'Ingresada','2012-05-25 04:36:04',1,1,1),(64,'Ingresada','2012-05-25 04:39:49',1,1,1),(65,'Ingresada','2012-05-25 04:39:49',1,1,1),(66,'Ingresada','2012-05-25 05:06:14',2,1,1),(67,'Ingresada','2012-05-25 05:40:13',2,1,1),(68,'Ingresada','2012-05-25 05:42:37',2,1,1),(69,'Ingresada','2012-05-25 05:43:43',2,1,1),(70,'Ingresada','2012-05-25 05:43:54',2,1,1),(71,'Ingresada','2012-05-25 05:45:03',2,1,1),(72,'Ingresada','2012-05-25 05:53:30',2,1,1),(73,'Ingresada','2012-05-25 05:55:14',2,1,1),(74,'Ingresada','2012-05-25 05:55:43',2,1,1),(75,'Ingresada','2012-05-25 05:58:58',2,1,1),(76,'Ingresada','2012-05-25 06:00:01',2,1,1),(77,'Ingresada','2012-05-25 06:00:27',2,1,1),(78,'Ingresada','2012-05-25 06:01:18',2,1,1),(79,'Ingresada','2012-05-25 06:02:03',2,1,1),(80,'Ingresada','2012-05-25 06:03:48',2,1,1),(81,'Ingresada','2012-05-25 08:55:53',2,1,1),(82,'Ingresada','2012-05-25 09:12:07',2,1,1),(83,'Ingresada','2012-05-25 18:49:38',2,1,1),(84,'Ingresada','2012-05-25 18:50:35',2,1,1),(85,'Ingresada','2012-05-25 18:51:00',2,1,1),(86,'Ingresada','2012-05-25 19:30:26',2,1,1),(87,'Ingresada','2012-05-25 19:32:01',2,1,1);

/*Table structure for table `solicitud_socio` */

DROP TABLE IF EXISTS `solicitud_socio`;

CREATE TABLE `solicitud_socio` (
  `soli_socio_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(10) unsigned NOT NULL,
  `socio_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`soli_socio_id`),
  UNIQUE KEY `FK_solicitud_socio` (`solicitud_id`),
  KEY `FK_solicitud_socio2` (`socio_id`),
  CONSTRAINT `FK_solicitud_socio` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`solicitud_id`),
  CONSTRAINT `FK_solicitud_socio2` FOREIGN KEY (`socio_id`) REFERENCES `socio` (`socio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `solicitud_socio` */

insert  into `solicitud_socio`(`soli_socio_id`,`solicitud_id`,`socio_id`) values (13,41,14),(14,42,14),(15,43,15),(16,44,15),(17,46,14),(18,48,14),(19,49,15),(20,50,14),(21,51,17),(23,52,16),(24,53,15),(25,54,15),(26,56,18),(27,57,16),(28,58,16),(29,59,16),(30,60,18),(31,66,14),(32,73,19),(33,83,19),(34,84,19),(35,85,17),(36,86,15),(37,87,15);

/*Table structure for table `sucursal` */

DROP TABLE IF EXISTS `sucursal`;

CREATE TABLE `sucursal` (
  `sucursal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sucursal_codigo` varchar(8) NOT NULL,
  `sucursal_nombre` varchar(25) NOT NULL,
  `sucursal_descripcion` text,
  `departamento_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`sucursal_id`),
  KEY `FK_sucursal_depto` (`departamento_id`),
  CONSTRAINT `FK_sucursal_depto` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`departamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `sucursal` */

insert  into `sucursal`(`sucursal_id`,`sucursal_codigo`,`sucursal_nombre`,`sucursal_descripcion`,`departamento_id`) values (1,'XXX01','Sucursal 1','Sucursal 1',1),(2,'XXX02','Sucursal 2','Sucursal 2',1);

/*Table structure for table `suites` */

DROP TABLE IF EXISTS `suites`;

CREATE TABLE `suites` (
  `suite_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `suite_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`suite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `suites` */

insert  into `suites`(`suite_id`,`suite_nombre`) values (1,'Administración'),(2,'Operador'),(3,'Gerente'),(4,'Socio');

/*Table structure for table `tipo_solicitud` */

DROP TABLE IF EXISTS `tipo_solicitud`;

CREATE TABLE `tipo_solicitud` (
  `tipo_soli_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_soli_nombre` varchar(30) NOT NULL,
  `tipo_soli_descripcion` text,
  PRIMARY KEY (`tipo_soli_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tipo_solicitud` */

insert  into `tipo_solicitud`(`tipo_soli_id`,`tipo_soli_nombre`,`tipo_soli_descripcion`) values (1,'Ingreso Socio','Ingreso Socio'),(2,'Solicitud Prestamo','Solicitud Prestamo');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `usuario_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(100) NOT NULL,
  `usuario_apellido` varchar(100) NOT NULL,
  `usuario_usuario` varchar(25) NOT NULL,
  `usuario_clave` char(32) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_estado` enum('Activo','Inactivo','Bloqueado') NOT NULL,
  `usuario_contador` int(1) NOT NULL DEFAULT '0',
  `perfil_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `FK_reportes_usuarios` (`perfil_id`),
  CONSTRAINT `FK_reportes_usuarios` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`perfil_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`usuario_id`,`usuario_nombre`,`usuario_apellido`,`usuario_usuario`,`usuario_clave`,`usuario_email`,`usuario_estado`,`usuario_contador`,`perfil_id`) values (1,'USUARIO','ROOT','root','202cb962ac59075b964b07152d234b70','root@codisola.com','Activo',0,1),(2,'JONATHAN','MORALES','Socio','202cb962ac59075b964b07152d234b70','socio@codisola.com','Activo',0,3),(3,'RODRIGO','SILVA','Operador','202cb962ac59075b964b07152d234b70','operador@codisola.com','Activo',0,5),(4,'MANUEL','PEÑA','Gerente','202cb962ac59075b964b07152d234b70','gerente@codisola.com','Activo',0,4),(5,'AMAYA','BEATRIZ','Administrador','202cb962ac59075b964b07152d234b70','administrador@codisola.com','Activo',0,2),(6,'Manuel','Peña','manuel@hotmail.com','9a4576a3c8889ce43a1abd885e7b5aa3','manuel@hotmail.com','Activo',0,3),(7,'RODRIGO','SILVA','RORAMOS15@HOTMAIL.COM','11d1cfc648876da14fb8b37fadace70c','RORAMOS15@HOTMAIL.COM','Activo',0,3),(14,'Manuel','Peña','manuel.pena@hotmail.com','db6e8f2353723c8bb5e69e236e23b3c6','manuel.pena@hotmail.com','Activo',0,3),(15,'RODRIGO','SILVA','rodrigo@codisola.com','20d12a1b1496a49f711e1a1e7876491a','rodrigo@codisola.com','Activo',0,3),(16,'Mario','Recinos','mariorecinos@gmail.com','d0994ff557e6d49a9834f842055692e9','mariorecinos@gmail.com','Activo',0,3),(17,'Jorge','Mario','123213@hotmail.com','3f23f79f70122a3ac297b8161cbc611d','123213@hotmail.com','Activo',0,3),(18,'Jose','Chacón','chacon@gmail.com','1335dae2de32206c1c88d997d90b73a7','chacon@gmail.com','Activo',0,3),(19,'Jorge','Aquino','123213@gmail.com','44697f23e59cb363c22538f52077f123','123213@gmail.com','Activo',0,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
