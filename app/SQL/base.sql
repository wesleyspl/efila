-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.7-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para efila
CREATE DATABASE IF NOT EXISTS `efila` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `efila`;

-- Copiando estrutura para tabela efila.atendente
CREATE TABLE IF NOT EXISTS `atendente` (
  `id_atendente` int(10) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_atendente`),
  KEY `FK_atendente_pessoa` (`pessoa_id`),
  CONSTRAINT `FK_atendente_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.atendente: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `atendente` DISABLE KEYS */;
INSERT INTO `atendente` (`id_atendente`, `pessoa_id`, `status`, `created_at`, `updated_at`) VALUES
	(11, 15, 'inativo', NULL, '2025-02-07 01:31:45'),
	(12, 16, 'inativo', NULL, '2025-02-07 01:31:53'),
	(13, 17, 'ativo', '2025-02-05 01:46:55', '2025-02-05 01:46:55');
/*!40000 ALTER TABLE `atendente` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.atendente_local
CREATE TABLE IF NOT EXISTS `atendente_local` (
  `id_atendente_local` int(10) NOT NULL AUTO_INCREMENT,
  `atendente_id` int(10) DEFAULT NULL,
  `local_id` int(10) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_atendente_local`),
  KEY `FK_atendente_local_atendente` (`atendente_id`),
  KEY `FK_atendente_local_local` (`local_id`),
  CONSTRAINT `FK_atendente_local_atendente` FOREIGN KEY (`atendente_id`) REFERENCES `atendente` (`id_atendente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_atendente_local_local` FOREIGN KEY (`local_id`) REFERENCES `local` (`id_local`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.atendente_local: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `atendente_local` DISABLE KEYS */;
INSERT INTO `atendente_local` (`id_atendente_local`, `atendente_id`, `local_id`, `numero`, `created_at`, `updated_at`) VALUES
	(1, 11, 3, NULL, '2025-02-05 01:42:49', '2025-02-12 01:30:18'),
	(2, 13, 4, '1', '2025-02-05 01:48:04', '2025-02-14 02:45:17'),
	(3, 12, 3, '4', '2025-02-06 02:23:57', '2025-02-06 02:23:57');
/*!40000 ALTER TABLE `atendente_local` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.atendente_servico
CREATE TABLE IF NOT EXISTS `atendente_servico` (
  `id_atendente_servico` int(10) NOT NULL AUTO_INCREMENT,
  `servico_id` int(10) DEFAULT NULL,
  `atendente_id` int(10) DEFAULT NULL,
  `departamento_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_atendente_servico`),
  KEY `FK_atendente_servico_servico` (`servico_id`),
  KEY `FK_atendente_servico_atendente` (`atendente_id`),
  KEY `FK_atendente_servico_departamento` (`departamento_id`),
  CONSTRAINT `FK_atendente_servico_atendente` FOREIGN KEY (`atendente_id`) REFERENCES `atendente` (`id_atendente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_atendente_servico_departamento` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_atendente_servico_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.atendente_servico: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `atendente_servico` DISABLE KEYS */;
INSERT INTO `atendente_servico` (`id_atendente_servico`, `servico_id`, `atendente_id`, `departamento_id`, `created_at`, `updated_at`) VALUES
	(10, 1, 13, NULL, '2025-02-14 02:27:16', '2025-02-14 02:27:16');
/*!40000 ALTER TABLE `atendente_servico` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.atendimento
CREATE TABLE IF NOT EXISTS `atendimento` (
  `id_atendimento` int(10) NOT NULL AUTO_INCREMENT,
  `atendimento_id` int(10) DEFAULT NULL,
  `numero_local` int(10) DEFAULT NULL,
  `nome_local` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ativo',
  `sigla` varchar(50) DEFAULT NULL,
  `servico_id` int(10) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `painel_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_atendimento`),
  KEY `FK_atendimento_servico` (`servico_id`),
  KEY `FK_atendimento_painel` (`painel_id`),
  CONSTRAINT `FK_atendimento_painel` FOREIGN KEY (`painel_id`) REFERENCES `painel` (`id_painel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_atendimento_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.atendimento: ~47 rows (aproximadamente)
/*!40000 ALTER TABLE `atendimento` DISABLE KEYS */;
INSERT INTO `atendimento` (`id_atendimento`, `atendimento_id`, `numero_local`, `nome_local`, `status`, `sigla`, `servico_id`, `numero`, `painel_id`, `created_at`, `updated_at`) VALUES
	(1, NULL, 34, 'IPTU', 'finalizado', 'INF', 1, 4, 2, '2025-02-05 02:01:03', '2025-02-13 03:32:43'),
	(6, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 2, NULL, '2025-02-05 02:23:11', '2025-02-05 02:23:11'),
	(7, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 3, NULL, '2025-02-05 02:23:19', '2025-02-05 02:23:19'),
	(8, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 5, NULL, '2025-02-05 02:26:04', '2025-02-05 02:26:04'),
	(9, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 6, NULL, '2025-02-05 02:26:38', '2025-02-05 02:26:38'),
	(10, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 7, NULL, '2025-02-05 02:27:21', '2025-02-05 02:27:21'),
	(11, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 8, NULL, '2025-02-05 02:27:44', '2025-02-05 02:27:44'),
	(12, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 9, NULL, '2025-02-05 02:29:38', '2025-02-05 02:29:38'),
	(13, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 10, NULL, '2025-02-05 02:30:13', '2025-02-05 02:30:13'),
	(14, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 11, NULL, '2025-02-05 02:30:30', '2025-02-05 02:30:30'),
	(15, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 12, NULL, '2025-02-05 02:31:06', '2025-02-05 02:31:06'),
	(16, NULL, 23, 'IPTU', 'atendendo', 'TFD', 2, 1, NULL, '2025-02-06 03:50:12', '2025-02-06 03:50:12'),
	(17, NULL, 23, 'Guichê', 'atendendo', 'INF', 1, 15, NULL, '2025-02-06 03:50:39', '2025-02-06 03:50:39'),
	(18, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 2, NULL, '2025-02-06 03:51:17', '2025-02-06 03:51:17'),
	(19, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 6, NULL, '2025-02-06 03:51:54', '2025-02-06 03:51:54'),
	(20, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 3, NULL, '2025-02-06 03:52:12', '2025-02-06 03:52:12'),
	(21, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 7, NULL, '2025-02-06 03:52:53', '2025-02-06 03:52:53'),
	(22, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 4, NULL, '2025-02-06 03:53:22', '2025-02-06 03:53:22'),
	(23, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 5, NULL, '2025-02-06 03:53:44', '2025-02-06 03:53:44'),
	(24, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 2, NULL, '2025-02-13 03:32:19', '2025-02-13 03:32:19'),
	(25, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 4, NULL, '2025-02-13 03:32:42', '2025-02-13 03:32:42'),
	(26, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 5, NULL, '2025-02-13 03:33:00', '2025-02-13 03:33:00'),
	(27, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 8, NULL, '2025-02-13 03:44:56', '2025-02-13 03:44:56'),
	(28, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 9, NULL, '2025-02-13 03:45:34', '2025-02-13 03:45:34'),
	(29, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 10, NULL, '2025-02-13 03:46:41', '2025-02-13 03:46:41'),
	(30, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 11, NULL, '2025-02-13 03:47:05', '2025-02-13 03:47:05'),
	(31, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 12, NULL, '2025-02-13 03:49:00', '2025-02-13 03:49:00'),
	(32, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 13, NULL, '2025-02-13 03:49:19', '2025-02-13 03:49:19'),
	(33, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 15, NULL, '2025-02-14 02:22:40', '2025-02-14 02:22:40'),
	(34, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 16, NULL, '2025-02-14 02:22:49', '2025-02-14 02:22:49'),
	(35, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 17, NULL, '2025-02-14 02:22:53', '2025-02-14 02:22:53'),
	(36, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 18, NULL, '2025-02-14 02:22:59', '2025-02-14 02:22:59'),
	(37, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 19, NULL, '2025-02-14 02:23:05', '2025-02-14 02:23:05'),
	(38, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 20, NULL, '2025-02-14 02:23:42', '2025-02-14 02:23:42'),
	(39, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 21, NULL, '2025-02-14 02:23:46', '2025-02-14 02:23:46'),
	(40, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 1, NULL, '2025-02-14 02:23:50', '2025-02-14 02:23:50'),
	(41, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 3, NULL, '2025-02-14 02:23:55', '2025-02-14 02:23:55'),
	(42, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 6, NULL, '2025-02-14 02:24:00', '2025-02-14 02:24:00'),
	(43, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 7, NULL, '2025-02-14 02:24:05', '2025-02-14 02:24:05'),
	(44, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 10, NULL, '2025-02-14 02:24:12', '2025-02-14 02:24:12'),
	(45, NULL, 2, 'Guichê', 'atendendo', 'ET', 1, 20, NULL, '2025-02-14 02:33:15', '2025-02-14 02:33:15'),
	(46, NULL, 2, 'Guichê', 'atendendo', 'ET', 1, 21, NULL, '2025-02-14 02:33:28', '2025-02-14 02:33:28'),
	(47, NULL, 2, 'Guichê', 'atendendo', 'ET', 1, 22, NULL, '2025-02-14 02:59:08', '2025-02-14 02:59:08'),
	(48, NULL, 1, 'mesa', 'atendendo', 'PET', 1, 26, NULL, '2025-02-14 02:59:44', '2025-02-14 02:59:44'),
	(49, NULL, 1, 'mesa', 'atendendo', 'PET', 1, 27, NULL, '2025-02-14 03:00:07', '2025-02-14 03:00:07'),
	(50, NULL, 1, 'mesa', 'atendendo', 'PET', 1, 28, NULL, '2025-02-14 03:09:06', '2025-02-14 03:09:06'),
	(51, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 11, NULL, '2025-02-14 03:23:42', '2025-02-14 03:23:42'),
	(52, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 54, NULL, '2025-02-17 00:37:10', '2025-02-17 00:37:10'),
	(53, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 56, NULL, '2025-02-17 00:37:57', '2025-02-17 00:37:57'),
	(54, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 58, NULL, '2025-02-17 00:39:15', '2025-02-17 00:39:15'),
	(55, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 63, NULL, '2025-02-17 01:17:48', '2025-02-17 01:17:48');
/*!40000 ALTER TABLE `atendimento` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.cache: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('manolo@gmail.com|127.0.0.1', 'i:1;', 1738813651),
	('manolo@gmail.com|127.0.0.1:timer', 'i:1738813651;', 1738813651),
	('wpsitemas2@gmail.com|127.0.0.1', 'i:1;', 1739329281),
	('wpsitemas2@gmail.com|127.0.0.1:timer', 'i:1739329281;', 1739329281);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.cache_locks: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.contador
CREATE TABLE IF NOT EXISTS `contador` (
  `id_contador` int(10) NOT NULL AUTO_INCREMENT,
  `servico_id` int(10) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `departamento_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_contador`),
  KEY `FK_contador_departamento` (`departamento_id`),
  KEY `FK_contador_servico` (`servico_id`),
  CONSTRAINT `FK_contador_departamento` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_contador_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.contador: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `contador` DISABLE KEYS */;
INSERT INTO `contador` (`id_contador`, `servico_id`, `numero`, `departamento_id`, `created_at`, `updated_at`) VALUES
	(15, 1, 63, NULL, '2025-02-12 02:39:59', '2025-02-17 01:17:42'),
	(19, 2, 10, NULL, '2025-02-12 02:54:31', '2025-02-13 02:06:21'),
	(20, 3, 3, NULL, '2025-02-12 03:40:04', '2025-02-13 02:06:56'),
	(21, 4, 1, NULL, '2025-02-12 03:40:21', '2025-02-12 03:41:59'),
	(22, 5, 4, NULL, '2025-02-12 03:40:34', '2025-02-13 02:10:03');
/*!40000 ALTER TABLE `contador` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.departamento
CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.departamento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.fila
CREATE TABLE IF NOT EXISTS `fila` (
  `id_fila` int(10) NOT NULL AUTO_INCREMENT,
  `servico_id` int(10) DEFAULT NULL,
  `departamento_id` int(10) DEFAULT NULL,
  `sigla` varchar(50) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_fila`),
  KEY `FK_fila_departamento` (`departamento_id`),
  KEY `FK_fila_servico` (`servico_id`),
  CONSTRAINT `FK_fila_departamento` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_fila_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.fila: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `fila` DISABLE KEYS */;
INSERT INTO `fila` (`id_fila`, `servico_id`, `departamento_id`, `sigla`, `peso`, `created_at`, `updated_at`, `numero`) VALUES
	(59, 5, NULL, '34', 0, '2025-02-12 03:41:51', '2025-02-12 03:41:51', 1),
	(60, 4, NULL, 'ET009', 1, '2025-02-12 03:41:59', '2025-02-12 03:41:59', 1),
	(61, 3, NULL, 'ETA', 0, '2025-02-12 03:42:14', '2025-02-12 03:42:14', 1),
	(63, 5, NULL, '34', 1, '2025-02-13 01:36:11', '2025-02-13 01:36:11', 2),
	(64, 5, NULL, '34', 0, '2025-02-13 01:36:44', '2025-02-13 01:36:44', 3),
	(66, 3, NULL, 'ETA', 1, '2025-02-13 02:06:47', '2025-02-13 02:06:47', 2),
	(67, 3, NULL, 'ETA', 0, '2025-02-13 02:06:56', '2025-02-13 02:06:56', 3),
	(69, 5, NULL, '34', 0, '2025-02-13 02:10:03', '2025-02-13 02:10:03', 4);
/*!40000 ALTER TABLE `fila` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.historico
CREATE TABLE IF NOT EXISTS `historico` (
  `id_historico` int(10) NOT NULL AUTO_INCREMENT,
  `numero_local` varchar(50) DEFAULT NULL,
  `nome_local` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `sigla` varchar(50) DEFAULT NULL,
  `servico_id` int(10) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `painel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_historico`),
  KEY `FK_historico_servico` (`servico_id`),
  CONSTRAINT `FK_historico_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.historico: ~76 rows (aproximadamente)
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
INSERT INTO `historico` (`id_historico`, `numero_local`, `nome_local`, `status`, `sigla`, `servico_id`, `numero`, `created_at`, `updated_at`, `painel_id`) VALUES
	(1, '34', 'IPTU', 'chamado', 'INF', 1, 1, '2025-02-05 01:58:23', '2025-02-05 01:58:23', NULL),
	(2, '34', 'IPTU', 'chamado', 'INF', 1, 4, '2025-02-05 01:59:20', '2025-02-05 01:59:20', NULL),
	(3, '34', 'IPTU', 'chamado', 'INF', 1, 2, '2025-02-05 02:01:25', '2025-02-05 02:01:25', NULL),
	(4, '34', 'IPTU', 'chamado', 'INF', 1, 3, '2025-02-05 02:04:40', '2025-02-05 02:04:40', NULL),
	(5, '34', 'IPTU', 'chamado', 'INF', 1, 5, '2025-02-05 02:24:41', '2025-02-05 02:24:41', 2),
	(6, '34', 'IPTU', 'chamado', 'INF', 1, 6, '2025-02-05 02:26:19', '2025-02-05 02:26:19', 2),
	(7, '34', 'IPTU', 'chamado', 'INF', 1, 7, '2025-02-05 02:27:09', '2025-02-05 02:27:09', 2),
	(8, '34', 'IPTU', 'chamado', 'INF', 1, 8, '2025-02-05 02:27:40', '2025-02-05 02:27:40', 2),
	(9, '34', 'IPTU', 'chamado', 'INF', 1, 9, '2025-02-05 02:28:19', '2025-02-05 02:28:19', 2),
	(10, '34', 'IPTU', 'chamado', 'INF', 1, 10, '2025-02-05 02:29:49', '2025-02-05 02:29:49', 2),
	(11, '34', 'IPTU', 'chamado', 'INF', 1, 11, '2025-02-05 02:30:19', '2025-02-05 02:30:19', 2),
	(12, '34', 'IPTU', 'chamado', 'INF', 1, 12, '2025-02-05 02:30:59', '2025-02-05 02:30:59', 2),
	(13, '34', 'IPTU', 'chamado', 'INF', 1, 13, '2025-02-05 02:38:33', '2025-02-05 02:38:33', 2),
	(14, '34', 'IPTU', 'chamado', 'INF', 1, 14, '2025-02-05 02:38:43', '2025-02-05 02:38:43', 2),
	(15, '23', 'IPTU', 'chamado', 'TFD', 2, 1, '2025-02-06 03:49:38', '2025-02-06 03:49:38', 3),
	(16, '23', 'Guichê', 'chamado', 'INF', 1, 15, '2025-02-06 03:50:29', '2025-02-06 03:50:29', 3),
	(17, '23', 'Guichê', 'chamado', 'TFD', 2, 2, '2025-02-06 03:50:50', '2025-02-06 03:50:50', 3),
	(18, '23', 'Guichê', 'chamado', 'TFD', 2, 6, '2025-02-06 03:51:29', '2025-02-06 03:51:29', 3),
	(19, '23', 'Guichê', 'chamado', 'TFD', 2, 3, '2025-02-06 03:51:59', '2025-02-06 03:51:59', 3),
	(20, '23', 'Guichê', 'chamado', 'TFD', 2, 7, '2025-02-06 03:52:20', '2025-02-06 03:52:20', 3),
	(21, '23', 'Guichê', 'chamado', 'TFD', 2, 4, '2025-02-06 03:53:19', '2025-02-06 03:53:19', 3),
	(22, '23', 'Guichê', 'chamado', 'TFD', 2, 5, '2025-02-06 03:53:39', '2025-02-06 03:53:39', 3),
	(23, '3', 'Guichê', 'chamado', 'A', 2, 2, '2025-02-13 03:32:10', '2025-02-13 03:32:10', 3),
	(24, '3', 'Guichê', 'chamado', 'A', 2, 4, '2025-02-13 03:32:30', '2025-02-13 03:32:30', 3),
	(25, '3', 'Guichê', 'chamado', 'A', 2, 5, '2025-02-13 03:32:50', '2025-02-13 03:32:50', 3),
	(26, '3', 'Guichê', 'chamado', 'A', 2, 8, '2025-02-13 03:33:10', '2025-02-13 03:33:10', 3),
	(27, '3', 'Guichê', 'chamado', 'A', 2, 9, '2025-02-13 03:33:50', '2025-02-13 03:33:50', 3),
	(28, '3', 'Guichê', 'chamado', 'TFD', 2, 9, '2025-02-13 03:45:22', '2025-02-13 03:45:22', 3),
	(29, '3', 'Guichê', 'chamado', 'TFD', 2, 10, '2025-02-13 03:46:22', '2025-02-13 03:46:22', 3),
	(30, '3', 'Guichê', 'chamado', 'TFD', 2, 11, '2025-02-13 03:46:52', '2025-02-13 03:46:52', 3),
	(31, '3', 'Guichê', 'chamado', 'TFD', 2, 12, '2025-02-13 03:47:22', '2025-02-13 03:47:22', 3),
	(32, '3', 'Guichê', 'chamado', 'TFD', 2, 13, '2025-02-13 03:49:02', '2025-02-13 03:49:02', 3),
	(33, '3', 'Guichê', 'chamado', 'TFD', 2, 14, '2025-02-13 03:49:22', '2025-02-13 03:49:22', 3),
	(34, '2', 'Guichê', 'chamado', 'ET', 1, 20, '2025-02-14 02:32:57', '2025-02-14 02:32:57', 3),
	(35, '2', 'Guichê', 'chamado', 'ET', 1, 21, '2025-02-14 02:33:25', '2025-02-14 02:33:25', 3),
	(36, '2', 'Guichê', 'chamado', 'ET', 1, 22, '2025-02-14 02:33:55', '2025-02-14 02:33:55', 3),
	(37, '2', 'Guichê', 'chamado', 'ET', 1, 2, '2025-02-14 02:41:35', '2025-02-14 02:41:35', 3),
	(38, '2', 'Guichê', 'chamado', 'ET', 1, 3, '2025-02-14 02:41:45', '2025-02-14 02:41:45', 3),
	(39, '2', 'Guichê', 'chamado', 'ET', 1, 5, '2025-02-14 02:41:55', '2025-02-14 02:41:55', 3),
	(40, '2', 'Guichê', 'chamado', 'ET', 1, 23, '2025-02-14 02:42:15', '2025-02-14 02:42:15', 3),
	(41, '2', 'Guichê', 'chamado', 'ET', 1, 6, '2025-02-14 02:42:35', '2025-02-14 02:42:35', 3),
	(42, '2', 'Guichê', 'chamado', 'ET', 1, 7, '2025-02-14 02:43:15', '2025-02-14 02:43:15', 3),
	(43, '2', 'Guichê', 'chamado', 'ET', 1, 24, '2025-02-14 02:43:45', '2025-02-14 02:43:45', 3),
	(44, '2', 'Guichê', 'chamado', 'ET', 1, 8, '2025-02-14 02:44:05', '2025-02-14 02:44:05', 3),
	(45, '2', 'Guichê', 'chamado', 'ET', 1, 9, '2025-02-14 02:44:24', '2025-02-14 02:44:24', 3),
	(46, '1', 'mesa', 'chamado', 'ET', 1, 10, '2025-02-14 02:45:25', '2025-02-14 02:45:25', 3),
	(47, '1', 'mesa', 'chamado', 'PET', 1, 25, '2025-02-14 02:55:11', '2025-02-14 02:55:11', 3),
	(48, '1', 'mesa', 'chamado', 'PET', 1, 26, '2025-02-14 02:59:14', '2025-02-14 02:59:14', 3),
	(49, '1', 'mesa', 'chamado', 'PET', 1, 27, '2025-02-14 02:59:54', '2025-02-14 02:59:54', 3),
	(50, '1', 'mesa', 'chamado', 'PET', 1, 28, '2025-02-14 03:00:14', '2025-02-14 03:00:14', 3),
	(51, '1', 'mesa', 'chamado', 'PET', 1, 29, '2025-02-14 03:09:14', '2025-02-14 03:09:14', 3),
	(52, '1', 'mesa', 'chamado', 'PET', 1, 30, '2025-02-14 03:09:23', '2025-02-14 03:09:23', 3),
	(53, '1', 'mesa', 'chamado', 'PET', 1, 31, '2025-02-14 03:09:34', '2025-02-14 03:09:34', 3),
	(54, '1', 'mesa', 'chamado', 'PET', 1, 32, '2025-02-14 03:10:38', '2025-02-14 03:10:38', 3),
	(55, '1', 'mesa', 'chamado', 'ET', 1, 11, '2025-02-14 03:22:38', '2025-02-14 03:22:38', 3),
	(56, '1', 'mesa', 'chamado', 'ET', 1, 13, '2025-02-14 03:24:31', '2025-02-14 03:24:31', 3),
	(57, '1', 'mesa', 'chamado', 'ET', 1, 14, '2025-02-14 03:24:54', '2025-02-14 03:24:54', 3),
	(58, '1', 'mesa', 'chamado', 'PET', 1, 34, '2025-02-14 03:25:04', '2025-02-14 03:25:04', 3),
	(59, '1', 'mesa', 'chamado', 'PET', 1, 35, '2025-02-14 03:25:24', '2025-02-14 03:25:24', 3),
	(60, '1', 'mesa', 'chamado', 'ET', 1, 16, '2025-02-14 03:25:44', '2025-02-14 03:25:44', 3),
	(61, '1', 'mesa', 'chamado', 'ET', 1, 17, '2025-02-14 03:27:59', '2025-02-14 03:27:59', 3),
	(62, '1', 'mesa', 'chamado', 'ET', 1, 18, '2025-02-14 03:28:04', '2025-02-14 03:28:04', 3),
	(63, '1', 'mesa', 'chamado', 'ET', 1, 19, '2025-02-14 03:28:24', '2025-02-14 03:28:24', 3),
	(64, '1', 'mesa', 'chamado', 'ET', 1, 33, '2025-02-14 03:36:38', '2025-02-14 03:36:38', 3),
	(65, '1', 'mesa', 'chamado', 'ET', 1, 36, '2025-02-14 03:37:34', '2025-02-14 03:37:34', 3),
	(66, '1', 'mesa', 'chamado', 'ET', 1, 37, '2025-02-14 03:39:38', '2025-02-14 03:39:38', 3),
	(67, '1', 'mesa', 'chamado', 'ET', 1, 38, '2025-02-14 03:40:28', '2025-02-14 03:40:28', 3),
	(68, '1', 'mesa', 'chamado', 'ET', 1, 39, '2025-02-14 03:40:44', '2025-02-14 03:40:44', 3),
	(69, '1', 'mesa', 'chamado', 'ET', 1, 40, '2025-02-14 03:41:14', '2025-02-14 03:41:14', 3),
	(70, '1', 'mesa', 'chamado', 'PET', 1, 41, '2025-02-14 03:43:08', '2025-02-14 03:43:08', 3),
	(71, '1', 'mesa', 'chamado', 'PET', 1, 42, '2025-02-14 03:43:24', '2025-02-14 03:43:24', 3),
	(72, '1', 'mesa', 'chamado', 'ET', 1, 44, '2025-02-14 03:44:04', '2025-02-14 03:44:04', 3),
	(73, '1', 'mesa', 'chamado', 'PET', 1, 43, '2025-02-14 03:44:54', '2025-02-14 03:44:54', 3),
	(74, '1', 'mesa', 'chamado', 'PET', 1, 45, '2025-02-14 03:45:34', '2025-02-14 03:45:34', 3),
	(75, '1', 'mesa', 'chamado', 'PET', 1, 46, '2025-02-14 03:49:30', '2025-02-14 03:49:30', 3),
	(76, '1', 'mesa', 'chamado', 'PET', 1, 47, '2025-02-14 03:49:34', '2025-02-14 03:49:34', 3);
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.job_batches: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.local
CREATE TABLE IF NOT EXISTS `local` (
  `id_local` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_local`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.local: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `local` DISABLE KEYS */;
INSERT INTO `local` (`id_local`, `nome`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'Guichê', 'ativo', '2025-02-04 03:50:40', '2025-02-06 03:50:05'),
	(4, 'mesa', 'ativo', '2025-02-14 02:45:03', '2025-02-14 02:45:03');
/*!40000 ALTER TABLE `local` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.migrations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.ordenacao
CREATE TABLE IF NOT EXISTS `ordenacao` (
  `id_ordenacao` int(10) NOT NULL AUTO_INCREMENT,
  `servico_id` int(10) DEFAULT NULL,
  `departamento_id` int(10) DEFAULT NULL,
  `prio_total` int(10) DEFAULT 5,
  `prio_cont` int(10) DEFAULT NULL,
  `nor_total` int(10) DEFAULT 5,
  `nor_cont` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ordenacao`),
  KEY `FK_ordenacao_servico` (`servico_id`),
  KEY `FK_ordenacao_departamento` (`departamento_id`),
  CONSTRAINT `FK_ordenacao_departamento` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ordenacao_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.ordenacao: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `ordenacao` DISABLE KEYS */;
INSERT INTO `ordenacao` (`id_ordenacao`, `servico_id`, `departamento_id`, `prio_total`, `prio_cont`, `nor_total`, `nor_cont`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 2, 1, 2, 1, '2025-02-05 01:43:12', '2025-02-17 01:17:45'),
	(2, 2, NULL, 3, 0, 1, 1, '2025-02-06 03:44:09', '2025-02-14 02:24:07'),
	(3, 5, NULL, 5, NULL, 5, NULL, '2025-02-12 03:41:51', '2025-02-12 03:41:51'),
	(4, 4, NULL, 5, NULL, 5, NULL, '2025-02-12 03:41:59', '2025-02-12 03:41:59'),
	(5, 3, NULL, 5, NULL, 5, NULL, '2025-02-12 03:42:14', '2025-02-12 03:42:14');
/*!40000 ALTER TABLE `ordenacao` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.painel
CREATE TABLE IF NOT EXISTS `painel` (
  `id_painel` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `obs` varchar(250) DEFAULT NULL,
  `key` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_painel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.painel: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `painel` DISABLE KEYS */;
INSERT INTO `painel` (`id_painel`, `nome`, `obs`, `key`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'painel teste', 'asdfasf', NULL, 'inativo', '2025-02-05 01:44:36', '2025-02-06 02:15:51'),
	(3, 'COMPRAS', 'sfsdf', NULL, 'ativo', '2025-02-06 02:16:11', '2025-02-06 02:16:11');
/*!40000 ALTER TABLE `painel` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.painel_senha
CREATE TABLE IF NOT EXISTS `painel_senha` (
  `id_painel` int(10) NOT NULL AUTO_INCREMENT,
  `numero_local` varchar(50) NOT NULL DEFAULT '',
  `nome_local` varchar(50) NOT NULL DEFAULT '',
  `status` varchar(50) NOT NULL DEFAULT 'ativo',
  `sigla` varchar(50) NOT NULL DEFAULT '',
  `numero` varchar(50) NOT NULL DEFAULT '',
  `servico_id` int(10) NOT NULL DEFAULT 0,
  `peso` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_painel`) USING BTREE,
  KEY `FK_painel_senha_servico` (`servico_id`),
  CONSTRAINT `FK_painel_senha_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.painel_senha: ~42 rows (aproximadamente)
/*!40000 ALTER TABLE `painel_senha` DISABLE KEYS */;
INSERT INTO `painel_senha` (`id_painel`, `numero_local`, `nome_local`, `status`, `sigla`, `numero`, `servico_id`, `peso`, `created_at`, `updated_at`) VALUES
	(4, '3', 'Guichê', 'chamado', 'A', '8', 2, 1, '2025-02-13 03:33:03', '2025-02-13 03:33:10'),
	(5, '3', 'Guichê', 'chamado', 'A', '9', 2, 1, '2025-02-13 03:33:44', '2025-02-13 03:33:50'),
	(12, '3', 'Guichê', 'chamado', 'TFD', '14', 2, 0, '2025-02-13 03:49:22', '2025-02-13 03:49:22'),
	(28, '2', 'Guichê', 'chamado', 'ET', '2', 1, 0, '2025-02-14 02:41:27', '2025-02-14 02:41:35'),
	(29, '2', 'Guichê', 'chamado', 'ET', '3', 1, 0, '2025-02-14 02:41:30', '2025-02-14 02:41:45'),
	(30, '2', 'Guichê', 'chamado', 'ET', '5', 1, 0, '2025-02-14 02:41:37', '2025-02-14 02:41:55'),
	(31, '2', 'Guichê', 'chamado', 'ET', '23', 1, 1, '2025-02-14 02:42:07', '2025-02-14 02:42:15'),
	(32, '2', 'Guichê', 'chamado', 'ET', '6', 1, 0, '2025-02-14 02:42:33', '2025-02-14 02:42:35'),
	(33, '2', 'Guichê', 'chamado', 'ET', '7', 1, 0, '2025-02-14 02:42:59', '2025-02-14 02:43:15'),
	(34, '2', 'Guichê', 'chamado', 'ET', '24', 1, 1, '2025-02-14 02:43:44', '2025-02-14 02:43:45'),
	(35, '2', 'Guichê', 'chamado', 'ET', '8', 1, 0, '2025-02-14 02:44:02', '2025-02-14 02:44:05'),
	(36, '2', 'Guichê', 'chamado', 'ET', '9', 1, 0, '2025-02-14 02:44:16', '2025-02-14 02:44:24'),
	(37, '1', 'mesa', 'chamado', 'ET', '10', 1, 0, '2025-02-14 02:45:22', '2025-02-14 02:45:25'),
	(38, '1', 'mesa', 'chamado', 'PET', '25', 1, 1, '2025-02-14 02:55:06', '2025-02-14 02:55:11'),
	(42, '1', 'mesa', 'chamado', 'PET', '29', 1, 1, '2025-02-14 03:09:10', '2025-02-14 03:09:14'),
	(43, '1', 'mesa', 'chamado', 'PET', '30', 1, 1, '2025-02-14 03:09:14', '2025-02-14 03:09:23'),
	(44, '1', 'mesa', 'chamado', 'PET', '31', 1, 1, '2025-02-14 03:09:28', '2025-02-14 03:09:34'),
	(45, '1', 'mesa', 'chamado', 'PET', '32', 1, 1, '2025-02-14 03:10:25', '2025-02-14 03:10:38'),
	(47, '1', 'mesa', 'chamado', 'ET', '13', 1, 0, '2025-02-14 03:24:25', '2025-02-14 03:24:31'),
	(48, '1', 'mesa', 'chamado', 'ET', '14', 1, 0, '2025-02-14 03:24:52', '2025-02-14 03:24:54'),
	(49, '1', 'mesa', 'chamado', 'PET', '34', 1, 1, '2025-02-14 03:25:02', '2025-02-14 03:25:04'),
	(50, '1', 'mesa', 'chamado', 'PET', '35', 1, 1, '2025-02-14 03:25:21', '2025-02-14 03:25:24'),
	(51, '1', 'mesa', 'chamado', 'ET', '16', 1, 0, '2025-02-14 03:25:36', '2025-02-14 03:25:44'),
	(52, '1', 'mesa', 'chamado', 'ET', '17', 1, 0, '2025-02-14 03:27:42', '2025-02-14 03:27:59'),
	(53, '1', 'mesa', 'chamado', 'ET', '18', 1, 0, '2025-02-14 03:28:03', '2025-02-14 03:28:04'),
	(54, '1', 'mesa', 'chamado', 'ET', '19', 1, 0, '2025-02-14 03:28:20', '2025-02-14 03:28:24'),
	(55, '1', 'mesa', 'chamado', 'ET', '33', 1, 0, '2025-02-14 03:36:10', '2025-02-14 03:36:38'),
	(56, '1', 'mesa', 'chamado', 'ET', '36', 1, 0, '2025-02-14 03:37:26', '2025-02-14 03:37:34'),
	(57, '1', 'mesa', 'chamado', 'ET', '37', 1, 0, '2025-02-14 03:39:31', '2025-02-14 03:39:38'),
	(58, '1', 'mesa', 'chamado', 'ET', '38', 1, 0, '2025-02-14 03:40:11', '2025-02-14 03:40:28'),
	(59, '1', 'mesa', 'chamado', 'ET', '39', 1, 0, '2025-02-14 03:40:43', '2025-02-14 03:40:44'),
	(60, '1', 'mesa', 'chamado', 'ET', '40', 1, 0, '2025-02-14 03:41:06', '2025-02-14 03:41:14'),
	(61, '1', 'mesa', 'chamado', 'PET', '41', 1, 1, '2025-02-14 03:42:57', '2025-02-14 03:43:08'),
	(62, '1', 'mesa', 'chamado', 'PET', '42', 1, 1, '2025-02-14 03:43:14', '2025-02-14 03:43:24'),
	(63, '1', 'mesa', 'chamado', 'ET', '44', 1, 0, '2025-02-14 03:44:03', '2025-02-14 03:44:04'),
	(64, '1', 'mesa', 'chamado', 'PET', '43', 1, 1, '2025-02-14 03:44:48', '2025-02-14 03:44:54'),
	(65, '1', 'mesa', 'chamado', 'PET', '45', 1, 1, '2025-02-14 03:45:29', '2025-02-14 03:45:34'),
	(66, '1', 'mesa', 'chamado', 'PET', '46', 1, 1, '2025-02-14 03:49:12', '2025-02-14 03:49:30'),
	(67, '1', 'mesa', 'chamado', 'PET', '47', 1, 1, '2025-02-14 03:49:33', '2025-02-14 03:49:34'),
	(68, '1', 'mesa', 'chamar', 'PET', '49', 1, 1, '2025-02-15 01:48:23', '2025-02-15 01:48:23'),
	(69, '1', 'mesa', 'chamar', 'ET', '48', 1, 0, '2025-02-15 01:48:28', '2025-02-15 01:48:28'),
	(70, '1', 'mesa', 'chamar', 'PET', '50', 1, 1, '2025-02-17 00:25:30', '2025-02-17 00:25:30'),
	(71, '1', 'mesa', 'chamar', 'PET', '51', 1, 1, '2025-02-17 00:34:01', '2025-02-17 00:34:01'),
	(72, '1', 'mesa', 'chamar', 'ET', '52', 1, 0, '2025-02-17 00:34:08', '2025-02-17 00:34:08'),
	(73, '1', 'mesa', 'chamar', 'ET', '53', 1, 0, '2025-02-17 00:35:42', '2025-02-17 00:35:42'),
	(75, '1', 'mesa', 'chamar', 'ET', '55', 1, 0, '2025-02-17 00:37:26', '2025-02-17 00:37:26'),
	(77, '1', 'mesa', 'chamar', 'ET', '57', 1, 0, '2025-02-17 00:38:04', '2025-02-17 00:38:04'),
	(79, '1', 'mesa', 'chamar', 'ET', '59', 1, 0, '2025-02-17 00:39:28', '2025-02-17 00:39:28'),
	(80, '1', 'mesa', 'chamar', 'ET', '60', 1, 0, '2025-02-17 00:40:28', '2025-02-17 00:40:28'),
	(81, '1', 'mesa', 'chamar', 'ET', '61', 1, 0, '2025-02-17 00:46:09', '2025-02-17 00:46:09'),
	(82, '1', 'mesa', 'chamar', 'ET', '62', 1, 0, '2025-02-17 01:10:55', '2025-02-17 01:10:55');
/*!40000 ALTER TABLE `painel_senha` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.painel_servicos
CREATE TABLE IF NOT EXISTS `painel_servicos` (
  `id_painel_servicos` int(10) NOT NULL AUTO_INCREMENT,
  `servico_id` int(10) DEFAULT NULL,
  `painel_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_painel_servicos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.painel_servicos: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `painel_servicos` DISABLE KEYS */;
INSERT INTO `painel_servicos` (`id_painel_servicos`, `servico_id`, `painel_id`, `created_at`, `updated_at`) VALUES
	(7, 1, 3, '2025-02-14 02:27:42', '2025-02-14 02:27:42');
/*!40000 ALTER TABLE `painel_servicos` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.password_reset_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.pessoa
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_pessoa` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.pessoa: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` (`id_pessoa`, `nome`, `email`, `cpf`, `created_at`, `updated_at`) VALUES
	(1, 'wesley ', 'suporte@cerradoclound.com.br', '09117166616', NULL, NULL),
	(2, 'afsdfasd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(3, 'wesley  dsfsd', 'sdfsdf', 'sdfsdf', NULL, NULL),
	(4, 'wesley  dsfsd', 'sdfsdf', 'sdfsdf', NULL, NULL),
	(5, 'wesley  dsfsd', 'sdfsdf', 'sdfsdf', NULL, NULL),
	(6, 'wesley  dsfsd', 'sdfsdf', 'sdfsdf', NULL, NULL),
	(7, 'wesley  dsfsd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(8, 'afsdfasd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(9, 'afsdfasd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(10, 'wesley  dsfsd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(11, 'wesley  dsfsd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(12, 'wesley  dsfsd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(13, '', '', '', NULL, NULL),
	(14, 'afsdfasd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(15, 'minha rola', 'bucetinhaasdasdasd', 'asdfas', NULL, NULL),
	(16, 'wesley  dsfsd', 'suporte@cerradoclound.com.br', '54545', NULL, NULL),
	(17, 'wesley da silva pereira', 'wpsistemas2@gmail.com', '023498203840', '2025-02-05 01:46:55', '2025-02-05 01:46:55');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.prioridade
CREATE TABLE IF NOT EXISTS `prioridade` (
  `id_prioridade` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `ativo` varchar(50) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_prioridade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.prioridade: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `prioridade` DISABLE KEYS */;
/*!40000 ALTER TABLE `prioridade` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.servico
CREATE TABLE IF NOT EXISTS `servico` (
  `id_servico` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `sigla` varchar(50) DEFAULT NULL,
  `departamento_id` int(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.servico: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` (`id_servico`, `nome`, `sigla`, `departamento_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'ENTREGA  CONTRA CHEQUE', 'ET', NULL, 'ativo', '2025-02-12 02:39:59', '2025-02-12 02:39:59'),
	(2, 'COMPRAS', 'A', NULL, 'ativo', '2025-02-12 02:54:31', '2025-02-12 02:54:31'),
	(3, 'CONTRA CHEQUES 2', 'ETA', NULL, 'ativo', '2025-02-12 03:40:04', '2025-02-12 03:40:04'),
	(4, 'lucas car', 'ET009', NULL, 'ativo', '2025-02-12 03:40:21', '2025-02-12 03:40:21'),
	(5, 'IPTU', '34', NULL, 'ativo', '2025-02-12 03:40:34', '2025-02-12 03:40:34');
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.servico_prioridade
CREATE TABLE IF NOT EXISTS `servico_prioridade` (
  `id_servico_prioridade` int(10) NOT NULL AUTO_INCREMENT,
  `servico_id` int(10) DEFAULT NULL,
  `prioridade_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_servico_prioridade`),
  KEY `FK_servico_prioridade_servico` (`servico_id`),
  KEY `FK_servico_prioridade_prioridade` (`prioridade_id`),
  CONSTRAINT `FK_servico_prioridade_prioridade` FOREIGN KEY (`prioridade_id`) REFERENCES `prioridade` (`id_prioridade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_servico_prioridade_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.servico_prioridade: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `servico_prioridade` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico_prioridade` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.sessions: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('5XYiLS2wjLdt8wJLr7anBo9qSUYAM7iBRwzIWbaR', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiVkhBaDJmMDZMTzcwUUQ0eVNRQmVoRTd1Y1lIaTVUc3ZUYmI3NHZ0UiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vZWZpbGEudGVzdC9zZW5oYS5lbWl0aXIvMS8wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjU6InNlbmhhIjtzOjQ6IkVUNjIiO3M6NDoidHlwZSI7czo4OiJjaGFtYW5kbyI7fQ==', 1739757059);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.touch
CREATE TABLE IF NOT EXISTS `touch` (
  `id_touch` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_touch`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.touch: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `touch` DISABLE KEYS */;
INSERT INTO `touch` (`id_touch`, `nome`, `obs`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'PROTOCOLO', 'PROTOCOLO', 'inativo', '2025-02-12 01:04:25', '2025-02-12 03:47:11'),
	(2, 'COMPRAS', 'paine do compras', 'ativo', '2025-02-13 01:35:39', '2025-02-13 01:35:39');
/*!40000 ALTER TABLE `touch` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.touch_servicos
CREATE TABLE IF NOT EXISTS `touch_servicos` (
  `id_touch_servico` int(10) NOT NULL AUTO_INCREMENT,
  `touch_id` int(10) DEFAULT NULL,
  `servico_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ativo',
  PRIMARY KEY (`id_touch_servico`),
  KEY `FK_touch_servicos_touch` (`touch_id`),
  KEY `FK_touch_servicos_servico` (`servico_id`),
  CONSTRAINT `FK_touch_servicos_servico` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_touch_servicos_touch` FOREIGN KEY (`touch_id`) REFERENCES `touch` (`id_touch`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.touch_servicos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `touch_servicos` DISABLE KEYS */;
INSERT INTO `touch_servicos` (`id_touch_servico`, `touch_id`, `servico_id`, `created_at`, `updated_at`, `status`) VALUES
	(11, 1, 1, '2025-02-12 02:41:49', '2025-02-12 02:41:49', 'ativo'),
	(12, 1, 2, '2025-02-12 02:54:42', '2025-02-12 02:54:42', 'ativo'),
	(13, 1, 3, '2025-02-12 03:41:02', '2025-02-12 03:41:02', 'ativo'),
	(14, 1, 4, '2025-02-12 03:41:02', '2025-02-12 03:41:02', 'ativo'),
	(15, 1, 5, '2025-02-12 03:41:02', '2025-02-12 03:41:02', 'ativo'),
	(17, 2, 1, '2025-02-13 02:05:51', '2025-02-13 02:05:51', 'ativo');
/*!40000 ALTER TABLE `touch_servicos` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `pessoa_id` int(10) DEFAULT NULL,
  `perfil_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `FK_user_pessoa` (`pessoa_id`),
  CONSTRAINT `FK_user_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Copiando estrutura para tabela efila.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pessoa_id` int(10) DEFAULT NULL,
  `perfil_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK_users_pessoa` (`pessoa_id`),
  CONSTRAINT `FK_users_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `pessoa_id`, `perfil_id`) VALUES
	(2, 'wesley', 'suporte@cerradoclound.com.br', NULL, '$2y$12$Jmi6ffI/Spi4BlNvk2tV2OjJd9euz4vEdOgcRayDE0uc.tjYr7sua', NULL, '2025-02-04 03:47:13', '2025-02-04 03:47:13', NULL, NULL),
	(3, 'wesley da silva pereira', 'wpsistemas2@gmail.com', NULL, '$2y$12$wuTqZqaD53KO1X3fjVSWseKkKRTIy4pSo0OOnD3hb0mejoRu9/8CO', NULL, '2025-02-05 01:46:56', '2025-02-05 01:46:56', 17, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
