-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: lennon_car
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carros`
--


/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `modelo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carros`
--

LOCK TABLES `carros` WRITE;
/*!40000 ALTER TABLE `carros` DISABLE KEYS */;
INSERT INTO `carros` VALUES (3,'Gol','Volkswagen',1),(4,'Palio','Fiat',1),(5,'Onix','Chevrolet',1),(6,'Ka','Ford',1),(7,'Kwid','Renault',1),(8,'HB20','Hyundai',1),(9,'Corolla','Toyota',1),(10,'Civic','Honda',1),(11,'Versa','Nissan',1),(12,'Voyage','Volkswagen',1),(13,'Uno','Fiat',1),(14,'Prisma','Chevrolet',1),(15,'Fiesta','Ford',1),(16,'Sandero','Renault',1),(17,'Creta','Hyundai',1),(18,'Etios','Toyota',1),(19,'Fit','Honda',1),(20,'March','Nissan',1),(21,'Up!','Volkswagen',1),(22,'Siena','Fiat',1),(23,'Cobalt','Chevrolet',1),(24,'Focus','Ford',1),(25,'Logan','Renault',1),(26,'i20','Hyundai',1),(27,'Yaris','Toyota',1),(28,'City','Honda',1),(29,'Sentra','Nissan',1),(30,'Polo','Volkswagen',1),(31,'Grand Siena','Fiat',1),(32,'Spin','Chevrolet',1),(33,'Ecosport','Ford',1),(34,'Captur','Renault',1),(35,'Tucson','Hyundai',1),(36,'Hilux','Toyota',1),(37,'WR-V','Honda',1),(38,'Kicks','Nissan',1),(39,'Fox','Volkswagen',1),(40,'Mobi','Fiat',1),(41,'Tracker','Chevrolet',1),(42,'Ranger','Ford',1),(43,'Duster','Renault',1),(44,'ix35','Hyundai',1),(45,'RAV4','Toyota',1),(46,'HR-V','Honda',1),(47,'Frontier','Nissan',1),(48,'Saveiro','Volkswagen',1),(49,'Argo','Fiat',1),(50,'Cruze','Chevrolet',1),(51,'Fusion','Ford',1),(52,'Fluence','Renault',2),(53,'i30','Hyundai',1),(54,'Camry','Toyota',1),(55,'Accord','Honda',1),(56,'Altima','Nissan',1),(57,'Virtus','Volkswagen',1),(58,'Cronos','Fiat',1),(59,'S10','Chevrolet',1),(60,'Edge','Ford',1),(61,'Oroch','Renault',1),(62,'Santa Fe','Hyundai',1),(63,'Prius','Toyota',1),(64,'CR-V','Honda',1),(65,'X-Trail','Nissan',1),(66,'Tiguan','Volkswagen',1),(67,'Toro','Fiat',1),(68,'Equinox','Chevrolet',1),(69,'Mustang','Ford',1),(70,'Koleos','Renault',1),(71,'Azera','Hyundai',1),(72,'Land Cruiser','Toyota',1),(73,'Pilot','Honda',1),(74,'Murano','Nissan',1),(75,'Amarok','Volkswagen',1),(76,'Doblo','Fiat',1),(77,'Trailblazer','Chevrolet',1),(78,'Explorer','Ford',1),(79,'Kangoo','Renault',1),(80,'Elantra','Hyundai',1),(81,'SW4','Toyota',1),(82,'Odyssey','Honda',1),(83,'Pathfinder','Nissan',1),(84,'Golf','Volkswagen',1),(85,'Ducato','Fiat',1),(86,'Camaro','Chevrolet',1),(87,'Transit','Ford',1),(88,'Master','Renault',1),(89,'Genesis','Hyundai',1),(90,'Prius C','Toyota',1),(91,'Freed','Honda',1),(92,'GT-R','Nissan',1),(93,'Jetta','Volkswagen',1),(94,'Fiorino','Fiat',1),(95,'Montana','Chevrolet',1),(96,'Ka Sedan','Ford',1),(97,'Zoe','Renault',1),(98,'Veloster','Hyundai',1),(99,'Prius V','Toyota',1),(100,'Insight','Honda',1),(101,'Leaf','Nissan',1),(102,'Passat','Volkswagen',1),(103,'teste','aa',2),(104,'tese','teste',1);
/*!40000 ALTER TABLE `carros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(355) NOT NULL,
  `bairro` varchar(355) NOT NULL,
  `rua` varchar(355) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'VITOR REGISON LIMA MACHADOO','88523147','vitorregison6@gmail.com','Conjunto Palmeiras','Doutor Codes Sandoval',1),(5,'ALESSANDRA FÉLIX  PATISSERIE','5585988634752','alessandra6@gmail.com','ALDEOTA','Culpa non adipisicin',1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque_produtos`
--

DROP TABLE IF EXISTS `estoque_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estoque_produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produto` int NOT NULL,
  `qtde` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque_produtos`
--

LOCK TABLES `estoque_produtos` WRITE;
/*!40000 ALTER TABLE `estoque_produtos` DISABLE KEYS */;
INSERT INTO `estoque_produtos` VALUES (10,1,0,1),(11,2,0,1);
/*!40000 ALTER TABLE `estoque_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_pecas`
--

DROP TABLE IF EXISTS `itens_pecas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens_pecas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idOrdemServico` int NOT NULL,
  `idPeca` int NOT NULL,
  `qtde` int NOT NULL,
  `valor` double NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_pecas`
--

LOCK TABLES `itens_pecas` WRITE;
/*!40000 ALTER TABLE `itens_pecas` DISABLE KEYS */;
INSERT INTO `itens_pecas` VALUES (79,23,52,1,45.8,1),(80,23,53,1,17.9,1),(81,23,54,1,22.5,1),(82,23,74,1,780,1),(83,23,60,2,237,1),(94,1,1,4,15,0),(95,1,1,1,23,0),(96,1,1,2,37.8,1),(97,1,2,1,1,0),(98,1,2,1,1,0),(99,1,2,4,100,0),(100,1,2,4,129.9,1);
/*!40000 ALTER TABLE `itens_pecas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_servicos`
--

DROP TABLE IF EXISTS `itens_servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens_servicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idOrdemServico` int NOT NULL,
  `idServico` int NOT NULL,
  `valor` double NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_servicos`
--

LOCK TABLES `itens_servicos` WRITE;
/*!40000 ALTER TABLE `itens_servicos` DISABLE KEYS */;
INSERT INTO `itens_servicos` VALUES (8,1,2,17,1),(9,1,1,124,1);
/*!40000 ALTER TABLE `itens_servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_sistema`
--

DROP TABLE IF EXISTS `log_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_sistema` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int NOT NULL,
  `acao` varchar(255) NOT NULL,
  `tabela` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_hora` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_sistema`
--

LOCK TABLES `log_sistema` WRITE;
/*!40000 ALTER TABLE `log_sistema` DISABLE KEYS */;
INSERT INTO `log_sistema` VALUES (1,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:27:18'),(2,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:29:30'),(3,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:50:06'),(4,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:50:33'),(5,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:50:59'),(6,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:51:32'),(7,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:52:53'),(8,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:57:52'),(9,7,'SELECT','Usuarios','LOGIN','2023-06-22 11:59:00'),(10,7,'SELECT','Usuarios','LOGIN','2023-06-22 12:08:08'),(11,7,'INSERT','estoque_produtos','Inserindo novo produto','2023-06-22 12:18:09'),(12,7,'INSERT','estoque_produtos','Inserindo novo produto','2023-06-22 12:18:23'),(13,7,'INSERT','estoque_produtos','Inserindo novo produto','2023-06-22 12:20:16'),(14,7,'INSERT','estoque_produtos','Inserindo novo produto','2023-06-22 12:20:43'),(15,7,'INSERT','estoque_produtos','Inserindo novo produto','2023-06-22 12:32:21'),(16,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 12:37:18'),(17,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 12:43:30'),(18,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 12:45:41'),(19,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 12:46:20'),(20,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 12:50:33'),(21,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 12:51:25'),(22,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 12:52:46'),(23,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 12:57:10'),(24,7,'SELECT','Usuarios','LOGIN','2023-06-22 16:02:10'),(25,7,'SELECT','Usuarios','LOGIN','2023-06-22 16:07:35'),(26,7,'UPDATE','estoque_produtos','Alterando estoque','2023-06-22 16:34:41'),(27,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 16:48:50'),(28,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 17:58:29'),(29,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 18:28:45'),(30,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 18:32:44'),(31,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 18:38:23'),(32,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 18:39:41'),(33,7,'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço','2023-06-22 19:18:02');
/*!40000 ALTER TABLE `log_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `observações`
--

DROP TABLE IF EXISTS `observações`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `observações` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_ordem_servico` int NOT NULL,
  `descrição` varchar(355) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `observações`
--

LOCK TABLES `observações` WRITE;
/*!40000 ALTER TABLE `observações` DISABLE KEYS */;
/*!40000 ALTER TABLE `observações` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordem_servico`
--

DROP TABLE IF EXISTS `ordem_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordem_servico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `id_carro` int NOT NULL,
  `corCarro` varchar(255) DEFAULT NULL,
  `KmAtual` double DEFAULT NULL,
  `ano_carro` int NOT NULL,
  `placa_carro` varchar(10) NOT NULL,
  `data_chegada` date NOT NULL,
  `data_entrega` date DEFAULT NULL,
  `valor_total_servico` double DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordem_servico`
--

LOCK TABLES `ordem_servico` WRITE;
/*!40000 ALTER TABLE `ordem_servico` DISABLE KEYS */;
INSERT INTO `ordem_servico` VALUES (1,1,4,'Ciano',55000,1983,'AQW-123A','2023-06-22','2023-06-22',736.2,1);
/*!40000 ALTER TABLE `ordem_servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pecas`
--

DROP TABLE IF EXISTS `pecas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pecas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_peca` varchar(500) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pecas`
--

LOCK TABLES `pecas` WRITE;
/*!40000 ALTER TABLE `pecas` DISABLE KEYS */;
INSERT INTO `pecas` VALUES (1,'Oleo 5W30',1),(2,'Pneu 15',1),(7,'Tampa do reservatório',1);
/*!40000 ALTER TABLE `pecas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_servico` varchar(255) NOT NULL,
  `descricao` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1,'Trocar Pneu','troca de Pneu',1),(2,'Troca de oleo','Trocar o oleo',1);
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (7,'vitor','827ccb0eea8a706c4c34a16891f84e7b',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-22 17:17:57
