<?php

declare(strict_types=1);

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function redirect(string $location): void
{
    header('Location: ' . $location, true, 303);
    exit;
}

function require_post(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        http_response_code(405);
        header('Allow: POST');
        exit('Método não permitido.');
    }
}

function post_string(string $key): string
{
    $value = $_POST[$key] ?? '';

    return is_string($value) ? trim($value) : '';
}

function get_positive_int(string $key): int
{
    $value = filter_input(INPUT_GET, $key, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1],
    ]);

    return $value === false || $value === null ? 0 : (int) $value;
}

function post_positive_int(string $key): int
{
    $value = filter_input(INPUT_POST, $key, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1],
    ]);

    return $value === false || $value === null ? 0 : (int) $value;
}

function only_digits(string $value): string
{
    return preg_replace('/\D+/', '', $value) ?? '';
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function pull_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    return is_array($flash) ? $flash : null;
}

function safe_next_path(string $value, string $fallback): string
{
    if ($value === '' || strpos($value, '://') !== false || strpos($value, '//') === 0) {
        return $fallback;
    }

    return preg_match('/^[a-zA-Z0-9_\-\.]+(?:\?[a-zA-Z0-9_\-\.=&%]+)?$/', $value)
        ? $value
        : $fallback;
}
