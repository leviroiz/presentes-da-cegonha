<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_once __DIR__ . '/config/database.php';

$customers = db()->query(
    'SELECT id_cliente, data_cadastro, nome, cpf, email, telefone, cidade
     FROM tb_cliente ORDER BY id_cliente DESC'
)->fetch_all(MYSQLI_ASSOC);
$flash = pull_flash();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Clientes | Administração</title>
</head>
<body class="admin-page">
<main class="admin-shell">
    <header class="admin-header">
        <div>
            <h1>Clientes</h1>
            <p>A senha nunca é exibida; apenas o hash é armazenado.</p>
        </div>
        <a class="admin-button secondary" href="tela_admin.php">Voltar ao painel</a>
    </header>

    <?php if ($flash): ?>
        <p class="admin-flash <?php echo $flash['type'] === 'error' ? 'error' : ''; ?>" role="alert">
            <?php echo e($flash['message']); ?>
        </p>
    <?php endif; ?>

    <section class="admin-card" aria-label="Lista de clientes">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo e($customer['id_cliente']); ?></td>
                    <td><?php echo e($customer['nome']); ?></td>
                    <td><?php echo e($customer['email']); ?></td>
                    <td><?php echo e($customer['telefone']); ?></td>
                    <td><?php echo e($customer['cidade']); ?></td>
                    <td><?php echo e(date('d/m/Y', strtotime($customer['data_cadastro']))); ?></td>
                    <td>
                        <a class="admin-button secondary" href="alterar_cliente.php?id=<?php echo e($customer['id_cliente']); ?>">Editar</a>
                        <form action="deletar_user.php" method="post" onsubmit="return confirm('Deseja remover este cliente?');">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id_cliente" value="<?php echo e($customer['id_cliente']); ?>">
                            <button class="admin-button danger" type="submit">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$customers): ?>
                <tr><td colspan="7">Nenhum cliente cadastrado.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>
