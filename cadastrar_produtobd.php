<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$adminId = (int) $_SESSION['id_admin'];
$name = post_string('nome');
$category = post_string('categoria');
$price = filter_var(post_string('preco'), FILTER_VALIDATE_FLOAT);
$stock = filter_var(post_string('estoque'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);

if ($name === '' || strlen($name) > 100 || $category === '' || $price === false || $price <= 0 || $stock === false) {
    set_flash('error', 'Preencha nome, categoria, preço e estoque com valores válidos.');
    redirect('cadastrar_produto.php');
}

$statement = db()->prepare(
    'INSERT INTO tb_produtos (id_admin_cadastro, nome, preco, estoque, categoria) VALUES (?, ?, ?, ?, ?)'
);
$statement->bind_param('isdis', $adminId, $name, $price, $stock, $category);
$statement->execute();

set_flash('success', 'Produto cadastrado com sucesso.');
redirect('listar_produtos.php');
