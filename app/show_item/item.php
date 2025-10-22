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

//Editar labubus
if (isset($_POST['editar'])) {
	$id = intval($_GET['id']);
	$nombre = $_POST['nombre'];
	$color = $_POST['color'];
	$estado = $_POST['estado'];
	$descr = $_POST['descr'];
	$precio = $_POST['precio'];
	$sql_update = "UPDATE catalogo SET nombre = '$nombre', color = '$color', estado = '$estado', descr = '$descr', precio = '$precio' WHERE id = '$id'";
	if (mysqli_query($conn, $sql_update)) {
        echo "<center><p><b>Datos modificados correctamente.</b></p></center>";
	} else {
        echo "<center><p style='color:red;'><b>Error al registrar: " . mysqli_error($conn) . "</b></p></center>";
    }
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
    echo "<p>Estado: {$row['estado']}</p>";
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

<form action="../modify_item" method="get">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" value="Modificar item">
</form>
<form action="../delete_item" method="get">
    <input type="hidden" name="item" value="<?php echo $id; ?>">
    <input type="submit" value="Borrar item">
</form>

<form action="../items" method="get">
    <input type="submit" value="Volver al catálogo">
</form>
<br><br><br><br>
<?php include_once('../header_and_footer/footer.php'); //Para el footer  ?>
</body>
</html>

