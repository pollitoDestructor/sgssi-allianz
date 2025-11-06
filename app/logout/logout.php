<?php
header('X-Content-Type-Options: nosniff');
session_start();
//Atributo samesite y hhtponly activado
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
    header('Set-Cookie: ' . $cookie, false);
}

// Vaciar todas las variables de sesión
$_SESSION = array();

// Borrar la cookie de sesión si existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Redirigir al índice
header("Location: ../index.php");
exit();
?>

