<html>
	<head>
		<title>
			Ejemplo página web SGSSI
		</title>
	</head>
	<body>
<form action="login_form.php" method="post">
	NOMBRE: <input type="text" id="nombre" name="nombre" value="Introduzca su nombre"><br>
	PASSWORD: <input type="password" id="nombre" name="contra"><br>
	<input  id="login_submit" type="submit" value="Enviar">
	<input type="reset" value="Borrar"><br><br>
	
	
</form>

	</body>
</html>
<?php
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname,$username,$password,$db);
  $nom = $_POST['nombre'];
  $contra = $_POST['contra'];
$con = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '$nom'") or die (mysqli_error($conn));
$row = mysqli_fetch_array($con);
if ($row['nombre']===$contra){
	echo "bien";
}
echo
   "<tr>
   <td>aaaaa</td>
    <td>{$row['id']}</td>
    <td>{$row['nombre']}</td>
   </tr>"
?>
	</body>
</html>


