<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_customer();
require_once __DIR__ . '/config/database.php';

$productId = get_positive_int('produto_id');
$productStatement = db()->prepare(
    'SELECT id_produto, nome, preco, estoque FROM tb_produtos WHERE id_produto = ?'
);
$productStatement->bind_param('i', $productId);
$productStatement->execute();
$product = $productStatement->get_result()->fetch_assoc();

if (!$product) {
    set_flash('error', 'Produto não encontrado.');
    redirect('home.php');
}

$customerId = (int) $_SESSION['id_cliente'];
$customerStatement = db()->prepare(
    'SELECT CEP, cidade, bairro, rua, n_residencia FROM tb_cliente WHERE id_cliente = ?'
);
$customerStatement->bind_param('i', $customerId);
$customerStatement->execute();
$customer = $customerStatement->get_result()->fetch_assoc();
$flash = pull_flash();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/checkout.css">
    <title>Finalizar pedido | Presentes da Cegonha</title>
</head>
<body class="checkout-page">
<main class="checkout-shell">
    <header class="checkout-header">
        <img src="img/logosite.png" alt="Presentes da Cegonha">
        <a class="checkout-back" href="home.php">Voltar à loja</a>
    </header>

    <section class="checkout-card">
        <div class="checkout-summary">
            <div>
                <h1><?php echo e($product['nome']); ?></h1>
                <p><?php echo (int) $product['estoque'] > 0 ? 'Disponível para demonstração' : 'Sem estoque'; ?></p>
            </div>
            <span class="checkout-price">R$ <?php echo e(number_format((float) $product['preco'], 2, ',', '.')); ?></span>
        </div>

        <?php if ($flash): ?>
            <p class="checkout-flash" role="alert"><?php echo e($flash['message']); ?></p>
        <?php endif; ?>

        <p class="checkout-note">
            Este é um fluxo acadêmico de demonstração. Nenhuma cobrança real ou dado de cartão é processado.
        </p>

        <?php if ((int) $product['estoque'] > 0): ?>
        <form class="checkout-form" action="pagamentobd.php" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id_produto" value="<?php echo e($product['id_produto']); ?>">

            <label>CEP
                <input type="text" name="cep" required maxlength="9" inputmode="numeric" value="<?php echo e($customer['CEP'] ?? ''); ?>">
            </label>
            <label>Cidade
                <input type="text" name="cidade" required maxlength="100" value="<?php echo e($customer['cidade'] ?? ''); ?>">
            </label>
            <label>Bairro
                <input type="text" name="bairro" required maxlength="100" value="<?php echo e($customer['bairro'] ?? ''); ?>">
            </label>
            <label>Rua
                <input type="text" name="rua" required maxlength="150" value="<?php echo e($customer['rua'] ?? ''); ?>">
            </label>
            <label>Número
                <input type="text" name="n_residencia" required maxlength="20" value="<?php echo e($customer['n_residencia'] ?? ''); ?>">
            </label>

            <fieldset class="full">
                <legend>Método de pagamento simulado</legend>
                <div class="checkout-options">
                    <label><input type="radio" name="tipo_pagamento" value="Cartão de Crédito" required> Cartão</label>
                    <label><input type="radio" name="tipo_pagamento" value="Dinheiro"> Dinheiro</label>
                    <label><input type="radio" name="tipo_pagamento" value="Pix"> Pix</label>
                </div>
            </fieldset>

            <div class="full">
                <button class="checkout-button" type="submit">Registrar pedido de demonstração</button>
            </div>
        </form>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
