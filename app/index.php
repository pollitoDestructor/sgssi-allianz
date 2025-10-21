<?php
// Recuperar datos de la sesion (si no se ha iniciado sesion aun, tambien es util!) 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
    <title>Allianz Labubu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<br>
</br>

<div class="content">
<h1>Allianz Labubu</h1>
</div>
<br>
</br> </br>
<div class="box">

<?php
//Si se ha iniciado sesión, no se muestran los botones de inicio de sesión ni de registro.
if (!isset($_SESSION['usuario'])) {

    // Botón para iniciar sesión
    ?>
    <br>
</br>
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
} 
else {
    // Usuario logueado: mostrar mensaje
    
    echo "<p>Bienvenido, " . htmlspecialchars($_SESSION['usuario']) . ".</p>";
}
?>

<?php if (isset($_SESSION['usuario'])){
?>
    <!-- Botón para ver catálogo -->
<form action="/catalogo/" method="get">
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

<?php 
}
?>
</div>
<!-- Footer con redes sociales -->
</br>
<br>
</br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<footer class="footer">
    <center>
        <hr size="2" color="black">
        <p>Contacto y redes sociales:</p>
        <div class="social-icons">
            <a href="https://x.com/allianzlabubu">
                <img src="img/twitter.png" width="50" height="50" alt="Twitter">
            </a>
            <a href="https://www.instagram.com/allianzlabubu/">
                <img src="img/insta.png" width="50" height="50" alt="Instagram">
            </a>
            <a href="https://www.tiktok.com/@allianzlabubu?lang=es">
                <img src="img/TikTok.png" width="50" height="50" alt="TikTok">
            </a>
        </div>
    </center>
</footer>

</body>
</html>
