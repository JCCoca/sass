CREATE DATABASE sass;

USE sass;

CREATE TABLE unidade (
    id BIGINT(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cidade VARCHAR(255) NOT NULL,
    estado CHAR(2) NOT NULL,
    criado_em DATETIME NOT NULL DEFAULT NOW(),
    atualizado_em DATETIME NULL,
    excluido_em DATETIME NULL
);

CREATE TABLE sala (
    id BIGINT(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    quantidade_maquina INT(9) NOT NULL,
    descricao TEXT NULL, 
    situacao ENUM('Ativa', 'Inativa') NOT NULL DEFAULT 'Ativa',
    id_unidade BIGINT(19) NOT NULL,
    FOREIGN KEY (id_unidade) REFERENCES unidade (id),
    criado_em DATETIME NOT NULL DEFAULT NOW(),
    atualizado_em DATETIME NULL,
    excluido_em DATETIME NULL
);

CREATE TABLE perfil (
    id BIGINT(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    criado_em DATETIME NOT NULL DEFAULT NOW(),
    atualizado_em DATETIME NULL,
    excluido_em DATETIME NULL
);

CREATE TABLE usuario (
    id BIGINT(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    funcao VARCHAR(100) NOT NULL,
    id_perfil BIGINT(19) NOT NULL,
    FOREIGN KEY (id_perfil) REFERENCES perfil (id),
    id_unidade BIGINT(19) NOT NULL,
    FOREIGN KEY (id_unidade) REFERENCES unidade (id),
    criado_em DATETIME NOT NULL DEFAULT NOW(),
    atualizado_em DATETIME NULL,
    excluido_em DATETIME NULL
);

CREATE TABLE agendamento (
    id BIGINT(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_termino TIME NOT NULL,
    turma VARCHAR(120) NOT NULL,
    uc VARCHAR(120) NOT NULL,
    motivo TEXT NOT NULL,
    situacao ENUM('Aprovado', 'Negado', 'Aguardando Confirmação') NOT NULL DEFAULT 'Aguardando Confirmação',
    id_usuario BIGINT(19) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario (id),
    id_sala BIGINT(19) NOT NULL,
    FOREIGN KEY (id_sala) REFERENCES sala (id),
    criado_em DATETIME NOT NULL DEFAULT NOW(),
    atualizado_em DATETIME NULL,
    excluido_em DATETIME NULL
);