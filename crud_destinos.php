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

// Insertar destino
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $descripcion = $_POST['descripcion'];
    $dc = $_POST['dc'];
    $imagen = $_POST['imagen'];

    $sql = "INSERT INTO destinos (nombre, ubicacion, descripcion, dc, imagen)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $ubicacion, $descripcion, $dc, $imagen);
    $stmt->execute();
}

// Eliminar destino
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM destinos WHERE id = $id");
}

// Obtener destinos
$resultado = $conexion->query("SELECT * FROM destinos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Destinos | Felcor</title>
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

    <h1 class="titulos">🏖️ CRUD de Destinos Turísticos</h1>

    <form method="post" class="formulario">
        <input type="text" name="nombre" placeholder="Nombre del destino" required>
        <input type="text" name="ubicacion" placeholder="Ubicación" required><br>
        <textarea name="descripcion" placeholder="Descripción" required rows="2" cols="50"></textarea><br>
        <textarea name="dc" placeholder="Texto adicional (dc)" required rows="2" cols="50"></textarea><br>
        <input type="text" name="imagen" placeholder="Ruta de imagen" required>
        <button type="submit" class="btn">Agregar destino</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Descripción</th>
                <th>DC</th>
                <th>Imagen</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['ubicacion']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['dc']; ?></td>
                    <td><img src="<?php echo $row['imagen']; ?>" width="80"></td>
                    <td><a href="?eliminar=<?php echo $row['id']; ?>">❌</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <p><a href="admin.php" style="color:#ccc;">⬅️ Volver al panel</a></p>

</body>
</html>
