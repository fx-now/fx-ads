-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 08/05/2020 às 14:51
-- Versão do servidor: 5.5.52-0+deb8u1
-- Versão do PHP: 5.6.40-0+deb8u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `w3v4g8_fxads`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios`
--

CREATE TABLE IF NOT EXISTS `anuncios` (
`id` int(11) NOT NULL,
  `chave` text NOT NULL,
  `idcidade` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `titulo` text,
  `descricao` text,
  `endereco` text NOT NULL,
  `bairro` text NOT NULL,
  `foto` text NOT NULL,
  `preco` int(10) NOT NULL DEFAULT '0',
  `categoria` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `plano` int(1) NOT NULL DEFAULT '0',
  `comentarios` int(1) NOT NULL DEFAULT '1',
  `dataexpira` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `foto2` text NOT NULL,
  `foto3` text NOT NULL,
  `foto4` text NOT NULL,
  `foto5` text NOT NULL,
  `telefone` text NOT NULL,
  `whatsapp` text NOT NULL,
  `email` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `instagram` text NOT NULL,
  `gmaps` text NOT NULL,
  `teleentrega` int(1) NOT NULL DEFAULT '0',
  `teleentregagratis` int(1) NOT NULL DEFAULT '0',
  `seg1` text NOT NULL,
  `seg2` text NOT NULL,
  `seg3` text NOT NULL,
  `seg4` text NOT NULL,
  `ter1` text NOT NULL,
  `ter2` text NOT NULL,
  `ter3` text NOT NULL,
  `ter4` text NOT NULL,
  `qua1` text NOT NULL,
  `qua2` text NOT NULL,
  `qua3` text NOT NULL,
  `qua4` text NOT NULL,
  `qui1` text NOT NULL,
  `qui2` text NOT NULL,
  `qui3` text NOT NULL,
  `qui4` text NOT NULL,
  `sex1` text NOT NULL,
  `sex2` text NOT NULL,
  `sex3` text NOT NULL,
  `sex4` text NOT NULL,
  `sab1` text NOT NULL,
  `sab2` text NOT NULL,
  `sab3` text NOT NULL,
  `sab4` text NOT NULL,
  `dom1` text NOT NULL,
  `dom2` text NOT NULL,
  `dom3` text NOT NULL,
  `dom4` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios_favoritos`
--

CREATE TABLE IF NOT EXISTS `anuncios_favoritos` (
`id` int(11) NOT NULL,
  `idanuncio` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
`id` int(11) NOT NULL,
  `idcidade` int(11) DEFAULT NULL,
  `espaco` int(1) DEFAULT NULL,
  `img` text,
  `link` text,
  `visualizacoes` int(11) DEFAULT '0',
  `cliques` int(11) DEFAULT '0',
  `dataexpira` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`id` int(11) NOT NULL,
  `nome` text,
  `catmae` int(11) DEFAULT '0',
  `ordem` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE IF NOT EXISTS `cidades` (
`id` int(11) NOT NULL,
  `nome` text,
  `nomeuf` text,
  `lat` text,
  `lon` text,
  `idadm` int(11) DEFAULT '1',
  `telefone` text NOT NULL,
  `email` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `instagram` text NOT NULL,
  `valordestaque` int(2) NOT NULL DEFAULT '15',
  `googleplay` text NOT NULL,
  `status` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pesquisas`
--

CREATE TABLE IF NOT EXISTS `pesquisas` (
`id` int(11) NOT NULL,
  `idcidade` int(11) NOT NULL,
  `termo` text,
  `contador` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessoes`
--

CREATE TABLE IF NOT EXISTS `sessoes` (
`id` int(11) NOT NULL,
  `ids` varchar(128) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `senha` varchar(128) DEFAULT NULL,
  `sessao` varchar(128) DEFAULT NULL,
  `ultimoacesso` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `idcidade` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(128) DEFAULT NULL,
  `nivel` int(1) DEFAULT '3',
  `anunciospagos` int(11) NOT NULL DEFAULT '0',
  `anunciosusados` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `anuncios`
--
ALTER TABLE `anuncios`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `anuncios_favoritos`
--
ALTER TABLE `anuncios_favoritos`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `banners`
--
ALTER TABLE `banners`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pesquisas`
--
ALTER TABLE `pesquisas`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sessoes`
--
ALTER TABLE `sessoes`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de tabela `anuncios_favoritos`
--
ALTER TABLE `anuncios_favoritos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `pesquisas`
--
ALTER TABLE `pesquisas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de tabela `sessoes`
--
ALTER TABLE `sessoes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

