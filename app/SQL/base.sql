-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.7-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.atendente: ~4 rows (aproximadamente)
INSERT INTO `atendente` (`id_atendente`, `pessoa_id`, `status`, `created_at`, `updated_at`) VALUES
	(11, 15, 'ativo', NULL, '2025-02-07 04:31:45'),
	(12, 1, 'ativo', NULL, '2025-02-07 04:31:53'),
	(13, 17, 'ativo', '2025-02-05 04:46:55', '2025-02-05 04:46:55'),
	(14, 18, 'ativo', '2025-02-27 05:23:26', '2025-02-27 05:23:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.atendente_local: ~4 rows (aproximadamente)
INSERT INTO `atendente_local` (`id_atendente_local`, `atendente_id`, `local_id`, `numero`, `created_at`, `updated_at`) VALUES
	(1, 11, 3, NULL, '2025-02-05 04:42:49', '2025-02-12 04:30:18'),
	(2, 13, 4, '1', '2025-02-05 04:48:04', '2025-02-14 05:45:17'),
	(3, 12, 3, '4', '2025-02-06 05:23:57', '2025-02-18 05:32:35'),
	(4, 14, 4, '2', '2025-02-27 05:25:31', '2025-02-27 05:41:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.atendente_servico: ~12 rows (aproximadamente)
INSERT INTO `atendente_servico` (`id_atendente_servico`, `servico_id`, `atendente_id`, `departamento_id`, `created_at`, `updated_at`) VALUES
	(10, 1, 13, NULL, '2025-02-14 05:27:16', '2025-02-14 05:27:16'),
	(11, 1, 12, NULL, '2025-02-18 05:26:27', '2025-02-18 05:26:27'),
	(17, 1, 11, NULL, '2025-02-25 05:48:23', '2025-02-25 05:48:23'),
	(18, 2, 11, NULL, '2025-02-25 05:48:23', '2025-02-25 05:48:23'),
	(19, 3, 11, NULL, '2025-02-25 05:48:23', '2025-02-25 05:48:23'),
	(20, 4, 11, NULL, '2025-02-25 05:48:23', '2025-02-25 05:48:23'),
	(21, 5, 11, NULL, '2025-02-25 05:48:23', '2025-02-25 05:48:23'),
	(22, 1, 14, NULL, '2025-02-27 05:26:30', '2025-02-27 05:26:30'),
	(23, 2, 14, NULL, '2025-02-27 05:39:29', '2025-02-27 05:39:29'),
	(24, 3, 14, NULL, '2025-02-27 05:39:29', '2025-02-27 05:39:29'),
	(25, 4, 14, NULL, '2025-02-27 05:39:29', '2025-02-27 05:39:29'),
	(26, 5, 14, NULL, '2025-02-27 05:39:29', '2025-02-27 05:39:29');

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
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.atendimento: ~86 rows (aproximadamente)
INSERT INTO `atendimento` (`id_atendimento`, `atendimento_id`, `numero_local`, `nome_local`, `status`, `sigla`, `servico_id`, `numero`, `painel_id`, `created_at`, `updated_at`) VALUES
	(1, NULL, 34, 'IPTU', 'finalizado', 'INF', 1, 4, 2, '2025-02-05 05:01:03', '2025-02-27 05:42:00'),
	(6, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 2, NULL, '2025-02-05 05:23:11', '2025-02-05 05:23:11'),
	(7, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 3, NULL, '2025-02-05 05:23:19', '2025-02-05 05:23:19'),
	(8, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 5, NULL, '2025-02-05 05:26:04', '2025-02-05 05:26:04'),
	(9, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 6, NULL, '2025-02-05 05:26:38', '2025-02-05 05:26:38'),
	(10, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 7, NULL, '2025-02-05 05:27:21', '2025-02-05 05:27:21'),
	(11, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 8, NULL, '2025-02-05 05:27:44', '2025-02-05 05:27:44'),
	(12, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 9, NULL, '2025-02-05 05:29:38', '2025-02-05 05:29:38'),
	(13, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 10, NULL, '2025-02-05 05:30:13', '2025-02-05 05:30:13'),
	(14, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 11, NULL, '2025-02-05 05:30:30', '2025-02-05 05:30:30'),
	(15, NULL, 34, 'IPTU', 'atendendo', 'INF', 1, 12, NULL, '2025-02-05 05:31:06', '2025-02-05 05:31:06'),
	(16, NULL, 23, 'IPTU', 'atendendo', 'TFD', 2, 1, NULL, '2025-02-06 06:50:12', '2025-02-06 06:50:12'),
	(17, NULL, 23, 'Guichê', 'atendendo', 'INF', 1, 15, NULL, '2025-02-06 06:50:39', '2025-02-06 06:50:39'),
	(18, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 2, NULL, '2025-02-06 06:51:17', '2025-02-06 06:51:17'),
	(19, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 6, NULL, '2025-02-06 06:51:54', '2025-02-06 06:51:54'),
	(20, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 3, NULL, '2025-02-06 06:52:12', '2025-02-06 06:52:12'),
	(21, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 7, NULL, '2025-02-06 06:52:53', '2025-02-06 06:52:53'),
	(22, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 4, NULL, '2025-02-06 06:53:22', '2025-02-06 06:53:22'),
	(23, NULL, 23, 'Guichê', 'atendendo', 'TFD', 2, 5, NULL, '2025-02-06 06:53:44', '2025-02-06 06:53:44'),
	(24, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 2, NULL, '2025-02-13 06:32:19', '2025-02-13 06:32:19'),
	(25, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 4, NULL, '2025-02-13 06:32:42', '2025-02-13 06:32:42'),
	(26, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 5, NULL, '2025-02-13 06:33:00', '2025-02-13 06:33:00'),
	(27, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 8, NULL, '2025-02-13 06:44:56', '2025-02-13 06:44:56'),
	(28, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 9, NULL, '2025-02-13 06:45:34', '2025-02-13 06:45:34'),
	(29, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 10, NULL, '2025-02-13 06:46:41', '2025-02-13 06:46:41'),
	(30, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 11, NULL, '2025-02-13 06:47:05', '2025-02-13 06:47:05'),
	(31, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 12, NULL, '2025-02-13 06:49:00', '2025-02-13 06:49:00'),
	(32, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 13, NULL, '2025-02-13 06:49:19', '2025-02-13 06:49:19'),
	(33, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 15, NULL, '2025-02-14 05:22:40', '2025-02-14 05:22:40'),
	(34, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 16, NULL, '2025-02-14 05:22:49', '2025-02-14 05:22:49'),
	(35, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 17, NULL, '2025-02-14 05:22:53', '2025-02-14 05:22:53'),
	(36, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 18, NULL, '2025-02-14 05:22:59', '2025-02-14 05:22:59'),
	(37, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 19, NULL, '2025-02-14 05:23:05', '2025-02-14 05:23:05'),
	(38, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 20, NULL, '2025-02-14 05:23:42', '2025-02-14 05:23:42'),
	(39, NULL, 3, 'Guichê', 'atendendo', 'TFD', 2, 21, NULL, '2025-02-14 05:23:46', '2025-02-14 05:23:46'),
	(40, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 1, NULL, '2025-02-14 05:23:50', '2025-02-14 05:23:50'),
	(41, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 3, NULL, '2025-02-14 05:23:55', '2025-02-14 05:23:55'),
	(42, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 6, NULL, '2025-02-14 05:24:00', '2025-02-14 05:24:00'),
	(43, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 7, NULL, '2025-02-14 05:24:05', '2025-02-14 05:24:05'),
	(44, NULL, 3, 'Guichê', 'atendendo', 'A', 2, 10, NULL, '2025-02-14 05:24:12', '2025-02-14 05:24:12'),
	(45, NULL, 2, 'Guichê', 'atendendo', 'ET', 1, 20, NULL, '2025-02-14 05:33:15', '2025-02-14 05:33:15'),
	(46, NULL, 2, 'Guichê', 'atendendo', 'ET', 1, 21, NULL, '2025-02-14 05:33:28', '2025-02-14 05:33:28'),
	(47, NULL, 2, 'Guichê', 'atendendo', 'ET', 1, 22, NULL, '2025-02-14 05:59:08', '2025-02-14 05:59:08'),
	(48, NULL, 1, 'mesa', 'atendendo', 'PET', 1, 26, NULL, '2025-02-14 05:59:44', '2025-02-14 05:59:44'),
	(49, NULL, 1, 'mesa', 'atendendo', 'PET', 1, 27, NULL, '2025-02-14 06:00:07', '2025-02-14 06:00:07'),
	(50, NULL, 1, 'mesa', 'atendendo', 'PET', 1, 28, NULL, '2025-02-14 06:09:06', '2025-02-14 06:09:06'),
	(51, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 11, NULL, '2025-02-14 06:23:42', '2025-02-14 06:23:42'),
	(52, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 54, NULL, '2025-02-17 03:37:10', '2025-02-17 03:37:10'),
	(53, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 56, NULL, '2025-02-17 03:37:57', '2025-02-17 03:37:57'),
	(54, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 58, NULL, '2025-02-17 03:39:15', '2025-02-17 03:39:15'),
	(55, NULL, 1, 'mesa', 'atendendo', 'ET', 1, 63, NULL, '2025-02-17 04:17:48', '2025-02-17 04:17:48'),
	(56, NULL, 1, 'mesa', 'atendendo', 'PET', 1, 66, NULL, '2025-02-18 04:09:56', '2025-02-18 04:09:56'),
	(57, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 89, NULL, '2025-02-19 04:42:01', '2025-02-19 04:42:01'),
	(58, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 90, NULL, '2025-02-19 04:42:39', '2025-02-19 04:42:39'),
	(59, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 100, NULL, '2025-02-19 05:04:54', '2025-02-19 05:04:54'),
	(60, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 103, NULL, '2025-02-19 05:09:43', '2025-02-19 05:09:43'),
	(61, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 105, NULL, '2025-02-19 05:10:36', '2025-02-19 05:10:36'),
	(62, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 102, NULL, '2025-02-19 05:10:55', '2025-02-19 05:10:55'),
	(63, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 104, NULL, '2025-02-19 05:11:23', '2025-02-19 05:11:23'),
	(64, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 109, NULL, '2025-02-19 05:14:22', '2025-02-19 05:14:22'),
	(65, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 106, NULL, '2025-02-19 05:19:48', '2025-02-19 05:19:48'),
	(66, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 107, NULL, '2025-02-19 05:20:02', '2025-02-19 05:20:02'),
	(67, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 108, NULL, '2025-02-19 05:20:18', '2025-02-19 05:20:18'),
	(68, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 110, NULL, '2025-02-19 05:20:30', '2025-02-19 05:20:30'),
	(69, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 111, NULL, '2025-02-19 05:20:47', '2025-02-19 05:20:47'),
	(70, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 112, NULL, '2025-02-19 05:21:05', '2025-02-19 05:21:05'),
	(71, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 113, NULL, '2025-02-19 05:23:13', '2025-02-19 05:23:13'),
	(72, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 114, NULL, '2025-02-19 05:24:33', '2025-02-19 05:24:33'),
	(73, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 115, NULL, '2025-02-19 05:24:47', '2025-02-19 05:24:47'),
	(74, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 118, NULL, '2025-02-19 05:25:03', '2025-02-19 05:25:03'),
	(75, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 116, NULL, '2025-02-19 05:25:13', '2025-02-19 05:25:13'),
	(76, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 117, NULL, '2025-02-19 05:25:24', '2025-02-19 05:25:24'),
	(77, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 119, NULL, '2025-02-19 05:25:55', '2025-02-19 05:25:55'),
	(78, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 121, NULL, '2025-02-19 06:09:44', '2025-02-19 06:09:44'),
	(79, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 124, NULL, '2025-02-19 06:10:19', '2025-02-19 06:10:19'),
	(80, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 125, NULL, '2025-02-21 04:43:54', '2025-02-21 04:43:54'),
	(81, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 123, NULL, '2025-02-21 04:53:55', '2025-02-21 04:53:55'),
	(82, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 127, NULL, '2025-02-24 05:06:43', '2025-02-24 05:06:43'),
	(83, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 128, NULL, '2025-02-24 05:34:09', '2025-02-24 05:34:09'),
	(84, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 139, NULL, '2025-02-24 06:30:49', '2025-02-24 06:30:49'),
	(85, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 140, NULL, '2025-02-24 06:31:16', '2025-02-24 06:31:16'),
	(86, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 142, NULL, '2025-02-24 06:32:05', '2025-02-24 06:32:05'),
	(87, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 141, NULL, '2025-02-24 06:36:51', '2025-02-24 06:36:51'),
	(88, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 143, NULL, '2025-02-24 06:38:46', '2025-02-24 06:38:46'),
	(89, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 144, NULL, '2025-02-24 06:40:13', '2025-02-24 06:40:13'),
	(90, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 146, NULL, '2025-02-25 04:01:07', '2025-02-25 04:01:07'),
	(91, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 147, NULL, '2025-02-25 04:04:07', '2025-02-25 04:04:07'),
	(92, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 148, NULL, '2025-02-25 04:05:32', '2025-02-25 04:05:32'),
	(93, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 149, NULL, '2025-02-25 04:07:13', '2025-02-25 04:07:13'),
	(94, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 150, NULL, '2025-02-25 04:11:09', '2025-02-25 04:11:09'),
	(95, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 151, NULL, '2025-02-25 04:12:24', '2025-02-25 04:12:24'),
	(96, NULL, 4, 'Guichê', 'atendendo', 'ET', 1, 152, NULL, '2025-02-25 04:12:58', '2025-02-25 04:12:58'),
	(97, NULL, 4, 'Guichê', 'atendendo', 'PET', 1, 153, NULL, '2025-02-25 04:59:01', '2025-02-25 04:59:01'),
	(98, NULL, 2, 'mesa', 'atendendo', 'A', 2, 11, NULL, '2025-02-27 05:41:21', '2025-02-27 05:41:21'),
	(99, NULL, 2, 'mesa', 'atendendo', 'PETA', 3, 4, NULL, '2025-02-27 05:41:59', '2025-02-27 05:41:59'),
	(100, NULL, 2, 'mesa', 'atendendo', 'P34', 5, 8, NULL, '2025-02-27 05:42:32', '2025-02-27 05:42:32'),
	(101, NULL, 2, 'mesa', 'atendendo', 'A', 2, 12, NULL, '2025-02-27 05:42:43', '2025-02-27 05:42:43'),
	(102, NULL, 2, 'mesa', 'atendendo', '34', 5, 6, NULL, '2025-02-27 05:42:55', '2025-02-27 05:42:55');

-- Copiando estrutura para tabela efila.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.cache: ~4 rows (aproximadamente)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('manolo@gmail.com|127.0.0.1', 'i:1;', 1738813651),
	('manolo@gmail.com|127.0.0.1:timer', 'i:1738813651;', 1738813651),
	('wpsitemas2@gmail.com|127.0.0.1', 'i:1;', 1739329281),
	('wpsitemas2@gmail.com|127.0.0.1:timer', 'i:1739329281;', 1739329281);

-- Copiando estrutura para tabela efila.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.cache_locks: ~0 rows (aproximadamente)

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
INSERT INTO `contador` (`id_contador`, `servico_id`, `numero`, `departamento_id`, `created_at`, `updated_at`) VALUES
	(15, 1, 154, NULL, '2025-02-12 05:39:59', '2025-02-27 05:38:54'),
	(19, 2, 12, NULL, '2025-02-12 05:54:31', '2025-02-27 05:41:39'),
	(20, 3, 4, NULL, '2025-02-12 06:40:04', '2025-02-27 05:41:33'),
	(21, 4, 3, NULL, '2025-02-12 06:40:21', '2025-02-27 05:39:50'),
	(22, 5, 8, NULL, '2025-02-12 06:40:34', '2025-02-27 05:42:19');

-- Copiando estrutura para tabela efila.departamento
CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.departamento: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.fila: ~3 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.historico: ~143 rows (aproximadamente)
INSERT INTO `historico` (`id_historico`, `numero_local`, `nome_local`, `status`, `sigla`, `servico_id`, `numero`, `created_at`, `updated_at`, `painel_id`) VALUES
	(1, '34', 'IPTU', 'chamado', 'INF', 1, 1, '2025-02-05 04:58:23', '2025-02-05 04:58:23', NULL),
	(2, '34', 'IPTU', 'chamado', 'INF', 1, 4, '2025-02-05 04:59:20', '2025-02-05 04:59:20', NULL),
	(3, '34', 'IPTU', 'chamado', 'INF', 1, 2, '2025-02-05 05:01:25', '2025-02-05 05:01:25', NULL),
	(4, '34', 'IPTU', 'chamado', 'INF', 1, 3, '2025-02-05 05:04:40', '2025-02-05 05:04:40', NULL),
	(5, '34', 'IPTU', 'chamado', 'INF', 1, 5, '2025-02-05 05:24:41', '2025-02-05 05:24:41', 2),
	(6, '34', 'IPTU', 'chamado', 'INF', 1, 6, '2025-02-05 05:26:19', '2025-02-05 05:26:19', 2),
	(7, '34', 'IPTU', 'chamado', 'INF', 1, 7, '2025-02-05 05:27:09', '2025-02-05 05:27:09', 2),
	(8, '34', 'IPTU', 'chamado', 'INF', 1, 8, '2025-02-05 05:27:40', '2025-02-05 05:27:40', 2),
	(9, '34', 'IPTU', 'chamado', 'INF', 1, 9, '2025-02-05 05:28:19', '2025-02-05 05:28:19', 2),
	(10, '34', 'IPTU', 'chamado', 'INF', 1, 10, '2025-02-05 05:29:49', '2025-02-05 05:29:49', 2),
	(11, '34', 'IPTU', 'chamado', 'INF', 1, 11, '2025-02-05 05:30:19', '2025-02-05 05:30:19', 2),
	(12, '34', 'IPTU', 'chamado', 'INF', 1, 12, '2025-02-05 05:30:59', '2025-02-05 05:30:59', 2),
	(13, '34', 'IPTU', 'chamado', 'INF', 1, 13, '2025-02-05 05:38:33', '2025-02-05 05:38:33', 2),
	(14, '34', 'IPTU', 'chamado', 'INF', 1, 14, '2025-02-05 05:38:43', '2025-02-05 05:38:43', 2),
	(15, '23', 'IPTU', 'chamado', 'TFD', 2, 1, '2025-02-06 06:49:38', '2025-02-06 06:49:38', 3),
	(16, '23', 'Guichê', 'chamado', 'INF', 1, 15, '2025-02-06 06:50:29', '2025-02-06 06:50:29', 3),
	(17, '23', 'Guichê', 'chamado', 'TFD', 2, 2, '2025-02-06 06:50:50', '2025-02-06 06:50:50', 3),
	(18, '23', 'Guichê', 'chamado', 'TFD', 2, 6, '2025-02-06 06:51:29', '2025-02-06 06:51:29', 3),
	(19, '23', 'Guichê', 'chamado', 'TFD', 2, 3, '2025-02-06 06:51:59', '2025-02-06 06:51:59', 3),
	(20, '23', 'Guichê', 'chamado', 'TFD', 2, 7, '2025-02-06 06:52:20', '2025-02-06 06:52:20', 3),
	(21, '23', 'Guichê', 'chamado', 'TFD', 2, 4, '2025-02-06 06:53:19', '2025-02-06 06:53:19', 3),
	(22, '23', 'Guichê', 'chamado', 'TFD', 2, 5, '2025-02-06 06:53:39', '2025-02-06 06:53:39', 3),
	(23, '3', 'Guichê', 'chamado', 'A', 2, 2, '2025-02-13 06:32:10', '2025-02-13 06:32:10', 3),
	(24, '3', 'Guichê', 'chamado', 'A', 2, 4, '2025-02-13 06:32:30', '2025-02-13 06:32:30', 3),
	(25, '3', 'Guichê', 'chamado', 'A', 2, 5, '2025-02-13 06:32:50', '2025-02-13 06:32:50', 3),
	(26, '3', 'Guichê', 'chamado', 'A', 2, 8, '2025-02-13 06:33:10', '2025-02-13 06:33:10', 3),
	(27, '3', 'Guichê', 'chamado', 'A', 2, 9, '2025-02-13 06:33:50', '2025-02-13 06:33:50', 3),
	(28, '3', 'Guichê', 'chamado', 'TFD', 2, 9, '2025-02-13 06:45:22', '2025-02-13 06:45:22', 3),
	(29, '3', 'Guichê', 'chamado', 'TFD', 2, 10, '2025-02-13 06:46:22', '2025-02-13 06:46:22', 3),
	(30, '3', 'Guichê', 'chamado', 'TFD', 2, 11, '2025-02-13 06:46:52', '2025-02-13 06:46:52', 3),
	(31, '3', 'Guichê', 'chamado', 'TFD', 2, 12, '2025-02-13 06:47:22', '2025-02-13 06:47:22', 3),
	(32, '3', 'Guichê', 'chamado', 'TFD', 2, 13, '2025-02-13 06:49:02', '2025-02-13 06:49:02', 3),
	(33, '3', 'Guichê', 'chamado', 'TFD', 2, 14, '2025-02-13 06:49:22', '2025-02-13 06:49:22', 3),
	(34, '2', 'Guichê', 'chamado', 'ET', 1, 20, '2025-02-14 05:32:57', '2025-02-14 05:32:57', 3),
	(35, '2', 'Guichê', 'chamado', 'ET', 1, 21, '2025-02-14 05:33:25', '2025-02-14 05:33:25', 3),
	(36, '2', 'Guichê', 'chamado', 'ET', 1, 22, '2025-02-14 05:33:55', '2025-02-14 05:33:55', 3),
	(37, '2', 'Guichê', 'chamado', 'ET', 1, 2, '2025-02-14 05:41:35', '2025-02-14 05:41:35', 3),
	(38, '2', 'Guichê', 'chamado', 'ET', 1, 3, '2025-02-14 05:41:45', '2025-02-14 05:41:45', 3),
	(39, '2', 'Guichê', 'chamado', 'ET', 1, 5, '2025-02-14 05:41:55', '2025-02-14 05:41:55', 3),
	(40, '2', 'Guichê', 'chamado', 'ET', 1, 23, '2025-02-14 05:42:15', '2025-02-14 05:42:15', 3),
	(41, '2', 'Guichê', 'chamado', 'ET', 1, 6, '2025-02-14 05:42:35', '2025-02-14 05:42:35', 3),
	(42, '2', 'Guichê', 'chamado', 'ET', 1, 7, '2025-02-14 05:43:15', '2025-02-14 05:43:15', 3),
	(43, '2', 'Guichê', 'chamado', 'ET', 1, 24, '2025-02-14 05:43:45', '2025-02-14 05:43:45', 3),
	(44, '2', 'Guichê', 'chamado', 'ET', 1, 8, '2025-02-14 05:44:05', '2025-02-14 05:44:05', 3),
	(45, '2', 'Guichê', 'chamado', 'ET', 1, 9, '2025-02-14 05:44:24', '2025-02-14 05:44:24', 3),
	(46, '1', 'mesa', 'chamado', 'ET', 1, 10, '2025-02-14 05:45:25', '2025-02-14 05:45:25', 3),
	(47, '1', 'mesa', 'chamado', 'PET', 1, 25, '2025-02-14 05:55:11', '2025-02-14 05:55:11', 3),
	(48, '1', 'mesa', 'chamado', 'PET', 1, 26, '2025-02-14 05:59:14', '2025-02-14 05:59:14', 3),
	(49, '1', 'mesa', 'chamado', 'PET', 1, 27, '2025-02-14 05:59:54', '2025-02-14 05:59:54', 3),
	(50, '1', 'mesa', 'chamado', 'PET', 1, 28, '2025-02-14 06:00:14', '2025-02-14 06:00:14', 3),
	(51, '1', 'mesa', 'chamado', 'PET', 1, 29, '2025-02-14 06:09:14', '2025-02-14 06:09:14', 3),
	(52, '1', 'mesa', 'chamado', 'PET', 1, 30, '2025-02-14 06:09:23', '2025-02-14 06:09:23', 3),
	(53, '1', 'mesa', 'chamado', 'PET', 1, 31, '2025-02-14 06:09:34', '2025-02-14 06:09:34', 3),
	(54, '1', 'mesa', 'chamado', 'PET', 1, 32, '2025-02-14 06:10:38', '2025-02-14 06:10:38', 3),
	(55, '1', 'mesa', 'chamado', 'ET', 1, 11, '2025-02-14 06:22:38', '2025-02-14 06:22:38', 3),
	(56, '1', 'mesa', 'chamado', 'ET', 1, 13, '2025-02-14 06:24:31', '2025-02-14 06:24:31', 3),
	(57, '1', 'mesa', 'chamado', 'ET', 1, 14, '2025-02-14 06:24:54', '2025-02-14 06:24:54', 3),
	(58, '1', 'mesa', 'chamado', 'PET', 1, 34, '2025-02-14 06:25:04', '2025-02-14 06:25:04', 3),
	(59, '1', 'mesa', 'chamado', 'PET', 1, 35, '2025-02-14 06:25:24', '2025-02-14 06:25:24', 3),
	(60, '1', 'mesa', 'chamado', 'ET', 1, 16, '2025-02-14 06:25:44', '2025-02-14 06:25:44', 3),
	(61, '1', 'mesa', 'chamado', 'ET', 1, 17, '2025-02-14 06:27:59', '2025-02-14 06:27:59', 3),
	(62, '1', 'mesa', 'chamado', 'ET', 1, 18, '2025-02-14 06:28:04', '2025-02-14 06:28:04', 3),
	(63, '1', 'mesa', 'chamado', 'ET', 1, 19, '2025-02-14 06:28:24', '2025-02-14 06:28:24', 3),
	(64, '1', 'mesa', 'chamado', 'ET', 1, 33, '2025-02-14 06:36:38', '2025-02-14 06:36:38', 3),
	(65, '1', 'mesa', 'chamado', 'ET', 1, 36, '2025-02-14 06:37:34', '2025-02-14 06:37:34', 3),
	(66, '1', 'mesa', 'chamado', 'ET', 1, 37, '2025-02-14 06:39:38', '2025-02-14 06:39:38', 3),
	(67, '1', 'mesa', 'chamado', 'ET', 1, 38, '2025-02-14 06:40:28', '2025-02-14 06:40:28', 3),
	(68, '1', 'mesa', 'chamado', 'ET', 1, 39, '2025-02-14 06:40:44', '2025-02-14 06:40:44', 3),
	(69, '1', 'mesa', 'chamado', 'ET', 1, 40, '2025-02-14 06:41:14', '2025-02-14 06:41:14', 3),
	(70, '1', 'mesa', 'chamado', 'PET', 1, 41, '2025-02-14 06:43:08', '2025-02-14 06:43:08', 3),
	(71, '1', 'mesa', 'chamado', 'PET', 1, 42, '2025-02-14 06:43:24', '2025-02-14 06:43:24', 3),
	(72, '1', 'mesa', 'chamado', 'ET', 1, 44, '2025-02-14 06:44:04', '2025-02-14 06:44:04', 3),
	(73, '1', 'mesa', 'chamado', 'PET', 1, 43, '2025-02-14 06:44:54', '2025-02-14 06:44:54', 3),
	(74, '1', 'mesa', 'chamado', 'PET', 1, 45, '2025-02-14 06:45:34', '2025-02-14 06:45:34', 3),
	(75, '1', 'mesa', 'chamado', 'PET', 1, 46, '2025-02-14 06:49:30', '2025-02-14 06:49:30', 3),
	(76, '1', 'mesa', 'chamado', 'PET', 1, 47, '2025-02-14 06:49:34', '2025-02-14 06:49:34', 3),
	(77, '1', 'mesa', 'chamado', 'PET', 1, 49, '2025-02-18 04:06:51', '2025-02-18 04:06:51', 3),
	(78, '1', 'mesa', 'chamado', 'ET', 1, 48, '2025-02-18 04:07:21', '2025-02-18 04:07:21', 3),
	(79, '1', 'mesa', 'chamado', 'PET', 1, 50, '2025-02-18 04:07:31', '2025-02-18 04:07:31', 3),
	(80, '1', 'mesa', 'chamado', 'PET', 1, 51, '2025-02-18 04:07:41', '2025-02-18 04:07:41', 3),
	(81, '1', 'mesa', 'chamado', 'ET', 1, 52, '2025-02-18 04:07:51', '2025-02-18 04:07:51', 3),
	(82, '1', 'mesa', 'chamado', 'ET', 1, 53, '2025-02-18 04:08:01', '2025-02-18 04:08:01', 3),
	(83, '1', 'mesa', 'chamado', 'ET', 1, 55, '2025-02-18 04:08:11', '2025-02-18 04:08:11', 3),
	(84, '1', 'mesa', 'chamado', 'ET', 1, 57, '2025-02-18 04:08:21', '2025-02-18 04:08:21', 3),
	(85, '1', 'mesa', 'chamado', 'ET', 1, 59, '2025-02-18 04:08:31', '2025-02-18 04:08:31', 3),
	(86, '1', 'mesa', 'chamado', 'ET', 1, 60, '2025-02-18 04:08:41', '2025-02-18 04:08:41', 3),
	(87, '1', 'mesa', 'chamado', 'ET', 1, 61, '2025-02-18 04:08:51', '2025-02-18 04:08:51', 3),
	(88, '1', 'mesa', 'chamado', 'ET', 1, 62, '2025-02-18 04:09:01', '2025-02-18 04:09:01', 3),
	(89, '1', 'mesa', 'chamado', 'PET', 1, 65, '2025-02-18 04:09:41', '2025-02-18 04:09:41', 3),
	(90, '1', 'mesa', 'chamado', 'PET', 1, 66, '2025-02-18 04:09:51', '2025-02-18 04:09:51', 3),
	(91, '4', 'Guichê', 'chamado', 'PET', 1, 73, '2025-02-18 05:33:32', '2025-02-18 05:33:32', 3),
	(92, '4', 'Guichê', 'chamado', 'PET', 1, 74, '2025-02-18 05:34:13', '2025-02-18 05:34:13', 3),
	(93, '4', 'Guichê', 'chamado', 'PET', 1, 75, '2025-02-18 05:34:53', '2025-02-18 05:34:53', 3),
	(94, '4', 'Guichê', 'chamado', 'PET', 1, 76, '2025-02-18 05:35:23', '2025-02-18 05:35:23', 3),
	(95, '4', 'Guichê', 'chamado', 'PET', 1, 77, '2025-02-18 05:35:33', '2025-02-18 05:35:33', 3),
	(96, '4', 'Guichê', 'chamado', 'PET', 1, 78, '2025-02-18 05:36:40', '2025-02-18 05:36:40', 3),
	(97, '4', 'Guichê', 'chamado', 'PET', 1, 79, '2025-02-18 05:36:53', '2025-02-18 05:36:53', 3),
	(98, '4', 'Guichê', 'chamado', 'ET', 1, 80, '2025-02-18 05:37:03', '2025-02-18 05:37:03', 3),
	(99, '4', 'Guichê', 'chamado', 'PET', 1, 83, '2025-02-18 05:40:03', '2025-02-18 05:40:03', 3),
	(100, '4', 'Guichê', 'chamado', 'PET', 1, 84, '2025-02-18 05:40:13', '2025-02-18 05:40:13', 3),
	(101, '4', 'Guichê', 'chamado', 'PET', 1, 85, '2025-02-18 05:46:59', '2025-02-18 05:46:59', 3),
	(102, '4', 'Guichê', 'chamado', 'ET', 1, 81, '2025-02-18 05:51:33', '2025-02-18 05:51:33', 3),
	(103, '4', 'Guichê', 'chamado', 'PET', 1, 87, '2025-02-18 05:56:17', '2025-02-18 05:56:17', 3),
	(104, '4', 'Guichê', 'chamado', 'ET', 1, 82, '2025-02-18 05:57:15', '2025-02-18 05:57:15', 3),
	(105, '4', 'Guichê', 'chamado', 'PET', 1, 88, '2025-02-18 05:57:23', '2025-02-18 05:57:23', 3),
	(106, '4', 'Guichê', 'chamado', 'PET', 1, 89, '2025-02-19 04:41:56', '2025-02-19 04:41:56', 3),
	(107, '4', 'Guichê', 'chamado', 'PET', 1, 90, '2025-02-19 04:42:34', '2025-02-19 04:42:34', 3),
	(108, '4', 'Guichê', 'chamado', 'PET', 1, 91, '2025-02-19 04:49:21', '2025-02-19 04:49:21', 3),
	(109, '4', 'Guichê', 'chamado', 'PET', 1, 92, '2025-02-19 04:49:40', '2025-02-19 04:49:40', 3),
	(110, '4', 'Guichê', 'chamado', 'PET', 1, 93, '2025-02-19 04:50:00', '2025-02-19 04:50:00', 3),
	(111, '4', 'Guichê', 'chamado', 'ET', 1, 94, '2025-02-19 04:59:26', '2025-02-19 04:59:26', 3),
	(112, '4', 'Guichê', 'chamado', 'ET', 1, 95, '2025-02-19 04:59:40', '2025-02-19 04:59:40', 3),
	(113, '4', 'Guichê', 'chamado', 'ET', 1, 96, '2025-02-19 04:59:50', '2025-02-19 04:59:50', 3),
	(114, '4', 'Guichê', 'chamado', 'ET', 1, 97, '2025-02-19 05:00:00', '2025-02-19 05:00:00', 3),
	(115, '4', 'Guichê', 'chamado', 'PET', 1, 99, '2025-02-19 05:00:30', '2025-02-19 05:00:30', 3),
	(116, '4', 'Guichê', 'chamado', 'PET', 1, 100, '2025-02-19 05:04:41', '2025-02-19 05:04:41', 3),
	(117, '4', 'Guichê', 'chamado', 'ET', 1, 98, '2025-02-19 05:05:56', '2025-02-19 05:05:56', 3),
	(118, '4', 'Guichê', 'chamado', 'PET', 1, 101, '2025-02-19 05:08:03', '2025-02-19 05:08:03', 3),
	(119, '4', 'Guichê', 'chamado', 'PET', 1, 105, '2025-02-19 05:10:27', '2025-02-19 05:10:27', 3),
	(120, '4', 'Guichê', 'chamado', 'ET', 1, 102, '2025-02-19 05:10:48', '2025-02-19 05:10:48', 3),
	(121, '4', 'Guichê', 'chamado', 'ET', 1, 104, '2025-02-19 05:11:17', '2025-02-19 05:11:17', 3),
	(122, '4', 'Guichê', 'chamado', 'PET', 1, 109, '2025-02-19 05:14:15', '2025-02-19 05:14:15', 3),
	(123, '4', 'Guichê', 'chamado', 'ET', 1, 106, '2025-02-19 05:19:39', '2025-02-19 05:19:39', 3),
	(124, '4', 'Guichê', 'chamado', 'ET', 1, 107, '2025-02-19 05:19:58', '2025-02-19 05:19:58', 3),
	(125, '4', 'Guichê', 'chamado', 'ET', 1, 108, '2025-02-19 05:20:08', '2025-02-19 05:20:08', 3),
	(126, '4', 'Guichê', 'chamado', 'PET', 1, 110, '2025-02-19 05:20:27', '2025-02-19 05:20:27', 3),
	(127, '4', 'Guichê', 'chamado', 'ET', 1, 111, '2025-02-19 05:20:38', '2025-02-19 05:20:38', 3),
	(128, '4', 'Guichê', 'chamado', 'PET', 1, 112, '2025-02-19 05:20:58', '2025-02-19 05:20:58', 3),
	(129, '4', 'Guichê', 'chamado', 'PET', 1, 113, '2025-02-19 05:21:18', '2025-02-19 05:21:18', 3),
	(130, '4', 'Guichê', 'chamado', 'ET', 1, 114, '2025-02-19 05:24:29', '2025-02-19 05:24:29', 3),
	(131, '4', 'Guichê', 'chamado', 'ET', 1, 115, '2025-02-19 05:24:38', '2025-02-19 05:24:38', 3),
	(132, '4', 'Guichê', 'chamado', 'PET', 1, 118, '2025-02-19 05:24:58', '2025-02-19 05:24:58', 3),
	(133, '4', 'Guichê', 'chamado', 'ET', 1, 116, '2025-02-19 05:25:08', '2025-02-19 05:25:08', 3),
	(134, '4', 'Guichê', 'chamado', 'ET', 1, 117, '2025-02-19 05:25:18', '2025-02-19 05:25:18', 3),
	(135, '4', 'Guichê', 'chamado', 'PET', 1, 119, '2025-02-19 05:25:50', '2025-02-19 05:25:50', 3),
	(136, '4', 'Guichê', 'chamado', 'PET', 1, 120, '2025-02-19 05:26:07', '2025-02-19 05:26:07', 3),
	(137, '4', 'Guichê', 'chamado', 'ET', 1, 121, '2025-02-19 06:09:21', '2025-02-19 06:09:21', 3),
	(138, '4', 'Guichê', 'chamado', 'PET', 1, 124, '2025-02-19 06:10:03', '2025-02-19 06:10:03', 3),
	(139, '4', 'Guichê', 'chamado', 'ET', 1, 122, '2025-02-19 06:10:23', '2025-02-19 06:10:23', 3),
	(140, '4', 'Guichê', 'chamado', 'PET', 1, 126, '2025-02-24 05:07:33', '2025-02-24 05:07:33', 3),
	(141, '4', 'Guichê', 'chamado', 'PET', 1, 128, '2025-02-24 05:07:43', '2025-02-24 05:07:43', 3),
	(142, '4', 'Guichê', 'chamado', 'PET', 1, 129, '2025-02-27 05:32:14', '2025-02-27 05:32:14', 3),
	(143, '4', 'Guichê', 'chamado', 'ET', 1, 130, '2025-02-27 05:32:24', '2025-02-27 05:32:24', 3),
	(144, '4', 'Guichê', 'chamado', 'ET', 1, 131, '2025-02-27 05:32:35', '2025-02-27 05:32:35', 3),
	(145, '4', 'Guichê', 'chamado', 'ET', 1, 132, '2025-02-27 05:32:45', '2025-02-27 05:32:45', 3),
	(146, '4', 'Guichê', 'chamado', 'ET', 1, 133, '2025-02-27 05:32:55', '2025-02-27 05:32:55', 3),
	(147, '4', 'Guichê', 'chamado', 'ET', 1, 134, '2025-02-27 05:33:06', '2025-02-27 05:33:06', 3),
	(148, '4', 'Guichê', 'chamado', 'ET', 1, 135, '2025-02-27 05:33:15', '2025-02-27 05:33:15', 3),
	(149, '4', 'Guichê', 'chamado', 'PET', 1, 136, '2025-02-27 05:33:25', '2025-02-27 05:33:25', 3),
	(150, '4', 'Guichê', 'chamado', 'ET', 1, 137, '2025-02-27 05:33:35', '2025-02-27 05:33:35', 3),
	(151, '4', 'Guichê', 'chamado', 'ET', 1, 138, '2025-02-27 05:33:51', '2025-02-27 05:33:51', 3),
	(152, '4', 'Guichê', 'chamado', 'PET', 1, 145, '2025-02-27 05:34:02', '2025-02-27 05:34:02', 3),
	(153, '2', 'mesa', 'chamado', 'A', 2, 11, '2025-02-27 05:41:11', '2025-02-27 05:41:11', 3),
	(154, '2', 'mesa', 'chamado', 'PETA', 3, 4, '2025-02-27 05:41:48', '2025-02-27 05:41:48', 3),
	(155, '2', 'mesa', 'chamado', 'P34', 5, 8, '2025-02-27 05:42:28', '2025-02-27 05:42:28', 3),
	(156, '2', 'mesa', 'chamado', 'A', 2, 12, '2025-02-27 05:42:38', '2025-02-27 05:42:38', 3),
	(157, '2', 'mesa', 'chamado', '34', 5, 6, '2025-02-27 05:42:48', '2025-02-27 05:42:48', 3),
	(158, '2', 'mesa', 'chamado', '34', 5, 7, '2025-02-27 05:43:02', '2025-02-27 05:43:02', 3);

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

-- Copiando estrutura para tabela efila.local
CREATE TABLE IF NOT EXISTS `local` (
  `id_local` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_local`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.local: ~0 rows (aproximadamente)
INSERT INTO `local` (`id_local`, `nome`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'Guichê', 'ativo', '2025-02-04 06:50:40', '2025-02-06 06:50:05'),
	(4, 'mesa', 'ativo', '2025-02-14 05:45:03', '2025-02-14 05:45:03');

-- Copiando estrutura para tabela efila.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.migrations: ~0 rows (aproximadamente)

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
INSERT INTO `ordenacao` (`id_ordenacao`, `servico_id`, `departamento_id`, `prio_total`, `prio_cont`, `nor_total`, `nor_cont`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 5, 0, 3, 1, '2025-02-05 04:43:12', '2025-02-27 05:40:21'),
	(2, 2, NULL, 3, 0, 1, 1, '2025-02-06 06:44:09', '2025-02-27 05:42:37'),
	(3, 5, NULL, 5, 2, 5, 2, '2025-02-12 06:41:51', '2025-02-27 05:42:59'),
	(4, 4, NULL, 5, NULL, 5, 2, '2025-02-12 06:41:59', '2025-02-27 05:40:23'),
	(5, 3, NULL, 5, 1, 5, NULL, '2025-02-12 06:42:14', '2025-02-27 05:41:47');

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
INSERT INTO `painel` (`id_painel`, `nome`, `obs`, `key`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'painel teste', 'asdfasf', NULL, 'inativo', '2025-02-05 04:44:36', '2025-02-06 05:15:51'),
	(3, 'COMPRAS', 'sfsdf', NULL, 'ativo', '2025-02-06 05:16:11', '2025-02-06 05:16:11');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.painel_senha: ~0 rows (aproximadamente)
INSERT INTO `painel_senha` (`id_painel`, `numero_local`, `nome_local`, `status`, `sigla`, `numero`, `servico_id`, `peso`, `created_at`, `updated_at`) VALUES
	(6, '2', 'mesa', 'chamado', '34', '7', 5, 0, '2025-02-27 05:42:59', '2025-02-27 05:43:02');

-- Copiando estrutura para tabela efila.painel_servicos
CREATE TABLE IF NOT EXISTS `painel_servicos` (
  `id_painel_servicos` int(10) NOT NULL AUTO_INCREMENT,
  `servico_id` int(10) DEFAULT NULL,
  `painel_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_painel_servicos`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.painel_servicos: ~5 rows (aproximadamente)
INSERT INTO `painel_servicos` (`id_painel_servicos`, `servico_id`, `painel_id`, `created_at`, `updated_at`) VALUES
	(7, 1, 3, '2025-02-14 05:27:42', '2025-02-14 05:27:42'),
	(8, 2, 3, '2025-02-27 05:34:50', '2025-02-27 05:34:50'),
	(9, 3, 3, '2025-02-27 05:34:50', '2025-02-27 05:34:50'),
	(10, 4, 3, '2025-02-27 05:34:50', '2025-02-27 05:34:50'),
	(11, 5, 3, '2025-02-27 05:34:50', '2025-02-27 05:34:50');

-- Copiando estrutura para tabela efila.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela efila.pessoa
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_pessoa` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.pessoa: ~6 rows (aproximadamente)
INSERT INTO `pessoa` (`id_pessoa`, `nome`, `email`, `cpf`, `created_at`, `updated_at`) VALUES
	(1, 'wesley ', 'suporte@cerradoclound.com.br', '09117166616', NULL, NULL),
	(2, 'afsdfasd', 'suporte@cerradoclound.com.br', 'asdfas', NULL, NULL),
	(15, 'Gaspar', 'gaspar@gmail.com', '23455565656', NULL, '2025-02-27 05:21:26'),
	(16, 'wesley  dsfsd', 'suporte@cerradoclound.com.br', '54545', NULL, NULL),
	(17, 'wesley da silva pereira', 'wpsistemas2@gmail.com', '023498203840', '2025-02-05 04:46:55', '2025-02-05 04:46:55'),
	(18, 'admin', 'admin@admin.com', '99798798798787', '2025-02-27 05:23:26', '2025-02-27 05:23:26');

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
INSERT INTO `servico` (`id_servico`, `nome`, `sigla`, `departamento_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'ENTREGA  CONTRA CHEQUE', 'ET', NULL, 'ativo', '2025-02-12 05:39:59', '2025-02-12 05:39:59'),
	(2, 'COMPRAS', 'A', NULL, 'ativo', '2025-02-12 05:54:31', '2025-02-12 05:54:31'),
	(3, 'CONTRA CHEQUES 2', 'ETA', NULL, 'ativo', '2025-02-12 06:40:04', '2025-02-12 06:40:04'),
	(4, 'lucas car', 'ET009', NULL, 'ativo', '2025-02-12 06:40:21', '2025-02-12 06:40:21'),
	(5, 'IPTU', '34', NULL, 'ativo', '2025-02-12 06:40:34', '2025-02-12 06:40:34');

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

-- Copiando dados para a tabela efila.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('mzeTvSY9Geah5Jkokp9CrT6X1I1C8mWSAiE9GF81', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiaDZzenlVUW1VUFBiSVBWaWFFWFdJbFR6SWtkVkVwZVdaUHdkRGlVbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9lZmlsYS50ZXN0L3RyaWFnZW0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjE3OiJodHRwOi8vZWZpbGEudGVzdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7czoxNDoiaWRfYXRlbmRpbWVudG8iO2k6NjtzOjQ6InR5cGUiO3M6ODoiY2hhbWFuZG8iO3M6NToic2VuaGEiO3M6MzoiMzQ3Ijt9', 1740624258);

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
INSERT INTO `touch` (`id_touch`, `nome`, `obs`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'PROTOCOLO', 'PROTOCOLO', 'inativo', '2025-02-12 04:04:25', '2025-02-12 06:47:11'),
	(2, 'COMPRAS', 'paine do compras', 'ativo', '2025-02-13 04:35:39', '2025-02-13 04:35:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela efila.touch_servicos: ~10 rows (aproximadamente)
INSERT INTO `touch_servicos` (`id_touch_servico`, `touch_id`, `servico_id`, `created_at`, `updated_at`, `status`) VALUES
	(11, 1, 1, '2025-02-12 05:41:49', '2025-02-12 05:41:49', 'ativo'),
	(12, 1, 2, '2025-02-12 05:54:42', '2025-02-12 05:54:42', 'ativo'),
	(13, 1, 3, '2025-02-12 06:41:02', '2025-02-12 06:41:02', 'ativo'),
	(14, 1, 4, '2025-02-12 06:41:02', '2025-02-12 06:41:02', 'ativo'),
	(15, 1, 5, '2025-02-12 06:41:02', '2025-02-12 06:41:02', 'ativo'),
	(17, 2, 1, '2025-02-13 05:05:51', '2025-02-13 05:05:51', 'ativo'),
	(21, 2, 2, '2025-02-27 05:38:20', '2025-02-27 05:38:20', 'ativo'),
	(22, 2, 3, '2025-02-27 05:38:25', '2025-02-27 05:38:25', 'ativo'),
	(23, 2, 4, '2025-02-27 05:38:31', '2025-02-27 05:38:31', 'ativo'),
	(24, 2, 5, '2025-02-27 05:38:37', '2025-02-27 05:38:37', 'ativo');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela efila.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `pessoa_id`, `perfil_id`) VALUES
	(2, 'wesley', 'suporte@cerradoclound.com.br', NULL, '$2y$12$Jmi6ffI/Spi4BlNvk2tV2OjJd9euz4vEdOgcRayDE0uc.tjYr7sua', NULL, '2025-02-04 06:47:13', '2025-02-04 06:47:13', 1, 2),
	(3, 'wesley da silva pereira', 'wpsistemas2@gmail.com', NULL, '$2y$12$wuTqZqaD53KO1X3fjVSWseKkKRTIy4pSo0OOnD3hb0mejoRu9/8CO', NULL, '2025-02-05 04:46:56', '2025-02-05 04:46:56', 17, 1),
	(4, 'admin', 'admin@admin.com', NULL, '$2y$12$n0S/j4Wb8JPseJ9X5DXzteTqknxR/k8AxS4jhJXbH.mLRpdLjSfmO', NULL, '2025-02-27 05:23:27', '2025-02-27 05:23:27', 18, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
