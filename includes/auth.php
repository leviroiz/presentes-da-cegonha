<?php

declare(strict_types=1);

function require_admin(): void
{
    if (empty($_SESSION['id_admin'])) {
        set_flash('error', 'Faça login como administrador para continuar.');
        redirect('login_admin.php');
    }
}

function require_customer(): void
{
    if (empty($_SESSION['id_cliente'])) {
        set_flash('error', 'Faça login para continuar.');
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        $next = safe_next_path(ltrim($requestUri, '/'), 'home.php');
        redirect('login.php?next=' . rawurlencode($next));
    }
}

function establish_admin_session(int $id, string $name): void
{
    session_regenerate_id(true);
    unset($_SESSION['id_cliente'], $_SESSION['cliente_nome']);
    $_SESSION['id_admin'] = $id;
    $_SESSION['admin_nome'] = $name;
}

function establish_customer_session(int $id, string $name): void
{
    session_regenerate_id(true);
    unset($_SESSION['id_admin'], $_SESSION['admin_nome']);
    $_SESSION['id_cliente'] = $id;
    $_SESSION['cliente_nome'] = $name;
}

function destroy_session(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
}
