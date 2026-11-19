-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/11/2026 às 20:17
-- Versão do servidor: 10.11.16-MariaDB
-- Versão do PHP: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_printer3d`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id` int(11) NOT NULL,
  `cpf_cnpj` varchar(16) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `email` varchar(60) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`id`, `cpf_cnpj`, `nome`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `email`, `celular`, `operador`, `datatual`) VALUES
(1, '11111111111', 'Reinert', 'aaaaaaaaaaaaaaaaaa', '21', '', '', 'São Miguel do Oeste', 'SC', '89900-000', 'fabio@hotmail.com', '(11) 111111111', 1, NULL),
(2, '22222222222', 'Reinert2', 'aaaaaaaaaaa', '', '', '', '', '', '', 'fabio2@hotmail.com', '(11) 222222222', 1, NULL),
(3, '33333333333', 'Reinert3', '', '', '', '', '', '', '', 'fabio3@hotmail.com', '(11) 333333333', 1, NULL),
(4, '44444444444', 'Reinert4', '', '', '', '', '', '', '', 'fabio4@hotmail.com', '(11) 444444444', 1, NULL),
(5, '55555555555', 'Reinert5', '', '', '', '', '', '', '', 'fabio5@hotmail.com', '(11) 555555555', 1, NULL),
(6, '66666666666', 'Reinert6', '', '', '', '', '', '', '', 'fabio6@hotmail.com', '(11) 666666666', 1, NULL),
(7, '77777777777', 'Reinert7', '', '', '', '', '', '', '', 'fabio7@hotmail.com', '(11) 777777777', 1, NULL),
(8, '88888888888', 'Reinert8', '', '', '', '', '', '', '', 'fabio8@hotmail.com', '(11) 888888888', 1, NULL),
(9, '99999999999', 'Reinert9', '', '', '', '', '', '', '', 'fabio9@hotmail.com', '(11) 999999999', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_filamentos`
--

CREATE TABLE `tb_filamentos` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `cor` varchar(100) DEFAULT NULL,
  `valor` decimal(4,4) NOT NULL,
  `peso` decimal(2,0) NOT NULL,
  `qtde_estoque` int(11) NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_filamentos`
--

INSERT INTO `tb_filamentos` (`id`, `marca`, `tipo`, `cor`, `valor`, `peso`, `qtde_estoque`, `operador`, `datatual`) VALUES
(0, 'Filamento da marca de testes', 'Novo filamento', 'preta', 0.9999, 0, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_fornecedores`
--

CREATE TABLE `tb_fornecedores` (
  `id` int(11) NOT NULL,
  `cpf_cnpj` varchar(16) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `tb_fornecedores`
--

INSERT INTO `tb_fornecedores` (`id`, `cpf_cnpj`, `nome`, `endereco`, `bairro`, `cidade`, `estado`, `cep`, `email`, `telefone`, `celular`, `operador`, `datatual`) VALUES
(2, '57034192804', 'teste q', 'rua', NULL, NULL, NULL, NULL, 'fr@gmail.com', NULL, '11495555', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_impressoras`
--

CREATE TABLE `tb_impressoras` (
  `id` int(11) NOT NULL,
  `marca` varchar(250) DEFAULT NULL,
  `modelo` varchar(250) DEFAULT NULL,
  `qtrolos` int(11) NOT NULL,
  `ocupada` varchar(3) NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_impressoras`
--

INSERT INTO `tb_impressoras` (`id`, `marca`, `modelo`, `qtrolos`, `ocupada`, `operador`, `datatual`) VALUES
(1, 'Raken de fera', '1000', 2, 'NÃO', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_lojas`
--

CREATE TABLE `tb_lojas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `CNPJ` varchar(15) DEFAULT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_niveis`
--

CREATE TABLE `tb_niveis` (
  `id` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `tb_niveis`
--

INSERT INTO `tb_niveis` (`id`, `descricao`, `operador`, `datatual`) VALUES
(1, 'Administrador', NULL, NULL),
(2, 'Operador', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedidos`
--

CREATE TABLE `tb_pedidos` (
  `id_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `preco` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total_venda` float NOT NULL,
  `status` int(11) NOT NULL,
  `dataCompra` date NOT NULL,
  `dataPrevisao` date NOT NULL,
  `dataFinaliza` date NOT NULL,
  `dataEntrega` date NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedxfilamento`
--

CREATE TABLE `tb_pedxfilamento` (
  `id_pedido` int(11) NOT NULL,
  `id_filamento` int(11) NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedximpres`
--

CREATE TABLE `tb_pedximpres` (
  `id_pedido` int(11) NOT NULL,
  `id_impressora` int(11) NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(11) NOT NULL,
  `descricao` varchar(10) NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `descricao`, `operador`, `datatual`) VALUES
(1, 'A iniciar', NULL, NULL),
(2, 'Inciado', NULL, NULL),
(3, 'Finalizado', NULL, NULL),
(4, 'Entregue', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(10) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `senha` varchar(8) NOT NULL,
  `nivel` tinyint(4) NOT NULL,
  `salario` decimal(12,2) DEFAULT NULL,
  `comissao` decimal(5,2) DEFAULT NULL,
  `operador` int(11) DEFAULT NULL,
  `datatual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `tb_filamentos`
--
ALTER TABLE `tb_filamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_fornecedores`
--
ALTER TABLE `tb_fornecedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `tb_impressoras`
--
ALTER TABLE `tb_impressoras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_lojas`
--
ALTER TABLE `tb_lojas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_niveis`
--
ALTER TABLE `tb_niveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD PRIMARY KEY (`id_venda`);

--
-- Índices de tabela `tb_pedxfilamento`
--
ALTER TABLE `tb_pedxfilamento`
  ADD KEY `id_pedfilamento` (`id_pedido`,`id_filamento`);

--
-- Índices de tabela `tb_pedximpres`
--
ALTER TABLE `tb_pedximpres`
  ADD KEY `id_pedimpress` (`id_pedido`,`id_impressora`);

--
-- Índices de tabela `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tb_fornecedores`
--
ALTER TABLE `tb_fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_impressoras`
--
ALTER TABLE `tb_impressoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_lojas`
--
ALTER TABLE `tb_lojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_niveis`
--
ALTER TABLE `tb_niveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
