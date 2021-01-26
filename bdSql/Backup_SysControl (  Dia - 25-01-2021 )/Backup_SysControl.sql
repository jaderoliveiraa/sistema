#
# TABLE STRUCTURE FOR: categorias
#

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_nome` varchar(45) NOT NULL,
  `categoria_ativa` tinyint(1) DEFAULT NULL,
  `categoria_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `categorias` (`categoria_id`, `categoria_nome`, `categoria_ativa`, `categoria_data_alteracao`) VALUES (1, 'Games', 1, '2020-12-13 20:33:04');
INSERT INTO `categorias` (`categoria_id`, `categoria_nome`, `categoria_ativa`, `categoria_data_alteracao`) VALUES (2, 'Celulares', 1, '2020-12-13 12:05:18');
INSERT INTO `categorias` (`categoria_id`, `categoria_nome`, `categoria_ativa`, `categoria_data_alteracao`) VALUES (4, 'Acessórios', 1, '2020-12-13 12:05:23');
INSERT INTO `categorias` (`categoria_id`, `categoria_nome`, `categoria_ativa`, `categoria_data_alteracao`) VALUES (5, 'Impressoras', 1, '2020-12-13 12:05:25');
INSERT INTO `categorias` (`categoria_id`, `categoria_nome`, `categoria_ativa`, `categoria_data_alteracao`) VALUES (6, 'Tablet&#039;s', 1, '2020-12-13 20:39:23');


