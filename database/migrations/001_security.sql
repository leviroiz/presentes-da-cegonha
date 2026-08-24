-- Migração para instalações criadas a partir do dump acadêmico de 2023.
-- Faça backup do banco antes de executar em uma instalação existente.

USE bd_cegonha;

-- Remove apenas os registros fictícios/inseguros presentes no dump público original.
DELETE FROM tb_admin WHERE login = 'admin' AND senha = 'admin';
DELETE FROM tb_cliente WHERE email = '123@teste.com' AND senha = '1234';

ALTER TABLE tb_admin
    MODIFY nome VARCHAR(100) NOT NULL,
    MODIFY login VARCHAR(100) NOT NULL,
    MODIFY senha VARCHAR(255) NOT NULL,
    MODIFY status_login VARCHAR(20) NOT NULL DEFAULT 'ativo',
    CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE tb_cliente
    MODIFY nome VARCHAR(100) NOT NULL,
    MODIFY cpf CHAR(11) NOT NULL,
    MODIFY email VARCHAR(150) NOT NULL,
    MODIFY senha VARCHAR(255) NOT NULL,
    MODIFY telefone VARCHAR(20) NOT NULL,
    MODIFY bairro VARCHAR(100) NOT NULL,
    MODIFY cidade VARCHAR(100) NOT NULL,
    MODIFY rua VARCHAR(150) NOT NULL,
    MODIFY n_residencia VARCHAR(20) NOT NULL,
    MODIFY CEP CHAR(8) NOT NULL,
    MODIFY sexo VARCHAR(20) NOT NULL,
    CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE tb_produtos
    MODIFY nome VARCHAR(100) NOT NULL,
    MODIFY preco DECIMAL(10,2) UNSIGNED NOT NULL,
    MODIFY estoque INT UNSIGNED NOT NULL DEFAULT 0,
    MODIFY categoria VARCHAR(100) NOT NULL,
    CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE tb_realiza_pagamento
    CHANGE data_pagamente data_pagamento TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    MODIFY cep CHAR(8) NOT NULL,
    MODIFY cidade VARCHAR(100) NOT NULL,
    MODIFY bairro VARCHAR(100) NOT NULL,
    MODIFY rua VARCHAR(150) NOT NULL,
    MODIFY n_residencia VARCHAR(20) NOT NULL,
    MODIFY tipo_pagamento VARCHAR(30) NOT NULL,
    MODIFY valor DECIMAL(10,2) UNSIGNED NOT NULL,
    CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE tb_admin ADD UNIQUE KEY uq_admin_login (login);
ALTER TABLE tb_cliente ADD UNIQUE KEY uq_cliente_cpf (cpf);
ALTER TABLE tb_cliente ADD UNIQUE KEY uq_cliente_email (email);
