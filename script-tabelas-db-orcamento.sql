-- ---------------------------------------
-- Banco de dados: ` orcamento`
-- ---------------------------------------
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
--SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
--SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
--SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Estrutura da tabela `cliente`
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `whatsapp` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `senha` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 13 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;


-- --------------------------------------------------------
-- Estrutura da tabela `dados`
DROP TABLE IF EXISTS `dados`;
CREATE TABLE IF NOT EXISTS `dados`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `sobrenome` VARCHAR(45) NOT NULL,
    `nascimento` DATE DEFAULT NULL,
    `whatsapp` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `cpf` VARCHAR(45) NOT NULL,
    `tecnologia` VARCHAR(255) NOT NULL,
    `trabalhoatual` VARCHAR(255) NOT NULL,
    `executor` VARCHAR(45) NOT NULL,
    `planejador` VARCHAR(45) NOT NULL,
    `comunicador` VARCHAR(45) NOT NULL,
    `analista` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 185 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
-- Estrutura da tabela `despesa`
DROP TABLE IF EXISTS `despesa`;
CREATE TABLE IF NOT EXISTS `despesa`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `valor` DECIMAL(12, 2) NOT NULL,
    `descricao` MEDIUMTEXT NOT NULL,
    `data` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `data_pagamento` DATE DEFAULT NULL,
    `status_pagamento` TINYINT(1) NOT NULL DEFAULT '0',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;


-- --------------------------------------------------------
-- Estrutura da tabela `login`
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `whatsapp` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `senha` VARCHAR(45) NOT NULL,
    `nivel` VARCHAR(45) NOT NULL,
    `status` TINYINT(1) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 119 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
-- Extraindo dados da tabela `login`
INSERT INTO `login`(`id`,`nome`,`whatsapp`,`email`,`senha`,`nivel`,`status`)
VALUES
(1,'Bruno Rojo','11999887766', 'bruno@rojo.com', '123', 'admin', 0),
(2,'Admin 01','11920201111', 'admin01@gmail.com', '123', 'admin', 0),
(3,'Admin 02','11920202222', 'admin02@gmail.com', '123', 'admin', 0),
(4,'Admin 03','11920203333', 'admin03@gmail.com', '123', 'admin', 0),
(5,'Admin 04','11920204444', 'admin04@gmail.com', '123', 'admin', 0),
(6,'Vendedor 01', '11990901111', 'vendedor01@gmail.com', '123', 'vendedor', 0),
(7,'Vendedor 02', '11990902222', 'vendedor02@gmail.com', '123', 'vendedor', 0),
(8,'Vendedor 03', '11990903333', 'vendedor03@gmail.com', '123', 'vendedor', 0),
(9,'Vendedor 04', '11990904444', 'vendedor04@gmail.com', '123', 'vendedor', 0),
(10,'Vendedor Bloq', '119909055555', 'vendedorbloq@gmail.com', '123', 'vendedor', 1),
(11, 'Desenv 01','11970701111','desenv01@gmail.com', '123',  'dev', 0),
(12,'Desenv 02','11970701122','desenv02@gmail.com', '123',  'dev', 0),
(13,'Desenv 03','11970701133','desenv03@gmail.com', '123',  'dev', 0),
(14,'Desenv 04','11970701144','desenv04@gmail.com', '123',  'dev', 0),
(15,'Desenv Bloq','119707055555','desenvbloq@gmail.com', '123',  'dev', 1);


-- --------------------------------------------------------
-- Estrutura da tabela `lucro_empresa`
DROP TABLE IF EXISTS `lucro_empresa`;
CREATE TABLE IF NOT EXISTS `lucro_empresa`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `total_parcela` INT NOT NULL,
    `valor_parcela` DECIMAL(8, 2) NOT NULL,
    `projeto_id` INT NOT NULL,
    `data_parcela` DATE DEFAULT NULL,
    PRIMARY KEY(`id`),
    KEY `projeto_id`(`projeto_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;


-- --------------------------------------------------------
-- Estrutura da tabela `orcamentos`
DROP TABLE IF EXISTS `orcamentos`;
CREATE TABLE IF NOT EXISTS `orcamentos`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `projeto_id` INT NOT NULL,
    `dev_id` INT NOT NULL,
    `dev` VARCHAR(100) NOT NULL,
    `valor_dev` DECIMAL(10, 2) NOT NULL,
    `valor_cliente` DECIMAL(10, 2) NOT NULL,
    `lucro_empresa` DECIMAL(10, 2) NOT NULL,
    `orc_status` VARCHAR(45) NOT NULL,
    `data_entrega` VARCHAR(45) NOT NULL,
    `observacao` TEXT,
    PRIMARY KEY(`id`),
    KEY `orcamentos_ibfk_1`(`projeto_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 141 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;


-- --------------------------------------------------------
-- Estrutura da tabela `projeto`
DROP TABLE IF EXISTS `projeto`;
CREATE TABLE IF NOT EXISTS `projeto`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `cliente` VARCHAR(45) NOT NULL,
    `briefing` MEDIUMTEXT NOT NULL,
    `desenvolvedor` VARCHAR(45) NOT NULL,
    `valordev` DECIMAL(10, 2) NOT NULL,
    `valorcliente` DECIMAL(10, 2) NOT NULL,
    `lucroempresa` DECIMAL(10, 2) NOT NULL,
    `status` VARCHAR(45) NOT NULL,
    `dataentrega` VARCHAR(45) NOT NULL,
    `data_inicio` DATE DEFAULT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 139 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;


-- --------------------------------------------------------
-- Estrutura da tabela `vendedor`
DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE IF NOT EXISTS `vendedor`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `whatsapp` INT NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
-- Restrições para despejos de tabelas

-- --------------------------------------------------------
-- Limitadores para a tabela `lucro_empresa`
ALTER TABLE `lucro_empresa` ADD CONSTRAINT `lucro_empresa_ibfk_1` FOREIGN KEY(`projeto_id`) REFERENCES `projeto`(`id`) ON DELETE CASCADE;

-- Limitadores para a tabela `orcamentos`
ALTER TABLE `orcamentos` ADD CONSTRAINT `orcamentos_ibfk_1` FOREIGN KEY(`projeto_id`) REFERENCES `projeto`(`id`) ON DELETE CASCADE;
COMMIT;

--/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
--/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
--/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
