CREATE DATABASE Dominor;
use Dominor;
CREATE TABLE usuarios(

	codigo int AUTO_INCREMENT PRIMARY KEY,
    nome varchar(30) not null,
    senha varchar(256),
    pontos int 
);



INSERT INTO usuarios (nome, senha) VALUES ('admin12345', SHA2('12345', 256));