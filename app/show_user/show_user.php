<?php include_once("../sesion_iniciada/comprobar_sesion_iniciada.php"); // Comprobar sesión iniciada ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Datos de usuario</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div>
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

// Obtener el valor de usuario desde el parametro en la URL

if (isset($_GET['user'])) {
    $user = $_GET['user'];
    echo "<h2>Datos del usuario con DNI: $user</h2>";
} else {
    echo "<h2>No se ha especificado ningún usuario</h2>";
}
// Mostrar datos del usuario
$sql = "SELECT * FROM `usuarios` WHERE usuarios.dni='$user'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "<table border='1' cellpadding='6' style='margin: 0 auto;'>";
    echo "<tr><th>DNI</th><th>Nombre</th><th>Apellidos</th><th>Fecha Nac.</th><th>Email</th><th>Telefono</th></tr>";
    $row = mysqli_fetch_assoc($resultado);
    echo "<tr>";
    echo "<td>{$row['dni']}</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "<td>{$row['apellidos']}</td>";
    echo "<td>{$row['fecha_nac']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['telefono']}</td>";
    echo "</tr>";
    echo "</table>";
    }
else{
    echo "No se ha encontrado datos del usuario con DNI '$user'";
    }
    mysqli_close($conn);
?>
</div>
    <br>
    <form action="../index.php" method="get">
    	<input type="submit" value="Volver al inicio">
    </form>
    <br>
</br>

</body>
</html>
