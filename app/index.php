<?php
// Evitar clickjacking
header("X-Frame-Options: SAMEORIGIN");
header('X-Content-Type-Options: nosniff');
header("Content-Security-Policy: frame-ancestors 'self'");

// Eliminar información de versión
header_remove("X-Powered-By");

// Recuperar datos de la sesión
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<br></br>

<?php include_once('header_and_footer/header.php'); ?>

<?php
if (!isset($_SESSION['usuario'])) {
    // Botón para iniciar sesión
    ?>
    <br></br>
    <form action="/login/" method="get">
        <input type="submit" value="Iniciar sesión">
    </form>
    <br>
    <!-- Botón para registrarse -->
    <form action="/register/" method="get">
        <input type="submit" value="Registrarse">
    </form>
    <br>
    <?php
} else {
    // Usuario logueado: mostrar mensaje
    echo "<p>Bienvenido, " . htmlspecialchars($_SESSION['usuario']) . ".</p>";
}
?>

<?php if (isset($_SESSION['usuario'])) { ?>
    <!-- Botón para ver catálogo -->
    <form action="/items/" method="get">
        <input type="submit" value="Ver catálogo">
    </form>
    <!-- Botón para ver los datos -->
    <form action="/show_user/" method="get">
        <input type="hidden" name="user" value="<?php echo $_SESSION['dni']; ?>">
        <input type="submit" value="Ver datos">
    </form>
    <!-- Botón para modificar datos -->
    <form action="/modify_user/" method="get">
        <input type="hidden" name="user" value="<?php echo $_SESSION['dni']; ?>">
        <input type="submit" value="Modificar datos">
    </form>
    <!-- Botón para cerrar sesión -->
    <form action="/logout/" method="get">
        <input type="submit" value="Cerrar sesión">
    </form>
    <br>
<?php } ?>

<!-- Footer con redes sociales -->
</br>
<br></br>
</br>
<br></br>
<br></br>
<br></br>
<?php include_once('header_and_footer/footer.php'); ?>

</body>
</html>

