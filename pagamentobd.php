<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_customer();
require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$customerId = (int) $_SESSION['id_cliente'];
$productId = post_positive_int('id_produto');
$postalCode = only_digits(post_string('cep'));
$city = post_string('cidade');
$district = post_string('bairro');
$street = post_string('rua');
$houseNumber = post_string('n_residencia');
$paymentType = post_string('tipo_pagamento');
$allowedPaymentTypes = ['Cartão de Crédito', 'Dinheiro', 'Pix'];

if ($productId === 0 || strlen($postalCode) !== 8 || $city === '' || $district === '' || $street === ''
    || $houseNumber === '' || !in_array($paymentType, $allowedPaymentTypes, true)) {
    set_flash('error', 'Revise os dados do pedido.');
    redirect('tela_pagamento.php?produto_id=' . $productId);
}

$connection = db();
$connection->begin_transaction();

try {
    $productStatement = $connection->prepare(
        'SELECT preco, estoque FROM tb_produtos WHERE id_produto = ? FOR UPDATE'
    );
    $productStatement->bind_param('i', $productId);
    $productStatement->execute();
    $product = $productStatement->get_result()->fetch_assoc();

    if (!$product || (int) $product['estoque'] < 1) {
        throw new RuntimeException('Produto indisponível.');
    }

    $value = (float) $product['preco'];
    $paymentStatement = $connection->prepare(
        'INSERT INTO tb_realiza_pagamento
            (id_produto, id_cliente, cep, cidade, bairro, rua, n_residencia, tipo_pagamento, valor)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $paymentStatement->bind_param(
        'iissssssd',
        $productId,
        $customerId,
        $postalCode,
        $city,
        $district,
        $street,
        $houseNumber,
        $paymentType,
        $value
    );
    $paymentStatement->execute();

    $stockStatement = $connection->prepare(
        'UPDATE tb_produtos SET estoque = estoque - 1 WHERE id_produto = ? AND estoque > 0'
    );
    $stockStatement->bind_param('i', $productId);
    $stockStatement->execute();

    $connection->commit();
} catch (Throwable $exception) {
    $connection->rollback();
    error_log('Falha ao registrar pedido: ' . $exception->getMessage());
    set_flash('error', 'Não foi possível registrar o pedido de demonstração.');
    redirect('tela_pagamento.php?produto_id=' . $productId);
}

set_flash('success', 'Pedido de demonstração registrado com sucesso.');
redirect('paychecked.php');
