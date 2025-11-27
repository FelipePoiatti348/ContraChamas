CREATE DATABASE avcb_form;
USE avcb_form;

CREATE TABLE solicitacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(200),
  endereco VARCHAR(255),
  email VARCHAR(150),
  telefone VARCHAR(50),
  tem_avcb VARCHAR(10),
  area DECIMAL(10,2),
  arquivo VARCHAR(255),
  data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
