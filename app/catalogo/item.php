<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Allianz - Info item</title>
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

// Consultar el item en la bd
$sql = "SELECT * FROM catalogo WHERE id = $id";
$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $row = mysqli_fetch_assoc($resultado);
    $imagen = "../img/" . $row['nombre'] . ".jpg";

    echo "<h2>{$row['nombre']}</h2>";
    echo "<img src='{$imagen}' alt='{$row['nombre']}' class='product-img'>";
    echo "<p>Precio: {$row['precio']} €</p>";
    echo "<p>Descripción: {$row['descr']}</p>";
    echo "<p>DNI asociado: {$row['dni']}</p>";
} else {
    echo "<p>Item no encontrado.</p>";
}

mysqli_close($conn);
?>

<br>
<form action="catalogo.php" method="get">
    <input type="submit" value="Volver al catálogo">
</form>

</body>
</html>

