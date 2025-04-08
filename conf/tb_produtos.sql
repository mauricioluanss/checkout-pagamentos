-- query pra criar a tabela produtos com as respectivas colunas e tipos.
USE db_pagamento;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto VARCHAR(100) NOT NULL UNIQUE,
    quantidade INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);

-- query para inserir produtos no banco.
INSERT INTO produtos (produto, quantidade, preco)
VALUES 
('Paracetamol 500mg', 100, 5.99),
('Dipirona Gotas 20ml', 80, 7.50),
('Vitamina C 1g', 60, 12.00),
('Álcool 70% 500ml', 40, 9.90),
('Esparadrapo 10cm x 4,5m', 20, 4.50);