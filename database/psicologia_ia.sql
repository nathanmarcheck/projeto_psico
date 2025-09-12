-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/09/2025 às 03:13
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
-- Banco de dados: `psicologia_ia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `conversa`
--

CREATE TABLE `conversa` (
  `id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `remetente` enum('cliente','ia') NOT NULL,
  `mensagem` text NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conversas`
--

CREATE TABLE `conversas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `remetente` enum('cliente','ia') NOT NULL,
  `mensagem` text NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conversas`
--

INSERT INTO `conversas` (`id`, `usuario_id`, `remetente`, `mensagem`, `criado_em`) VALUES
(79, 13, 'cliente', 'oi tudo bem?', '2025-09-11 22:57:39'),
(80, 13, 'ia', '⚠️ Erro: {\"error\":{\"message\":\"Incorrect API key provided: AQUI III**********************************IIII. You can find your API key at https:\\/\\/platform.openai.com\\/account\\/api-keys.\",\"type\":\"invalid_request_error\",\"param\":null,\"code\":\"invalid_api_key\"}}', '2025-09-11 22:57:40'),
(81, 13, 'cliente', 'oi', '2025-09-11 22:58:04'),
(82, 13, 'ia', 'Oi! Como você está se sentindo hoje? Há algo específico que gostaria de compartilhar ou discutir?', '2025-09-11 22:58:06'),
(83, 13, 'cliente', 'sonhei com umas coisa hj', '2025-09-11 22:58:18'),
(84, 13, 'ia', 'Fico curioso para saber sobre o seu sonho. Os sonhos muitas vezes têm um significado profundo e podem revelar muito sobre nossos sentimentos e conflitos internos. Você se sentiria à vontade para compartilhar o que aconteceu no sonho? Quais foram as imagens, emoções ou situações que você vivenciou?', '2025-09-11 22:58:20'),
(85, 14, 'cliente', 'ola', '2025-09-12 01:08:03'),
(86, 14, 'ia', 'Olá! Como você está se sentindo hoje? Há algo específico que gostaria de explorar ou discutir?', '2025-09-12 01:08:05'),
(87, 14, 'cliente', 'estou ansioso', '2025-09-12 01:08:41'),
(88, 14, 'ia', 'Entendo que a ansiedade pode ser uma experiência difícil de lidar. Muitas vezes, a ansiedade está ligada a pensamentos, memórias ou situações que podem estar enterradas em nosso inconsciente. Para começarmos a explorar isso juntos, que tal falarmos sobre o que está causando essa ansiedade? Você consegue identificar alguma situação específica, pensamento ou até mesmo um sonho que esteja contribuindo para esse sentimento?', '2025-09-12 01:08:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('cliente','psicologo','admin') DEFAULT 'cliente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `criado_em`) VALUES
(1, 'Nathan Teste', 'nathan@email.com', '1234', 'cliente', '2025-09-07 18:09:57'),
(10, 'teste', 'teste@gmail.com', '$2y$10$UnqdLV5dyBdPukviD/XQbeziYMQgSacS8gZUuunVGFgTExFgprz8e', 'cliente', '2025-09-09 22:31:16'),
(11, 'Nathan', 'nathanmarcheckneves@gmail.com', '$2y$10$r9Zxv8pq2fZGPJIjLZB/POfUV.xTkdsHFPvpMLTER3b.V9zurcxcq', 'psicologo', '2025-09-11 00:06:30'),
(12, 'teste2', 'teste2@gmail.com', '$2y$10$eZXVjk7FejCAjblDrBwz.ebnQXmnHTJGpuD2e/zEA/xKa93yxhqk.', 'cliente', '2025-09-11 00:29:26'),
(13, 'teste3', 'teste3@gmail.com', '$2y$10$.gvfZfiOQwuprOe7BgXGsOm7PX6fVjvRMYKXLfRU8k.yzeJ5obfpO', 'cliente', '2025-09-11 22:57:20'),
(14, 'teste4', 'teste4@gmail.com', '$2y$10$OX9NNk9eenE01ZLKCN8a9O4pkJaeIJpHB1ba41V/QGQ1Ew0Ss2J1i', 'cliente', '2025-09-12 01:07:03');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `conversa`
--
ALTER TABLE `conversa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id` (`usuarios_id`);

--
-- Índices de tabela `conversas`
--
ALTER TABLE `conversas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `conversa`
--
ALTER TABLE `conversa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conversas`
--
ALTER TABLE `conversas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `conversa`
--
ALTER TABLE `conversa`
  ADD CONSTRAINT `conversa_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `conversas`
--
ALTER TABLE `conversas`
  ADD CONSTRAINT `conversas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
