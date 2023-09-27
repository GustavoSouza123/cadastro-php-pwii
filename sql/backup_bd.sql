-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15-Ago-2023 às 11:17
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `idade` smallint NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `estado_civil` varchar(16) NOT NULL,
  `humanas` tinyint NOT NULL,
  `exatas` tinyint NOT NULL,
  `biologicas` tinyint NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `idade`, `sexo`, `estado_civil`, `humanas`, `exatas`, `biologicas`, `senha`) VALUES
(1, 'Gustavo Souza', 'gustavoelia7@gmail.com', 16, 'M', 'solteiro', 0, 1, 0, '412f262cb2c4371a3eb3ed15e02d4718'),
(2, 'José \"JR\" Roberto', 'jr@etecsm.sp.gov.br', 120, 'M', 'casado', 1, 0, 0, '8b28c7134887bb938e1ffed68456ffb2'),
(3, 'João Paulo', 'joaopaulo@yahoo.com.br', 46, 'M', 'divorciado', 0, 1, 1, '1ae3688d9ecd1681a65aea3da816201d'),
(4, 'Maria da Silva', 'mariadasilva2@gmail.com', 28, 'F', 'viuvo', 1, 0, 0, '0e2c5596b95c4b6c58772d884fccfe51'),
(5, 'Estéfão Ferreira', 'estefao123@hotmail.com', 74, 'M', 'viuvo', 1, 1, 0, '101193d7181cc88340ae5b2b17bba8a1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;