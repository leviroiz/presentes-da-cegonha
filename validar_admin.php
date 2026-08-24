<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$login = post_string('login');
$password = post_string('senha');

if ($login === '' || $password === '') {
    set_flash('error', 'Informe login e senha.');
    redirect('login_admin.php');
}

$statement = db()->prepare(
    'SELECT id_admin, nome, senha FROM tb_admin WHERE login = ? AND status_login = ? LIMIT 1'
);
$active = 'ativo';
$statement->bind_param('ss', $login, $active);
$statement->execute();
$admin = $statement->get_result()->fetch_assoc();

if (!$admin || !password_verify($password, $admin['senha'])) {
    set_flash('error', 'Login ou senha inválidos.');
    redirect('login_admin.php');
}

establish_admin_session((int) $admin['id_admin'], $admin['nome']);
redirect('tela_admin.php');
