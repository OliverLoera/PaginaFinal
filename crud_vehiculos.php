<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$conexion = new mysqli("fdb1030.awardspace.net", "4586180_aeromexico", "JmY%7r@32);9d:vt", "4586180_aeromexico");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Insertar nuevo vehículo
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipo = $_POST['tipo'];
    $modelo = $_POST['modelo'];
    $capacidad = $_POST['capacidad'];
    $imagen = $_POST['imagen'];
    $ciudad = $_POST['ciudad'];

    $sql = "INSERT INTO vehiculos (tipo, modelo, capacidad, imagen, ciudad) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssiss", $tipo, $modelo, $capacidad, $imagen, $ciudad);
    $stmt->execute();
}

// Eliminar vehículo
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM vehiculos WHERE id = $id");
}

// Obtener todos los vehículos
$resultado = $conexion->query("SELECT * FROM vehiculos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Vehículos | Felcor</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Open+Sans&family=Poppins:wght@600&display=swap" rel="stylesheet">

   

</head>
<body>

    <header>
        <div class="logo">
        <img src="imagenes/Logo.jpg" alt="Felcor">
        </div>

        <nav>
            <ul>
                <li><a href="admin.php">Inicio</a></li>
                <li><a href="crud_vehiculos.php">Vehículos</a></li>
                <li><a href="crud_destinos.php">Destinos</a></li>
                <li><a href="crud_costos.php">Costos</a></li>
            </ul>
        </nav>

        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="usuario">Usuario: <strong><?php echo $_SESSION['usuario']; ?></strong></div>
        <?php endif; ?>
    </header>


    <h1 class="titulos">🛠️ CRUD de Vehículos</h1>

    <form method="post" class="formulario">
        <input type="text" name="tipo" placeholder="Tipo" required>
        <input type="text" name="modelo" placeholder="Modelo" required>
        <input type="number" name="capacidad" placeholder="Capacidad" required>
        <input type="text" name="imagen" placeholder="Ruta de imagen" required>
        <input type="text" name="ciudad" placeholder="Ciudad" required>
        <button type="submit" class="btn">Agregar vehículo</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Modelo</th>
                <th>Capacidad</th>
                <th>Imagen</th>
                <th>Ciudad</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['tipo']; ?></td>
                    <td><?php echo $row['modelo']; ?></td>
                    <td><?php echo $row['capacidad']; ?></td>
                    <td><img src="<?php echo $row['imagen']; ?>" width="80"></td>
                    <td><?php echo $row['ciudad']; ?></td>
                    <td><a href="?eliminar=<?php echo $row['id']; ?>">❌</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <p><a href="admin.php" style="color:#ccc;">⬅️ Volver al panel</a></p>

</body>
</html>
