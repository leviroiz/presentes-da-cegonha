<?php

declare(strict_types=1);

/**
 * Carrega variáveis locais sem sobrescrever as definidas pelo servidor.
 */
function load_env_file(string $path): void
{
    static $loadedPaths = [];

    if (isset($loadedPaths[$path]) || !is_file($path)) {
        return;
    }

    $loadedPaths[$path] = true;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) {
            continue;
        }

        [$key, $value] = array_map('trim', explode('=', $line, 2));

        if ($key === '' || getenv($key) !== false) {
            continue;
        }

        if (strlen($value) >= 2) {
            $first = $value[0];
            $last = $value[strlen($value) - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        putenv($key . '=' . $value);
        $_ENV[$key] = $value;
    }
}
load_env_file(dirname(__DIR__) . '/.env');

function env_value(string $key, ?string $default = null): ?string
{
    $value = getenv($key);

    return $value === false ? $default : $value;
}

function env_bool(string $key, bool $default = false): bool
{
    $value = env_value($key);

    if ($value === null) {
        return $default;
    }

    return filter_var($value, FILTER_VALIDATE_BOOLEAN);
}
