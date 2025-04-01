USE sistema_login;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto VARCHAR(100) NOT NULL UNIQUE,
    quantidade INT NOT NULL,
    preco INT NOT NULL,
    --data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);