#
# TABLE STRUCTURE FOR: clientes
#

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `cliente_tipo` tinyint(1) DEFAULT NULL,
  `cliente_nome` varchar(45) NOT NULL,
  `cliente_sobrenome` varchar(150) NOT NULL,
  `cliente_data_nascimento` date NOT NULL,
  `cliente_cpf_cnpj` varchar(20) NOT NULL,
  `cliente_rg_ie` varchar(20) NOT NULL,
  `cliente_email` varchar(50) NOT NULL,
  `cliente_telefone` varchar(20) NOT NULL,
  `cliente_celular` varchar(20) NOT NULL,
  `cliente_cep` varchar(10) NOT NULL,
  `cliente_endereco` varchar(155) NOT NULL,
  `cliente_numero_endereco` varchar(20) NOT NULL,
  `cliente_bairro` varchar(45) NOT NULL,
  `cliente_complemento` varchar(145) NOT NULL,
  `cliente_cidade` varchar(105) NOT NULL,
  `cliente_estado` varchar(2) NOT NULL,
  `cliente_ativo` tinyint(1) NOT NULL,
  `cliente_obs` tinytext DEFAULT NULL,
  `cliente_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

INSERT INTO `clientes` (`cliente_id`, `cliente_data_cadastro`, `cliente_tipo`, `cliente_nome`, `cliente_sobrenome`, `cliente_data_nascimento`, `cliente_cpf_cnpj`, `cliente_rg_ie`, `cliente_email`, `cliente_telefone`, `cliente_celular`, `cliente_cep`, `cliente_endereco`, `cliente_numero_endereco`, `cliente_bairro`, `cliente_complemento`, `cliente_cidade`, `cliente_estado`, `cliente_ativo`, `cliente_obs`, `cliente_data_alteracao`) VALUES (101, '2020-12-05 21:47:36', 1, 'Jáder', 'Oliveira', '2020-12-23', '620.998.923-34', '2002029276028', 'jaderoliveiraa@gmail.com', '(88) 2154-8754', '(88) 98842-0622', '63.034-118', 'rua do o', '25', 'pirajá', '', 'Juazeiro do Norte', 'CE', 1, 'esse cliente é um cliente de teste', '2020-12-09 21:37:43');
INSERT INTO `clientes` (`cliente_id`, `cliente_data_cadastro`, `cliente_tipo`, `cliente_nome`, `cliente_sobrenome`, `cliente_data_nascimento`, `cliente_cpf_cnpj`, `cliente_rg_ie`, `cliente_email`, `cliente_telefone`, `cliente_celular`, `cliente_cep`, `cliente_endereco`, `cliente_numero_endereco`, `cliente_bairro`, `cliente_complemento`, `cliente_cidade`, `cliente_estado`, `cliente_ativo`, `cliente_obs`, `cliente_data_alteracao`) VALUES (102, '2020-12-09 23:29:05', 1, 'Cicera Camila', 'Nogueira', '2020-12-02', '835.042.510-50', '123456', 'milasantosnogueira27@gmail.com', '', '', '63.030-000', 'Rua Rui Barbosa', '255', 'pirajá', '', 'Juazeiro do Norte', 'CE', 1, '', '2021-01-04 14:07:29');
INSERT INTO `clientes` (`cliente_id`, `cliente_data_cadastro`, `cliente_tipo`, `cliente_nome`, `cliente_sobrenome`, `cliente_data_nascimento`, `cliente_cpf_cnpj`, `cliente_rg_ie`, `cliente_email`, `cliente_telefone`, `cliente_celular`, `cliente_cep`, `cliente_endereco`, `cliente_numero_endereco`, `cliente_bairro`, `cliente_complemento`, `cliente_cidade`, `cliente_estado`, `cliente_ativo`, `cliente_obs`, `cliente_data_alteracao`) VALUES (104, '2021-01-02 16:37:41', 1, 'Leonilda', 'da Silva Oliveira', '1959-04-12', '214.265.973-04', '265487474', 'lilianoliveiraa2017@gmail.com', '(88) 2154-8474', '(88) 98861-2341', '63.031-474', 'rua do campo', '23', 'lagoa seca 2', '', 'Barbalha', 'CE', 1, '', '2021-01-02 16:37:41');


#
# TABLE STRUCTURE FOR: contas_pagar
#

DROP TABLE IF EXISTS `contas_pagar`;

CREATE TABLE `contas_pagar` (
  `conta_pagar_id` int(11) NOT NULL AUTO_INCREMENT,
  `conta_pagar_fornecedor_id` int(11) DEFAULT NULL,
  `conta_pagar_descricao` varchar(150) NOT NULL,
  `conta_pagar_data_vencimento` date DEFAULT NULL,
  `conta_pagar_data_pagamento` datetime DEFAULT NULL,
  `conta_pagar_valor` varchar(15) DEFAULT NULL,
  `conta_pagar_status` tinyint(1) DEFAULT NULL,
  `conta_pagar_obs` tinytext DEFAULT NULL,
  `conta_pagar_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`conta_pagar_id`),
  KEY `fk_conta_pagar_id_fornecedor` (`conta_pagar_fornecedor_id`),
  CONSTRAINT `fk_conta_pagar_id_fornecedor` FOREIGN KEY (`conta_pagar_fornecedor_id`) REFERENCES `fornecedores` (`fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='		';

INSERT INTO `contas_pagar` (`conta_pagar_id`, `conta_pagar_fornecedor_id`, `conta_pagar_descricao`, `conta_pagar_data_vencimento`, `conta_pagar_data_pagamento`, `conta_pagar_valor`, `conta_pagar_status`, `conta_pagar_obs`, `conta_pagar_data_alteracao`) VALUES (1, 4004, 'Tv a cabo', '2021-01-16', NULL, '200.00', 0, 'rasrasrasrasrasrasrasr', '2021-01-16 21:23:45');
INSERT INTO `contas_pagar` (`conta_pagar_id`, `conta_pagar_fornecedor_id`, `conta_pagar_descricao`, `conta_pagar_data_vencimento`, `conta_pagar_data_pagamento`, `conta_pagar_valor`, `conta_pagar_status`, `conta_pagar_obs`, `conta_pagar_data_alteracao`) VALUES (2, 4001, 'Compra de Acessórios', '2021-01-24', NULL, '100.10', 0, 'çkajsdhlajksadgalsjdgasd', '2021-01-24 22:29:10');
INSERT INTO `contas_pagar` (`conta_pagar_id`, `conta_pagar_fornecedor_id`, `conta_pagar_descricao`, `conta_pagar_data_vencimento`, `conta_pagar_data_pagamento`, `conta_pagar_valor`, `conta_pagar_status`, `conta_pagar_obs`, `conta_pagar_data_alteracao`) VALUES (3, 4001, 'teste de descrição', '2021-01-29', NULL, '10', 0, 'asdasdasdasdasd', '2021-01-16 21:24:49');
INSERT INTO `contas_pagar` (`conta_pagar_id`, `conta_pagar_fornecedor_id`, `conta_pagar_descricao`, `conta_pagar_data_vencimento`, `conta_pagar_data_pagamento`, `conta_pagar_valor`, `conta_pagar_status`, `conta_pagar_obs`, `conta_pagar_data_alteracao`) VALUES (4, 4001, 'internet', '2021-01-07', '2021-01-16 10:25:19', '97', 1, 'paga', '2021-01-16 21:25:19');


#
# TABLE STRUCTURE FOR: contas_receber
#

DROP TABLE IF EXISTS `contas_receber`;

CREATE TABLE `contas_receber` (
  `conta_receber_id` int(11) NOT NULL AUTO_INCREMENT,
  `conta_receber_cliente_id` int(11) NOT NULL,
  `conta_receber_data_vencimento` date DEFAULT NULL,
  `conta_receber_data_pagamento` datetime DEFAULT NULL,
  `conta_receber_valor` varchar(20) DEFAULT NULL,
  `conta_receber_status` tinyint(1) DEFAULT NULL,
  `conta_receber_obs` tinytext DEFAULT NULL,
  `conta_receber_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`conta_receber_id`),
  KEY `fk_conta_receber_id_cliente` (`conta_receber_cliente_id`),
  CONSTRAINT `fk_conta_receber_id_cliente` FOREIGN KEY (`conta_receber_cliente_id`) REFERENCES `clientes` (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `contas_receber` (`conta_receber_id`, `conta_receber_cliente_id`, `conta_receber_data_vencimento`, `conta_receber_data_pagamento`, `conta_receber_valor`, `conta_receber_status`, `conta_receber_obs`, `conta_receber_data_alteracao`) VALUES (1, 101, '2020-02-28', '2021-01-16 09:53:53', '150,226.22', 1, '', '2021-01-16 20:53:53');
INSERT INTO `contas_receber` (`conta_receber_id`, `conta_receber_cliente_id`, `conta_receber_data_vencimento`, `conta_receber_data_pagamento`, `conta_receber_valor`, `conta_receber_status`, `conta_receber_obs`, `conta_receber_data_alteracao`) VALUES (2, 102, '2020-02-21', '2020-02-28 18:33:19', '350.00', 1, NULL, '2020-02-28 18:33:19');
INSERT INTO `contas_receber` (`conta_receber_id`, `conta_receber_cliente_id`, `conta_receber_data_vencimento`, `conta_receber_data_pagamento`, `conta_receber_valor`, `conta_receber_status`, `conta_receber_obs`, `conta_receber_data_alteracao`) VALUES (3, 104, '2020-02-28', '2020-02-28 17:22:47', '56.00', 1, NULL, '2020-02-28 17:22:47');
INSERT INTO `contas_receber` (`conta_receber_id`, `conta_receber_cliente_id`, `conta_receber_data_vencimento`, `conta_receber_data_pagamento`, `conta_receber_valor`, `conta_receber_status`, `conta_receber_obs`, `conta_receber_data_alteracao`) VALUES (7, 101, '2021-01-16', NULL, '145.00', 0, '', '2021-01-24 22:38:12');
INSERT INTO `contas_receber` (`conta_receber_id`, `conta_receber_cliente_id`, `conta_receber_data_vencimento`, `conta_receber_data_pagamento`, `conta_receber_valor`, `conta_receber_status`, `conta_receber_obs`, `conta_receber_data_alteracao`) VALUES (8, 102, '2021-01-24', NULL, '1,200.00', 0, '', '2021-01-24 22:42:39');


#
# TABLE STRUCTURE FOR: formas_pagamentos
#

DROP TABLE IF EXISTS `formas_pagamentos`;

CREATE TABLE `formas_pagamentos` (
  `forma_pagamento_id` int(11) NOT NULL AUTO_INCREMENT,
  `forma_pagamento_nome` varchar(45) DEFAULT NULL,
  `forma_pagamento_aceita_parc` tinyint(1) DEFAULT NULL,
  `forma_pagamento_ativa` tinyint(1) DEFAULT NULL,
  `forma_pagamento_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`forma_pagamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `formas_pagamentos` (`forma_pagamento_id`, `forma_pagamento_nome`, `forma_pagamento_aceita_parc`, `forma_pagamento_ativa`, `forma_pagamento_data_alteracao`) VALUES (1, 'Cartão de crédito', 0, 1, '2020-02-14 20:46:46');
INSERT INTO `formas_pagamentos` (`forma_pagamento_id`, `forma_pagamento_nome`, `forma_pagamento_aceita_parc`, `forma_pagamento_ativa`, `forma_pagamento_data_alteracao`) VALUES (2, 'Dinheiro', 0, 1, '2020-01-29 18:43:54');
INSERT INTO `formas_pagamentos` (`forma_pagamento_id`, `forma_pagamento_nome`, `forma_pagamento_aceita_parc`, `forma_pagamento_ativa`, `forma_pagamento_data_alteracao`) VALUES (3, 'Boleto bancário', 1, 1, '2021-01-04 13:37:10');
INSERT INTO `formas_pagamentos` (`forma_pagamento_id`, `forma_pagamento_nome`, `forma_pagamento_aceita_parc`, `forma_pagamento_ativa`, `forma_pagamento_data_alteracao`) VALUES (4, 'Pix', 0, 1, '2021-01-04 13:36:54');


#
# TABLE STRUCTURE FOR: fornecedores
#

DROP TABLE IF EXISTS `fornecedores`;

CREATE TABLE `fornecedores` (
  `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `fornecedor_razao` varchar(200) DEFAULT NULL,
  `fornecedor_nome_fantasia` varchar(145) DEFAULT NULL,
  `fornecedor_cnpj` varchar(20) DEFAULT NULL,
  `fornecedor_ie` varchar(20) DEFAULT NULL,
  `fornecedor_telefone` varchar(20) DEFAULT NULL,
  `fornecedor_celular` varchar(20) DEFAULT NULL,
  `fornecedor_email` varchar(100) DEFAULT NULL,
  `fornecedor_contato` varchar(45) DEFAULT NULL,
  `fornecedor_cep` varchar(10) DEFAULT NULL,
  `fornecedor_endereco` varchar(145) DEFAULT NULL,
  `fornecedor_numero_endereco` varchar(20) DEFAULT NULL,
  `fornecedor_bairro` varchar(45) DEFAULT NULL,
  `fornecedor_complemento` varchar(45) DEFAULT NULL,
  `fornecedor_cidade` varchar(45) DEFAULT NULL,
  `fornecedor_estado` varchar(2) DEFAULT NULL,
  `fornecedor_ativo` tinyint(1) DEFAULT NULL,
  `fornecedor_obs` tinytext DEFAULT NULL,
  `fornecedor_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4005 DEFAULT CHARSET=latin1;

INSERT INTO `fornecedores` (`fornecedor_id`, `fornecedor_data_cadastro`, `fornecedor_razao`, `fornecedor_nome_fantasia`, `fornecedor_cnpj`, `fornecedor_ie`, `fornecedor_telefone`, `fornecedor_celular`, `fornecedor_email`, `fornecedor_contato`, `fornecedor_cep`, `fornecedor_endereco`, `fornecedor_numero_endereco`, `fornecedor_bairro`, `fornecedor_complemento`, `fornecedor_cidade`, `fornecedor_estado`, `fornecedor_ativo`, `fornecedor_obs`, `fornecedor_data_alteracao`) VALUES (4001, '2020-12-10 07:12:23', 'fulano de tal ME', 'bing ball', '50.499.786/0001-01', '215487222+2', '(88) 3512-2545', '(88) 98852-6547', 'fulano@gmail.com', 'Fernando', '63.034-258', 'rua 1 de maio', '1021', 'populares', NULL, 'Juazeiro do Norte', 'CE', 1, 'Teste de observações', '2020-12-15 20:23:49');
INSERT INTO `fornecedores` (`fornecedor_id`, `fornecedor_data_cadastro`, `fornecedor_razao`, `fornecedor_nome_fantasia`, `fornecedor_cnpj`, `fornecedor_ie`, `fornecedor_telefone`, `fornecedor_celular`, `fornecedor_email`, `fornecedor_contato`, `fornecedor_cep`, `fornecedor_endereco`, `fornecedor_numero_endereco`, `fornecedor_bairro`, `fornecedor_complemento`, `fornecedor_cidade`, `fornecedor_estado`, `fornecedor_ativo`, `fornecedor_obs`, `fornecedor_data_alteracao`) VALUES (4004, '2020-12-12 16:50:36', 'fulano de tal', 'distribuidora me', '43.070.041/0001-67', '6548741-22', '(88) 3521-5484', '(88) 98852-6545', 'alunaficticia@gmail.com', 'Júlia', '63.034-118', 'Rua Vereador Jose Xavier de Oliveira', '35', 'Franciscanos', 'Loja1', 'Juazeiro do Norte', 'CE', 1, 'teste de informações', '2020-12-14 22:07:48');


#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES (1, 'admin', 'Administrator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES (2, 'Vendedor', 'Vendedores');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES (3, 'Técnico', 'gurpo de técnicos');


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: marcas
#

DROP TABLE IF EXISTS `marcas`;

CREATE TABLE `marcas` (
  `marca_id` int(11) NOT NULL AUTO_INCREMENT,
  `marca_nome` varchar(45) NOT NULL,
  `marca_ativa` tinyint(1) DEFAULT NULL,
  `marca_data_alteracao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (2, 'CCE', 1, '2021-01-08 20:30:06');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (3, 'Samsung', 1, '2020-12-13 11:09:08');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (4, 'LG', 1, '2020-12-13 11:09:15');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (6, 'Motorola', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (7, 'Lenovo', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (8, 'Multilaser', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (9, 'Xiaomi', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (10, 'Sony', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (11, 'Asus', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (12, 'Blu', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (13, 'Positivo', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (14, 'Acer', 1, '0000-00-00 00:00:00');
INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES (15, 'Apple', 1, '0000-00-00 00:00:00');


#
# TABLE STRUCTURE FOR: ordem_tem_servicos
#

DROP TABLE IF EXISTS `ordem_tem_servicos`;

CREATE TABLE `ordem_tem_servicos` (
  `ordem_ts_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordem_ts_id_servico` int(11) DEFAULT NULL,
  `ordem_ts_id_ordem_servico` int(11) DEFAULT NULL,
  `ordem_ts_quantidade` int(11) DEFAULT NULL,
  `ordem_ts_valor_unitario` varchar(45) DEFAULT NULL,
  `ordem_ts_valor_desconto` varchar(45) DEFAULT NULL,
  `ordem_ts_valor_total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ordem_ts_id`),
  KEY `fk_ordem_ts_id_servico` (`ordem_ts_id_servico`),
  KEY `fk_ordem_ts_id_ordem_servico` (`ordem_ts_id_ordem_servico`),
  CONSTRAINT `fk_ordem_ts_id_ordem_servico` FOREIGN KEY (`ordem_ts_id_ordem_servico`) REFERENCES `ordens_servicos` (`ordem_servico_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ordem_ts_id_servico` FOREIGN KEY (`ordem_ts_id_servico`) REFERENCES `servicos` (`servico_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Tabela de relacionamento entre as tabelas servicos e ordem_servico';

INSERT INTO `ordem_tem_servicos` (`ordem_ts_id`, `ordem_ts_id_servico`, `ordem_ts_id_ordem_servico`, `ordem_ts_quantidade`, `ordem_ts_valor_unitario`, `ordem_ts_valor_desconto`, `ordem_ts_valor_total`) VALUES (2, 2, 2, 4, '80.00', '0', '320.00');
INSERT INTO `ordem_tem_servicos` (`ordem_ts_id`, `ordem_ts_id_servico`, `ordem_ts_id_ordem_servico`, `ordem_ts_quantidade`, `ordem_ts_valor_unitario`, `ordem_ts_valor_desconto`, `ordem_ts_valor_total`) VALUES (5, 3, 3, 1, ' 120.00', '0 ', ' 120.00');
INSERT INTO `ordem_tem_servicos` (`ordem_ts_id`, `ordem_ts_id_servico`, `ordem_ts_id_ordem_servico`, `ordem_ts_quantidade`, `ordem_ts_valor_unitario`, `ordem_ts_valor_desconto`, `ordem_ts_valor_total`) VALUES (6, 1, 1, 1, ' 80.00', '0 ', ' 80.00');
INSERT INTO `ordem_tem_servicos` (`ordem_ts_id`, `ordem_ts_id_servico`, `ordem_ts_id_ordem_servico`, `ordem_ts_quantidade`, `ordem_ts_valor_unitario`, `ordem_ts_valor_desconto`, `ordem_ts_valor_total`) VALUES (7, 1, 12, 1, ' 50.00', '50 ', ' 25.00');
INSERT INTO `ordem_tem_servicos` (`ordem_ts_id`, `ordem_ts_id_servico`, `ordem_ts_id_ordem_servico`, `ordem_ts_quantidade`, `ordem_ts_valor_unitario`, `ordem_ts_valor_desconto`, `ordem_ts_valor_total`) VALUES (8, 1, 14, 1, ' 50.00', '-100 ', ' 100.00');


#
# TABLE STRUCTURE FOR: ordens_servicos
#

DROP TABLE IF EXISTS `ordens_servicos`;

CREATE TABLE `ordens_servicos` (
  `ordem_servico_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordem_servico_forma_pagamento_id` int(11) DEFAULT NULL,
  `ordem_servico_cliente_id` int(11) DEFAULT NULL,
  `ordem_servico_situacao_id` int(11) NOT NULL,
  `ordem_servico_data_emissao` timestamp NULL DEFAULT current_timestamp(),
  `ordem_servico_data_conclusao` varchar(100) DEFAULT NULL,
  `ordem_servico_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_marca_equipamento_id` int(11) DEFAULT NULL,
  `ordem_servico_modelo_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_acessorios` tinytext DEFAULT NULL,
  `ordem_servico_defeito` tinytext DEFAULT NULL,
  `ordem_servico_valor_desconto` varchar(25) DEFAULT NULL,
  `ordem_servico_valor_total` varchar(25) DEFAULT NULL,
  `ordem_servico_status` tinyint(20) DEFAULT NULL,
  `ordem_servico_obs` tinytext DEFAULT NULL,
  `ordem_servico_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`ordem_servico_id`),
  KEY `fk_ordem_servico_id_cliente` (`ordem_servico_cliente_id`),
  KEY `fk_ordem_servico_id_forma_pagto` (`ordem_servico_forma_pagamento_id`),
  KEY `fk_ordem_servico_id_marca` (`ordem_servico_marca_equipamento_id`),
  KEY `fk_ordem_servico_id_situacao` (`ordem_servico_situacao_id`),
  CONSTRAINT `fk_ordem_servico_id_cliente` FOREIGN KEY (`ordem_servico_cliente_id`) REFERENCES `clientes` (`cliente_id`),
  CONSTRAINT `fk_ordem_servico_id_forma_pagto` FOREIGN KEY (`ordem_servico_forma_pagamento_id`) REFERENCES `formas_pagamentos` (`forma_pagamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_situacao_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento_id`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES (1, 1, 101, 1, '2020-02-14 17:30:35', NULL, 'Fone de ouvido', 10, 'AV1801', 'Mouse e carregador', 'Não sai aúdio no lado esquerdo', 'R$ 0.00', '80.00', 0, 'Observações da Ordem de serviços', '2021-01-08 21:29:55');
INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_situacao_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento_id`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES (2, 1, 102, 2, '2020-02-14 17:48:53', NULL, 'Notebook gamer', 2, 'FONE01', 'Mouse e carregador', 'Não carrega', 'R$ 0.00', '80.00', 0, '', '2021-01-08 21:29:58');
INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_situacao_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento_id`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES (3, 1, 104, 2, '2020-02-17 20:53:26', NULL, 'Notebook Sony', 10, 'FONE01', 'Mouse e carregador', 'Tela trincada', 'R$ 0.00', '120.00', 1, 'Vem buscar pela manhã', '2021-01-08 21:30:01');
INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_situacao_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento_id`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES (11, NULL, 102, 1, '2021-01-08 20:00:28', NULL, 'Celular J5 Prime', 14, 'SM-G570', 'Sem Acessórios', 'Frontal quebrada', 'R$ 0.00', '0.00', 0, '', '2021-01-08 21:30:03');
INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_situacao_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento_id`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES (12, NULL, 101, 0, '2021-01-09 18:56:54', NULL, 'Celular J5 Prime', 10, 'SM-G570', 'Sem Acessórios', 'Frontal quebrada', 'R$ 25.00', '25.00', 0, '', NULL);
INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_situacao_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento_id`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES (13, NULL, 102, 0, '2021-01-23 21:03:04', NULL, 'Celular J5 Prime', 3, 'SM-G570', 'Sem Acessórios', 'Frontal quebrada', 'R$ 0.00', '0.00', 0, '', NULL);
INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_situacao_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento_id`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES (14, NULL, 102, 0, '2021-01-24 16:50:58', NULL, 'Notebook', 7, 'LN020', 'carregador', 'Lento travando', '-R$ 50.00', '100.00', 3, 'cliente', NULL);


#
# TABLE STRUCTURE FOR: produtos
#

DROP TABLE IF EXISTS `produtos`;

CREATE TABLE `produtos` (
  `produto_id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_codigo` varchar(45) DEFAULT NULL,
  `produto_data_cadastro` datetime DEFAULT NULL,
  `produto_categoria_id` int(11) NOT NULL,
  `produto_marca_id` int(11) NOT NULL,
  `produto_fornecedor_id` int(11) NOT NULL,
  `produto_descricao` varchar(145) DEFAULT NULL,
  `produto_unidade` varchar(25) DEFAULT NULL,
  `produto_preco_custo` varchar(45) DEFAULT NULL,
  `produto_preco_venda` varchar(45) DEFAULT NULL,
  `produto_estoque_minimo` varchar(10) DEFAULT NULL,
  `produto_qtde_estoque` varchar(10) DEFAULT NULL,
  `produto_ativo` tinyint(1) DEFAULT NULL,
  `produto_obs` tinytext DEFAULT NULL,
  `produto_data_alteracao` timestamp NOT NULL DEFAULT '2020-12-01 01:00:00',
  PRIMARY KEY (`produto_id`),
  KEY `produto_categoria_id` (`produto_categoria_id`,`produto_marca_id`,`produto_fornecedor_id`),
  KEY `fk_produto_marca_id` (`produto_marca_id`),
  KEY `fk_produto_forncedor_id` (`produto_fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `produtos` (`produto_id`, `produto_codigo`, `produto_data_cadastro`, `produto_categoria_id`, `produto_marca_id`, `produto_fornecedor_id`, `produto_descricao`, `produto_unidade`, `produto_preco_custo`, `produto_preco_venda`, `produto_estoque_minimo`, `produto_qtde_estoque`, `produto_ativo`, `produto_obs`, `produto_data_alteracao`) VALUES (1, '72495380', NULL, 1, 7, 4001, 'Notebook gamer', 'UN', '1.800,00', '3.900,00', '2', '4', 1, 'TESTE DE INFORMAÇÕES', '2020-12-14 19:44:47');
INSERT INTO `produtos` (`produto_id`, `produto_codigo`, `produto_data_cadastro`, `produto_categoria_id`, `produto_marca_id`, `produto_fornecedor_id`, `produto_descricao`, `produto_unidade`, `produto_preco_custo`, `produto_preco_venda`, `produto_estoque_minimo`, `produto_qtde_estoque`, `produto_ativo`, `produto_obs`, `produto_data_alteracao`) VALUES (2, '50412637', NULL, 1, 3, 4001, 'Fone de ouvido gamer', 'UN', '112,00', '125,00', '1', '42', 1, '', '2020-12-14 19:25:09');
INSERT INTO `produtos` (`produto_id`, `produto_codigo`, `produto_data_cadastro`, `produto_categoria_id`, `produto_marca_id`, `produto_fornecedor_id`, `produto_descricao`, `produto_unidade`, `produto_preco_custo`, `produto_preco_venda`, `produto_estoque_minimo`, `produto_qtde_estoque`, `produto_ativo`, `produto_obs`, `produto_data_alteracao`) VALUES (7, '19564702', NULL, 4, 8, 4004, 'Teclado Usb - Multilaser', 'UN', '10,00', '12,00', '2', '2', 1, 'Teclado usb comum', '2020-12-01 01:00:00');


#
# TABLE STRUCTURE FOR: servicos
#

DROP TABLE IF EXISTS `servicos`;

CREATE TABLE `servicos` (
  `servico_id` int(11) NOT NULL AUTO_INCREMENT,
  `servico_nome` varchar(145) DEFAULT NULL,
  `servico_preco` varchar(15) DEFAULT NULL,
  `servico_descricao` tinytext DEFAULT NULL,
  `servico_ativo` tinyint(1) DEFAULT NULL,
  `servico_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`servico_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `servicos` (`servico_id`, `servico_nome`, `servico_preco`, `servico_descricao`, `servico_ativo`, `servico_data_alteracao`) VALUES (1, 'Formatação', '80,00', 'Formatação de computadores ou tablets', 1, '2021-01-24 16:52:54');
INSERT INTO `servicos` (`servico_id`, `servico_nome`, `servico_preco`, `servico_descricao`, `servico_ativo`, `servico_data_alteracao`) VALUES (2, 'Solda elétrica', '80,00', 'Solda elétrica', 0, '2020-12-13 08:46:03');
INSERT INTO `servicos` (`servico_id`, `servico_nome`, `servico_preco`, `servico_descricao`, `servico_ativo`, `servico_data_alteracao`) VALUES (3, 'Restauração de componentes', '120,00', 'Restauração de componentes', 1, '2020-02-13 19:11:29');


#
# TABLE STRUCTURE FOR: sistema
#

DROP TABLE IF EXISTS `sistema`;

CREATE TABLE `sistema` (
  `sistema_id` int(11) NOT NULL AUTO_INCREMENT,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_cnpj` varchar(25) DEFAULT NULL,
  `sistema_ie` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_url` varchar(100) DEFAULT NULL,
  `sistema_cep` varchar(25) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_bairro` varchar(75) NOT NULL,
  `sistema_cidade` varchar(45) DEFAULT NULL,
  `sistema_estado` varchar(2) DEFAULT NULL,
  `sistema_txt_ordem_servico` tinytext DEFAULT NULL,
  `sistema_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`sistema_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sistema` (`sistema_id`, `sistema_razao_social`, `sistema_nome_fantasia`, `sistema_cnpj`, `sistema_ie`, `sistema_telefone_fixo`, `sistema_telefone_movel`, `sistema_email`, `sistema_site_url`, `sistema_cep`, `sistema_endereco`, `sistema_numero`, `sistema_bairro`, `sistema_cidade`, `sistema_estado`, `sistema_txt_ordem_servico`, `sistema_data_alteracao`) VALUES (1, 'Funk Celulares e Informática', 'sistema de Ordem de serviços', '08.622.523/0001-00', '21088827-0', '(88) 2154-6541', '(88) 9 8842-0622', 'contato@sistema.net', 'http://localhost/sistema/', '63.034-118', 'rua jose xavier de oliveira', '68', 'pirajá', 'juazeiro do norte', 'CE', 'Teste de texto que irá constar nas ordens de serviços e nas vendas...', '2021-01-08 20:38:13');


#
# TABLE STRUCTURE FOR: situacoes
#

DROP TABLE IF EXISTS `situacoes`;

CREATE TABLE `situacoes` (
  `situacao_id` int(11) NOT NULL AUTO_INCREMENT,
  `situacao_nome` varchar(45) NOT NULL,
  `situacao_ativa` tinyint(1) DEFAULT NULL,
  `situacao_data_alteracao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`situacao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO `situacoes` (`situacao_id`, `situacao_nome`, `situacao_ativa`, `situacao_data_alteracao`) VALUES (1, 'Aguardando Orçamento', 1, '2021-01-08 21:31:08');
INSERT INTO `situacoes` (`situacao_id`, `situacao_nome`, `situacao_ativa`, `situacao_data_alteracao`) VALUES (2, 'Aguardando Autorização', 1, '2021-01-08 21:16:46');
INSERT INTO `situacoes` (`situacao_id`, `situacao_nome`, `situacao_ativa`, `situacao_data_alteracao`) VALUES (18, 'Orçamento autorizado', 1, '0000-00-00 00:00:00');
INSERT INTO `situacoes` (`situacao_id`, `situacao_nome`, `situacao_ativa`, `situacao_data_alteracao`) VALUES (19, 'Aguardando peças', 1, '0000-00-00 00:00:00');
INSERT INTO `situacoes` (`situacao_id`, `situacao_nome`, `situacao_ativa`, `situacao_data_alteracao`) VALUES (20, 'Reparo em andamento', 1, '0000-00-00 00:00:00');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES (5, '::1', 'jaderoliveiraa', '$2y$12$UzF1Mvpp1Jj4z4J6lZvC9unbkIUxScVv9SlFstbwSgJim1qdicwGS', 'jaderoliveiraa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1607043618, 1611534840, 1, 'Carlos jader', 'da Silva oliveira', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES (9, '::1', 'jadderr', '$2y$10$AdqCUHg0BfAILRGufrsjDuENZ6fmTadlPxES3HeABFAz8lGOdftCe', 'jadderr@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1610847677, 1611521298, 1, 'Carlos demostenes', 'oliveira', NULL, NULL);


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (15, 5, 1);
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (22, 9, 2);


#
# TABLE STRUCTURE FOR: venda_produtos
#

DROP TABLE IF EXISTS `venda_produtos`;

CREATE TABLE `venda_produtos` (
  `id_venda_produtos` int(11) NOT NULL AUTO_INCREMENT,
  `venda_produto_id_venda` int(11) DEFAULT NULL,
  `venda_produto_id_produto` int(11) DEFAULT NULL,
  `venda_produto_quantidade` varchar(15) DEFAULT NULL,
  `venda_produto_valor_unitario` varchar(20) DEFAULT NULL,
  `venda_produto_desconto` varchar(10) DEFAULT NULL,
  `venda_produto_valor_total` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_venda_produtos`),
  KEY `fk_venda_produtos_id_produto` (`venda_produto_id_produto`),
  KEY `fk_venda_produtos_id_venda` (`venda_produto_id_venda`),
  CONSTRAINT `fk_venda_produtos_id_produto` FOREIGN KEY (`venda_produto_id_produto`) REFERENCES `produtos` (`produto_id`),
  CONSTRAINT `fk_venda_produtos_id_venda` FOREIGN KEY (`venda_produto_id_venda`) REFERENCES `vendas` (`venda_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO `venda_produtos` (`id_venda_produtos`, `venda_produto_id_venda`, `venda_produto_id_produto`, `venda_produto_quantidade`, `venda_produto_valor_unitario`, `venda_produto_desconto`, `venda_produto_valor_total`) VALUES (11, 1, 7, '1', ' 12.00', '0 ', ' 12.00');
INSERT INTO `venda_produtos` (`id_venda_produtos`, `venda_produto_id_venda`, `venda_produto_id_produto`, `venda_produto_quantidade`, `venda_produto_valor_unitario`, `venda_produto_desconto`, `venda_produto_valor_total`) VALUES (12, 2, 2, '1', ' 125.00', '0 ', ' 125.00');
INSERT INTO `venda_produtos` (`id_venda_produtos`, `venda_produto_id_venda`, `venda_produto_id_produto`, `venda_produto_quantidade`, `venda_produto_valor_unitario`, `venda_produto_desconto`, `venda_produto_valor_total`) VALUES (13, 3, 7, '1', ' 12.00', '0 ', ' 12.00');
INSERT INTO `venda_produtos` (`id_venda_produtos`, `venda_produto_id_venda`, `venda_produto_id_produto`, `venda_produto_quantidade`, `venda_produto_valor_unitario`, `venda_produto_desconto`, `venda_produto_valor_total`) VALUES (21, 11, 1, '1', ' 3900.00', '0 ', ' 3,900.00');


#
# TABLE STRUCTURE FOR: vendas
#

DROP TABLE IF EXISTS `vendas`;

CREATE TABLE `vendas` (
  `venda_id` int(11) NOT NULL AUTO_INCREMENT,
  `venda_cliente_id` int(11) DEFAULT NULL,
  `venda_forma_pagamento_id` int(11) DEFAULT NULL,
  `venda_vendedor_id` int(11) DEFAULT NULL,
  `venda_tipo` tinyint(1) DEFAULT NULL,
  `venda_data_emissao` timestamp NULL DEFAULT current_timestamp(),
  `venda_valor_desconto` varchar(25) DEFAULT NULL,
  `venda_valor_total` varchar(25) DEFAULT NULL,
  `venda_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`venda_id`),
  KEY `fk_venda_cliente_id` (`venda_cliente_id`),
  KEY `fk_venda_forma_pagto_id` (`venda_forma_pagamento_id`),
  KEY `fk_venda_vendedor_id` (`venda_vendedor_id`),
  CONSTRAINT `fk_venda_cliente_id` FOREIGN KEY (`venda_cliente_id`) REFERENCES `clientes` (`cliente_id`),
  CONSTRAINT `fk_venda_forma_pagto_id` FOREIGN KEY (`venda_forma_pagamento_id`) REFERENCES `formas_pagamentos` (`forma_pagamento_id`),
  CONSTRAINT `fk_venda_vendedor_id` FOREIGN KEY (`venda_vendedor_id`) REFERENCES `vendedores` (`vendedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `vendas` (`venda_id`, `venda_cliente_id`, `venda_forma_pagamento_id`, `venda_vendedor_id`, `venda_tipo`, `venda_data_emissao`, `venda_valor_desconto`, `venda_valor_total`, `venda_data_alteracao`) VALUES (1, 101, 1, 5, 1, '2021-01-04 10:41:45', 'R$ 0.00', '12.00', '2021-01-10 13:10:46');
INSERT INTO `vendas` (`venda_id`, `venda_cliente_id`, `venda_forma_pagamento_id`, `venda_vendedor_id`, `venda_tipo`, `venda_data_emissao`, `venda_valor_desconto`, `venda_valor_total`, `venda_data_alteracao`) VALUES (2, 102, 2, 5, 1, '2021-01-12 21:46:48', 'R$ 0.00', '125.00', NULL);
INSERT INTO `vendas` (`venda_id`, `venda_cliente_id`, `venda_forma_pagamento_id`, `venda_vendedor_id`, `venda_tipo`, `venda_data_emissao`, `venda_valor_desconto`, `venda_valor_total`, `venda_data_alteracao`) VALUES (3, 104, 4, 1, 1, '2021-01-12 22:29:44', 'R$ 0.00', '12.00', NULL);
INSERT INTO `vendas` (`venda_id`, `venda_cliente_id`, `venda_forma_pagamento_id`, `venda_vendedor_id`, `venda_tipo`, `venda_data_emissao`, `venda_valor_desconto`, `venda_valor_total`, `venda_data_alteracao`) VALUES (11, 102, 1, 5, 2, '2021-01-24 17:14:55', 'R$ 0.00', '3,900.00', NULL);


#
# TABLE STRUCTURE FOR: vendedores
#

DROP TABLE IF EXISTS `vendedores`;

CREATE TABLE `vendedores` (
  `vendedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendedor_codigo` varchar(10) NOT NULL,
  `vendedor_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `vendedor_nome_completo` varchar(145) NOT NULL,
  `vendedor_cpf` varchar(25) NOT NULL,
  `vendedor_rg` varchar(25) NOT NULL,
  `vendedor_telefone` varchar(15) DEFAULT NULL,
  `vendedor_celular` varchar(15) DEFAULT NULL,
  `vendedor_email` varchar(45) DEFAULT NULL,
  `vendedor_cep` varchar(15) DEFAULT NULL,
  `vendedor_endereco` varchar(45) DEFAULT NULL,
  `vendedor_numero_endereco` varchar(25) DEFAULT NULL,
  `vendedor_complemento` varchar(45) DEFAULT NULL,
  `vendedor_bairro` varchar(45) DEFAULT NULL,
  `vendedor_cidade` varchar(45) DEFAULT NULL,
  `vendedor_estado` varchar(2) DEFAULT NULL,
  `vendedor_ativo` tinyint(1) DEFAULT NULL,
  `vendedor_obs` tinytext DEFAULT NULL,
  `vendedor_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`vendedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `vendedores` (`vendedor_id`, `vendedor_codigo`, `vendedor_data_cadastro`, `vendedor_nome_completo`, `vendedor_cpf`, `vendedor_rg`, `vendedor_telefone`, `vendedor_celular`, `vendedor_email`, `vendedor_cep`, `vendedor_endereco`, `vendedor_numero_endereco`, `vendedor_complemento`, `vendedor_bairro`, `vendedor_cidade`, `vendedor_estado`, `vendedor_ativo`, `vendedor_obs`, `vendedor_data_alteracao`) VALUES (1, '09842571', '2020-01-27 22:24:17', 'Lucio Antonio de Souza', '946.873.070-00', '36.803.319-3', '', '(41) 99999-9999', 'vendedor@gmail.com', '80530-000', 'Rua das vendas', '45', '', 'Centro', 'Curitiba', 'PR', 1, '', '2020-01-27 22:24:17');
INSERT INTO `vendedores` (`vendedor_id`, `vendedor_codigo`, `vendedor_data_cadastro`, `vendedor_nome_completo`, `vendedor_cpf`, `vendedor_rg`, `vendedor_telefone`, `vendedor_celular`, `vendedor_email`, `vendedor_cep`, `vendedor_endereco`, `vendedor_numero_endereco`, `vendedor_complemento`, `vendedor_bairro`, `vendedor_cidade`, `vendedor_estado`, `vendedor_ativo`, `vendedor_obs`, `vendedor_data_alteracao`) VALUES (5, '80967534', '2020-12-12 22:55:30', 'Daniel Coelho do Nascimento', '111.111.111-11', '54849788', '(69) 3229-5874', '(69) 98487-5869', 'danielcoelho461@gmail.com', '63.030-000', 'Rua Rui Barbosa 1975', '6548', 'loja 1', 'centro', 'Juazeiro do Norte', 'CE', 1, '', '2020-12-12 22:55:30');


