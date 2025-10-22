<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar item - Allianz Labubu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
// Datos de conexión
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Conexión
$conn = mysqli_connect($hostname, $username, $password, $db);
if (!$conn) {
    die("<p>Error de conexión: " . mysqli_connect_error() . "</p>");
}

// Obtener el id del item (viene como id en la URL)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo "<center><p style='color:red;'><b>ID de item no válido.</b></p></center>";
    echo "<form action='../items'><input type='submit' value='Volver al catálogo'></form>";
    exit;
}

// Consultar datos del item
$sql = "SELECT * FROM catalogo WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<center><p style='color:red;'><b>Item no encontrado.</b></p></center>";
    echo "<form action='../items'><input type='submit' value='Volver al catálogo'></form>";
    exit;
}

$row = mysqli_fetch_assoc($result);
$imagen = "../img/" . $row['nombre'] . ".jpg";

// Si se confirma el borrado
if (isset($_POST['confirmar'])) {
    mysqli_query($conn, "DELETE FROM catalogo WHERE id = $id");
    echo "<script>alert('Item eliminado correctamente.'); window.location.href='../items';</script>";
    exit;
}

echo "<center>";
echo "<h2>¿Seguro que quieres eliminar este item?</h2>";
echo "<div class='product-card'>";
echo "<img src='{$imagen}' alt='{$row['nombre']}' class='product-img'>";
echo "<p><b>Nombre:</b> {$row['nombre']}</p>";
echo "<p><b>Color:</b> {$row['color']}</p>";
echo "<p><b>Estado:</b> {$row['estado']}</p>";
echo "<p><b>Descripción:</b> {$row['descr']}</p>";
echo "<p><b>Precio:</b> {$row['precio']} €</p>";
echo "</div><br>";

echo "<form method='post' onsubmit=\"return confirm('¿Seguro que deseas eliminar este item?');\">";
echo "<input type='submit' name='confirmar' value='Sí, eliminar item'>";
echo "</form><br>";

echo "<form action='../items/item.php' method='get'>";
echo "<input type='hidden' name='id' value='$id'>";
echo "<input type='submit' value='Cancelar'>";
echo "</form>";
echo "</center>";

mysqli_close($conn);
?>
</body>
</html>

