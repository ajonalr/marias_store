-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: elconstructor
-- ------------------------------------------------------
-- Server version	8.0.26-0ubuntu0.20.04.2

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
-- Table structure for table `abonos_proveedores`
--

DROP TABLE IF EXISTS `abonos_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `abonos_proveedores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` bigint unsigned NOT NULL,
  `valor` double NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_cobro` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `abonos_proveedores_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `abonos_proveedores_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonos_proveedores`
--

/*!40000 ALTER TABLE `abonos_proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `abonos_proveedores` ENABLE KEYS */;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articulos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `categoria_id` bigint unsigned NOT NULL,
  `proveedor_id` bigint unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cod_barras` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion_interna` text COLLATE utf8mb4_unicode_ci,
  `p_venta` double(7,2) NOT NULL,
  `p_costo` double(7,2) NOT NULL,
  `p_descuento` double DEFAULT NULL,
  `stock` double(7,2) NOT NULL,
  `min_stock` double DEFAULT '0',
  `img` text COLLATE utf8mb4_unicode_ci,
  `img2` text COLLATE utf8mb4_unicode_ci,
  `fecha_promo` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articulos_categoria_id_foreign` (`categoria_id`),
  KEY `articulos_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `articulos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  CONSTRAINT `articulos_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;

--
-- Table structure for table `articulos_catalogo`
--

DROP TABLE IF EXISTS `articulos_catalogo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articulos_catalogo` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` double NOT NULL,
  `descuento` double NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos_catalogo`
--

/*!40000 ALTER TABLE `articulos_catalogo` DISABLE KEYS */;
/*!40000 ALTER TABLE `articulos_catalogo` ENABLE KEYS */;

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caja` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `valor` double NOT NULL DEFAULT '0',
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operacion` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'UNDAD','UNIDAD',NULL,'2021-10-03 06:30:13','2021-10-03 06:30:13'),(2,'CAJA','CAJA',NULL,'2021-10-03 06:30:13','2021-10-03 06:30:13');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'C/F',
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Ciudad',
  `telefono1` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono2` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (14,'Consumidor Final','CF','ciudad',NULL,NULL,NULL,'2021-10-03 06:30:13','2021-10-03 06:30:13');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

--
-- Table structure for table `compra_articulos`
--

DROP TABLE IF EXISTS `compra_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra_articulos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `articulo_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `cantidad` double NOT NULL,
  `factura` char(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compra_articulos_articulo_id_foreign` (`articulo_id`),
  KEY `compra_articulos_user_id_foreign` (`user_id`),
  CONSTRAINT `compra_articulos_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`),
  CONSTRAINT `compra_articulos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra_articulos`
--

/*!40000 ALTER TABLE `compra_articulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra_articulos` ENABLE KEYS */;

--
-- Table structure for table `compra_proveedores`
--

DROP TABLE IF EXISTS `compra_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra_proveedores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` bigint unsigned NOT NULL,
  `articulo_id` bigint unsigned NOT NULL,
  `cantidad` double NOT NULL,
  `factura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_de_compra` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compra_proveedores_proveedor_id_foreign` (`proveedor_id`),
  KEY `compra_proveedores_articulo_id_foreign` (`articulo_id`),
  CONSTRAINT `compra_proveedores_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`),
  CONSTRAINT `compra_proveedores_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra_proveedores`
--

/*!40000 ALTER TABLE `compra_proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra_proveedores` ENABLE KEYS */;

--
-- Table structure for table `cotizacion`
--

DROP TABLE IF EXISTS `cotizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cotizacion` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `articulo_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` double NOT NULL,
  `total` double NOT NULL,
  `descuento` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cotizacion_articulo_id_foreign` (`articulo_id`),
  CONSTRAINT `cotizacion_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizacion`
--

/*!40000 ALTER TABLE `cotizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizacion` ENABLE KEYS */;

--
-- Table structure for table `cuadre`
--

DROP TABLE IF EXISTS `cuadre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuadre` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `entrada` double(7,2) NOT NULL,
  `salida` double(7,2) NOT NULL,
  `cuadre` double(7,2) NOT NULL,
  `boleta` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalEfectico` double(7,2) NOT NULL,
  `faltante` double(7,2) NOT NULL,
  `totalVisas` double(7,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuadre_user_id_foreign` (`user_id`),
  CONSTRAINT `cuadre_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuadre`
--

/*!40000 ALTER TABLE `cuadre` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuadre` ENABLE KEYS */;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descuento` double DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `descripcion_min` text COLLATE utf8mb4_unicode_ci,
  `total` double DEFAULT NULL,
  `total_des` double DEFAULT NULL,
  `mayoristas` blob,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;

--
-- Table structure for table `facturas_proveedor`
--

DROP TABLE IF EXISTS `facturas_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturas_proveedor` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` bigint unsigned NOT NULL,
  `factura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` double NOT NULL,
  `fecha_de_pago` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facturas_proveedor_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `facturas_proveedor_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas_proveedor`
