<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}
require_once dirname(__DIR__) . '/config/database.php';

function prompt(string $label): string
{
    fwrite(STDOUT, $label);
    $value = fgets(STDIN);

    return $value === false ? '' : trim($value);
}

$name = prompt('Nome do administrador: ');
$login = prompt('Login: ');
$password = prompt('Senha (mínimo de 10 caracteres): ');

if ($name === '' || $login === '' || strlen($password) < 10) {
    fwrite(STDERR, "Dados inválidos. Use nome e login preenchidos e uma senha com pelo menos 10 caracteres.\n");
    exit(1);
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$statement = db()->prepare(
    'INSERT INTO tb_admin (nome, login, senha, status_login) VALUES (?, ?, ?, ?)'
);
$status = 'ativo';
$statement->bind_param('ssss', $name, $login, $hash, $status);

try {
    $statement->execute();
    fwrite(STDOUT, "Administrador criado com sucesso.\n");
} catch (mysqli_sql_exception $exception) {
    fwrite(STDERR, "Não foi possível criar o administrador. Verifique se o login já existe.\n");
    exit(1);
}
