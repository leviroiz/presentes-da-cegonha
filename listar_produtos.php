<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_once __DIR__ . '/config/database.php';

$products = db()->query(
    'SELECT id_produto, id_admin_cadastro, data_cadastro, nome, preco, estoque, categoria
     FROM tb_produtos ORDER BY id_produto DESC'
)->fetch_all(MYSQLI_ASSOC);
$flash = pull_flash();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Produtos | Administração</title>
</head>
<body class="admin-page">
<main class="admin-shell">
    <header class="admin-header">
        <div>
            <h1>Produtos</h1>
            <p>Gerencie o catálogo da demonstração.</p>
        </div>
        <nav class="admin-actions" aria-label="Ações administrativas">
            <a class="admin-button secondary" href="tela_admin.php">Painel</a>
            <a class="admin-button" href="cadastrar_produto.php">Novo produto</a>
        </nav>
    </header>

    <?php if ($flash): ?>
        <p class="admin-flash <?php echo $flash['type'] === 'error' ? 'error' : ''; ?>" role="alert">
            <?php echo e($flash['message']); ?>
        </p>
    <?php endif; ?>

    <section class="admin-card" aria-label="Lista de produtos">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo e($product['id_produto']); ?></td>
                    <td><?php echo e($product['nome']); ?></td>
                    <td><?php echo e($product['categoria']); ?></td>
                    <td>R$ <?php echo e(number_format((float) $product['preco'], 2, ',', '.')); ?></td>
                    <td><?php echo e($product['estoque']); ?></td>
                    <td><?php echo e(date('d/m/Y', strtotime($product['data_cadastro']))); ?></td>
                    <td>
                        <a class="admin-button secondary" href="alterar_produto.php?id=<?php echo e($product['id_produto']); ?>">Editar</a>
                        <form action="deletar_produto.php" method="post" onsubmit="return confirm('Deseja remover este produto?');">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id_produto" value="<?php echo e($product['id_produto']); ?>">
                            <button class="admin-button danger" type="submit">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$products): ?>
                <tr><td colspan="7">Nenhum produto cadastrado.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>
