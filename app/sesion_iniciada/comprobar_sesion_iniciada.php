<?php
header('X-Content-Type-Options: nosniff');

session_start();
// Atributo SameSite + HttpOnly
if (PHP_VERSION_ID < 70300) {
    $params = session_get_cookie_params();
    $sessionId = session_id();
    $cookie = sprintf(
        'PHPSESSID=%s; Path=%s; HttpOnly; SameSite=Lax',
        $sessionId,
        $params['path']
    );

    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        $cookie .= '; Secure';
    }

    header('Set-Cookie: ' . $cookie, true);
}
// Si no hay sesion iniciada, te redirige al login
if (!isset($_SESSION['usuario']) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: /login/');
    exit();
}
?>
