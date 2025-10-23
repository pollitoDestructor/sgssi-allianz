<?php //TODO include_once("../sesion_iniciada/comprobar_sesion_iniciada.php"); // Comprobar sesión iniciada ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Allianz Labubu - Eliminar item</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/regex.js"></script>
</head>
<body>

<?php
// Datos de conexión
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Conexión a la base de datos
$conn = mysqli_connect($hostname, $username, $password, $db);
if (!$conn) {
    die("<p>Error de conexión: " . mysqli_connect_error() . "</p>");
}

// Obtener el id desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo "<center><p style='color:red;'><b>ID de item no válido.</b></p></center>";
    echo "<form action='../items'><input type='submit' value='Volver al catálogo'></form>";
    exit;
}

// Consultar el item
$sql = "SELECT * FROM catalogo WHERE id = $id";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    echo "<center><p style='color:red;'><b>Item no encontrado.</b></p></center>";
    echo "<form action='../items'><input type='submit' value='Volver al catálogo'></form>";
    exit;
}

$row = mysqli_fetch_assoc($resultado);
$imagen = "../img/" . $row['nombre'] . ".jpg";

// Si se confirma la eliminación
if (isset($_POST['confirmar'])) {
    mysqli_query($conn, "DELETE FROM catalogo WHERE id = $id");
    echo "<script>alert('Item eliminado correctamente.'); window.location.href='../items';</script>"; //TODO revisar esto.
    exit;
}
?>

<center>
    <h2>¿Seguro que quieres eliminar este item?</h2>

    <div class="product-card">
        <img src="<?= $imagen ?>" alt="<?= $row['nombre'] ?>" class="product-img">
        <p><b>Nombre:</b> <?= $row['nombre'] ?></p>
        <p><b>Color:</b> <?= $row['color'] ?></p>
        <p><b>Estado:</b> <?= $row['estado'] ?></p>
        <p><b>Descripción:</b> <?= $row['descr'] ?></p>
        <p><b>Precio:</b> <?= $row['precio'] ?> €</p>
    </div>

    <br>

    <form method="post" onsubmit="return confirm('¿Seguro que deseas eliminar este item?');">
        <input id="item_delete_submit" type="submit" name="confirmar" value="Sí, eliminar item">
    </form>

    <form action="../show_item" method="get" onsubmit="return confirm('¿Deseas cancelar y volver atrás?')">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="submit" value="Cancelar">
    </form>

</center>

<?php mysqli_close($conn); ?>

<br><br><br><br>

<?php include_once('../header_and_footer/footer.php'); // Para el footer ?>
</body>
</html>

