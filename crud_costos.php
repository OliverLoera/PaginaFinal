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

// === INSERTAR EN costostraslado ===
if (isset($_POST['insertar_costostraslado'])) {
    $vehiculo = $_POST['vehiculo'];
    $ubicacion = $_POST['ubicacion'];
    $costo = $_POST['costo'];

    $stmt = $conexion->prepare("INSERT INTO costostraslado (vehiculo, ubicacion, costo) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $vehiculo, $ubicacion, $costo);
    $stmt->execute();
}

// === ELIMINAR DE costostraslado ===
if (isset($_GET['eliminar_ct'])) {
    $id = $_GET['eliminar_ct'];
    $conexion->query("DELETE FROM costostraslado WHERE id = $id");
}

// === INSERTAR EN costostrasladosdis ===
if (isset($_POST['insertar_costostrasladosdis'])) {
    $vehiculos = $_POST['vehiculos'];
    $destino = $_POST['destino'];
    $costos = $_POST['costos'];

    $stmt = $conexion->prepare("INSERT INTO costostrasladosdis (vehiculos, destino, costos) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $vehiculos, $destino, $costos);
    $stmt->execute();
}

// === ELIMINAR DE costostrasladosdis ===
if (isset($_GET['eliminar_cd'])) {
    $id = $_GET['eliminar_cd'];
    $conexion->query("DELETE FROM costostrasladosdis WHERE id = $id");
}

// === CONSULTAS PARA MOSTRAR DATOS ===
$costos1 = $conexion->query("SELECT * FROM costostraslado");
$costos2 = $conexion->query("SELECT * FROM costostrasladosdis");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Costos de Traslados</title>
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

    <h1 class="titulos">💰 CRUD de Costos de Traslados</h1>

    <!-- costostraslado -->
    <h2 class="titulos2">🟪 Traslados Generales</h2>
    <form method="post">
        <input type="hidden" name="insertar_costostraslado" value="1">
        <input type="text" name="vehiculo" placeholder="Vehículo" required>
        <input type="text" name="ubicacion" placeholder="Ubicación" required>
        <input type="number" step="0.01" name="costo" placeholder="Costo" required>
        <button class="btn" type="submit">Agregar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehículo</th>
                <th>Ubicación</th>
                <th>Costo</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $costos1->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['vehiculo']; ?></td>
                <td><?php echo $row['ubicacion']; ?></td>
                <td>$<?php echo number_format($row['costo'], 2); ?></td>
                <td><a href="?eliminar_ct=<?php echo $row['id']; ?>">❌</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- costostrasladosdis -->
    <h2 class="titulos2">🟩 Traslados a disposicion</h2>
    <form method="post">
        <input type="hidden" name="insertar_costostrasladosdis" value="1">
        <input type="text" name="vehiculos" placeholder="Vehículo" required>
        <input type="text" name="destino" placeholder="Destino" required>
        <input type="number" step="0.01" name="costos" placeholder="Costo" required>
        <button class="btn" type="submit">Agregar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehículo</th>
                <th>Destino</th>
                <th>Costo</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $costos2->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['vehiculos']; ?></td>
                <td><?php echo $row['destino']; ?></td>
                <td>$<?php echo number_format($row['costos'], 2); ?></td>
                <td><a href="?eliminar_cd=<?php echo $row['id']; ?>">❌</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <p><a href="admin.php" style="color:#ccc;">⬅️ Volver al panel</a></p>

</body>
</html>
