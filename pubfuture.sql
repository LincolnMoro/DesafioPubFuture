-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 17, 2022 at 01:55 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pubfuture`
--

-- --------------------------------------------------------

--
-- Table structure for table `contas`
--

DROP TABLE IF EXISTS `contas`;
CREATE TABLE IF NOT EXISTS `contas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `saldo` float NOT NULL,
  `tipoConta` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `instituicaoFinanceira` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `conta` int(10) NOT NULL,
  `titular` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `contas`
--

INSERT INTO `contas` (`id`, `saldo`, `tipoConta`, `instituicaoFinanceira`, `conta`, `titular`) VALUES
(1, 1500, 'Conta Corrente', 'Santander', 58706, 'Lincoln Moro'),
(2, 1300, 'PoupanÃ§a', 'Viacred', 105, 'Camila');

-- --------------------------------------------------------

--
-- Table structure for table `despesas`
--

DROP TABLE IF EXISTS `despesas`;
CREATE TABLE IF NOT EXISTS `despesas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `valor` float NOT NULL,
  `dataPagamento` date NOT NULL,
  `dataPagamentoEsperado` date NOT NULL,
  `tipoDespesa` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `conta` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `despesas`
--

INSERT INTO `despesas` (`id`, `valor`, `dataPagamento`, `dataPagamentoEsperado`, `tipoDespesa`, `conta`) VALUES
(8, 500, '2022-01-16', '2022-01-16', 'Outros', 2);

-- --------------------------------------------------------

--
-- Table structure for table `receitas`
--

DROP TABLE IF EXISTS `receitas`;
CREATE TABLE IF NOT EXISTS `receitas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `valor` float NOT NULL,
  `dataRecebimento` date NOT NULL,
  `dataRecebimentoEsperado` date NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `conta` int(10) NOT NULL,
  `tipoReceita` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `receitas`
--

INSERT INTO `receitas` (`id`, `valor`, `dataRecebimento`, `dataRecebimentoEsperado`, `descricao`, `conta`, `tipoReceita`) VALUES
(20, 300, '2022-01-16', '2022-01-16', 'Recebimento', 1, 'SalÃ¡rio'),
(19, 500, '2022-01-16', '2022-01-16', 'Recebimento', 1, 'SalÃ¡rio'),
(18, 100, '2022-01-16', '2022-01-16', 'Recebimento', 2, 'SalÃ¡rio'),
(17, 1500, '2022-01-15', '2022-01-15', 'SalÃ¡rio', 1, 'SalÃ¡rio');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `email`, `foto`) VALUES
(1, 'Lincoln Moro', 'pubfuture', '$argon2id$v=19$m=65536,t=4,p=1$VEZpZm9yVWJ4MmNVMjNEdQ$fBU//qzHGheI1FxHGUzrtasc8D8tl2Xt1nwAJ1jTz5M', 'lincoln.moro.bc@gmail.com', 'perfil.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
