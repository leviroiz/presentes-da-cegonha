<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';
require_admin();
$flash = pull_flash();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Novo produto | Administração</title>
</head>
<body class="admin-page">
<main class="admin-shell">
    <header class="admin-header">
        <div>
            <h1>Novo produto</h1>
            <p>Cadastre um item no catálogo de demonstração.</p>
        </div>
        <a class="admin-button secondary" href="listar_produtos.php">Cancelar</a>
    </header>

    <?php if ($flash): ?>
        <p class="admin-flash error" role="alert"><?php echo e($flash['message']); ?></p>
    <?php endif; ?>

    <section class="admin-card">
        <form class="admin-form" action="cadastrar_produtobd.php" method="post">
            <?php echo csrf_field(); ?>
            <label class="full">Nome
                <input type="text" name="nome" required maxlength="100">
            </label>
            <label>Categoria
                <input type="text" name="categoria" required maxlength="100">
            </label>
            <label>Preço
                <input type="number" name="preco" required min="0.01" step="0.01">
            </label>
            <label>Estoque
                <input type="number" name="estoque" required min="0" step="1">
            </label>
            <div class="full">
                <button class="admin-button" type="submit">Cadastrar produto</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>
