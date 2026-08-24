<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_once __DIR__ . '/config/database.php';

$productId = get_positive_int('id');
$statement = db()->prepare(
    'SELECT id_produto, nome, preco, estoque FROM tb_produtos WHERE id_produto = ?'
);
$statement->bind_param('i', $productId);
$statement->execute();
$product = $statement->get_result()->fetch_assoc();

if (!$product) {
    http_response_code(404);
    exit('Produto não encontrado.');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Editar produto | Administração</title>
</head>
<body class="admin-page">
<main class="admin-shell">
    <header class="admin-header">
        <div>
            <h1>Editar produto</h1>
            <p>Atualize os dados operacionais do catálogo.</p>
        </div>
        <a class="admin-button secondary" href="listar_produtos.php">Cancelar</a>
    </header>

    <section class="admin-card">
        <form class="admin-form" action="alterar_produtobd.php" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id_produto" value="<?php echo e($product['id_produto']); ?>">

            <label class="full">Nome
                <input type="text" name="nome" required maxlength="100" value="<?php echo e($product['nome']); ?>">
            </label>
            <label>Preço
                <input type="number" name="preco" required min="0.01" step="0.01" value="<?php echo e($product['preco']); ?>">
            </label>
            <label>Estoque
                <input type="number" name="estoque" required min="0" step="1" value="<?php echo e($product['estoque']); ?>">
            </label>
            <div class="full">
                <button class="admin-button" type="submit">Salvar alterações</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>
