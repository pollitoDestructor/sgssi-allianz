<?php
//Comprobación de la sesión
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu - Catálogo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <h2>Catálogo de productos de Labubus</h2>

    <?php
    // Datos de conexión
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    // Conexión a la base de datos
    $conn = mysqli_connect($hostname, $username, $password, $db);

    if (!$conn) {
        die("<p>Error al conectar con la base de datos: " . mysqli_connect_error() . "</p>");
    }

    // Mostrar productos existentes
    $sql = "SELECT * FROM `catalogo`";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $imagen = "../img/" . $row['nombre'] . ".jpg";

        echo "<div class='product-card'>";
        echo "<img src='{$imagen}' alt='{$row['nombre']}' class='product-img'>";
        //redireccionar a los items
        echo "<h3><a href='item.php?id={$row['id']}' style='text-decoration: underline; color: blue;'>{$row['nombre']}</a></h3>";
        echo "<p>Precio: {$row['precio']} €</p>";
        echo "</div>";
    }

    $count = "SELECT count(*) as total FROM catalogo";
    $resultado = mysqli_query($conn, $count);
    $data = mysqli_fetch_assoc($resultado);
    $id = $data['total'];
    echo "<p>Número de elementos = $id</p>";

} else {
    echo "<p>No hay productos disponibles.</p>";
}


    // Si se envía el formulario, agregar nuevo producto
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = $_POST['nombre'];
        $color = $_POST['color'];
        $estado = $_POST['estado'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        $insert = "INSERT INTO catalogo (nombre, color, estado, descr, precio)
                   VALUES ('$nombre', '$color', '$estado', '$descripcion', '$precio')";
        if (mysqli_query($conn, $insert)) {
            echo "<p>Producto añadido correctamente.</p>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "<p>Error al añadir el producto: " . mysqli_error($conn) . "</p>";
        }
    }

    mysqli_close($conn);
    ?>

    <h3>Añadir nuevo producto</h3>
    <form method="post" action="">
        Nombre: <input type="text" name="nombre" required><br><br>
        Color: <input type="text" name="color" required><br><br>
        <label for="estado">Estado:</label>
	<select id="estado" name="estado" required>
		<option value="">Selecciona un estado</option>
		<option value="nuevo">Nuevo</option>
		<option value="usado">Usado</option>
		<option value="defectuoso">Defectuoso</option>
	</select><br><br>
        Descripción: <input type="text" name="descripcion" required><br><br>
        Precio (€): <input type="number" step="0.01" name="precio" required placeholder="0 - 999.99"><br><br>
        <input type="submit" value="Añadir producto">
    </form>

    <br>
   <form action="../index.php" method="get">
    	<input type="submit" value="Volver al inicio">
    </form>
<br><br><br><br>

<?php include_once('../header_and_footer/footer.php'); //Para el footer  ?>
</body>
</html>

