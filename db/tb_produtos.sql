USE db_pagamento;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto VARCHAR(100) NOT NULL UNIQUE,
    quantidade INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);