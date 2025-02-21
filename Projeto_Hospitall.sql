-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: projeto_hospital
-- ------------------------------------------------------
-- Server version	8.0.41-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Administradores`
--

DROP TABLE IF EXISTS `Administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Administradores` (
  `nome` varchar(255) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id_administrador` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_administrador`),
  UNIQUE KEY `matricula` (`matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Administradores`
--

LOCK TABLES `Administradores` WRITE;
/*!40000 ALTER TABLE `Administradores` DISABLE KEYS */;
INSERT INTO `Administradores` VALUES ('adm1','111','81dc9bdb52d04dc20036dbd8313ed055',7),('adm2','222','81dc9bdb52d04dc20036dbd8313ed055',8),('adm3','333','310dcbbf4cce62f762a2aaa148d556bd',10),('Joana D\'arc','444','550a141f12de6341fba65b0ad0433500',11);
/*!40000 ALTER TABLE `Administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Medicos`
--

DROP TABLE IF EXISTS `Medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Medicos` (
  `id_medico` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `crm` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id_medico`),
  UNIQUE KEY `crm` (`crm`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Medicos`
--

LOCK TABLES `Medicos` WRITE;
/*!40000 ALTER TABLE `Medicos` DISABLE KEYS */;
INSERT INTO `Medicos` VALUES (46,'Medico 01','111','81dc9bdb52d04dc20036dbd8313ed055'),(47,'Medico 02','222','81dc9bdb52d04dc20036dbd8313ed055'),(48,'Medico 03','333','81dc9bdb52d04dc20036dbd8313ed055'),(49,'Medico 04','444','81dc9bdb52d04dc20036dbd8313ed055'),(50,'Medico 05','555','81dc9bdb52d04dc20036dbd8313ed055'),(52,'Joana D\'arc','777','f1c1592588411002af340cbaedd6fc33');
/*!40000 ALTER TABLE `Medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Operacoes`
--

DROP TABLE IF EXISTS `Operacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Operacoes` (
  `id_operacao` int NOT NULL AUTO_INCREMENT,
  `id_medico` int DEFAULT NULL,
  `id_paciente` int DEFAULT NULL,
  `sala` varchar(50) NOT NULL,
  `data_agendamento` date NOT NULL,
  `data_operacao` date NOT NULL,
  `hora` time NOT NULL,
  `nome_operacao` varchar(100) NOT NULL,
  `liberado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_operacao`),
  KEY `id_medico` (`id_medico`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `Operacoes_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `Medicos` (`id_medico`),
  CONSTRAINT `Operacoes_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `Pacientes` (`id_paciente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Operacoes`
--

LOCK TABLES `Operacoes` WRITE;
/*!40000 ALTER TABLE `Operacoes` DISABLE KEYS */;
INSERT INTO `Operacoes` VALUES (1,46,6,'1','2024-11-01','2024-11-18','11:11:00','Operação 01',1),(2,46,9,'2','2024-11-06','2024-12-04','22:22:00','Operação 02',1),(4,48,9,'4','2025-02-18','2025-02-19','04:44:00','Joana D\'arc',0),(5,48,6,'2','2025-02-04','2025-02-10','22:22:00','teste',0);
/*!40000 ALTER TABLE `Operacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pacientes`
--

DROP TABLE IF EXISTS `Pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pacientes` (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id_paciente`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pacientes`
--

LOCK TABLES `Pacientes` WRITE;
/*!40000 ALTER TABLE `Pacientes` DISABLE KEYS */;
INSERT INTO `Pacientes` VALUES (6,'Paciente 01','111','81dc9bdb52d04dc20036dbd8313ed055'),(7,'Paciente 02','222','bcbe3365e6ac95ea2c0343a2395834dd'),(8,'Paciente 03','333','310dcbbf4cce62f762a2aaa148d556bd'),(9,'Joana D\'arc','444','81dc9bdb52d04dc20036dbd8313ed055');
/*!40000 ALTER TABLE `Pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'projeto_hospital'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-20 21:51:44
