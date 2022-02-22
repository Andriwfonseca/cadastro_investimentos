-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 03:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco_douglas`
--

-- --------------------------------------------------------

--
-- Table structure for table `investimentos`
--

CREATE TABLE `investimentos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor_cota` decimal(6,2) NOT NULL,
  `percentual` double NOT NULL,
  `valor_pagar` decimal(6,2) NOT NULL,
  `participante` tinyint(1) NOT NULL,
  `qtd_cota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investimentos`
--

INSERT INTO `investimentos` (`id`, `descricao`, `valor_cota`, `percentual`, `valor_pagar`, `participante`, `qtd_cota`) VALUES
(1, 'Imóvel', '150.00', 20, '100.00', 0, 5),
(2, 'Apartamento', '100.00', 10, '150.00', 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `cidade` varchar(15) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `rua` varchar(15) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`, `estado`, `cidade`, `bairro`, `rua`, `numero`, `admin`) VALUES
(1, 'Andriw', 'filipefonsequinha@gmail.com', '202cb962ac59075b964b07152d234b70', '9974444', 'Santa Catarina', 'Joinville', 'Comasa', 'Avencal', '399', 0),
(2, 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '55', 'Santa Catarina', 'Joinville', 'Comasa', 'Avencal', '123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `investimentos`
--
ALTER TABLE `investimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `investimentos`
--
ALTER TABLE `investimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
