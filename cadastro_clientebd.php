<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_post();
require_csrf();
require_once __DIR__ . '/config/database.php';

$name = post_string('nome');
$cpf = only_digits(post_string('cpf'));
$birthDate = post_string('data_nascimento');
$email = filter_var(post_string('email'), FILTER_VALIDATE_EMAIL);
$password = post_string('senha');
$phone = only_digits(post_string('telefone'));
$district = post_string('bairro');
$city = post_string('cidade');
$street = post_string('rua');
$houseNumber = post_string('n_residencia');
$postalCode = only_digits(post_string('CEP'));
$gender = post_string('sexo');
$allowedGenders = ['Masculino', 'Feminino', 'Outro', 'Prefiro não informar'];
$date = DateTimeImmutable::createFromFormat('!Y-m-d', $birthDate);
$validDate = $date !== false && $date->format('Y-m-d') === $birthDate && $date <= new DateTimeImmutable('today');

$invalid = $name === ''
    || strlen($name) > 100
    || strlen($cpf) !== 11
    || !$validDate
    || $email === false
    || strlen($password) < 10
    || strlen($phone) < 10
    || strlen($phone) > 13
    || $district === ''
    || $city === ''
    || $street === ''
    || $houseNumber === ''
    || strlen($postalCode) !== 8
    || !in_array($gender, $allowedGenders, true);

if ($invalid) {
    set_flash('error', 'Revise os dados. A senha deve ter ao menos 10 caracteres.');
    redirect('cadastro_cliente.php');
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$statement = db()->prepare(
    'INSERT INTO tb_cliente
        (nome, cpf, data_nascimento, email, senha, telefone, bairro, cidade, rua, n_residencia, CEP, sexo)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);
$statement->bind_param(
    'ssssssssssss',
    $name,
    $cpf,
    $birthDate,
    $email,
    $passwordHash,
    $phone,
    $district,
    $city,
    $street,
    $houseNumber,
    $postalCode,
    $gender
);

try {
    $statement->execute();
} catch (mysqli_sql_exception $exception) {
    if ((int) $exception->getCode() === 1062) {
        set_flash('error', 'Já existe uma conta com este e-mail ou CPF.');
        redirect('cadastro_cliente.php');
    }

    throw $exception;
}

set_flash('success', 'Cadastro realizado. Agora você já pode entrar.');
redirect('login.php');
