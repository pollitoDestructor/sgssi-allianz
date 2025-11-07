<?php
header('X-Content-Type-Options: nosniff');

session_start();
// Si no hay sesion iniciada, te redirige al login
if (!isset($_SESSION['usuario']) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: /login/');
    exit();
}
?>
