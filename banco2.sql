-- mysql workbench forward engineering

set @old_unique_checks=@@unique_checks, unique_checks=0;
set @old_foreign_key_checks=@@foreign_key_checks, foreign_key_checks=0;
set @old_sql_mode=@@sql_mode, sql_mode='only_full_group_by,strict_trans_tables,no_zero_in_date,no_zero_date,error_for_division_by_zero,no_engine_substitution';

-- -----------------------------------------------------
-- schema ac_sistemas
-- -----------------------------------------------------

-- -----------------------------------------------------
-- schema ac_sistemas
-- -----------------------------------------------------
create schema if not exists `ac_sistemas` default character set utf8 ;
use `ac_sistemas` ;

-- -----------------------------------------------------
-- table `ac_sistemas`.`cidade`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`cidade` (
  `cd_cidade` int not null auto_increment,
  `nm_cidade` varchar(50) not null,
  `uf_cidade` char(2) not null,
  primary key (`cd_cidade`))
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`empresa`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`empresa` (
  `cd_empresa` int not null auto_increment,
  `nm_rsocial` varchar(50) not null,
  `nm_fantasia` varchar(50) not null,
  `ed_email` varchar(80) null,
  `nr_contato` varchar(14) null,
  `nr_telefone` varchar(14) null,
  `ft_logo` varchar(255) null,
  `ft_logosrc` blob null,
  `cd_cidade` int not null,
  `ft_baner` varchar(255) null,
  `ft_banerscr` blob null,
  primary key (`cd_empresa`),
  index `fk101_idx` (`cd_cidade` asc) ,
  constraint `fk101`
    foreign key (`cd_cidade`)
    references `ac_sistemas`.`cidade` (`cd_cidade`)
    on delete restrict
    on update cascade)
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`cadastro`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`cadastro` (
  `cd_cadastro` int not null auto_increment,
  `nm_cadastro` varchar(50) not null,
  `dt_nascto` date not null,
  `sexo` char(1) not null,
  `co_complemento` varchar(80) null,
  `nr_endereco` varchar(5) null,
  `ba_cadastro` varchar(50) null,
  `cd_cidade` int not null,
  `ed_cadastro` varchar(80) null,
  `nr_cep` varchar(9) null,
  `nr_cpf` varchar(14) not null,
  `nr_rg` varchar(9) not null,
  `ed_email` varchar(80) null,
  `nr_telefone` varchar(14) null,
  `nr_contato` varchar(14) null,
  primary key (`cd_cadastro`),
  index `fk102_idx` (`cd_cidade` asc),
  unique index `nr_rg_unique` (`nr_rg` asc),
  unique index `nr_cpf_unique` (`nr_cpf` asc),
  constraint `fk102`
    foreign key (`cd_cidade`)
    references `ac_sistemas`.`cidade` (`cd_cidade`)
    on delete cascade
    on update cascade)
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`fpagamento`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`fpagamento` (
  `cd_fpagto` int not null auto_increment,
  `ds_fpagto` varchar(50) not null,
  `qt_parcela` int null,
  `vl_min` decimal(18,2) null,
  primary key (`cd_fpagto`))
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`compra`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`compra` (
  `cd_cadastro` int not null,
  `cd_compra` int not null auto_increment,
  `cd_fpagto` int not null,
  `dt_compra` date not null,
  `vl_total` decimal(18,2) null,
  primary key (`cd_compra`),
  index `fk103_idx` (`cd_cadastro` asc) ,
  constraint `fk103`
    foreign key (`cd_cadastro`)
    references `ac_sistemas`.`cadastro` (`cd_cadastro`)
    on delete restrict
    on update cascade,
  constraint `fk203`
    foreign key (`cd_fpagto`)
    references `ac_sistemas`.`fpagamento` (`cd_fpagto`)
    on delete restrict
    on update cascade)
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`promocao`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`promocao` (
  `cd_promossao` int not null auto_increment,
  `ds_promossao` varchar(45) not null,
  `vl_promossao` decimal(18,2) null,
  `dt_prazoini` date null,
  `dt_prazofim` date null,
  primary key (`cd_promossao`))
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`tipoevento`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`tipoevento` (
  `cd_tipoevento` int not null auto_increment,
  `ds_evento` varchar(50) not null,
  primary key (`cd_tipoevento`))
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`evento`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`evento` (
  `cd_evento` int not null auto_increment,
  `cd_cidade` int not null,
  `cd_promocao` int null,
  `ds_evento` varchar(50) not null,
  `ds_local` varchar(50) not null,
  `dt_evento` date not null,
  `ft_caminho` varchar(255) null,
  `ft_evento` blob null,
  `sn_cancelado` char(1) null,
  `vl_venda` decimal(18,2) not null,
  `vl_promocao` decimal(18,2) null,
  `nr_classifi` int null,
  `cd_tipoevento` int not null,
  primary key (`cd_evento`),
  index `fk104_idx` (`cd_cidade` asc) ,
  index `fk204_idx` (`cd_promocao` asc) ,
  index `fk304_idx` (`cd_tipoevento` asc) ,
  constraint `fk104`
    foreign key (`cd_cidade`)
    references `ac_sistemas`.`cidade` (`cd_cidade`)
    on delete cascade
    on update restrict,
  constraint `fk204`
    foreign key (`cd_promocao`)
    references `ac_sistemas`.`promocao` (`cd_promossao`)
    on delete restrict
    on update cascade,
  constraint `fk304`
    foreign key (`cd_tipoevento`)
    references `ac_sistemas`.`tipoevento` (`cd_tipoevento`)
    on delete cascade
    on update cascade)
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`ingresso`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`ingresso` (
  `cd_ingresso` int not null auto_increment,
  `ds_ingresso` varchar(50) not null,
  `cd_evento` int not null,
  `dt_prazoini` date null,
  `dt_prazofim` date null,
  `nr_lote` varchar(20) not null,
  `vl_venda` decimal(18,2) not null,
  primary key (`cd_ingresso`, `cd_evento`),
  index `fk105_idx` (`cd_evento` asc) ,
  constraint `fk105`
    foreign key (`cd_evento`)
    references `ac_sistemas`.`evento` (`cd_evento`)
    on delete restrict
    on update cascade)
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`comprait`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`comprait` (
  `cd_compra` int not null,
  `cd_ingresso` int not null,
  `qt_compra` int not null,
  `vl_compra` decimal(18,2) not null,
  primary key (`cd_compra`, `cd_ingresso`),
  index `cd_ingresso_idx` (`cd_ingresso` asc) ,
  constraint `fk206`
    foreign key (`cd_ingresso`)
    references `ac_sistemas`.`ingresso` (`cd_ingresso`)
    on delete restrict
    on update cascade,
  constraint `fk106`
    foreign key (`cd_compra`)
    references `ac_sistemas`.`compra` (`cd_compra`)
    on delete restrict
    on update cascade)
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`permissao`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`permissao` (
  `cd_permissao` int not null auto_increment,
  `ds_permissao` varchar(50) not null,
  primary key (`cd_permissao`))
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`login`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`login` (
  `cd_cadastro` int not null auto_increment,
  `nm_usuario` varchar(50) not null,
  `senha` varchar(50) not null,
  `cd_permissao` int not null,
  unique index `nm_usuario_unique` (`nm_usuario` asc) ,
  unique index `cd_cadastro_unique` (`cd_cadastro` asc) ,
  index `fk207_idx` (`cd_permissao` asc) ,
  constraint `fk107`
    foreign key (`cd_cadastro`)
    references `ac_sistemas`.`cadastro` (`cd_cadastro`)
    on delete restrict
    on update cascade,
  constraint `fk207`
    foreign key (`cd_permissao`)
    references `ac_sistemas`.`permissao` (`cd_permissao`)
    on delete restrict
    on update cascade)
