<?php 
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://code.jquery.com; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self'; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
header("X-Frame-Options: SAMEORIGIN");
header('X-Content-Type-Options: nosniff');
header_remove("X-Powered-By");

// Recuperar datos de la sesión (si no se ha iniciado sesión aun, también es útil)
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
// Si no se ha iniciado sesión, no se muestran los botones de inicio de sesión ni de registro.
if (!isset($_SESSION['usuario'])) { ?>
    <br></br>
    <!-- Botón para iniciar sesión -->
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

    <!-- Botón para Modificar datos -->
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

</div>

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
