<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$email = filter_var(post_string('email'), FILTER_VALIDATE_EMAIL);
$password = post_string('senha');
$next = safe_next_path(post_string('next'), 'home.php');

if ($email === false || $password === '') {
    set_flash('error', 'Informe e-mail e senha válidos.');
    redirect('login.php?next=' . rawurlencode($next));
}

$statement = db()->prepare(
    'SELECT id_cliente, nome, senha FROM tb_cliente WHERE email = ? LIMIT 1'
);
$statement->bind_param('s', $email);
$statement->execute();
$customer = $statement->get_result()->fetch_assoc();

if (!$customer || !password_verify($password, $customer['senha'])) {
    set_flash('error', 'E-mail ou senha inválidos.');
    redirect('login.php?next=' . rawurlencode($next));
}

establish_customer_session((int) $customer['id_cliente'], $customer['nome']);
redirect($next);
