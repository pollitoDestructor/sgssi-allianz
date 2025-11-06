<?php
header('X-Content-Type-Options: nosniff');

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
