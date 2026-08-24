<?php

declare(strict_types=1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = (int) (getenv('DB_PORT') ?: '3306');
$adminUser = getenv('DB_ADMIN_USER') ?: 'root';
$adminPassword = getenv('DB_ADMIN_PASSWORD') ?: '';
$schemaPath = dirname(__DIR__) . '/bd_cegonha.sql';
$schema = file_get_contents($schemaPath);

if ($schema === false) {
    fwrite(STDERR, "Não foi possível ler bd_cegonha.sql.\n");
    exit(1);
}

try {
    $connection = new mysqli($host, $adminUser, $adminPassword, '', $port);
    $connection->set_charset('utf8mb4');
    $connection->multi_query($schema);

    do {
        $result = $connection->store_result();
        if ($result instanceof mysqli_result) {
            $result->free();
        }
    } while ($connection->more_results() && $connection->next_result());

    echo "Banco de integração inicializado.\n";
} catch (Throwable $exception) {
    fwrite(STDERR, "Falha ao inicializar o banco de integração: {$exception->getMessage()}\n");
    exit(1);
}
