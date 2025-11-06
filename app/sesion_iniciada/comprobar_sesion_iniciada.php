<?php
session_set_cookie_params([
    'lifetime' => 0,       // La cookie dura hasta que se cierra el navegador
    'path' => '/',
    'domain' => '',        // Déjalo vacío o ajusta tu dominio si es necesario
    'secure' => false,     // Cambia a true si usas HTTPS
    'httponly' => true,    // Evita acceso por JavaScript
    'samesite' => 'Lax'    // Puede ser 'Strict', 'Lax' o 'None'
]);
session_start();
// Si no hay sesion iniciada, te redirige al login
if (!isset($_SESSION['usuario']) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: /login/');
    exit();
}
// Si no hay parámetro GET "user", redirige automáticamente con el DNI de sesión.
if (!isset($_GET['user']) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    $dni = $_SESSION['dni'];
    header("Location: /items?user=" . urlencode($dni));
    exit;
}
?>
