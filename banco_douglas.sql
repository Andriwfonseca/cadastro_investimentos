-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 05:12 PM
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
  `id_admin` int(1) NOT NULL,
  `qtd_cota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `relacionamentos`
--

CREATE TABLE `relacionamentos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_investimento` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '5511', 'Santa Catarina2', 'Joinville', 'Comasa', 'Avencal', '10', 1),
(3, 'Admin2', 'admin2@admin.com', '202cb962ac59075b964b07152d234b70', '551155555', 'Santa Catarina', 'Joinville', 'Comasa', 'Avencal', '40', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `investimentos`
--
ALTER TABLE `investimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relacionamentos`
--
ALTER TABLE `relacionamentos`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `relacionamentos`
--
ALTER TABLE `relacionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
