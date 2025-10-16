<html>
<head>
    <title>Catálogo - Tienda Labubus ;) </title>
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
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Mostrar productos existentes
$sql = "SELECT * FROM `catalogo` ";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Producto</th><th>Precio (€)</th><th>Descripción</th><th>DNI</th></tr>";

    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['nombre']}</td>";
        echo "<td>{$row['precio']}</td>";
        echo "<td>{$row['descr']}</td>";
        echo "<td>{$row['dni']}</td>";
        echo "</tr>";
    }    
    echo "</table>";
    
    $count = "SELECT count(*) as total FROM catalogo";
    $resultado = mysqli_query($conn, $count);
    $data = mysqli_fetch_assoc($resultado);
    $id = $data['total'];
    echo "Número de elementos = $id.";
    
} else {
    echo "<p>No hay productos disponibles.</p>";
}

// Si se envía el formulario, agregar nuevo producto
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $dni = $_POST['dni'];
    
    //Calcular ID
    $count = "SELECT count(*) as total FROM catalogo";
    $resultado = mysqli_query($conn, $count);
    $data = mysqli_fetch_assoc($resultado);
    $id = $data['total'] +1;
    
    $insert = "INSERT INTO catalogo (id, nombre, precio, descr, dni)
               VALUES ('$id', '$nombre', '$precio', '$descripcion','$dni')";
    if (mysqli_query($conn, $insert)) {
        echo "<p> Producto añadido correctamente.</p>";
        // Refrescar la página para mostrar el producto agregado
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
    Precio (€): <input type="number" step="0.01" name="precio" required><br><br>
    Descripción: <input type="text" name="descripcion"><br><br>
    DNI: <input type="text" name="dni"><br><br>
    <input type="submit" value="Añadir producto">
    <input type="reset" value="Borrar">
</form>

<br>
<a href="../index.php">Volver al inicio</a>

</body>
</html>
