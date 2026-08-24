<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';
require_admin();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Painel administrativo</title>
</head>
<body class="admin-page">
<main class="admin-shell">
    <header class="admin-header">
        <div>
            <h1>Painel administrativo</h1>
            <p>Olá, <?php echo e($_SESSION['admin_nome'] ?? 'administrador'); ?>.</p>
        </div>
        <form action="logout.php" method="post">
            <?php echo csrf_field(); ?>
            <button class="admin-button secondary" type="submit">Sair</button>
        </form>
    </header>

    <section class="admin-card">
        <div class="admin-actions">
            <a class="admin-button" href="cadastrar_produto.php">Cadastrar produto</a>
            <a class="admin-button secondary" href="listar_produtos.php">Gerenciar produtos</a>
            <a class="admin-button secondary" href="listar_user.php">Gerenciar clientes</a>
        </div>
    </section>
</main>
</body>
</html>
