<?php
  //Comprobación de la sesión
  session_start();
  // Si no hay sesion iniciada, te redirige al login
  if (!isset($_SESSION['usuario'])) {
    header('Location: /login/');
    exit();
  }
  // Si no hay parámetro GET "user", redirige automáticamente con el DNI de sesión.
  if (!isset($_GET['user'])) {
    $dni = $_SESSION['dni'];
    header("Location: /modify_user?user=" . urlencode($dni));
    exit;
  }
  // Si el parametro GET "user" es distinto al DNI del usuario actual, redirige al inicio. No se tiene permiso para modificar a esa información.
  if ($_GET['user']!=$_SESSION['dni']) {
    $dni = $_SESSION['dni'];
    header("Location: /login/login_form.php");
    exit;
  }

//Guardar datos reales del dni
  if (isset($_GET['user'])) {
    $dni = $_GET['user'];
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
        
        $_SESSION['usuario'] = $nombre; //Actualizar los datos de sesión
        $_SESSION['dni'] = $dni;

        if (mysqli_query($conn, $sql_update)) {
            echo "<center><p><b>Datos modificados correctamente.</b></p></center>";
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
    <script>
        function validarFormulario() {
            const nombre = document.getElementById("nombre").value.trim();
            const apellidos = document.getElementById("apellidos").value.trim();
            const dni = document.getElementById("dni").value.trim();
            const fecha_nac = document.getElementById("fecha_nac").value;
            const telefono = document.getElementById("telefono").value.trim();
            const email = document.getElementById("email").value.trim();
		
	    // ============= Todo esto para verificar o validar los campos =============
            if (!nombre || !apellidos || !dni || !fecha_nac || !telefono || !email) {
                alert("Por favor, completa todos los campos.");
                return false;
            }
            
            // Regex para DNI
            const dniRegex = /^[0-9]{8}[A-Z]$/;
            if (!dniRegex.test(dni)) {
                alert("DNI inválido, formato incorrecto.");
                return false;
            } else {
                let cadena = "TRWAGMYFPDXBNJZSQVHLCKET";
                let dniNumeros = parseInt(dni.substring(0, dni.length - 1));
                let posicion = dniNumeros % (cadena.length - 1);
                if (dni[dni.length - 1].toLowerCase() != cadena[posicion].toLowerCase()) {
                    alert("DNI inválido, la letra no coincide.");
                    return false;
                }
            }
            
	   // Regex para email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Correo electrónico inválido.");
                return false;
            }
            
	    // Regex para telefono
            const telefonoRegex = /^[0-9]{9}$/;
            if (!telefonoRegex.test(telefono)) {
                alert("Número de teléfono inválido (9 dígitos).");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<br><br>
<br><br><br>

<div class="box3">
    <h2>Modificar datos del usuario</h2>
    <br>
    <form action="user_modify_form.php" method="post" onsubmit="return validarFormulario();">
        <label for="nombre"><b>Nombre:</b></label><br>
        <input type="text" id="nombre" name="nombre" value="<?= $nombreUS ?>" required><br><br>

        <label for="apellidos"><b>Apellidos:</b></label><br>
        <input type="text" id="apellidos" name="apellidos" value="<?= $apellidosUS ?>" required><br><br>

        <label for="dni"><b>DNI:</b></label><br>
        <input type="text" id="dni" name="dni" value="<?= $dniUS ?>" required><br><br>

        <label for="fecha_nac"><b>Fecha de nacimiento:</b></label><br>
        <input type="date" id="fecha_nac" name="fecha_nac" value="<?= $fecha_nacUS ?>" required><br><br>

        <label for="telefono"><b>Teléfono:</b></label><br>
        <input type="text" id="telefono" name="telefono" value="<?= $telefonoUS ?>" required><br><br>

        <label for="email"><b>Email:</b></label><br>
        <input type="email" id="email" name="email" value="<?= $emailUS ?>" required><br><br>

        <input type="submit" value="Modificar usuario">
    </form>
</div>

<br>
<form action="../index.php" method="get">
    <input type="submit" value="Volver al inicio">
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
