<!DOCTYPE html>
<html>
<head>
    <title>Registro de usuario - SGSSI</title>
    <meta charset="UTF-8">
    <script>
        function validarFormulario() {
            const nombre = document.getElementById("nombre").value.trim();
            const apellidos = document.getElementById("apellidos").value.trim();
            const telefono = document.getElementById("telefono").value.trim();
            const email = document.getElementById("email").value.trim();
            const contra = document.getElementById("contra").value;
		
	    // Todo esto para verificar o validar los campos
            if (!nombre || !apellidos || !telefono || !email || !contra) {
                alert("Por favor, completa todos los campos.");
                return false;
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
<h2>Formulario de registro</h2>
<form action="register_form.php" method="post" onsubmit="return validarFormulario();">
    NOMBRE: <input type="text" id="nombre" name="nombre"><br>
    APELLIDOS: <input type="text" id="apellidos" name="apellidos"><br>
    TELÉFONO: <input type="text" id="telefono" name="telefono"><br>
    EMAIL: <input type="email" id="email" name="email"><br>
    PASSWORD: <input type="password" id="contra" name="contra"><br>
    <input type="submit" value="Registrar">
    <input type="reset" value="Borrar"><br><br>
</form>

<a href="../index.php">Volver al inicio</a>

<?php
// Datos de conexión
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Conexión a la base de datos
$conn = mysqli_connect($hostname, $username, $password, $db);

if (!$conn) {
    die("Error al conectarse con la base de datos: " . mysqli_connect_error());
}

// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener y sanitizar datos
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contra = $_POST['contra'];

    // Comprobar si el usuario ya existe por nombre o email
    $sql_check = "SELECT * FROM usuarios WHERE nombre = '$nombre' OR email = '$email'";
    $resultado = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<p>El usuario o el correo ya existe. Prueba con otro.</p>";
    } else {
        // Cifrar la contraseña antes de guardarla
        $hash = password_hash($contra, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario
        $sql_insert = "INSERT INTO usuarios (nombre, apellidos, telefono, email, password) 
                       VALUES ('$nombre', '$apellidos', '$telefono', '$email', '$hash')";

        if (mysqli_query($conn, $sql_insert)) {
            echo "<p>Usuario registrado correctamente.</p>";
        } else {
            echo "<p>Error al registrar: " . mysqli_error($conn) . "</p>";
        }
    }
}

// Cerrar conexión
mysqli_close($conn);
?>
</body>
</html>

