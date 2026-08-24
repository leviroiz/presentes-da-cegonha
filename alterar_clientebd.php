<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_admin();
require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$customerId = post_positive_int('id_cliente');
$name = post_string('nome');
$email = filter_var(post_string('email'), FILTER_VALIDATE_EMAIL);
$phone = only_digits(post_string('telefone'));
$district = post_string('bairro');
$city = post_string('cidade');
$street = post_string('rua');
$houseNumber = post_string('n_residencia');
$postalCode = only_digits(post_string('CEP'));

if ($customerId === 0 || $name === '' || $email === false || strlen($phone) < 10 || strlen($postalCode) !== 8
    || $district === '' || $city === '' || $street === '' || $houseNumber === '') {
    set_flash('error', 'Dados do cliente inválidos.');
    redirect('listar_user.php');
}

$statement = db()->prepare(
    'UPDATE tb_cliente
     SET nome = ?, email = ?, telefone = ?, bairro = ?, cidade = ?, rua = ?, n_residencia = ?, CEP = ?
     WHERE id_cliente = ?'
);
$statement->bind_param(
    'ssssssssi',
    $name,
    $email,
    $phone,
    $district,
    $city,
    $street,
    $houseNumber,
    $postalCode,
    $customerId
);

try {
    $statement->execute();
} catch (mysqli_sql_exception $exception) {
    if ((int) $exception->getCode() === 1062) {
        set_flash('error', 'Este e-mail já está em uso.');
        redirect('listar_user.php');
    }
    throw $exception;
}

set_flash('success', 'Cliente atualizado com sucesso.');
redirect('listar_user.php');