--

/*!40000 ALTER TABLE `facturas_proveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas_proveedor` ENABLE KEYS */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2020_12_17_055226_create_roles_table',1),(4,'2020_12_17_055308_create_permissions_table',1),(5,'2020_12_17_060416_create_role_permissions_pivot_table',1),(6,'2020_12_17_061340_add_relationship_fields_to_users_table',1),(7,'2021_01_26_213743_create_trakings_table',1),(8,'2021_07_15_120544_create_proveedores_table',1),(9,'2021_07_15_120655_create_categoria_table',1),(10,'2021_07_15_120739_create_caja_table',1),(11,'2021_07_15_120836_create_clientes_table',1),(12,'2021_07_15_121820_create_cuadre_table',1),(13,'2021_07_15_122110_create_facturas_table',1),(14,'2021_07_15_122210_create_articulos_table',1),(15,'2021_07_15_123708_create_ventasarticulos_table',1),(16,'2021_07_15_123852_create_articulos_catalogo__table',1),(17,'2021_07_15_124008_create_compra_articulos_table',1),(18,'2021_07_15_124139_add_proveedor_to_articulos',1),(19,'2021_07_15_230108_add_fone_to_users',1),(20,'2021_07_16_193613_add_pdescuento_to_articulos',1),(21,'2021_07_28_142109_add_horario_to_user',1),(22,'2021_07_29_133256_create_cotizacion_table',1),(23,'2021_07_30_122849_create_facturas_proveedor_table',1),(24,'2021_07_30_132734_create_abonos_proveedores_table',1),(25,'2021_07_30_174834_add_data_to_cotizacion',1),(26,'2021_07_31_170857_create_compra_proveedores_table',1),(27,'2021_09_11_200955_add_nombre_empresa_to_proveedores',1),(28,'2021_09_11_221341_add_fecha_compra_to_facturas_proveedor',1),(29,'2021_09_21_221727_add_description_to_permissions',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'admin_panel_access','2021-10-03 06:30:10','2021-10-03 06:30:10','PERMITE EL ACCESO AL SISTEMA'),(2,'users_access','2021-10-03 06:30:10','2021-10-03 06:30:10','PERMITE LISTAR LOS USUARIOS'),(3,'user_edit','2021-10-03 06:30:10','2021-10-03 06:30:10','PERMITE EDITAR LOS USUARIOS'),(4,'user_delete','2021-10-03 06:30:10','2021-10-03 06:30:10','PERMITE ELIMINAR A UN USUARIO'),(5,'user_create','2021-10-03 06:30:10','2021-10-03 06:30:10','PERMITE REGISTRAR A UN USUARIO'),(6,'user_show','2021-10-03 06:30:11','2021-10-03 06:30:11','VER PERFIL DE USUARIO'),(7,'roles_access','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE LISTAR LOS ROLES'),(8,'role_edit','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE EDITAR LOS ROLES'),(9,'role_delete','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ELIMINAR UN ROL'),(10,'role_create','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE CREAR UN ROL'),(11,'role_show','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VISUALIZAR UN ROL'),(12,'permissions_access','2021-10-03 06:30:11','2021-10-03 06:30:11',NULL),(13,'permission_edit','2021-10-03 06:30:11','2021-10-03 06:30:11',NULL),(14,'permission_delete','2021-10-03 06:30:11','2021-10-03 06:30:11',NULL),(15,'permission_create','2021-10-03 06:30:11','2021-10-03 06:30:11',NULL),(16,'articulos_listado','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE LISTAR TODOS LOS ARTICULOS'),(17,'articulos_show','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER Y ACTUALIZR EL PERFIL DE LOS ARTICULOS'),(18,'articulos_store','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE REGISTAR UN NUEVO ARTICULO'),(19,'articulos_delete','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ELIMINAR UN ARTICULO'),(20,'articulos_min_stock','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VISUALIZAR LOS ARTICULOS CON MINIMO DE STOCK'),(21,'articulos_compra_store','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE GURARDAR UNA COMPRA DE UN ARTICULO YA EXISTENTE'),(22,'articulos_historial','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER EL HISTORIAL DE COMPRAS DE LOS ARTICULOS'),(23,'articulos_hitorial_delete','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ELIMINAR UN ARTICULO DEL HISTORIAL DE COMPRAS'),(24,'articulos_report_all','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER TODOS LOS REPORTES DE LOS ARTICULOS'),(25,'articulos_catalogo_add','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE AÑADIR UN ARTICULO PARA EL CATALOGO'),(26,'articulos_catalogo_update','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ACTUALIZAR UN ARTICULO EN CATALOGO'),(27,'articulos_catalog_delete','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ELIMINAR UN ARTICULO EN CATLOGO'),(28,'articulos_catalogo_report','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE GENERAR EL REPORTE DE ARTICULOS EN CATALOGO'),(29,'clientes_all','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE USO DE MODULO DE CLIENTES'),(30,'categoria_list','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE LISTAR TODAS LAS CATEGORIAS'),(31,'categoria_show','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER EL PERFIL DE CATEGORIAS / ACTUALIZAR'),(32,'categoria_delete','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ELIMINAR UNA CATEGORIA'),(33,'categoria_create','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE CREAR UNA NUEVA CATEGORIA'),(34,'categoria_report','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE GENERAR EL REPORTE DE CATEGORIAS'),(35,'venta_inicio','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE REALIZAR VENTAS E IMPRIMIR RECIBOS'),(36,'venta_historial','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER EL HITORIAL DE VENTAS'),(37,'venta_recibo','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE LA REIMPRESION DE RECIBOS DE VETAS'),(38,'venta_anulacion','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE LA ANULACION DE UNA VENTA'),(39,'venta_reports','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE GENERAR TODOS LOS REPORTES DE VENTAS'),(40,'caja_registro_cajachica','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE REGISTRAR DATOS EN CAJA CHICA'),(41,'caja_registro_gastos','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE REGISTRAR GASTOS'),(42,'caja_cuadre','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE REALIZAR UN CUADRE'),(43,'caja_cuadre_delete','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ELIMINAR REPORTE DE CUADRES DE CAJA'),(44,'caja_delete_cajachica','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ELIMINAR UN DATO DE CAJA CHICA'),(45,'caja_delete_gasto','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE ELIMINAR UN DATO DE GASTOS'),(46,'caja_filtrado_cajachica','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER MOVIMIENTOS DE CAJA CHICA FILTRADOS'),(47,'caja_filtrado_gastos','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER MOVIMIENTOS DE GASTOS FILTRADOS'),(48,'caja_movimientos_filtrados','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER LOS MOVIMIENTOS DEL MES / FILTRADOS'),(49,'caja_movimientos_dia','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VER LOS MOVIMIENTOS DEL DIA'),(50,'tracking_all','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE USO DE MODULO DE TRACKINGS'),(51,'proveedor_list','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE LISTAR A TODOS LOS PROVEEDORES'),(52,'proveedor_all','2021-10-03 06:30:11','2021-10-03 06:30:11','PERMITE VISUALIZAR EL PERFIL DE CADA PROVEEDOR PARA ACTUALIZAR DATOS Y ASIGNAR FACTURAS DE PAGO');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Not a Number',
  `articulos` text COLLATE utf8mb4_unicode_ci,
  `dias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `empresa` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Proveedor Ejemplo','456123','456456','Hierro, Cemento, Tubos, Clavos, Pegamix','jueves, sabado',NULL,'2021-10-03 06:30:13','2021-10-03 06:30:13',NULL,NULL);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_permissions` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  KEY `role_permissions_role_id_foreign` (`role_id`),
  KEY `role_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,47),(1,48),(1,49),(1,50),(1,51),(1,52),(2,1),(2,2);
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','Admin','2021-10-03 06:30:10','2021-10-03 06:30:10'),(2,'User',NULL,'2021-10-03 06:30:10','2021-10-03 06:30:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

--
-- Table structure for table `trakings`
--

DROP TABLE IF EXISTS `trakings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trakings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` double(8,2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trakings`
--

