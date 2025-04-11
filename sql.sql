-- Gera��o de Modelo f�sico
-- Sql ANSI 2003 - brModelo.
-- DROP DATABASE gerenciador_tarefas;
CREATE DATABASE IF NOT EXISTS gerenciador_tarefas;
USE gerenciador_tarefas;

CREATE TABLE IF NOT EXISTS usuario (
id_usuario INTEGER(14) PRIMARY KEY NOT NULL AUTO_INCREMENT,
email VARCHAR(100) NOT NULL,
nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS tarefa (
id_tarefa INTEGER(14) PRIMARY KEY NOT NULL AUTO_INCREMENT,
descricao VARCHAR(255) NOT NULL,
setor VARCHAR(50) NOT NULL,
data_cadastro DATE NOT NULL,
prioridade VARCHAR(50) NOT NULL,
status ENUM('A fazer', 'Fazendo', 'Pronto') DEFAULT 'A fazer' NOT NULL,
id_usuario INTEGER(14) NOT NULL,
FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario) ON DELETE RESTRICT
);


