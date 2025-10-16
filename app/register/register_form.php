<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu - Registro de usuario</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function validarFormulario() {
            const nombre = document.getElementById("nombre").value.trim();
            const apellidos = document.getElementById("apellidos").value.trim();
            const dni = document.getElementById("dni").value.trim();
            const fecha_nac = document.getElementById("fecha_nac").value;
            const telefono = document.getElementById("telefono").value.trim();
            const email = document.getElementById("email").value.trim();
            const contra = document.getElementById("contra").value;

            if (!nombre || !apellidos || !dni || !fecha_nac || !telefono || !email || !contra) {
                alert("Por favor, completa todos los campos.");
                return false;
            }

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

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Correo electrónico inválido.");
                return false;
            }

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
    <h2>Registro de usuario</h2>
    <br>
    <form action="register_form.php" method="post" onsubmit="return validarFormulario();">
        <label for="nombre"><b>Nombre:</b></label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre" required><br><br>

        <label for="apellidos"><b>Apellidos:</b></label><br>
        <input type="text" id="apellidos" name="apellidos" placeholder="Introduzca sus apellidos" required><br><br>

        <label for="dni"><b>DNI:</b></label><br>
        <input type="text" id="dni" name="dni" placeholder="12345678A" required><br><br>

        <label for="fecha_nac"><b>Fecha de nacimiento:</b></label><br>
        <input type="date" id="fecha_nac" name="fecha_nac" required><br><br>

        <label for="telefono"><b>Teléfono:</b></label><br>
        <input type="text" id="telefono" name="telefono" placeholder="Ej: 600123456" required><br><br>

        <label for="email"><b>Email:</b></label><br>
        <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required><br><br>

        <label for="contra"><b>Contraseña:</b></label><br>
        <input type="password" id="contra" name="contra" placeholder="Introduzca su contraseña" required><br><br>

        <input type="submit" value="Registrar usuario">
        <input type="reset" value="Borrar">
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

<?php
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $dni = mysqli_real_escape_string($conn, $_POST['dni']);
    $fecha_nac = mysqli_real_escape_string($conn, $_POST['fecha_nac']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contra = $_POST['contra'];

    $sql_check = "SELECT * FROM usuarios WHERE nombre = '$nombre' OR email = '$email'";
    $resultado = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<center><p style='color:red;'><b>El usuario o el correo ya existe. Prueba con otro.</b></p></center>";
    } else {
        $hash = password_hash($contra, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO usuarios (nombre, apellidos, dni, fecha_nac, telefono, email, contraseña) 
                       VALUES ('$nombre', '$apellidos', '$dni', '$fecha_nac', '$telefono', '$email', '$hash')";

        if (mysqli_query($conn, $sql_insert)) {
            echo "<center><p><b>Usuario registrado correctamente.</b></p></center>";
        } else {
            echo "<center><p style='color:red;'><b>Error al registrar: " . mysqli_error($conn) . "</b></p></center>";
        }
    }
}
mysqli_close($conn);
?>

