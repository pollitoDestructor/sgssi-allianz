<?php
  //Comprobación de la sesión
  session_start();
  // Si ya hay sesión, no dejar registrarse
  if (isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
  }
  
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

// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener y sanitizar datos
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $dni = mysqli_real_escape_string($conn, $_POST['dni']);
    $fecha_nac = mysqli_real_escape_string($conn, $_POST['fecha_nac']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contra = $_POST['contra'];

    // Comprobar si el usuario ya existe por nombre o email
    $sql_check = "SELECT * FROM usuarios WHERE nombre = '$nombre' OR email = '$email'";
    $resultado = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<center><p style='color:red;'><b>El usuario o el correo ya existe. Prueba con otro.</b></p></center>";
    } else {
        // Cifrar la contraseña antes de guardarla
        $hash = password_hash($contra, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario
        $sql_insert = "INSERT INTO usuarios (nombre, apellidos, dni, fecha_nac, telefono, email, contraseña) 
                       VALUES ('$nombre', '$apellidos', '$dni', '$fecha_nac', '$telefono', '$email', '$hash')";

        if (mysqli_query($conn, $sql_insert)) {
            echo "<center><p><b>Usuario registrado correctamente.</b></p></center>";
        } else {
            echo "<center><p style='color:red;'><b>Error al registrar: " . mysqli_error($conn) . "</b></p></center>";
        }
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu - Registro de usuario</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/regex.js"></script>
</head>
<body>
<br><br>
<br><br><br>

<div class="box3">
    <h2>Registro de usuario</h2>
    <br>
    <form id="register_form" action="register_form.php" method="post" onsubmit="return validarFormulario();">
        <label for="nombre"><b>Nombre:</b></label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre" ><br><br>

        <label for="apellidos"><b>Apellidos:</b></label><br>
        <input type="text" id="apellidos" name="apellidos" placeholder="Introduzca sus apellidos" ><br><br>

        <label for="dni"><b>DNI:</b></label><br>
        <input type="text" id="dni" name="dni" placeholder="12345678A" ><br><br>

        <label for="fecha_nac"><b>Fecha de nacimiento:</b></label><br>
        <input type="text" id="fecha_nac" name="fecha_nac" placeholder="dd/mm/aaaa" ><br><br>

        <label for="telefono"><b>Teléfono:</b></label><br>
        <input type="text" id="telefono" name="telefono" placeholder="Ej: 600123456" ><br><br>

        <label for="email"><b>Email:</b></label><br>
        <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" ><br><br>

        <label for="contra"><b>Contraseña:</b></label><br>
        <input type="password" id="contra" name="contra" placeholder="Introduzca su contraseña" ><br><br>

        <input id="register_submit" type="submit" value="Registrar usuario">
        <input type="reset" value="Borrar">
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
