-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Nov-2021 às 18:24
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ac_sistemas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `cd_album` int(11) NOT NULL AUTO_INCREMENT,
  `cd_evento` int(11) NOT NULL,
  `ds_album` varchar(50) DEFAULT NULL,
  `ft_caminho` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_album`),
  KEY `fk1044_idx` (`cd_album`),
  KEY `fk10444_idx` (`cd_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `album`
--

INSERT INTO `album` (`cd_album`, `cd_evento`, `ds_album`, `ft_caminho`) VALUES
(1, 1, 'Imagem 1', 'arquivos/uploads_evento_albuns/1510375231274726496202111021550.jpg'),
(2, 1, 'Imagem 2', 'arquivos/uploads_evento_albuns/2198345797870268860202111021550.jpg'),
(3, 1, 'Imagem 3', 'arquivos/uploads_evento_albuns/303907835771163116202111021550.jpg'),
(4, 1, 'Imagem 4', 'arquivos/uploads_evento_albuns/244124258179582326202111021550.jpg'),
(5, 1, 'Imagem 5', 'arquivos/uploads_evento_albuns/1331717015177671590202111021550jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

DROP TABLE IF EXISTS `cadastro`;
CREATE TABLE IF NOT EXISTS `cadastro` (
  `cd_cadastro` int(11) NOT NULL AUTO_INCREMENT,
  `nm_cadastro` varchar(50) NOT NULL,
  `dt_nascto` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `co_complemento` varchar(80) DEFAULT NULL,
  `nr_endereco` varchar(5) DEFAULT NULL,
  `ba_cadastro` varchar(50) DEFAULT NULL,
  `cd_cidade` int(11) NOT NULL,
  `ed_cadastro` varchar(80) DEFAULT NULL,
  `nr_cep` varchar(9) DEFAULT NULL,
  `nr_cpf` varchar(14) NOT NULL,
  `nr_rg` varchar(9) NOT NULL,
  `ed_email` varchar(80) DEFAULT NULL,
  `nr_telefone` varchar(14) DEFAULT NULL,
  `nr_contato` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`cd_cadastro`),
  UNIQUE KEY `nr_rg_unique` (`nr_rg`),
  UNIQUE KEY `nr_cpf_unique` (`nr_cpf`),
  KEY `fk102_idx` (`cd_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`cd_cadastro`, `nm_cadastro`, `dt_nascto`, `sexo`, `co_complemento`, `nr_endereco`, `ba_cadastro`, `cd_cidade`, `ed_cadastro`, `nr_cep`, `nr_cpf`, `nr_rg`, `ed_email`, `nr_telefone`, `nr_contato`) VALUES
(1, 'Vitor Souza', '1990-05-11', 'M', NULL, '111', 'bairro teste', 70, 'teste endereco', '88810563', '88072590014', '55555554', 'vitorsouza@gmail.com', '4812345678', '48123456789'),
(2, 'Maria Augusta', '1997-08-10', 'F', NULL, '111', 'bairro teste', 70, 'teste endereco', '88810563', '10842255907', '55555g54', 'mariaaugusta@gmail.com', '4812345678', NULL),
(3, 'Alfredo Neves', '1995-05-27', 'M', NULL, '111', 'bairro teste', 70, 'teste endereco', '88810563', '431.298.700-91', '55555c54', 'alfredoneves@gmail.com', NULL, '48123456789'),
(4, 'Ricardo da Silva', '1995-05-27', 'M', NULL, '111', 'bairro teste', 70, 'teste endereco', '88810563', '14838921071', '55555c52', 'ricardosilva@gmail.com', NULL, NULL),
(5, 'Patricia Lemos', '1995-05-27', 'F', NULL, 'sdd', 'dsasda', 4, 'asdfdfdf', '88815320', '02778306056', '027.783.0', 'patricialemos@gmail.com', NULL, NULL),
(6, 'Jose antonio', '1997-06-11', 'M', NULL, '275', 'bairro teste', 10, 'endereÃ§o teste', '88818300', '70650449045', '42.062.11', 'joseantonio@gmail.com', NULL, NULL),
(7, 'Pedro Paulo', '1990-11-05', 'M', NULL, '111', 'bairro teste', 70, 'teste endereco', '88810563', '43129870091', '55555c544', 'pedropaulo@gmail.com', NULL, NULL),
(8, 'Vitoria Reis', '1995-05-27', 'F', NULL, '275', 'hfhhfg', 5, 'sdfsdfd', '72450160', '55252444030', '22.278.40', 'vitoriareis@gmail.com', NULL, NULL),
(9, 'Maria Eduarda', '1995-05-27', 'F', NULL, '344', 'sdfsdf', 6, 'fsdfsdf', '74391291', '45200316057', '21.322.60', 'mariaeduarda@gmail.com', NULL, NULL),
(10, 'Ana Paula Souza', '1995-05-27', 'F', NULL, 'fggd', 'dgdfg', 5, 'dgfdgf', '59090615', '30627636047', 'gdfgdfg', 'anapaulasouza@gmail.com', NULL, NULL),
(11, 'AdmnistraÃ§Ã£o Blablabla', '1990-07-14', 'M', NULL, '000', 'Centro', 70, 'teste', '88818120', '34173818009', '23.884.92', 'admblablabla@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE IF NOT EXISTS `cidade` (
  `cd_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `nm_cidade` varchar(50) NOT NULL,
  `uf_cidade` char(2) NOT NULL,
  PRIMARY KEY (`cd_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`cd_cidade`, `nm_cidade`, `uf_cidade`) VALUES
(1, 'Ãguas de ChapecÃ³', 'SC'),
(2, 'Ãguas Frias', 'SC'),
(3, 'Ãguas Mornas', 'SC'),
(4, 'Alfredo Wagner', 'SC'),
(5, 'Alto Bela Vista', 'SC'),
(6, 'Anchieta', 'SC'),
(7, 'Angelina', 'SC'),
(8, 'Anita Garibaldi', 'SC'),
(9, 'AnitÃ¡polis', 'SC'),
(10, 'AntÃ´nio Carlos', 'SC'),
(11, 'ApiÃºna', 'SC'),
(12, 'ArabutÃ£', 'SC'),
(13, 'Araquari', 'SC'),
(14, 'AraranguÃ¡', 'SC'),
(15, 'ArmazÃ©m', 'SC'),
(16, 'Arroio Trinta', 'SC'),
(17, 'Arvoredo', 'SC'),
(18, 'Ascurra', 'SC'),
(19, 'Atalanta', 'SC'),
(20, 'Aurora', 'SC'),
(21, 'BalneÃ¡rio Arroio do Silva', 'SC'),
(22, 'BalneÃ¡rio Barra do Sul', 'SC'),
(23, 'BalneÃ¡rio CamboriÃº', 'SC'),
(24, 'BalneÃ¡rio Gaivota', 'SC'),
(25, 'Bandeirante', 'SC'),
(26, 'Barra Bonita', 'SC'),
(27, 'Barra Velha', 'SC'),
(28, 'Bela Vista do Toldo', 'SC'),
(29, 'Belmonte', 'SC'),
(30, 'Benedito Novo', 'SC'),
(31, 'BiguaÃ§u', 'SC'),
(32, 'Blumenau', 'SC'),
(33, 'Bocaina do Sul', 'SC'),
(34, 'Bom Jardim da Serra', 'SC'),
(35, 'Bom Jesus', 'SC'),
(36, 'Bom Jesus do Oeste', 'SC'),
(37, 'Bom Retiro', 'SC'),
(38, 'Bombinhas', 'SC'),
(39, 'BotuverÃ¡', 'SC'),
(40, 'BraÃ§o do Norte', 'SC'),
(41, 'BraÃ§o do Trombudo', 'SC'),
(42, 'BrunÃ³polis', 'SC'),
(43, 'Brusque', 'SC'),
(44, 'CaÃ§ador', 'SC'),
(45, 'Caibi', 'SC'),
(46, 'Calmon', 'SC'),
(47, 'CamboriÃº', 'SC'),
(48, 'Campo Alegre', 'SC'),
(49, 'Campo Belo do Sul', 'SC'),
(50, 'Campo ErÃª', 'SC'),
(51, 'Campos Novos', 'SC'),
(52, 'Canelinha', 'SC'),
(53, 'Canoinhas', 'SC'),
(54, 'CapÃ£o Alto', 'SC'),
(55, 'Capinzal', 'SC'),
(56, 'Capivari de Baixo', 'SC'),
(57, 'Catanduvas', 'SC'),
(58, 'Caxambu do Sul', 'SC'),
(59, 'Celso Ramos', 'SC'),
(60, 'Cerro Negro', 'SC'),
(61, 'ChapadÃ£o do Lageado', 'SC'),
(62, 'ChapecÃ³', 'SC'),
(63, 'Cocal do Sul', 'SC'),
(64, 'ConcÃ³rdia', 'SC'),
(65, 'Cordilheira Alta', 'SC'),
(66, 'Coronel Freitas', 'SC'),
(67, 'Coronel Martins', 'SC'),
(68, 'Correia Pinto', 'SC'),
(69, 'CorupÃ¡', 'SC'),
(70, 'CriciÃºma', 'SC'),
(71, 'Cunha PorÃ£', 'SC'),
(72, 'CunhataÃ­', 'SC'),
(73, 'Curitibanos', 'SC'),
(74, 'Descanso', 'SC'),
(75, 'DionÃ­sio Cerqueira', 'SC'),
(76, 'Dona Emma', 'SC'),
(77, 'Doutor Pedrinho', 'SC'),
(78, 'Entre Rios', 'SC'),
(79, 'Ermo', 'SC'),
(80, 'Erval Velho', 'SC'),
(81, 'Faxinal dos Guedes', 'SC'),
(82, 'Flor do SertÃ£o', 'SC'),
(83, 'FlorianÃ³polis', 'SC'),
(84, 'Formosa do Sul', 'SC'),
(85, 'Forquilhinha', 'SC'),
(86, 'Fraiburgo', 'SC'),
(87, 'Frei RogÃ©rio', 'SC'),
(88, 'GalvÃ£o', 'SC'),
(89, 'Garopaba', 'SC'),
(90, 'Garuva', 'SC'),
(91, 'Gaspar', 'SC'),
(92, 'Governador Celso Ramos', 'SC'),
(93, 'GrÃ£o ParÃ¡', 'SC'),
(94, 'Gravatal', 'SC'),
(95, 'Guabiruba', 'SC'),
(96, 'Guaraciaba', 'SC'),
(97, 'Guaramirim', 'SC'),
(98, 'GuarujÃ¡ do Sul', 'SC'),
(99, 'GuatambÃº', 'SC'),
(100, 'Herval d`Oeste', 'SC'),
(101, 'Ibiam', 'SC'),
(102, 'IbicarÃ©', 'SC'),
(103, 'Ibirama', 'SC'),
(104, 'IÃ§ara', 'SC'),
(105, 'Ilhota', 'SC'),
(106, 'ImaruÃ­', 'SC'),
(107, 'Imbituba', 'SC'),
(108, 'Imbuia', 'SC'),
(109, 'Indaial', 'SC'),
(110, 'IomerÃª', 'SC'),
(111, 'Ipira', 'SC'),
(112, 'IporÃ£ do Oeste', 'SC'),
(113, 'IpuaÃ§u', 'SC'),
(114, 'Ipumirim', 'SC'),
(115, 'Iraceminha', 'SC'),
(116, 'Irani', 'SC'),
(117, 'Irati', 'SC'),
(118, 'IrineÃ³polis', 'SC'),
(119, 'ItÃ¡', 'SC'),
(120, 'ItaiÃ³polis', 'SC'),
(121, 'ItajaÃ­', 'SC'),
(122, 'Itapema', 'SC'),
(123, 'Itapiranga', 'SC'),
(124, 'ItapoÃ¡', 'SC'),
(125, 'Ituporanga', 'SC'),
(126, 'JaborÃ¡', 'SC'),
(127, 'Jacinto Machado', 'SC'),
(128, 'Jaguaruna', 'SC'),
(129, 'JaraguÃ¡ do Sul', 'SC'),
(130, 'JardinÃ³polis', 'SC'),
(131, 'JoaÃ§aba', 'SC'),
(132, 'Joinville', 'SC'),
(133, 'JosÃ© Boiteux', 'SC'),
(134, 'JupiÃ¡', 'SC'),
(135, 'LacerdÃ³polis', 'SC'),
(136, 'Lages', 'SC'),
(137, 'Laguna', 'SC'),
(138, 'Lajeado Grande', 'SC'),
(139, 'Laurentino', 'SC'),
(140, 'Lauro Muller', 'SC'),
(141, 'Lebon RÃ©gis', 'SC'),
(142, 'Leoberto Leal', 'SC'),
(143, 'LindÃ³ia do Sul', 'SC'),
(144, 'Lontras', 'SC'),
(145, 'Luiz Alves', 'SC'),
(146, 'Luzerna', 'SC'),
(147, 'Macieira', 'SC'),
(148, 'Mafra', 'SC'),
(149, 'Major Gercino', 'SC'),
(150, 'Major Vieira', 'SC'),
(151, 'MaracajÃ¡', 'SC'),
(152, 'Maravilha', 'SC'),
(153, 'Marema', 'SC'),
(154, 'Massaranduba', 'SC'),
(155, 'Matos Costa', 'SC'),
(156, 'Meleiro', 'SC'),
(157, 'Mirim Doce', 'SC'),
(158, 'Modelo', 'SC'),
(159, 'MondaÃ­', 'SC'),
(160, 'Monte Carlo', 'SC'),
(161, 'Monte Castelo', 'SC'),
(162, 'Morro da FumaÃ§a', 'SC'),
(163, 'Morro Grande', 'SC'),
(164, 'Navegantes', 'SC'),
(165, 'Nova Erechim', 'SC'),
(166, 'Nova Itaberaba', 'SC'),
(167, 'Nova Trento', 'SC'),
(168, 'Nova Veneza', 'SC'),
(169, 'Novo Horizonte', 'SC'),
(170, 'Orleans', 'SC'),
(171, 'OtacÃ­lio Costa', 'SC'),
(172, 'Ouro', 'SC'),
(173, 'Ouro Verde', 'SC'),
(174, 'Paial', 'SC'),
(175, 'Painel', 'SC'),
(176, 'PalhoÃ§a', 'SC'),
(177, 'Palma Sola', 'SC'),
(178, 'Palmeira', 'SC'),
(179, 'Palmitos', 'SC'),
(180, 'Papanduva', 'SC'),
(181, 'ParaÃ­so', 'SC'),
(182, 'Passo de Torres', 'SC'),
(183, 'Passos Maia', 'SC'),
(184, 'Paulo Lopes', 'SC'),
(185, 'Pedras Grandes', 'SC'),
(186, 'Penha', 'SC'),
(187, 'Peritiba', 'SC'),
(188, 'PetrolÃ¢ndia', 'SC'),
(189, 'PiÃ§arras', 'SC'),
(190, 'Pinhalzinho', 'SC'),
(191, 'Pinheiro Preto', 'SC'),
(192, 'Piratuba', 'SC'),
(193, 'Planalto Alegre', 'SC'),
(194, 'Pomerode', 'SC'),
(195, 'Ponte Alta', 'SC'),
(196, 'Ponte Alta do Norte', 'SC'),
(197, 'Ponte Serrada', 'SC'),
(198, 'Porto Belo', 'SC'),
(199, 'Porto UniÃ£o', 'SC'),
(200, 'Pouso Redondo', 'SC'),
(201, 'Praia Grande', 'SC'),
(202, 'Presidente Castelo Branco', 'SC'),
(203, 'Presidente GetÃºlio', 'SC'),
(204, 'Presidente Nereu', 'SC'),
(205, 'Princesa', 'SC'),
(206, 'Quilombo', 'SC'),
(207, 'Rancho Queimado', 'SC'),
(208, 'Rio das Antas', 'SC'),
(209, 'Rio do Campo', 'SC'),
(210, 'Rio do Oeste', 'SC'),
(211, 'Rio do Sul', 'SC'),
(212, 'Rio dos Cedros', 'SC'),
(213, 'Rio Fortuna', 'SC'),
(214, 'Rio Negrinho', 'SC'),
(215, 'Rio Rufino', 'SC'),
(216, 'Riqueza', 'SC'),
(217, 'Rodeio', 'SC'),
(218, 'RomelÃ¢ndia', 'SC'),
(219, 'Salete', 'SC'),
(220, 'Saltinho', 'SC'),
(221, 'Salto Veloso', 'SC'),
(222, 'SangÃ£o', 'SC'),
(223, 'Santa CecÃ­lia', 'SC'),
(224, 'Santa Helena', 'SC'),
(225, 'Santa Rosa de Lima', 'SC'),
(226, 'Santa Rosa do Sul', 'SC'),
(227, 'Santa Terezinha', 'SC'),
(228, 'Santa Terezinha do Progresso', 'SC'),
(229, 'Santiago do Sul', 'SC'),
(230, 'Santo Amaro da Imperatriz', 'SC'),
(231, 'SÃ£o Bento do Sul', 'SC'),
(232, 'SÃ£o Bernardino', 'SC'),
(233, 'SÃ£o BonifÃ¡cio', 'SC'),
(234, 'SÃ£o Carlos', 'SC'),
(235, 'SÃ£o CristovÃ£o do Sul', 'SC'),
(236, 'SÃ£o Domingos', 'SC'),
(237, 'SÃ£o Francisco do Sul', 'SC'),
(238, 'SÃ£o JoÃ£o Batista', 'SC'),
(239, 'SÃ£o JoÃ£o do ItaperiÃº', 'SC'),
(240, 'SÃ£o JoÃ£o do Oeste', 'SC'),
(241, 'SÃ£o JoÃ£o do Sul', 'SC'),
(242, 'SÃ£o Joaquim', 'SC'),
(243, 'SÃ£o JosÃ©', 'SC'),
(244, 'SÃ£o JosÃ© do Cedro', 'SC'),
(245, 'SÃ£o JosÃ© do Cerrito', 'SC'),
(246, 'SÃ£o LourenÃ§o do Oeste', 'SC'),
(247, 'SÃ£o Ludgero', 'SC'),
(248, 'SÃ£o Martinho', 'SC'),
(249, 'SÃ£o Miguel da Boa Vista', 'SC'),
(250, 'SÃ£o Miguel do Oeste', 'SC'),
(251, 'SÃ£o Pedro de AlcÃ¢ntara', 'SC'),
(252, 'Saudades', 'SC'),
(253, 'Schroeder', 'SC'),
(254, 'Seara', 'SC'),
(255, 'Serra Alta', 'SC'),
(256, 'SiderÃ³polis', 'SC'),
(257, 'Sombrio', 'SC'),
(258, 'Sul Brasil', 'SC'),
(259, 'TaiÃ³', 'SC'),
(260, 'TangarÃ¡', 'SC'),
(261, 'Tigrinhos', 'SC'),
(262, 'Tijucas', 'SC'),
(263, 'TimbÃ© do Sul', 'SC'),
(264, 'TimbÃ³', 'SC'),
(265, 'TimbÃ³ Grande', 'SC'),
(266, 'TrÃªs Barras', 'SC'),
(267, 'Treviso', 'SC'),
(268, 'Treze de Maio', 'SC'),
(269, 'Treze TÃ­lias', 'SC'),
(270, 'Trombudo Central', 'SC'),
(271, 'TubarÃ£o', 'SC'),
(272, 'TunÃ¡polis', 'SC'),
(273, 'Turvo', 'SC'),
(274, 'UniÃ£o do Oeste', 'SC'),
(275, 'Urubici', 'SC'),
(276, 'Urupema', 'SC'),
(277, 'Urussanga', 'SC'),
(278, 'VargeÃ£o', 'SC'),
(279, 'Vargem', 'SC'),
(280, 'Vargem Bonita', 'SC'),
(281, 'Vidal Ramos', 'SC'),
(282, 'Videira', 'SC'),
(283, 'Vitor Meireles', 'SC'),
(284, 'Witmarsum', 'SC'),
(285, 'XanxerÃª', 'SC'),
(286, 'Xavantina', 'SC'),
(287, 'Xaxim', 'SC'),
(288, 'ZortÃ©a', 'SC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `cd_cadastro` int(11) NOT NULL,
  `cd_compra` int(11) NOT NULL AUTO_INCREMENT,
  `cd_fpagto` int(11) NOT NULL,
  `dt_compra` timestamp NOT NULL,
  `vl_total` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`cd_compra`),
  KEY `fk103_idx` (`cd_cadastro`),
  KEY `fk203` (`cd_fpagto`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`cd_cadastro`, `cd_compra`, `cd_fpagto`, `dt_compra`, `vl_total`) VALUES
(6, 12, 2, '2021-10-31 20:05:46', '250.00'),
(6, 13, 3, '2021-10-31 20:07:12', '130.00'),
(1, 14, 3, '2021-10-31 23:40:45', '20.00'),
(8, 15, 3, '2021-11-01 03:18:53', '80.00'),
(1, 16, 2, '2021-11-01 04:24:19', '160.00'),
(2, 17, 2, '2021-11-01 04:25:22', '240.00'),
(3, 18, 3, '2021-11-01 04:25:56', '160.00'),
(4, 19, 2, '2021-11-01 04:26:49', '320.00'),
(5, 20, 3, '2021-11-01 04:27:36', '80.00'),
(9, 21, 3, '2021-11-01 04:28:07', '160.00'),
(7, 22, 1, '2021-11-01 04:28:47', '400.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comprait`
--

DROP TABLE IF EXISTS `comprait`;
CREATE TABLE IF NOT EXISTS `comprait` (
  `cd_compra` int(11) NOT NULL,
  `cd_ingresso` int(11) NOT NULL,
  `qt_compra` int(11) NOT NULL,
  `vl_compra` decimal(18,2) NOT NULL,
  PRIMARY KEY (`cd_compra`,`cd_ingresso`),
  KEY `cd_ingresso_idx` (`cd_ingresso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comprait`
--

INSERT INTO `comprait` (`cd_compra`, `cd_ingresso`, `qt_compra`, `vl_compra`) VALUES
(12, 2, 2, '100.00'),
(12, 3, 2, '25.00'),
(13, 5, 2, '20.00'),
(13, 6, 3, '30.00'),
(14, 1, 1, '20.00'),
(15, 4, 1, '80.00'),
(16, 4, 2, '80.00'),
(17, 4, 3, '80.00'),
(18, 4, 2, '80.00'),
(19, 4, 4, '80.00'),
(20, 4, 1, '80.00'),
(21, 4, 2, '80.00'),
(22, 4, 5, '80.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `cd_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nm_rsocial` varchar(50) NOT NULL,
  `nm_fantasia` varchar(50) NOT NULL,
  `ed_email` varchar(80) DEFAULT NULL,
  `nr_contato` varchar(14) DEFAULT NULL,
  `nr_telefone` varchar(14) DEFAULT NULL,
  `ft_logo` varchar(255) DEFAULT NULL,
  `ft_logosrc` blob,
  `cd_cidade` int(11) NOT NULL,
  `ft_baner` varchar(255) DEFAULT NULL,
  `ft_banerscr` blob,
  PRIMARY KEY (`cd_empresa`),
  KEY `fk101_idx` (`cd_cidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `cd_evento` int(11) NOT NULL AUTO_INCREMENT,
  `cd_cidade` int(11) NOT NULL,
  `cd_promocao` int(11) DEFAULT NULL,
  `ds_evento` varchar(50) NOT NULL,
  `ds_local` varchar(50) NOT NULL,
  `dt_evento` date NOT NULL,
  `ft_caminho` varchar(255) DEFAULT NULL,
  `ft_evento` blob,
  `sn_cancelado` char(1) DEFAULT NULL,
  `vl_venda` decimal(18,2) NOT NULL,
  `vl_promocao` decimal(18,2) DEFAULT NULL,
  `nr_classifi` int(11) DEFAULT NULL,
  `cd_tipoevento` int(11) NOT NULL,
  `hr_evento` time NOT NULL,
  `nr_lotacao` int(11) NOT NULL,
  `publica` char(1) NOT NULL DEFAULT 'N',
  `dt_publica` datetime DEFAULT NULL,
  PRIMARY KEY (`cd_evento`),
  KEY `fk104_idx` (`cd_cidade`),
  KEY `fk204_idx` (`cd_promocao`),
  KEY `fk304_idx` (`cd_tipoevento`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`cd_evento`, `cd_cidade`, `cd_promocao`, `ds_evento`, `ds_local`, `dt_evento`, `ft_caminho`, `ft_evento`, `sn_cancelado`, `vl_venda`, `vl_promocao`, `nr_classifi`, `cd_tipoevento`, `hr_evento`, `nr_lotacao`, `publica`, `dt_publica`) VALUES
(1, 70, NULL, 'Show Gusttavo Lima', 'Ginasio', '2021-11-02', 'arquivos/uploads_evento/225962606625243596202110192345.jpg', NULL, NULL, '90.00', NULL, NULL, 4, '12:00:00', 1000, 'S', '2021-11-02 13:00:24'),
(2, 61, NULL, 'Show Ivete Sangalo', 'Ginasio', '2022-03-21', 'arquivos/uploads_evento/1089548478331145980202110180119.png', NULL, NULL, '100.00', NULL, 10, 4, '13:00:00', 2, 'S', '2021-11-02 13:00:24'),
(3, 70, 2, 'Palestra motivacional', 'Ginasio 2', '2022-03-21', 'arquivos/uploads_evento/1157140418406253351202110180120.jpg', NULL, NULL, '25.00', '15.00', 14, 5, '20:00:00', 2, 'S', '2021-11-02 13:00:24'),
(4, 72, 3, 'Evento de incentivo a leitura', 'Ginasio', '2022-03-25', NULL, NULL, NULL, '50.00', '20.00', NULL, 3, '12:00:00', 1000, 'S', '2021-11-02 13:00:24'),
(5, 69, 3, 'Curso bÃ¡sico de programaÃ§Ã£o web', 'Ginasio', '2022-03-16', 'arquivos/uploads_evento/848097837731818151202111021413.jpg', NULL, NULL, '70.00', '20.00', NULL, 1, '08:00:00', 1000, 'S', '2021-11-02 13:00:24'),
(6, 1, NULL, 'Curso de mÃ¡gica', 'Ginasio', '2021-11-06', 'arquivos/uploads_evento/52839379419850508202110180130.jpg', NULL, NULL, '30.00', NULL, NULL, 3, '15:00:00', 3, 'S', '2021-11-02 13:00:24'),
(7, 3, NULL, 'Show Wesley safadÃ£o', 'Ginasio', '2022-01-29', 'arquivos/uploads_evento/863015299628290534202110180123.jpg', NULL, NULL, '80.00', NULL, NULL, 4, '19:00:00', 1000, 'S', '2021-11-02 13:00:24'),
(11, 37, 3, 'evento de teste', 'local teste', '2021-12-22', NULL, NULL, NULL, '100.00', '20.00', 10, 5, '14:00:00', 2, 'S', '2021-11-02 16:27:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fpagamento`
--

DROP TABLE IF EXISTS `fpagamento`;
CREATE TABLE IF NOT EXISTS `fpagamento` (
  `cd_fpagto` int(11) NOT NULL AUTO_INCREMENT,
  `ds_fpagto` varchar(50) NOT NULL,
  `qt_parcela` int(11) DEFAULT NULL,
  `vl_min` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`cd_fpagto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fpagamento`
--

INSERT INTO `fpagamento` (`cd_fpagto`, `ds_fpagto`, `qt_parcela`, `vl_min`) VALUES
(1, '3x no cartÃ£o de crÃ©dito', 3, '150.00'),
(2, '2x no cartÃ£o de crÃ©dito', 2, '100.00'),
(3, 'Avista', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fpagamentoit`
--

DROP TABLE IF EXISTS `fpagamentoit`;
CREATE TABLE IF NOT EXISTS `fpagamentoit` (
  `cd_fpagtoit` int(11) NOT NULL AUTO_INCREMENT,
  `cd_fpagto` int(11) NOT NULL,
  `nr_parcela` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_fpagtoit`,`cd_fpagto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingresso`
--

DROP TABLE IF EXISTS `ingresso`;
CREATE TABLE IF NOT EXISTS `ingresso` (
  `cd_ingresso` int(11) NOT NULL AUTO_INCREMENT,
  `ds_ingresso` varchar(50) NOT NULL,
  `cd_evento` int(11) NOT NULL,
  `dt_prazoini` date DEFAULT NULL,
  `dt_prazofim` date DEFAULT NULL,
  `nr_lote` varchar(20) NOT NULL,
  `vl_venda` decimal(18,2) NOT NULL,
  PRIMARY KEY (`cd_ingresso`,`cd_evento`),
  KEY `fk105_idx` (`cd_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ingresso`
--

INSERT INTO `ingresso` (`cd_ingresso`, `ds_ingresso`, `cd_evento`, `dt_prazoini`, `dt_prazofim`, `nr_lote`, `vl_venda`) VALUES
(1, 'Ingresso do Evento: Evento de incentivo a leitura', 4, NULL, NULL, '2915b939c5a6440d2358', '20.00'),
(2, 'Ingresso do Evento: Show Ivete Sangalo', 2, NULL, NULL, '7cd3d83f4178a598930e', '100.00'),
(3, 'Ingresso do Evento: Palestra motivacional', 3, NULL, NULL, '5db996a8b3612fb5f5f9', '25.00'),
(4, 'Ingresso do Evento: Show Wesley safadÃ£o', 7, NULL, NULL, '45cdf1d7b48a1fa85cca', '80.00'),
(5, 'Ingresso do Evento: evento de teste', 11, NULL, NULL, 'c961836aba9ffeea2fd5', '20.00'),
(6, 'Ingresso do Evento: Curso de mÃ¡gica', 6, NULL, NULL, '27285be7d824413227bd', '30.00'),
(7, 'Ingresso do Evento: Show Gusttavo Lima', 1, NULL, NULL, '535be723be7555321b0e', '90.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `cd_cadastro` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `cd_permissao` int(11) NOT NULL,
  UNIQUE KEY `nm_usuario_unique` (`nm_usuario`),
  UNIQUE KEY `cd_cadastro_unique` (`cd_cadastro`),
  KEY `fk207_idx` (`cd_permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`cd_cadastro`, `nm_usuario`, `senha`, `cd_permissao`) VALUES
(11, 'adm.blablabla', '25d55ad283aa400af464c76d713c07ad', 1),
(3, 'alfredo.neves', '25d55ad283aa400af464c76d713c07ad', 2),
(10, 'ana.paula.souza', '25d55ad283aa400af464c76d713c07ad', 2),
(6, 'jose.antonio', '25d55ad283aa400af464c76d713c07ad', 2),
(2, 'maria.augusta', '25d55ad283aa400af464c76d713c07ad', 2),
(9, 'maria.eduarda', '25d55ad283aa400af464c76d713c07ad', 2),
(5, 'patricia.lemos', '25d55ad283aa400af464c76d713c07ad', 2),
(7, 'pedro.paulo', '25d55ad283aa400af464c76d713c07ad', 2),
(4, 'ricardo.silva', '25d55ad283aa400af464c76d713c07ad', 2),
(1, 'vitor.souza', '25d55ad283aa400af464c76d713c07ad', 2),
(8, 'vitoria.reis', '25d55ad283aa400af464c76d713c07ad', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `cd_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `ds_permissao` varchar(50) NOT NULL,
  PRIMARY KEY (`cd_permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`cd_permissao`, `ds_permissao`) VALUES
(1, 'Administrador'),
(2, 'Usuário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao`
--

DROP TABLE IF EXISTS `promocao`;
CREATE TABLE IF NOT EXISTS `promocao` (
  `cd_promossao` int(11) NOT NULL AUTO_INCREMENT,
  `ds_promossao` varchar(45) NOT NULL,
  `vl_promossao` decimal(18,2) DEFAULT NULL,
  `dt_prazoini` date DEFAULT NULL,
  `dt_prazofim` date DEFAULT NULL,
  PRIMARY KEY (`cd_promossao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `promocao`
--

INSERT INTO `promocao` (`cd_promossao`, `ds_promossao`, `vl_promossao`, `dt_prazoini`, `dt_prazofim`) VALUES
(1, 'Idoso 80+', '15.00', NULL, NULL),
(2, 'CrianÃ§a 2021, crianÃ§a atÃ© 13 anos', '15.00', '2021-10-01', '2021-10-31'),
(3, 'Estudante 2022', '20.00', '2022-01-01', '2022-12-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoevento`
--

DROP TABLE IF EXISTS `tipoevento`;
CREATE TABLE IF NOT EXISTS `tipoevento` (
  `cd_tipoevento` int(11) NOT NULL AUTO_INCREMENT,
  `ds_evento` varchar(50) NOT NULL,
  PRIMARY KEY (`cd_tipoevento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipoevento`
--

INSERT INTO `tipoevento` (`cd_tipoevento`, `ds_evento`) VALUES
(1, 'Evento AcadÃªmico'),
(2, 'Evento Escolar'),
(3, 'Evento Infantil'),
(4, 'Show'),
(5, 'Palestra'),
(6, 'Gospel'),
(7, 'teste');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `fk10888` FOREIGN KEY (`cd_evento`) REFERENCES `evento` (`cd_evento`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `fk102` FOREIGN KEY (`cd_cidade`) REFERENCES `cidade` (`cd_cidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk103` FOREIGN KEY (`cd_cadastro`) REFERENCES `cadastro` (`cd_cadastro`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk203` FOREIGN KEY (`cd_fpagto`) REFERENCES `fpagamento` (`cd_fpagto`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `comprait`
--
ALTER TABLE `comprait`
  ADD CONSTRAINT `fk106` FOREIGN KEY (`cd_compra`) REFERENCES `compra` (`cd_compra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk206` FOREIGN KEY (`cd_ingresso`) REFERENCES `ingresso` (`cd_ingresso`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk101` FOREIGN KEY (`cd_cidade`) REFERENCES `cidade` (`cd_cidade`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk104` FOREIGN KEY (`cd_cidade`) REFERENCES `cidade` (`cd_cidade`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk204` FOREIGN KEY (`cd_promocao`) REFERENCES `promocao` (`cd_promossao`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk304` FOREIGN KEY (`cd_tipoevento`) REFERENCES `tipoevento` (`cd_tipoevento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `fpagamentoit`
--
ALTER TABLE `fpagamentoit`
  ADD CONSTRAINT `fk108` FOREIGN KEY (`cd_fpagtoit`) REFERENCES `fpagamento` (`cd_fpagto`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `ingresso`
--
ALTER TABLE `ingresso`
  ADD CONSTRAINT `fk105` FOREIGN KEY (`cd_evento`) REFERENCES `evento` (`cd_evento`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk107` FOREIGN KEY (`cd_cadastro`) REFERENCES `cadastro` (`cd_cadastro`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk207` FOREIGN KEY (`cd_permissao`) REFERENCES `permissao` (`cd_permissao`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE evento
ADD motivo_cancelamento VARCHAR(255) NULL;
