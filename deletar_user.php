<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$customerId = post_positive_int('id_cliente');

if ($customerId === 0) {
    set_flash('error', 'Cliente inválido.');
    redirect('listar_user.php');
}

$statement = db()->prepare('DELETE FROM tb_cliente WHERE id_cliente = ?');
$statement->bind_param('i', $customerId);

try {
    $statement->execute();
    set_flash('success', 'Cliente removido com sucesso.');
} catch (mysqli_sql_exception $exception) {
    set_flash('error', 'O cliente possui pedidos relacionados e não pode ser removido.');
}

redirect('listar_user.php');