ENGINE=InnoDB ;


-- -----------------------------------------------------
-- table `ac_sistemas`.`fpagamentoit`
-- -----------------------------------------------------
create table if not exists `ac_sistemas`.`fpagamentoit` (
  `cd_fpagtoit` int not null auto_increment,
  `cd_fpagto` int not null,
  `nr_parcela` int null,
  primary key (`cd_fpagtoit`, `cd_fpagto`),
  constraint `fk108`
    foreign key (`cd_fpagtoit`)
    references `ac_sistemas`.`fpagamento` (`cd_fpagto`)
    on delete restrict
    on update cascade)
ENGINE=InnoDB ;


set sql_mode=@old_sql_mode;
set foreign_key_checks=@old_foreign_key_checks;
set unique_checks=@old_unique_checks;

INSERT INTO permissao (ds_permissao) VALUES ('Administrador');
INSERT INTO permissao (ds_permissao) VALUES ('Usuário');

INSERT INTO `cidade` (`nm_cidade`, `uf_cidade`) VALUES
( 'Águas de Chapecó', 'SC'),
( 'Águas Frias', 'SC'),
( 'Águas Mornas', 'SC'),
( 'Alfredo Wagner', 'SC'),
( 'Alto Bela Vista', 'SC'),
( 'Anchieta', 'SC'),
( 'Angelina', 'SC'),
( 'Anita Garibaldi', 'SC'),
( 'Anitápolis', 'SC'),
( 'Antônio Carlos', 'SC'),
( 'Apiúna', 'SC'),
( 'Arabutã', 'SC'),
( 'Araquari', 'SC'),
( 'Araranguá', 'SC'),
( 'Armazém', 'SC'),
( 'Arroio Trinta', 'SC'),
( 'Arvoredo', 'SC'),
( 'Ascurra', 'SC'),
( 'Atalanta', 'SC'),
( 'Aurora', 'SC'),
( 'Balneário Arroio do Silva', 'SC'),
( 'Balneário Barra do Sul', 'SC'),
( 'Balneário Camboriú', 'SC'),
( 'Balneário Gaivota', 'SC'),
( 'Bandeirante', 'SC'),
( 'Barra Bonita', 'SC'),
( 'Barra Velha', 'SC'),
( 'Bela Vista do Toldo', 'SC'),
( 'Belmonte', 'SC'),
( 'Benedito Novo', 'SC'),
( 'Biguaçu', 'SC'),
( 'Blumenau', 'SC'),
( 'Bocaina do Sul', 'SC'),
( 'Bom Jardim da Serra', 'SC'),
( 'Bom Jesus', 'SC'),
( 'Bom Jesus do Oeste', 'SC'),
( 'Bom Retiro', 'SC'),
( 'Bombinhas', 'SC'),
( 'Botuverá', 'SC'),
( 'Braço do Norte', 'SC'),
( 'Braço do Trombudo', 'SC'),
( 'Brunópolis', 'SC'),
( 'Brusque', 'SC'),
( 'Caçador', 'SC'),
( 'Caibi', 'SC'),
( 'Calmon', 'SC'),
( 'Camboriú', 'SC'),
( 'Campo Alegre', 'SC'),
( 'Campo Belo do Sul', 'SC'),
( 'Campo Erê', 'SC'),
( 'Campos Novos', 'SC'),
( 'Canelinha', 'SC'),
( 'Canoinhas', 'SC'),
( 'Capão Alto', 'SC'),
( 'Capinzal', 'SC'),
( 'Capivari de Baixo', 'SC'),
( 'Catanduvas', 'SC'),
( 'Caxambu do Sul', 'SC'),
( 'Celso Ramos', 'SC'),
( 'Cerro Negro', 'SC'),
( 'Chapadão do Lageado', 'SC'),
( 'Chapecó', 'SC'),
( 'Cocal do Sul', 'SC'),
( 'Concórdia', 'SC'),
( 'Cordilheira Alta', 'SC'),
( 'Coronel Freitas', 'SC'),
( 'Coronel Martins', 'SC'),
( 'Correia Pinto', 'SC'),
( 'Corupá', 'SC'),
( 'Criciúma', 'SC'),
( 'Cunha Porã', 'SC'),
( 'Cunhataí', 'SC'),
( 'Curitibanos', 'SC'),
( 'Descanso', 'SC'),
( 'Dionísio Cerqueira', 'SC'),
( 'Dona Emma', 'SC'),
( 'Doutor Pedrinho', 'SC'),
( 'Entre Rios', 'SC'),
( 'Ermo', 'SC'),
( 'Erval Velho', 'SC'),
( 'Faxinal dos Guedes', 'SC'),
( 'Flor do Sertão', 'SC'),
( 'Florianópolis', 'SC'),
( 'Formosa do Sul', 'SC'),
( 'Forquilhinha', 'SC'),
( 'Fraiburgo', 'SC'),
( 'Frei Rogério', 'SC'),
( 'Galvão', 'SC'),
( 'Garopaba', 'SC'),
( 'Garuva', 'SC'),
( 'Gaspar', 'SC'),
( 'Governador Celso Ramos', 'SC'),
( 'Grão Pará', 'SC'),
( 'Gravatal', 'SC'),
( 'Guabiruba', 'SC'),
( 'Guaraciaba', 'SC'),
( 'Guaramirim', 'SC'),
( 'Guarujá do Sul', 'SC'),
( 'Guatambú', 'SC'),
( 'Herval d`Oeste', 'SC'),
( 'Ibiam', 'SC'),
( 'Ibicaré', 'SC'),
( 'Ibirama', 'SC'),
( 'Içara', 'SC'),
( 'Ilhota', 'SC'),
( 'Imaruí', 'SC'),
( 'Imbituba', 'SC'),
( 'Imbuia', 'SC'),
( 'Indaial', 'SC'),
( 'Iomerê', 'SC'),
( 'Ipira', 'SC'),
( 'Iporã do Oeste', 'SC'),
( 'Ipuaçu', 'SC'),
( 'Ipumirim', 'SC'),
( 'Iraceminha', 'SC'),
( 'Irani', 'SC'),
( 'Irati', 'SC'),
( 'Irineópolis', 'SC'),
( 'Itá', 'SC'),
( 'Itaiópolis', 'SC'),
( 'Itajaí', 'SC'),
( 'Itapema', 'SC'),
( 'Itapiranga', 'SC'),
( 'Itapoá', 'SC'),
( 'Ituporanga', 'SC'),
( 'Jaborá', 'SC'),
( 'Jacinto Machado', 'SC'),
( 'Jaguaruna', 'SC'),
( 'Jaraguá do Sul', 'SC'),
( 'Jardinópolis', 'SC'),
( 'Joaçaba', 'SC'),
( 'Joinville', 'SC'),
( 'José Boiteux', 'SC'),
( 'Jupiá', 'SC'),
( 'Lacerdópolis', 'SC'),
( 'Lages', 'SC'),
( 'Laguna', 'SC'),
( 'Lajeado Grande', 'SC'),
( 'Laurentino', 'SC'),
( 'Lauro Muller', 'SC'),
( 'Lebon Régis', 'SC'),
( 'Leoberto Leal', 'SC'),
( 'Lindóia do Sul', 'SC'),
( 'Lontras', 'SC'),
( 'Luiz Alves', 'SC'),
( 'Luzerna', 'SC'),
( 'Macieira', 'SC'),
( 'Mafra', 'SC'),
( 'Major Gercino', 'SC'),
( 'Major Vieira', 'SC'),
( 'Maracajá', 'SC'),
( 'Maravilha', 'SC'),
( 'Marema', 'SC'),
( 'Massaranduba', 'SC'),
( 'Matos Costa', 'SC'),
( 'Meleiro', 'SC'),
( 'Mirim Doce', 'SC'),
( 'Modelo', 'SC'),
( 'Mondaí', 'SC'),
( 'Monte Carlo', 'SC'),
( 'Monte Castelo', 'SC'),
( 'Morro da Fumaça', 'SC'),
( 'Morro Grande', 'SC'),
( 'Navegantes', 'SC'),
( 'Nova Erechim', 'SC'),
( 'Nova Itaberaba', 'SC'),
( 'Nova Trento', 'SC'),
( 'Nova Veneza', 'SC'),
( 'Novo Horizonte', 'SC'),
( 'Orleans', 'SC'),
( 'Otacílio Costa', 'SC'),
( 'Ouro', 'SC'),
( 'Ouro Verde', 'SC'),
( 'Paial', 'SC'),
( 'Painel', 'SC'),
( 'Palhoça', 'SC'),
( 'Palma Sola', 'SC'),
( 'Palmeira', 'SC'),
( 'Palmitos', 'SC'),
( 'Papanduva', 'SC'),
( 'Paraíso', 'SC'),
( 'Passo de Torres', 'SC'),
( 'Passos Maia', 'SC'),
( 'Paulo Lopes', 'SC'),
( 'Pedras Grandes', 'SC'),
( 'Penha', 'SC'),
( 'Peritiba', 'SC'),
( 'Petrolândia', 'SC'),
( 'Piçarras', 'SC'),
( 'Pinhalzinho', 'SC'),
( 'Pinheiro Preto', 'SC'),
( 'Piratuba', 'SC'),
( 'Planalto Alegre', 'SC'),
( 'Pomerode', 'SC'),
( 'Ponte Alta', 'SC'),
( 'Ponte Alta do Norte', 'SC'),
( 'Ponte Serrada', 'SC'),
( 'Porto Belo', 'SC'),
( 'Porto União', 'SC'),
( 'Pouso Redondo', 'SC'),
( 'Praia Grande', 'SC'),
( 'Presidente Castelo Branco', 'SC'),
( 'Presidente Getúlio', 'SC'),
( 'Presidente Nereu', 'SC'),
( 'Princesa', 'SC'),
( 'Quilombo', 'SC'),
( 'Rancho Queimado', 'SC'),
( 'Rio das Antas', 'SC'),
( 'Rio do Campo', 'SC'),
( 'Rio do Oeste', 'SC'),
( 'Rio do Sul', 'SC'),
( 'Rio dos Cedros', 'SC'),
( 'Rio Fortuna', 'SC'),
( 'Rio Negrinho', 'SC'),
( 'Rio Rufino', 'SC'),
( 'Riqueza', 'SC'),
( 'Rodeio', 'SC'),
( 'Romelândia', 'SC'),
( 'Salete', 'SC'),
( 'Saltinho', 'SC'),
( 'Salto Veloso', 'SC'),
( 'Sangão', 'SC'),
( 'Santa Cecília', 'SC'),
( 'Santa Helena', 'SC'),
( 'Santa Rosa de Lima', 'SC'),
( 'Santa Rosa do Sul', 'SC'),
( 'Santa Terezinha', 'SC'),
( 'Santa Terezinha do Progresso', 'SC'),
( 'Santiago do Sul', 'SC'),
( 'Santo Amaro da Imperatriz', 'SC'),
( 'São Bento do Sul', 'SC'),
( 'São Bernardino', 'SC'),
( 'São Bonifácio', 'SC'),
( 'São Carlos', 'SC'),
( 'São Cristovão do Sul', 'SC'),
( 'São Domingos', 'SC'),
( 'São Francisco do Sul', 'SC'),
( 'São João Batista', 'SC'),
( 'São João do Itaperiú', 'SC'),
( 'São João do Oeste', 'SC'),
( 'São João do Sul', 'SC'),
( 'São Joaquim', 'SC'),
( 'São José', 'SC'),
( 'São José do Cedro', 'SC'),
( 'São José do Cerrito', 'SC'),
( 'São Lourenço do Oeste', 'SC'),
( 'São Ludgero', 'SC'),
( 'São Martinho', 'SC'),
( 'São Miguel da Boa Vista', 'SC'),
( 'São Miguel do Oeste', 'SC'),
( 'São Pedro de Alcântara', 'SC'),
( 'Saudades', 'SC'),
( 'Schroeder', 'SC'),
( 'Seara', 'SC'),
( 'Serra Alta', 'SC'),
( 'Siderópolis', 'SC'),
( 'Sombrio', 'SC'),
( 'Sul Brasil', 'SC'),
( 'Taió', 'SC'),
( 'Tangará', 'SC'),
( 'Tigrinhos', 'SC'),
( 'Tijucas', 'SC'),
( 'Timbé do Sul', 'SC'),
( 'Timbó', 'SC'),
( 'Timbó Grande', 'SC'),
( 'Três Barras', 'SC'),
( 'Treviso', 'SC'),
( 'Treze de Maio', 'SC'),
( 'Treze Tílias', 'SC'),
( 'Trombudo Central', 'SC'),
( 'Tubarão', 'SC'),
( 'Tunápolis', 'SC'),
( 'Turvo', 'SC'),
( 'União do Oeste', 'SC'),
( 'Urubici', 'SC'),
( 'Urupema', 'SC'),
( 'Urussanga', 'SC'),
( 'Vargeão', 'SC'),
( 'Vargem', 'SC'),
( 'Vargem Bonita', 'SC'),
( 'Vidal Ramos', 'SC'),
( 'Videira', 'SC'),
( 'Vitor Meireles', 'SC'),
( 'Witmarsum', 'SC'),
( 'Xanxerê', 'SC'),
( 'Xavantina', 'SC'),
( 'Xaxim', 'SC'),
( 'Zortéa', 'SC');