/*!40000 ALTER TABLE `trakings` DISABLE KEYS */;
/*!40000 ALTER TABLE `trakings` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Ariel Ramirez','ariel12jona@gmail.com',NULL,NULL,NULL,'$2y$10$6cWvd8ce6FyF7p7TbU.JK.gtCPemnX6kxMi0pIotFYBG.HdB8ckZa',1,NULL,NULL,'2021-10-03 06:30:13','2021-10-03 06:30:13'),(2,'User Jonatan Lopez','ariel20jona@gmail.com',NULL,NULL,NULL,'$2y$10$JrWiAKIYdopiofrZI7ohZewmNtSdMrCkA32rO.zo45y3VEQHyn7Tq',2,NULL,NULL,'2021-10-03 06:30:13','2021-10-03 06:30:13');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `venta_articulos`
--

DROP TABLE IF EXISTS `venta_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta_articulos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `articulo_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `cliente_id` bigint unsigned NOT NULL,
  `factura_id` bigint unsigned NOT NULL,
  `credito` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` double NOT NULL,
  `total` double NOT NULL,
  `descuento` double NOT NULL,
  `mayorista` blob,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_articulos_articulo_id_foreign` (`articulo_id`),
  KEY `venta_articulos_user_id_foreign` (`user_id`),
  KEY `venta_articulos_cliente_id_foreign` (`cliente_id`),
  KEY `venta_articulos_factura_id_foreign` (`factura_id`),
  CONSTRAINT `venta_articulos_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`),
  CONSTRAINT `venta_articulos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `venta_articulos_factura_id_foreign` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`),
  CONSTRAINT `venta_articulos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_articulos`
--

/*!40000 ALTER TABLE `venta_articulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_articulos` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-03  0:31:46
