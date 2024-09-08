-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/09/2024 às 00:25
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bookhub`
--
CREATE DATABASE IF NOT EXISTS `bookhub` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bookhub`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `autor`
--

DROP TABLE IF EXISTS `autor`;
CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `arquivado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor`
--

INSERT INTO `autor` (`id`, `nome`, `arquivado`) VALUES
(1, 'Clarice Lispector', 0),
(2, 'V. E. Schwab', 1),
(4, 'Bell', 1),
(7, 'Ana', 1),
(8, 'Camila', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

DROP TABLE IF EXISTS `emprestimo`;
CREATE TABLE `emprestimo` (
  `id` int(11) NOT NULL,
  `nomePessoa` varchar(120) NOT NULL,
  `emailPessoa` varchar(120) NOT NULL,
  `idLivro` int(11) NOT NULL,
  `dataEmprestimo` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

DROP TABLE IF EXISTS `livro`;
CREATE TABLE `livro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `idAutor` int(11) NOT NULL,
  `ano` varchar(120) NOT NULL,
  `capa` varchar(1024) NOT NULL,
  `emprestado` tinyint(1) NOT NULL DEFAULT 0,
  `arquivado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livro`
--

INSERT INTO `livro` (`id`, `titulo`, `idAutor`, `ano`, `capa`, `emprestado`, `arquivado`) VALUES
(12, 'Tudo Sobre o Amor', 4, '1999', 'image/51zZpV5P2aL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(13, 'sla', 2, '2024', 'image/IMG_20240826_073853045_AE.jpg', 0, 0),
(14, 'sa', 4, '21', 'image/1000013826-removebg-preview.png', 0, 1),
(15, 'Novoherat', 1, '785', 'image/1.png', 1, 0),
(16, 'pesquisa', 4, '18291', 'image/51zZpV5P2aL._AC_UF1000,1000_QL80_.jpg', 0, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idLivro` (`idLivro`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAutor` (`idAutor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`idLivro`) REFERENCES `livro` (`id`);

--
-- Restrições para tabelas `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
