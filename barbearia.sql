-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/05/2026 às 02:16
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
-- Banco de dados: `barbearia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `servico` varchar(50) NOT NULL,
  `data_agendada` date NOT NULL,
  `horario` time NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `cliente`, `servico`, `data_agendada`, `horario`, `valor`, `id_usuario`) VALUES
(6, 'ronaldo fenomeno', 'Barba', '2026-05-29', '09:00:00', 20.00, 1),
(8, 'ronaldinho gaucho', 'Cabelo e Barba', '2026-05-12', '10:00:00', 50.00, 2),
(10, 'Ronaldo', 'Cabelo e Barba', '2026-05-16', '18:00:00', 50.00, 1),
(11, 'ronaldo fenomeno', 'Cabelo', '2026-05-20', '10:00:00', 30.00, 1),
(12, 'ronaldo fenomeno', 'Cabelo', '2026-06-05', '14:00:00', 30.00, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'ronaldo fenomeno', 'ronaldo@email.com', '$2y$10$Njb9kH6uUGj5nvqHlpZ4EOM6d9Iiz6/L./3KzU6YilPT0uO1EpzQS'),
(2, 'ronaldinho gaucho', 'r10gaucho@email.com', '$2y$10$A4r9QVIohtaTdaF4bDhJf.Z5.Z5IGoVZ.TwYZhNO0W8Q0duGaTgXm'),
(3, 'teste 1', 'teste@email.com', '$2y$10$1pQxe2M1XQxWrZL5siofiuF2sgClrVuOe7946op/s3GGxyfXOEMlu');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_data_horario` (`data_agendada`,`horario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
