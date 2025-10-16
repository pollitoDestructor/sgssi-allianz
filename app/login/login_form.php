<?php
  //Activar el manejo de sesiones
  session_start();
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
      $nom = $_POST['nombre'];
      $contra = $_POST['contra'];

      // Consultar usuario
      $query = "SELECT * FROM usuarios WHERE nombre = '$nom'";
      $con = mysqli_query($conn, $query) or die(mysqli_error($conn));
      $row = mysqli_fetch_array($con);

      if ($row) {
          if (password_verify($contra, $row['contraseña'])) {
              //Guardar los datos de la sesion
              $_SESSION['usuario'] = $row['nombre'];
              $_SESSION['dni'] = $row['dni'];
              // Redirigir a index.php al iniciar sesión
       	      header('Location: ../index.php');
       	      exit();
          } else {
              echo "<center><p style='color:red;'><b>Contraseña incorrecta.</b></p></center>";
          }
      } else {
          echo "<center><p style='color:red;'><b>Usuario no encontrado.</b></p></center>";
      }

      // Mostrar información (como en el original)
      echo "
      <center>
      <table border='1' cellpadding='5'>
        <tr>
          <th>ID</th><th>Nombre</th><th>Contraseña</th>
        </tr>
        <tr>
          <td>aaaaa</td>
          <td>{$row['nombre']}</td>
          <td>{$row['contraseña']}</td>
        </tr>
      </table>
      </center>";
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
    <form action="login_form.php" method="post">
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
