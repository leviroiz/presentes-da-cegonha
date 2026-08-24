<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/bootstrap.php';

function expect(bool $condition, string $message): void
{
    if (!$condition) {
        fwrite(STDERR, "Falha: {$message}\n");
        exit(1);
    }
}

expect(only_digits('123.456-78') === '12345678', 'normalização de números');
expect(safe_next_path('home.php', 'index.php') === 'home.php', 'destino local simples');
expect(
    safe_next_path('tela_pagamento.php?produto_id=1', 'index.php') === 'tela_pagamento.php?produto_id=1',
    'destino local com parâmetros'
);
expect(safe_next_path('https://example.com', 'index.php') === 'index.php', 'bloqueio de URL externa');
expect(safe_next_path('../admin.php', 'index.php') === 'index.php', 'bloqueio de path traversal');

$password = 'uma-senha-de-teste';
$hash = password_hash($password, PASSWORD_DEFAULT);
expect(password_verify($password, $hash), 'hash seguro de senha');
expect(!password_verify('senha-incorreta', $hash), 'rejeição de senha incorreta');

$token = csrf_token();
expect(strlen($token) === 64, 'token CSRF com entropia adequada');
expect(hash_equals($token, csrf_token()), 'token CSRF estável durante a sessão');

fwrite(STDOUT, "Security smoke tests: OK\n");
