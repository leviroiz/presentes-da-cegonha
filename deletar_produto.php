<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$productId = post_positive_int('id_produto');

if ($productId === 0) {
    set_flash('error', 'Produto inválido.');
    redirect('listar_produtos.php');
}

$statement = db()->prepare('DELETE FROM tb_produtos WHERE id_produto = ?');
$statement->bind_param('i', $productId);

try {
    $statement->execute();
    set_flash('success', 'Produto removido com sucesso.');
} catch (mysqli_sql_exception $exception) {
    set_flash('error', 'O produto possui pedidos relacionados e não pode ser removido.');
}

redirect('listar_produtos.php');
