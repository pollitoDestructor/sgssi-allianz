<?php 
header_remove("X-Powered-By");
//Activar el manejo de sesiones
  session_start();
  
	//TODO Crear token CSRF si no existe
	if (empty($_SESSION['csrf_token'])) {
	    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}
	$csrf_token = $_SESSION['csrf_token'];
	
  // Si ya hay sesión, no dejar volver a logearse (Ni accediendo a través de la URL)
  if (isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
  }
  // Datos de conexión
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname, $username, $password, $db);

  if (!$conn) {
      die("<center><p style='color:red;'>Error de conexión: " . mysqli_connect_error() . "</p></center>");
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Error: token CSRF inválido');
    }
    
      $nom = $_POST['nombre'];
      $contra = $_POST['contra'];
      
	// TODO mysqlite
	$stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre = ?");
	$stmt->bind_param("s", $nom);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

      if ($row) {
          if (password_verify($contra, $row['contraseña'])) {
              //Guardar los datos de la sesion
              $_SESSION['usuario'] = $row['nombre'];
              $_SESSION['dni'] = $row['dni'];
              
              // Regenerar sesión y token CSRF para seguridad
              session_regenerate_id(true);
              $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    
              // Redirigir a index.php al iniciar sesión
       	      header('Location: ../index.php');
       	      exit();
          } else {
              echo "<center><p style='color:red;'><b>Contraseña incorrecta.</b></p></center>";
          }
      } else {
          echo "<center><p style='color:red;'><b>Usuario no encontrado.</b></p></center>";
      }
  }
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu - Iniciar sesión</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<br><br>
<br><br><br>

<div class="box2">
    <h2>Iniciar sesión</h2>
<br>
</br>
    <form id="login_form" action="login_form.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
    
        <label for="nombre"><b>Nombre:</b></label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre" required><br><br>

        <label for="contra"><b>Contraseña:</b></label><br>
        <input type="password" id="contra" name="contra" placeholder="Introduzca su contraseña" required><br><br>

        <input id="login_submit" type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>

</div>
    <br>
    <form action="../index.php" method="get">
    	<input type="submit" value="Volver al inicio">
    </form>
    <br>
</br>


<br><br><br><br>
<?php include_once('../header_and_footer/footer.php'); //Para el footer  ?>

</body>
</html>
