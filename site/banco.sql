create table cidade(
    cd_cidade INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nm_cidade VARCHAR(50) NOT NULL,
    uf_cidade CHAR(2) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

create table cadastro(
    cd_cadastro INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nm_cadastro VARCHAR(50) NOT NULL,
    dt_nascto DATE NOT NULL,
    sexo CHAR(1) NOT NULL,
    co_complemento VARCHAR(80),
    nr_endereco VARCHAR(5) NOT NULL,
    ba_cadastro VARCHAR(50) NOT NULL,
    cd_cidade INT NOT NULL,
    ed_cadastro VARCHAR(80) NOT NULL,
    nr_cep VARCHAR(9) NOT NULL,
    nr_cpf VARCHAR(14) NOT NULL,
    nr_rg VARCHAR(9) NOT NULL,
    ed_email VARCHAR(80) NOT NULL,
    nr_telefone VARCHAR(14),
    nr_contato VARCHAR(14)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE cadastro ADD FOREIGN KEY (cd_cidade) REFERENCES cidade(cd_cidade);

create table permissao(
    cd_permissao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ds_permissao VARCHAR(50) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


create table login(
    cd_cadastro INT NOT NULL,
    nm_usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    cd_permissao INT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE login ADD FOREIGN KEY (cd_cadastro) REFERENCES cadastro(cd_cadastro);
ALTER TABLE login ADD FOREIGN KEY (cd_permissao) REFERENCES permissao(cd_permissao);

INSERT INTO permissao (ds_permissao) VALUES ('Administrador');
INSERT INTO permissao (ds_permissao) VALUES ('Usuário');

INSERT INTO cidade (nm_cidade,uf_cidade) VALUES ('Criciúma','UF');