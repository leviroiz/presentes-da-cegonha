<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$productId = post_positive_int('id_produto');
$name = post_string('nome');
$price = filter_var(post_string('preco'), FILTER_VALIDATE_FLOAT);
$stock = filter_var(post_string('estoque'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);

if ($productId === 0 || $name === '' || strlen($name) > 100 || $price === false || $price <= 0 || $stock === false) {
    set_flash('error', 'Dados do produto inválidos.');
    redirect('listar_produtos.php');
}

$statement = db()->prepare(
    'UPDATE tb_produtos SET nome = ?, preco = ?, estoque = ? WHERE id_produto = ?'
);
$statement->bind_param('sdii', $name, $price, $stock, $productId);
$statement->execute();

set_flash('success', 'Produto atualizado com sucesso.');
redirect('listar_produtos.php');
