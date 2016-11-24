CREATE DATABASE  IF NOT EXISTS `agenda` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `agenda`;
-- MySQL dump 10.13  Distrib 5.6.17, for Linux (i686)
--
-- Host: localhost    Database: agenda
-- ------------------------------------------------------
-- Server version	5.1.73

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades` (
  `idactividades` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la actividad, UNICO',
  `campanya` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre de la campanya',
  `actividad` varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la actividad',
  `descripcion` text COLLATE utf8_spanish_ci COMMENT 'Descripcion de la actividad',
  `organiza` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre del organizador u organizadores (separados por - )',
  `lugar` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Direccion donde tiene lugar la actividad',
  `idbarrio` int(11) NOT NULL COMMENT 'ID del barrio donde se realiza la actividad',
  `idseccion` int(11) NOT NULL COMMENT 'ID de la seccion a la que pertenece',
  `fecha` datetime NOT NULL COMMENT 'Fecha y hora de comienzo de la actividad',
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'login del usuario',
  `publicada` tinyint(1) DEFAULT '0' COMMENT 'Si esta publicada o no la actividad (1- Publicada,  0 - No publicada)',
  PRIMARY KEY (`idactividades`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `barrios`
--

DROP TABLE IF EXISTS `barrios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barrios` (
  `idbarrios` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del barrio, UNICO',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del barrio',
  PRIMARY KEY (`idbarrios`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `iddocumentos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del documento, UNICO',
  `idactividad` int(11) NOT NULL COMMENT 'ID de la actividad a la que pertenece el documento',
  `rutadocumento` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ruta donde esta el documento ',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Descripcion del documento',
  PRIMARY KEY (`iddocumentos`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes` (
  `idimagenes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la imagen, UNICO',
  `idactividad` int(11) NOT NULL COMMENT 'ID de la actividad a la que pertenece',
  `rutaimagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ruta donde esta la imagen',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Descripcion de la imagen',
  PRIMARY KEY (`idimagenes`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `secciones`
--

DROP TABLE IF EXISTS `secciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secciones` (
  `idsecciones` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la seccion, UNICO',
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la seccion',
  PRIMARY KEY (`idsecciones`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `login` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Login de entrada del usuario, UNICO',
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Password. md5',
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del usuario',
  `idacl` int(11) NOT NULL COMMENT 'Identificador de la ACL: 0-Disabled, 1-Super Administrador, 2-Redactor, 3-Editor',
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'agenda'
--

--
-- Dumping routines for database 'agenda'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-24  7:23:09
