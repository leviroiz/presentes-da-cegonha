<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_once __DIR__ . '/config/database.php';

$customerId = get_positive_int('id');
$statement = db()->prepare(
    'SELECT id_cliente, nome, email, telefone, bairro, cidade, rua, n_residencia, CEP
     FROM tb_cliente WHERE id_cliente = ?'
);
$statement->bind_param('i', $customerId);
$statement->execute();
$customer = $statement->get_result()->fetch_assoc();

if (!$customer) {
    http_response_code(404);
    exit('Cliente não encontrado.');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Editar cliente | Administração</title>
</head>
<body class="admin-page">
<main class="admin-shell">
    <header class="admin-header">
        <div>
            <h1>Editar cliente</h1>
            <p>Dados de autenticação não são exibidos nesta tela.</p>
        </div>
        <a class="admin-button secondary" href="listar_user.php">Cancelar</a>
    </header>

    <section class="admin-card">
        <form class="admin-form" action="alterar_clientebd.php" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id_cliente" value="<?php echo e($customer['id_cliente']); ?>">

            <label>Nome
                <input type="text" name="nome" required maxlength="100" value="<?php echo e($customer['nome']); ?>">
            </label>
            <label>E-mail
                <input type="email" name="email" required maxlength="150" value="<?php echo e($customer['email']); ?>">
            </label>
            <label>Telefone
                <input type="tel" name="telefone" required maxlength="15" value="<?php echo e($customer['telefone']); ?>">
            </label>
            <label>CEP
                <input type="text" name="CEP" required maxlength="9" value="<?php echo e($customer['CEP']); ?>">
            </label>
            <label>Cidade
                <input type="text" name="cidade" required maxlength="100" value="<?php echo e($customer['cidade']); ?>">
            </label>
            <label>Bairro
                <input type="text" name="bairro" required maxlength="100" value="<?php echo e($customer['bairro']); ?>">
            </label>
            <label>Rua
                <input type="text" name="rua" required maxlength="150" value="<?php echo e($customer['rua']); ?>">
            </label>
            <label>Número
                <input type="text" name="n_residencia" required maxlength="20" value="<?php echo e($customer['n_residencia']); ?>">
            </label>
            <div class="full">
                <button class="admin-button" type="submit">Salvar alterações</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>
