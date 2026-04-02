CREATE DATABASE projeto;
USE projeto;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(150),
    senha VARCHAR(255),
    mensagem VARCHAR(250)
);