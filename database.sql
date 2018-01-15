CREATE DATABASE  IF NOT EXISTS `progest` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `progest`;
-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: progest
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `coordenacaos`
--

DROP TABLE IF EXISTS `coordenacaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coordenacaos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `coordenador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordenacaos`
--

LOCK TABLES `coordenacaos` WRITE;
/*!40000 ALTER TABLE `coordenacaos` DISABLE KEYS */;
INSERT INTO `coordenacaos` VALUES (1,'Coordenacao1','2016-03-27 19:28:12','2016-03-27 19:28:12','','','(00) 0000-0000',1);
/*!40000 ALTER TABLE `coordenacaos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devolucao_sub_material`
--

DROP TABLE IF EXISTS `devolucao_sub_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devolucao_sub_material` (
  `devolucao_id` int(10) unsigned NOT NULL,
  `sub_material_id` int(10) unsigned NOT NULL,
  `quant` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `devolucao_sub_material_devolucao_id_index` (`devolucao_id`),
  KEY `devolucao_sub_material_sub_material_id_index` (`sub_material_id`),
  CONSTRAINT `devolucao_sub_material_devolucao_id_foreign` FOREIGN KEY (`devolucao_id`) REFERENCES `devolucaos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `devolucao_sub_material_sub_material_id_foreign` FOREIGN KEY (`sub_material_id`) REFERENCES `sub_materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devolucao_sub_material`
--

