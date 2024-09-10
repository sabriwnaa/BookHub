-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/09/2024 às 21:12
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

CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `arquivado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor`
--

INSERT INTO `autor` (`id`, `nome`, `arquivado`) VALUES
(1, 'Clarice Lispector', 1),
(9, 'Bell Hooks', 0),
(10, 'Rainer Maria Rilke', 0),
(11, 'Machado de Assis', 0),
(12, 'Jorge Amado', 0),
(13, 'George Orwell', 0),
(14, 'Jane Austen', 0),
(15, 'Conceição Evaristo', 1),
(16, 'Adélia Prado', 0),
(17, 'Lima Barreto', 0),
(18, 'Hilda Hilst', 0),
(19, 'Sabrina Hahn Melo', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

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
(16, 'A Hora da Estrela', 1, '1977', 'image/810Vj9zyi-L._AC_UF1000,1000_QL80_.jpg', 0, 0),
(17, 'A Paixão Segundo G.H.', 1, '1964', 'image/9786555320060.jpg', 0, 0),
(18, 'O Lustre', 1, '1946', 'image/9788532531605.jpg', 0, 0),
(19, 'Perto do Coração Selvagem', 1, '1943', 'image/71jFv8WMDwL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(20, 'A Maçã no Escuro', 1, '1961', 'image/7126JQcgtJL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(21, 'Ain\'t I a Woman? Black Women and Feminism', 9, '1981', 'image/41rvdILzVCL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(22, 'All About Love: New Visions', 9, '2000', 'image/41C2g-DTB1L._SY580_.jpg', 0, 0),
(23, 'Feminism Is for Everybody: Passionate Politics', 9, '2000', 'image/81WtXK7TfKL._AC_UF894,1000_QL80_.jpg', 0, 0),
(24, 'Teaching to Transgress: Education as the Practice of Freedom', 9, '1994', 'image/51W93uj1ezL._AC_UF894,1000_QL80_.jpg', 0, 0),
(25, 'The Will to Change: Men, Masculinity, and Love', 9, '2004', 'image/71lhiY1JWCL._AC_UF894,1000_QL80_.jpg', 0, 0),
(26, 'Cartas a um Jovem Poeta', 10, '1929', 'image/cartas_a_um_jovem_poeta_nova_9788525409584_hd.jpg', 0, 0),
(27, 'O Livro de Horas', 10, '1905', 'image/201.jpg', 0, 0),
(28, 'As Elegias de Duíno e Sonetos a Orfeu', 10, '1923', 'image/as-elegias-de-duino-e-sonetos-a-orfeu-rilke.jpg', 0, 0),
(29, 'Dom Casmurro', 11, '1899', 'image/51BxlPc6-sL._SY580_.jpg', 0, 0),
(30, 'Memórias Póstumas de Brás Cubas', 11, '1881', 'image/815u+SBDpJL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(31, 'Gabriela, Cravo e Canela', 12, '1968', 'image/81IyZdXmUqL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(32, 'Capitães de Areia', 12, '1961', 'image/81t7altQZxL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(33, '1984', 13, '1949', 'image/819js3EQwbL._AC_UF1000,1000_QL80_.jpg', 0, 1),
(34, 'A Revolução dos Bichos', 13, '1945', 'image/91BsZhxCRjL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(35, 'Orgulho e Preconceito', 14, '1813', 'image/71Xta4Nf7uL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(36, 'Razão e Sensibilidade', 14, '1811', 'image/81eN74IRg4L._AC_UF1000,1000_QL80_.jpg', 0, 0),
(37, 'Ponciá Vicêncio', 15, '2003', 'image/81EULWTz2PL._AC_UL210_SR210,210_.jpg', 0, 0),
(38, 'Olhos d\'Água', 15, '2014', 'image/51RjYjNVpRL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(39, 'Beco da Memória', 15, '2021', 'image/81rKkgH1vgL._AC_UL210_SR210,210_.jpg', 0, 0),
(40, 'Bagagem', 16, '1976', 'image/81odwQ9uCxL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(41, 'O Coração Disparado', 16, '1980', 'image/41Wpip1zteL._SY580_.jpg', 0, 0),
(42, 'Triste Fim de Policarpo Quaresma', 17, '1915', 'image/91dS9YlzIWS._AC_UF1000,1000_QL80_.jpg', 0, 0),
(43, 'O Cemitério dos Vivos', 17, '1950', 'image/41187szsM0L._SY780_.jpg', 0, 0),
(44, 'A Obscena Senhora D', 18, '1990', 'image/91txP8kXKGL._AC_UF1000,1000_QL80_.jpg', 0, 0),
(45, 'As Aves da Noite: O visitante', 18, '1999', 'image/hilda_hilst_teatro_completo_1_9788525437617_hd.jpg', 0, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
