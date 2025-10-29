/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.3-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mysitedb
-- ------------------------------------------------------
-- Server version	11.8.3-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `tComentarios`
--

DROP TABLE IF EXISTS `tComentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tComentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(2000) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `libro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `libro_id` (`libro_id`),
  CONSTRAINT `tComentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tUsuarios` (`id`),
  CONSTRAINT `tComentarios_ibfk_2` FOREIGN KEY (`libro_id`) REFERENCES `tLibros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tComentarios`
--

LOCK TABLES `tComentarios` WRITE;
/*!40000 ALTER TABLE `tComentarios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `tComentarios` VALUES
(1,'Una obra maestra, me encantó cada página.',1,1),
(2,'Muy interesante, aunque algo oscuro.',2,2),
(3,'Me atrapó desde el primer capítulo.',3,3),
(4,'Narrativa excelente y personajes profundos.',4,4),
(5,'Perfecto para jóvenes lectores, muy emocionante.',5,5),
(6,'Una obra maestra, me encantó cada página.',1,1),
(7,'Muy interesante, aunque algo oscuro.',2,2),
(8,'Me atrapó desde el primer capítulo.',3,3),
(9,'Narrativa excelente y personajes profundos.',4,4),
(10,'Perfecto para jóvenes lectores, muy emocionante.',5,5);
/*!40000 ALTER TABLE `tComentarios` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `tLibros`
--

DROP TABLE IF EXISTS `tLibros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tLibros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `url_imagen` varchar(200) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `año_publicacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tLibros`
--

LOCK TABLES `tLibros` WRITE;
/*!40000 ALTER TABLE `tLibros` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `tLibros` VALUES
(1,'Cien años de soledad','https://upload.wikimedia.org/wikipedia/en/4/4c/Cien_a%C3%B1os_de_soledad.jpg','Gabriel García Márquez',1967),
(2,'1984','https://upload.wikimedia.org/wikipedia/en/c/c3/1984first.jpg','George Orwell',1949),
(3,'El nombre del viento','https://upload.wikimedia.org/wikipedia/en/2/2e/The_Name_of_the_Wind_cover.jpg','Patrick Rothfuss',2007),
(4,'La sombra del viento','https://upload.wikimedia.org/wikipedia/en/8/8e/La_sombra_del_viento.jpg','Carlos Ruiz Zafón',2001),
(5,'Los juegos del hambre','https://upload.wikimedia.org/wikipedia/en/3/39/The_Hunger_Games_cover.jpg','Suzanne Collins',2008),
(6,'Cien años de soledad','https://upload.wikimedia.org/wikipedia/en/4/4c/Cien_a%C3%B1os_de_soledad.jpg','Gabriel García Márquez',1967),
(7,'1984','https://upload.wikimedia.org/wikipedia/en/c/c3/1984first.jpg','George Orwell',1949),
(8,'El nombre del viento','https://upload.wikimedia.org/wikipedia/en/2/2e/The_Name_of_the_Wind_cover.jpg','Patrick Rothfuss',2007),
(9,'La sombra del viento','https://upload.wikimedia.org/wikipedia/en/8/8e/La_sombra_del_viento.jpg','Carlos Ruiz Zafón',2001),
(10,'Los juegos del hambre','https://upload.wikimedia.org/wikipedia/en/3/39/The_Hunger_Games_cover.jpg','Suzanne Collins',2008);
/*!40000 ALTER TABLE `tLibros` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `tUsuarios`
--

DROP TABLE IF EXISTS `tUsuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tUsuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contraseña` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tUsuarios`
--

LOCK TABLES `tUsuarios` WRITE;
/*!40000 ALTER TABLE `tUsuarios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `tUsuarios` VALUES
(1,'Laura','Gómez Ruiz','laura.gomez@example.com','clave123'),
(2,'Carlos','Martínez Pérez','carlos.martinez@example.com','segura456'),
(3,'Ana','López Díaz','ana.lopez@example.com','pass789'),
(4,'David','Fernández Soto','david.fernandez@example.com','admin321'),
(5,'Marta','Núñez Torres','marta.nunez@example.com','mypass987');
/*!40000 ALTER TABLE `tUsuarios` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-10-20 20:36:22
