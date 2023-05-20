-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Maio-2023 às 18:51
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `orcamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `whatsapp` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `whatsapp`, `email`, `senha`) VALUES
(13, 'Cliente 1', '744444443', 'cliente@oi.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados`
--

DROP TABLE IF EXISTS `dados`;
CREATE TABLE IF NOT EXISTS `dados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `whatsapp` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `tecnologia` varchar(255) NOT NULL,
  `trabalhoatual` varchar(255) NOT NULL,
  `executor` varchar(45) NOT NULL,
  `planejador` varchar(45) NOT NULL,
  `comunicador` varchar(45) NOT NULL,
  `analista` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa`
--

DROP TABLE IF EXISTS `despesa`;
CREATE TABLE IF NOT EXISTS `despesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `descricao` mediumtext NOT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_pagamento` date DEFAULT NULL,
  `status_pagamento` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `whatsapp` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nivel` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `nome`, `whatsapp`, `email`, `senha`, `nivel`, `status`) VALUES
(116, 'Bruno Rojo', '11980110000', 'admin@gmail.com', '123', 'admin', 0),
(117, 'Vendedor', '11980802233', 'vendedor@gmail.com', '123', 'vendedor', 0),
(118, 'Vendedor 01', '11990901111', 'vendedor01@gmail.com', 'vendedor01@304050', 'vendedor', 0),
(119, 'Vendedor Bloq', '119909055555', 'vendedorbloq@gmail.com', 'vendedorbloq@304050', 'vendedor', 1),
(120, 'Desenv', '11970701144', 'desenv@gmail.com', '123', 'dev', 0),
(121, 'Desenv 01','11970701111','desenv01@gmail.com', 'desenv01@304050',  'dev', 0),
(122, 'Desenv Bloq','119707055555','desenvbloq@gmail.com', 'desenvbloq@304050',  'dev', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lucro_empresa`
--

DROP TABLE IF EXISTS `lucro_empresa`;
CREATE TABLE IF NOT EXISTS `lucro_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_parcela` int(11) NOT NULL,
  `valor_parcela` decimal(8,2) NOT NULL,
  `projeto_id` int(11) NOT NULL,
  `data_parcela` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projeto_id` (`projeto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentos`
--

DROP TABLE IF EXISTS `orcamentos`;
CREATE TABLE IF NOT EXISTS `orcamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projeto_id` int(11) NOT NULL,
  `dev_id` int(11) NOT NULL,
  `dev` varchar(100) NOT NULL,
  `valor_dev` decimal(10,2) NOT NULL,
  `valor_cliente` decimal(10,2) NOT NULL,
  `lucro_empresa` decimal(10,2) NOT NULL,
  `orc_status` varchar(45) NOT NULL,
  `data_entrega` varchar(45) NOT NULL,
  `observacao` text,
  PRIMARY KEY (`id`),
  KEY `orcamentos_ibfk_1` (`projeto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

DROP TABLE IF EXISTS `projeto`;
CREATE TABLE IF NOT EXISTS `projeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cliente` varchar(45) NOT NULL,
  `briefing` mediumtext NOT NULL,
  `desenvolvedor` varchar(45) DEFAULT NULL,
  `valordev` decimal(10,2) DEFAULT NULL,
  `valorcliente` decimal(10,2) DEFAULT NULL,
  `lucroempresa` decimal(10,2) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `dataentrega` varchar(45) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedor`
--

DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE IF NOT EXISTS `vendedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `whatsapp` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `lucro_empresa`
--
ALTER TABLE `lucro_empresa`
  ADD CONSTRAINT `lucro_empresa_ibfk_1` FOREIGN KEY (`projeto_id`) REFERENCES `projeto` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD CONSTRAINT `orcamentos_ibfk_1` FOREIGN KEY (`projeto_id`) REFERENCES `projeto` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