LOCK TABLES `devolucao_sub_material` WRITE;
/*!40000 ALTER TABLE `devolucao_sub_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `devolucao_sub_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devolucaos`
--

DROP TABLE IF EXISTS `devolucaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devolucaos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `saida_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `devolucaos_saida_id_foreign` (`saida_id`),
  CONSTRAINT `devolucaos_saida_id_foreign` FOREIGN KEY (`saida_id`) REFERENCES `saidas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devolucaos`
--

LOCK TABLES `devolucaos` WRITE;
/*!40000 ALTER TABLE `devolucaos` DISABLE KEYS */;
/*!40000 ALTER TABLE `devolucaos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empenho_sub_material`
--

DROP TABLE IF EXISTS `empenho_sub_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empenho_sub_material` (
  `empenho_id` int(10) unsigned NOT NULL,
  `sub_material_id` int(10) unsigned NOT NULL,
  `quant` int(11) NOT NULL,
  `vl_total` double(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `empenho_sub_material_empenho_id_index` (`empenho_id`),
  KEY `empenho_sub_material_sub_material_id_index` (`sub_material_id`),
  CONSTRAINT `empenho_sub_material_empenho_id_foreign` FOREIGN KEY (`empenho_id`) REFERENCES `empenhos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `empenho_sub_material_sub_material_id_foreign` FOREIGN KEY (`sub_material_id`) REFERENCES `sub_materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empenho_sub_material`
--

LOCK TABLES `empenho_sub_material` WRITE;
/*!40000 ALTER TABLE `empenho_sub_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `empenho_sub_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empenhos`
--

DROP TABLE IF EXISTS `empenhos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empenhos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `numero` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cat_despesa` int(11) NOT NULL,
  `el_consumo` int(11) NOT NULL,
  `mod_licitacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_processo` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `fornecedor_id` int(10) unsigned NOT NULL,
  `solicitante_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empenhos_fornecedor_id_foreign` (`fornecedor_id`),
  KEY `empenhos_solicitante_id_foreign` (`solicitante_id`),
  CONSTRAINT `empenhos_fornecedor_id_foreign` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `empenhos_solicitante_id_foreign` FOREIGN KEY (`solicitante_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empenhos`
--

LOCK TABLES `empenhos` WRITE;
/*!40000 ALTER TABLE `empenhos` DISABLE KEYS */;
/*!40000 ALTER TABLE `empenhos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada_sub_material`
--

DROP TABLE IF EXISTS `entrada_sub_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada_sub_material` (
  `entrada_id` int(10) unsigned NOT NULL,
  `sub_material_id` int(10) unsigned NOT NULL,
  `quant` int(11) NOT NULL,
  `vl_total` double(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `entrada_sub_material_entrada_id_index` (`entrada_id`),
  KEY `entrada_sub_material_sub_material_id_index` (`sub_material_id`),
  CONSTRAINT `entrada_sub_material_entrada_id_foreign` FOREIGN KEY (`entrada_id`) REFERENCES `entradas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `entrada_sub_material_sub_material_id_foreign` FOREIGN KEY (`sub_material_id`) REFERENCES `sub_materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada_sub_material`
--

LOCK TABLES `entrada_sub_material` WRITE;
/*!40000 ALTER TABLE `entrada_sub_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `entrada_sub_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradas`
--

DROP TABLE IF EXISTS `entradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entradas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num_nf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empenho_id` int(10) unsigned NOT NULL,
  `natureza_op` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cod_chave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vl_total` double(10,2) NOT NULL,
  `dt_recebimento` date NOT NULL,
  `dt_emissao` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `entradas_empenho_id_foreign` (`empenho_id`),
  CONSTRAINT `entradas_empenho_id_foreign` FOREIGN KEY (`empenho_id`) REFERENCES `empenhos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas`
--

LOCK TABLES `entradas` WRITE;
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedors`
--

DROP TABLE IF EXISTS `fornecedors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fantasia` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `razao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cnpj` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telefone1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telefone2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fornecedors_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedors`
--

LOCK TABLES `fornecedors` WRITE;
/*!40000 ALTER TABLE `fornecedors` DISABLE KEYS */;
/*!40000 ALTER TABLE `fornecedors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` bigint(20) NOT NULL,
  `descricao` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `disponivel` tinyint(1) NOT NULL,
  `unidade_id` int(10) unsigned NOT NULL,
  `qtd_min` int(11) NOT NULL,
  `imagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vencimento` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materials_unidade_id_foreign` (`unidade_id`),
  CONSTRAINT `materials_unidade_id_foreign` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_01_20_130632_create_setors_table',1),('2016_01_20_130642_create_coordenacaos_table',1),('2016_01_20_200314_relationship_usuario_setor_coordenacao',1),('2016_01_20_203952_user_habilitado',1),('2016_01_20_204422_create_fornecedors_table',1),('2016_02_03_125130_create_materials_table',1),('2016_02_03_125610_create_empenhos_table',1),('2016_02_03_133338_create_sub_items_table',1),('2016_02_03_191410_create_sub_materials_table',1),('2016_02_03_232006_add_estoques_materiais',1),('2016_02_04_172622_add_fields_empenho',1),('2016_02_14_165903_create_entradas_table',1),('2016_02_18_191115_create_saidas_table',1),('2016_02_25_160745_create_unidades_table',1),('2016_02_25_185843_entrust_setup_tables',1),('2016_02_26_184436_relationship_unidade_material',1),('2016_02_29_141125_relationship_setor_coordenacao',1),('2016_03_01_181644_excluindo_coluna_coordenacao_de_usuario',1),('2016_03_01_184451_inclusao_campos_coordenacao',1),('2016_03_01_190652_create_pedidos_table',1),('2016_03_02_144444_inclusao_campos_ativado',1),('2016_03_03_132150_arrumar_gambiarra_status_ativado',1),('2016_03_08_231153_add_solicitante_empenho',1),('2016_03_09_113511_add_imagem_estoque_min_material',1),('2016_03_10_120634_add_pedidoId_to_saida',1),('2016_03_14_151000_remocao_campo_mod_aplicacao',1),('2016_03_29_214021_create_devolucaos_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('markrener@hotmail.com','3b234c93a06995e96be644565d3b37ec9341b4c7ba84faaaf4105c020877bebc','2016-04-15 14:26:45'),('lucianoleal@ifba.edu.br','56fe88325b15f2d521cd15bbe7a9a6f48beaed975d3854f9623787572c612211','2016-05-18 15:32:25'),('srozane@ifba.edu.br','30509d623a2abd381dd2a9403ddf03d3873680ed54b9299a0d0928d803fdda0b','2016-05-30 20:40:29'),('IGGORLBS@GMAIL.COM','eb0c7e025315782895de43f0d2ed2a505edfe8fdf2d796e3e3469f44e22b6f91','2016-06-07 18:07:08'),('marceladantas@gmail.com','d7cc578e37cf50ec0d9283eaf509f5874d8b21653b208f191171b7c28ad09d5a','2016-09-20 13:45:39'),('rtorquato@gmail.com','feccbbae4c2fdb784d389217600b4d294defaae81e2d4992a33f601d6e3c636b','2017-03-09 14:21:42');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_material`
--

DROP TABLE IF EXISTS `pedido_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_material` (
  `pedido_id` int(10) unsigned NOT NULL,
  `material_id` int(10) unsigned NOT NULL,
  `quant` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `pedido_material_pedido_id_index` (`pedido_id`),
  KEY `pedido_material_material_id_index` (`material_id`),
  CONSTRAINT `pedido_material_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  CONSTRAINT `pedido_material_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_material`
--

LOCK TABLES `pedido_material` WRITE;
/*!40000 ALTER TABLE `pedido_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `obs` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pedidos_user_id_foreign` (`user_id`),
  CONSTRAINT `pedidos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(4,1),(2,2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrador',NULL,'2016-03-27 19:28:14','2016-03-27 19:28:14'),(2,'solicitante','Solicitante',NULL,'2016-03-27 19:28:14','2016-03-27 19:28:14'),(3,'almoxarife','Almoxarife',NULL,'2016-03-27 19:28:14','2016-03-27 19:28:14');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saida_sub_material`
--

DROP TABLE IF EXISTS `saida_sub_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saida_sub_material` (
  `saida_id` int(10) unsigned NOT NULL,
  `sub_material_id` int(10) unsigned NOT NULL,
  `quant` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `saida_sub_material_saida_id_index` (`saida_id`),
  KEY `saida_sub_material_sub_material_id_index` (`sub_material_id`),
  CONSTRAINT `saida_sub_material_saida_id_foreign` FOREIGN KEY (`saida_id`) REFERENCES `saidas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `saida_sub_material_sub_material_id_foreign` FOREIGN KEY (`sub_material_id`) REFERENCES `sub_materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saida_sub_material`
--

LOCK TABLES `saida_sub_material` WRITE;
/*!40000 ALTER TABLE `saida_sub_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `saida_sub_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saidas`
--

DROP TABLE IF EXISTS `saidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saidas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `responsavel_id` int(10) unsigned NOT NULL,
  `solicitante_id` int(10) unsigned NOT NULL,
  `obs` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pedido_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `saidas_responsavel_id_foreign` (`responsavel_id`),
  KEY `saidas_solicitante_id_foreign` (`solicitante_id`),
  KEY `saidas_pedido_id_foreign` (`pedido_id`),
  CONSTRAINT `saidas_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `saidas_responsavel_id_foreign` FOREIGN KEY (`responsavel_id`) REFERENCES `users` (`id`),
  CONSTRAINT `saidas_solicitante_id_foreign` FOREIGN KEY (`solicitante_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saidas`
--

LOCK TABLES `saidas` WRITE;
/*!40000 ALTER TABLE `saidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `saidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saldos`
--

DROP TABLE IF EXISTS `saldos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saldos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sub_item_id` int(10) unsigned NOT NULL,
  `mes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ano` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(11,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `saldos_sub_item_id_foreign` (`sub_item_id`),
  CONSTRAINT `saldos_sub_item_id_foreign` FOREIGN KEY (`sub_item_id`) REFERENCES `sub_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saldos`
--

LOCK TABLES `saldos` WRITE;
/*!40000 ALTER TABLE `saldos` DISABLE KEYS */;
/*!40000 ALTER TABLE `saldos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setors`
--

DROP TABLE IF EXISTS `setors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `coordenacao_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `setors_coordenacao_id_foreign` (`coordenacao_id`),
  CONSTRAINT `setors_coordenacao_id_foreign` FOREIGN KEY (`coordenacao_id`) REFERENCES `coordenacaos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setors`
--

LOCK TABLES `setors` WRITE;
/*!40000 ALTER TABLE `setors` DISABLE KEYS */;
INSERT INTO `setors` VALUES (1,'Setor1','2016-03-27 19:28:48','2016-03-27 19:28:48',1,1);
/*!40000 ALTER TABLE `setors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_items`
--

DROP TABLE IF EXISTS `sub_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `material_consumo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_items`
--

LOCK TABLES `sub_items` WRITE;
/*!40000 ALTER TABLE `sub_items` DISABLE KEYS */;
INSERT INTO `sub_items` VALUES (1,'COMBUSTÍVEIS E LUBRIFICANTES AUTOMOTIVOS','2016-03-27 19:28:09','2016-04-12 21:28:43',0),(2,'COMBUSTÍVEIS E LUBRIFICANTES DE AVIAÇÃO','2016-03-27 19:28:10','2016-04-12 21:28:48',0),(3,'COMBUSTÍVEIS E LUBRIFICANTES PARA OUTRAS FINALIDADES','2016-03-27 19:28:10','2016-04-12 21:29:00',0),(4,'GÁS ENGARRAFADO','2016-03-27 19:28:10','2016-04-12 21:29:05',0),(5,'EXPLOSIVOS E MUNIÇÕES','2016-03-27 19:28:10','2016-04-12 21:29:16',0),(6,'ALIMENTOS PARA ANIMAIS','2016-03-27 19:28:10','2016-04-12 21:34:25',0),(7,'GÊNEROS DE ALIMENTAÇÃO','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(8,'ANIMAIS PARA PESQUISA E ABATE','2016-03-27 19:28:10','2016-04-12 21:34:35',0),(9,'MATERIAL FARMACOLÓGICO','2016-03-27 19:28:10','2016-04-12 21:34:52',0),(10,'MATERIAL ODONTOLÓGICO','2016-03-27 19:28:10','2016-04-12 21:35:40',0),(11,'MATERIAL QUÍMICO','2016-03-27 19:28:10','2016-04-12 21:36:21',0),(12,'MATERIAL DE COUDELARIA OU DE USO ZOOTÉCNICO','2016-03-27 19:28:10','2016-04-12 21:36:10',0),(13,'MATERIAL DE CAÇA E PESCA','2016-03-27 19:28:10','2016-04-12 21:36:47',0),(14,'MATERIAL EDUCATIVO E ESPORTIVO','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(15,'MATERIAL PARA FESTIVIDADES E HOMENAGENS','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(16,'MATERIAL DE EXPEDIENTE','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(17,'MATERIAL DE PROCESSAMENTO DE DADOS','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(18,'MATERIAIS E MEDICAMENTOS PARA USO VETERINÁRIO','2016-03-27 19:28:10','2017-03-27 16:52:31',1),(19,'MATERIAL DE ACONDICIONAMENTO E EMBALAGEM','2016-03-27 19:28:10','2017-03-27 16:52:22',1),(20,'MATERIAL DE CAMA, MESA E BANHO','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(21,'MATERIAL DE COPA E COZINHA','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(22,'MATERIAL DE LIMPEZA E PRODUÇÃO DE HIGIENIZAÇÃO','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(23,'UNIFORMES, TECIDOS E AVIAMENTOS','2016-03-27 19:28:10','2016-04-12 21:41:48',0),(24,'MATERIAL PARA MANUTENÇÃO DE BENS IMÓVEIS','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(25,'MATERIAL PARA MANUTENÇÃO DE BENS MÓVEIS (EXCETO VEÍCULOS)','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(26,'MATERIAL ELÉTRICO E ELETRÔNICO','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(27,'MATERIAL DE MANOBRA E PATRULHAMENTO','2016-03-27 19:28:10','2016-04-12 21:42:15',0),(28,'MATERIAL DE PROTEÇÃO E SEGURANÇA','2016-03-27 19:28:10','2016-03-27 19:28:10',1),(29,'MATERIAL PARA ÁUDIO, VÍDEO E FOTO','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(30,'MATERIAL PARA COMUNICAÇÕES','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(31,'SEMENTES, MUDAS DE PLANTAS E INSUMOS','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(32,'SUPRIMENTO DE AVIAÇÃO','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(33,'MATERIAL PARA PRODUÇÃO INDUSTRIAL','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(34,'SOBRESSALENTES, MÁQUINAS E MOTORES DE NAVIOS E EMBARCAÇÕES','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(35,'MATERIAL LABORATORIAL','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(36,'MATERIAL HOSPITALAR','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(37,'SOBRESSALENTES DE ARMAMENTO','2016-03-27 19:28:11','2016-04-12 21:42:34',0),(38,'SUPRIMENTO DE PROTEÇÃO AO VÔO','2016-03-27 19:28:11','2016-04-12 21:40:05',0),(39,'MATERIAL PARA MANUTENÇÃO DE VEÍCULOS','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(40,'MATERIAL BIOLÓGICO','2016-03-27 19:28:11','2016-04-12 21:39:25',0),(41,'MATERIAL PARA UTILIZAÇÃO EM GRÁFICA','2016-03-27 19:28:11','2016-04-12 21:39:13',0),(42,'FERRAMENTAS','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(43,'MATERIAL PARA REABILITAÇÃO PROFISSIONAL','2016-03-27 19:28:11','2016-04-12 21:38:59',0),(44,'MATERIAL DE SINALIZAÇÃO VISUAL E AFINS','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(45,'MATERIAL TÉCNICO PARA SELEÇÃO E TREINAMENTO','2016-03-27 19:28:11','2016-04-12 21:38:47',0),(46,'MATERIAL BIBLIOGRÁFICO NÃO IMOBILIZÁVEL','2016-03-27 19:28:11','2017-09-21 17:11:25',1),(47,'AQUISIÇÃO DE SOFTWARES DE BASE','2016-03-27 19:28:11','2016-04-12 21:38:12',0),(48,'BENS MÓVEIS NÃO ATIVÁVEIS','2016-03-27 19:28:11','2016-04-12 21:38:03',0),(49,'BILHETES DE PASSAGEM','2016-03-27 19:28:11','2016-04-12 21:37:39',0),(50,'BANDEIRAS, FLÂMULAS E INSÍGNIAS','2016-03-27 19:28:11','2016-03-27 19:28:11',1),(51,'DISCOTECAS E FILMOTECAS NAO IMOBILIZAVEL','2016-03-27 19:28:11','2016-04-12 21:37:23',0),(52,'MATERIAL DE CARATER SECRETO OU RESERVADO','2016-03-27 19:28:11','2016-04-12 21:37:17',0),(53,'MATERIAL METEOROLOGICO','2016-03-27 19:28:11','2016-04-12 21:37:09',0);
/*!40000 ALTER TABLE `sub_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_materials`
--

DROP TABLE IF EXISTS `sub_materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vencimento` date NOT NULL,
  `vl_total` decimal(10,3) NOT NULL,
  `qtd_estoque` int(11) NOT NULL,
  `qtd_solicitada` int(11) NOT NULL,
  `material_id` int(10) unsigned NOT NULL,
  `empenho_id` int(10) unsigned NOT NULL,
  `sub_item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_materials_material_id_foreign` (`material_id`),
  KEY `sub_materials_empenho_id_foreign` (`empenho_id`),
  KEY `sub_materials_sub_item_id_foreign` (`sub_item_id`),
  CONSTRAINT `sub_materials_empenho_id_foreign` FOREIGN KEY (`empenho_id`) REFERENCES `empenhos` (`id`),
  CONSTRAINT `sub_materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  CONSTRAINT `sub_materials_sub_item_id_foreign` FOREIGN KEY (`sub_item_id`) REFERENCES `sub_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_materials`
--

LOCK TABLES `sub_materials` WRITE;
/*!40000 ALTER TABLE `sub_materials` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'Caixa','2016-03-27 19:28:13','2016-03-27 19:28:13',1),(2,'Dúzia','2016-03-27 19:28:13','2016-03-27 19:28:13',1),(3,'Unidade','2016-03-27 19:28:13','2016-03-27 19:28:13',1),(4,'Pacote','2016-03-27 19:28:13','2016-03-27 19:28:13',1),(5,'Cento','2016-03-27 19:28:13','2016-03-27 19:28:13',1),(6,'Resma','2016-03-27 19:28:13','2016-03-27 19:28:13',1),(7,'Frasco','2016-03-27 19:28:13','2016-03-27 19:28:13',1),(8,'Quilo','2016-03-27 19:28:13','2016-03-27 19:28:13',1),(9,'Litro','2016-03-27 19:28:14','2016-03-27 19:28:14',1),(10,'Estojo','2016-04-12 20:57:12','2017-07-20 22:27:37',1),(11,'Galão','2016-04-15 15:56:45','2017-07-20 22:28:20',1),(12,'Par','2016-04-19 20:26:46','2017-07-20 22:28:28',1),(13,'Metro','2016-05-24 14:53:26','2016-05-24 14:53:26',1),(14,'Jogo','2017-07-20 22:28:45','2017-07-20 22:28:45',1),(15,'Fardo','2017-07-20 22:29:11','2017-07-20 22:29:11',1),(16,'Rolo','2017-09-05 23:12:02','2017-09-11 23:01:45',1);
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `siape` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `setor_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `habilitado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_setor_id_foreign` (`setor_id`),
  CONSTRAINT `users_setor_id_foreign` FOREIGN KEY (`setor_id`) REFERENCES `setors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador','administrador@progest.com','$2y$10$DLW0QcH.Ps2B3M/HMheChOt8/CJ.SSG0aE1bzRSNKQ53LxAsMQstO','(77) 98888-8888','1111111',1,'qxLcIiFB5ioJPwkgMbrKsyKAD0YzXey108C0sz2XcVhFXIFwywXpIV3EPXBK','2016-03-27 19:28:14','2018-01-12 21:25:09',1),(2,'Solicitante','solicitante@progest.com','$2y$10$IJe6MutShQBgDosMObwWSeGmAClBa1Qo2CTKC44nWQPJ/3N5wiI9S','(77) 99199-9991','2222222',1,'ZUHlxq7I8idUSCObCqdmcCJ8bF6MkkqXLhRt6SWqzfLVpj4ZycBpDIU3qsad','2016-03-27 19:28:14','2018-01-12 21:28:36',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-15 10:00:11
