<?php //TODO include_once("../sesion_iniciada/comprobar_sesion_iniciada.php"); // Comprobar sesión iniciada ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu - Añadir item</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/regex.js"></script>
</head>
<body>

    <h2>Añade un item al catálogo</h2>

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
    <form method="post" action="" onsubmit="validarModifyItem();">
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
        <input type="submit" id="item_add_submit" value="Añadir item">
    </form>

    <br>
   <form action="../items" method="get">
    	<input type="submit" value="Volver al catálogo">
    </form>
<br><br><br><br>

<?php include_once('../header_and_footer/footer.php'); //Para el footer  ?>
</body>
</html>

