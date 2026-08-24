<?php

declare(strict_types=1);

require_once __DIR__ . '/env.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function db(): mysqli
{
    static $connection = null;

    if ($connection instanceof mysqli) {
        return $connection;
    }

    try {
        $connection = new mysqli(
            env_value('DB_HOST', '127.0.0.1'),
            env_value('DB_USER', 'root'),
            env_value('DB_PASSWORD', ''),
            env_value('DB_NAME', 'bd_cegonha'),
            (int) env_value('DB_PORT', '3306')
        );
        $connection->set_charset('utf8mb4');
    } catch (mysqli_sql_exception $exception) {
        error_log('Falha na conexão com o banco: ' . $exception->getMessage());
        http_response_code(500);
        exit('Não foi possível conectar ao banco de dados. Verifique a configuração do ambiente.');
    }

    return $connection;
}
