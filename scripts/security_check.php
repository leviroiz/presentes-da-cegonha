<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
);
$violations = [];
$rules = [
    'mysqli_query legado' => '/\bmysqli_query\s*\(/',
    'entrada escapada antes do banco' => '/htmlspecialchars\s*\(\s*\$_(?:POST|GET)/',
    'redirecionamento por JavaScript' => '/window\.location\s*=/',
    'senha em input de texto' => '/<input[^>]+type=["\x27]text["\x27][^>]+name=["\x27]senha["\x27]/i',
    'exclusão acionada por link' => '/href=["\x27][^"\x27]*deletar_(?:produto|user)\.php/i',
];

foreach ($iterator as $file) {
    if (!$file->isFile() || strtolower($file->getExtension()) !== 'php') {
        continue;
    }

    $path = $file->getPathname();
    $relativePath = str_replace($root . DIRECTORY_SEPARATOR, '', $path);

    if ($relativePath === 'scripts' . DIRECTORY_SEPARATOR . 'security_check.php') {
        continue;
    }

    $contents = file_get_contents($path);
    if ($contents === false) {
        $violations[] = "Não foi possível ler {$relativePath}";
        continue;
    }

    foreach ($rules as $label => $pattern) {
        if (preg_match($pattern, $contents) === 1) {
            $violations[] = "{$relativePath}: {$label}";
        }
    }
}

$csrfHandlers = [
    'validar_user.php',
    'validar_admin.php',
    'cadastro_clientebd.php',
    'cadastrar_produtobd.php',
    'alterar_produtobd.php',
    'alterar_clientebd.php',
    'deletar_produto.php',
    'deletar_user.php',
    'pagamentobd.php',
    'logout.php',
];

foreach ($csrfHandlers as $handler) {
    $contents = file_get_contents($root . DIRECTORY_SEPARATOR . $handler);
    if ($contents === false || strpos($contents, 'require_csrf();') === false) {
        $violations[] = "{$handler}: proteção CSRF ausente";
    }
}

if ($violations) {
    fwrite(STDERR, "Security check encontrou problemas:\n- " . implode("\n- ", $violations) . "\n");
    exit(1);
}

fwrite(STDOUT, "Security static check: OK\n");
