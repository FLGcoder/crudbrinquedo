CREATE DATABASE crud_brinquedos;
USE crud_brinquedos;

CREATE TABLE brinquedos (
    id INT AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    faixa_estaria VARCHAR(20) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO brinquedos (nome, categoria, faixa_estaria, preco, quantidade) VALUES
('Quebra-cabeça 100 peças', 'Quebra-cabeça', '6-8 anos', 39.90, 25),
('Carrinho Controle Remoto', 'Veículos', '6-8 anos', 189.90, 10),
('Jogo de Tabuleiro', 'Jogos', '9-11 anos', 149.00, 7);
