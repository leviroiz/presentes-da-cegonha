<?php

declare(strict_types=1);

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return (string) $_SESSION['csrf_token'];
}
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function require_csrf(): void
{
    $submitted = post_string('csrf_token');
    $expected = $_SESSION['csrf_token'] ?? '';

    if (!is_string($expected) || $expected === '' || !hash_equals($expected, $submitted)) {
        http_response_code(419);
        exit('Sua sessão expirou. Atualize a página e tente novamente.');
    }
}
