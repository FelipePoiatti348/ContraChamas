CREATE DATABASE contrachamas;
USE contrachamas;

--Table do criar conta (criarConta)
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(200) NOT NULL,
  email VARCHAR(150) NOT NULL,
  senha VARCHAR(200) NOT NULL,
  telefone VARCHAR(50) NOT NULL
);

--Table de solicitaçoes (pag.inicial)
CREATE TABLE solicitacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(200) NOT NULL,
  endereco VARCHAR(255) NOT NULL,
  email VARCHAR(150) NOT NULL,
  telefone VARCHAR(50) NOT NULL,
  tem_avcb VARCHAR(10) NOT NULL,
  area DECIMAL(10,2) NOT NULL,
  arquivo VARCHAR(255) NOT NULL,
  data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);






