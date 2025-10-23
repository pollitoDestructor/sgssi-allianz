<?php
/* TODO
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
    header("Location: /modify_user?user=" . urlencode($dni));
    exit;
}
// Si el parametro GET "user" es distinto al DNI del usuario actual, redirige al inicio. No se tiene permiso para modificar a esa información.
if (isset($_GET['user']) && $_GET['user'] != $_SESSION['dni'] && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /");
    exit;
}
// Determinar el DNI a usar
if (isset($_GET['user'])) {
    $dni = $_GET['user'];
} else {
    $dni = $_SESSION['dni'];
}
// Comprobación de permisos
if ($dni !== $_SESSION['dni'] && $_SERVER["REQUEST_METHOD"] !== "POST") {
    // El usuario intenta modificar otro perfil: redirigimos
    header("Location: /");
    exit;
}
*/
//Obtención genérica del usuario a partir de la URL
$dni=$_GET['user'];

// Datos de conexión
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Conexión a la base de datos
$conn = mysqli_connect($hostname, $username, $password, $db);

if (!$conn) {
    die("<center><p style='color:red;'>Error de conexión: " . mysqli_connect_error() . "</p></center>");
}

      // Consultar usuario
      $query = "SELECT * FROM usuarios WHERE dni ='$dni'";
      $con = mysqli_query($conn, $query) or die(mysqli_error($conn));
      $row = mysqli_fetch_array($con);
	
      // Atributos del US (usuario sesión)
      $nombreUS = $row['nombre'];
      $apellidosUS = $row['apellidos'];
      $dniUS = $row['dni'];
      $fecha_nacUS = $row['fecha_nac'];
      $telefonoUS = $row['telefono'];
      $emailUS = $row['email'];

// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener y sanitizar datos
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $dni = mysqli_real_escape_string($conn, $_POST['dni']);
    $fecha_nac = mysqli_real_escape_string($conn, $_POST['fecha_nac']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Edita el usuario
    $sql_update = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', dni = '$dni', fecha_nac = '$fecha_nac', telefono = '$telefono', email = '$email' WHERE dni = '$dniUS'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<center><p><b>Datos modificados correctamente.</b></p></center>";
        $_SESSION['usuario'] = $nombre; //Actualizar los datos de sesión
        $_SESSION['dni'] = $dni;
        // Consultar usuario (con datos actualizados)
	$query = "SELECT * FROM usuarios WHERE dni ='$dni'";
	$con = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$row = mysqli_fetch_array($con);
	// Atributos del US (usuario sesión) actualizado
	$nombreUS = $row['nombre'];
	$apellidosUS = $row['apellidos'];
	$dniUS = $row['dni'];
	$fecha_nacUS = $row['fecha_nac'];
	$telefonoUS = $row['telefono'];
	$emailUS = $row['email'];
    } else {
        echo "<center><p style='color:red;'><b>Error al registrar: " . mysqli_error($conn) . "</b></p></center>";
    }
}
// Cerrar conexión
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu - Modificar datos del usuario</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/regex.js"> </script>
</head>
<body>
<br><br>
<br><br><br>

<div class="box3">
    <h2>Modificar datos del usuario</h2>
    <br>
    <form id="user_modify_form" action="/modify_user/?user=<?= $_GET['user'] ?>" method="post" onsubmit="return validarFormulario();">
        <label for="nombre"><b>Nombre:</b></label><br>
        <input type="text" id="nombre" name="nombre" value="<?= $nombreUS ?>" ><br><br>

        <label for="apellidos"><b>Apellidos:</b></label><br>
        <input type="text" id="apellidos" name="apellidos" value="<?= $apellidosUS ?>" ><br><br>

        <label for="dni"><b>DNI:</b></label><br>
        <input type="text" id="dni" name="dni" value="<?= $dniUS ?>" ><br><br>

        <label for="fecha_nac"><b>Fecha de nacimiento:</b></label><br>
        <input type="date" id="fecha_nac" name="fecha_nac" value="<?= $fecha_nacUS ?>" ><br><br>

        <label for="telefono"><b>Teléfono:</b></label><br>
        <input type="text" id="telefono" name="telefono" value="<?= $telefonoUS ?>" ><br><br>

        <label for="email"><b>Email:</b></label><br>
        <input type="email" id="email" name="email" value="<?= $emailUS ?>" ><br><br>

        <input type="submit" id="user_modify_submit" value="Modificar usuario">
    </form>
</div>

<br>
<form action="../index.php" method="get">
    <input type="submit" value="Volver al inicio">
</form>
<br><br><br><br>

<?php include_once('../header_and_footer/footer.php'); //Para el footer  ?>

</body>
</html>
