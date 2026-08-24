<?php

declare(strict_types=1);

require_once __DIR__ . '/env.php';
require_once dirname(__DIR__) . '/includes/helpers.php';

if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('cegonha_session');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => env_bool('SESSION_SECURE', false),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

require_once dirname(__DIR__) . '/includes/csrf.php';
require_once dirname(__DIR__) . '/includes/auth.php';
