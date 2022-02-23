-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Fev-2022 às 02:32
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco_douglas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `investimentos`
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

--
-- Extraindo dados da tabela `investimentos`
--

INSERT INTO `investimentos` (`id`, `descricao`, `valor_cota`, `percentual`, `valor_pagar`, `id_admin`, `qtd_cota`) VALUES
(1, 'Imóvel', '100.00', 10, '50.00', 2, 4),
(2, 'Imóvel2', '50.00', 15, '15.00', 3, 0),
(3, 'Carro', '800.00', 8, '1920.00', 3, 29),
(4, 'Terreno', '1200.00', 10, '120.00', 2, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacionamentos`
--

CREATE TABLE `relacionamentos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_investimento` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `relacionamentos`
--

INSERT INTO `relacionamentos` (`id`, `id_usuario`, `id_investimento`, `id_admin`) VALUES
(5, 4, 2, 3),
(7, 4, 3, 3),
(8, 4, 1, 2),
(12, 4, 4, 2),
(14, 1, 2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
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
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`, `estado`, `cidade`, `bairro`, `rua`, `numero`, `admin`) VALUES
(1, 'Andriw', 'filipefonsequinha@gmail.com', '202cb962ac59075b964b07152d234b70', '5511', 'Santa Catarina2', 'Joinville2', 'Comasa2', 'Avencal2', '10', 0),
(2, 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '5511', 'Santa Catarina2', 'Joinville2', 'Comasa2', 'Avencal2', '10', 1),
(3, 'Admin2', 'admin2@admin.com', '202cb962ac59075b964b07152d234b70', '5511', 'Santa Catarina2', 'Joinville2', 'Comasa2', 'Avencal2', '10', 1),
(4, 'Teste', 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', '5511', 'Santa Catarina2', 'Joinville2', 'Comasa2', 'Avencal2', '10', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `investimentos`
--
ALTER TABLE `investimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `relacionamentos`
--
ALTER TABLE `relacionamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `investimentos`
--
ALTER TABLE `investimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `relacionamentos`
--
ALTER TABLE `relacionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
