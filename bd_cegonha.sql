-- Presentes da Cegonha - esquema seguro para ambiente de demonstração
-- Dados pessoais e credenciais do projeto acadêmico original foram removidos.

CREATE DATABASE IF NOT EXISTS bd_cegonha
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE bd_cegonha;

CREATE TABLE IF NOT EXISTS tb_admin (
    id_admin INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    login VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    status_login VARCHAR(20) NOT NULL DEFAULT 'ativo',
    PRIMARY KEY (id_admin),
    UNIQUE KEY uq_admin_login (login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tb_cliente (
    id_cliente INT UNSIGNED NOT NULL AUTO_INCREMENT,
    data_cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) NOT NULL,
    data_nascimento DATE NOT NULL,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    rua VARCHAR(150) NOT NULL,
    n_residencia VARCHAR(20) NOT NULL,
    CEP CHAR(8) NOT NULL,
    sexo VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_cliente),
    UNIQUE KEY uq_cliente_cpf (cpf),
    UNIQUE KEY uq_cliente_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tb_produtos (
    id_produto INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_admin_cadastro INT UNSIGNED NULL,
    data_cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) UNSIGNED NOT NULL,
    estoque INT UNSIGNED NOT NULL DEFAULT 0,
    categoria VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_produto),
    KEY idx_produtos_admin (id_admin_cadastro),
    CONSTRAINT fk_produtos_admin
        FOREIGN KEY (id_admin_cadastro) REFERENCES tb_admin (id_admin)
        ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tb_realiza_pagamento (
    id_pagamento INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_produto INT UNSIGNED NOT NULL,
    id_cliente INT UNSIGNED NOT NULL,
    data_pagamento TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cep CHAR(8) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    rua VARCHAR(150) NOT NULL,
    n_residencia VARCHAR(20) NOT NULL,
    tipo_pagamento VARCHAR(30) NOT NULL,
    valor DECIMAL(10,2) UNSIGNED NOT NULL,
    PRIMARY KEY (id_pagamento),
    KEY idx_pagamentos_produto (id_produto),
    KEY idx_pagamentos_cliente (id_cliente),
    CONSTRAINT fk_pagamentos_produto
        FOREIGN KEY (id_produto) REFERENCES tb_produtos (id_produto)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_pagamentos_cliente
        FOREIGN KEY (id_cliente) REFERENCES tb_cliente (id_cliente)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Catálogo fictício para demonstração. Nenhum dado pessoal é incluído.
INSERT INTO tb_produtos (id_produto, id_admin_cadastro, nome, preco, estoque, categoria) VALUES
    (1, NULL, 'Sandália infantil', 69.99, 10, 'Calçados'),
    (2, NULL, 'Kit com 3 meias', 29.90, 20, 'Acessórios'),
    (3, NULL, 'Sapatinho para bebê', 49.90, 12, 'Calçados'),
    (4, NULL, 'Urso de pelúcia', 69.90, 8, 'Brinquedos'),
    (5, NULL, 'Mamadeira', 19.90, 18, 'Alimentação'),
    (6, NULL, 'Carrinho de bebê', 399.90, 5, 'Passeio'),
    (7, NULL, 'Camiseta infantil', 29.90, 16, 'Roupas'),
    (8, NULL, 'Urso de pelúcia rosa', 69.90, 9, 'Brinquedos'),
    (9, NULL, 'Camiseta para menino', 29.90, 14, 'Roupas'),
    (10, NULL, 'Berço infantil', 109.90, 4, 'Quarto'),
    (11, NULL, 'Sapatinho feminino', 49.90, 11, 'Calçados'),
    (12, NULL, 'Mamadeira rosa', 29.90, 13, 'Alimentação')
ON DUPLICATE KEY UPDATE nome = VALUES(nome);
