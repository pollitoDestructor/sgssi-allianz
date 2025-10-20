<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu - Info item</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
// Datos de conexión
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Conexión a la base de datos
$conn = mysqli_connect($hostname, $username, $password, $db);
if (!$conn) {
    die("<p>Error de conexión: " . mysqli_connect_error() . "</p>");
}

// Obtener el id desde la URL, el que pasa catalogo
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Eliminar labubus
if (isset($_POST['borrar'])) {
    $id = intval($_GET['id']);  // toma el id desde la URL
    mysqli_query($conn, "DELETE FROM catalogo WHERE id = $id");
}

// Consultar el item en la bd
$sql = "SELECT * FROM catalogo WHERE id = $id";
$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $row = mysqli_fetch_assoc($resultado);
    $imagen = "../img/" . $row['nombre'] . ".jpg";

    echo "<h2>{$row['nombre']}</h2>";
    echo "<div class='product-card'>";
    echo "<img src='{$imagen}' alt='{$row['nombre']}' class='product-img'>";
    echo "<p>Color: {$row['color']}</p>";
    echo "<p>Descripción: {$row['descr']}</p>";
    echo "<p>Precio: {$row['precio']} €</p>";
} else {
    echo "<p>Item no encontrado.</p>";
}
        echo "</div>";
        
mysqli_close($conn);
?>

<br>
<br></br>
<form method="post" onsubmit="return confirm('¿Quieres borrar este item?');">
    <input type="submit" name="borrar" value="Borrar">
</form>
</form>

<form action="catalogo.php" method="get">
    <input type="submit" value="Volver al catálogo">
</form>
<br><br><br><br>

<footer class="footer">
    <center>
        <hr size="2" color="black">
        <p>Contacto y redes sociales:</p>
        <div class="social-icons">
            <a href="https://x.com/allianzlabubu">
                <img src="../img/twitter.png" width="50" height="50" alt="Twitter">
            </a>
            <a href="https://www.instagram.com/allianzlabubu/">
                <img src="../img/insta.png" width="50" height="50" alt="Instagram">
            </a>
            <a href="https://www.tiktok.com/@allianzlabubu?lang=es">
                <img src="../img/TikTok.png" width="50" height="50" alt="TikTok">
            </a>
        </div>
    </center>
</footer>
</body>
</html>

