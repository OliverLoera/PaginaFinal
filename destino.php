<?php
$conexion = new mysqli("fdb1030.awardspace.net", "4586180_aeromexico", "JmY%7r@32);9d:vt", "4586180_aeromexico");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$nombre = $_GET['nombre'] ?? '';

$sql = "SELECT * FROM destinos WHERE nombre = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$resultado = $stmt->get_result();

$encontrado = false;

if ($fila = $resultado->fetch_assoc()) {
    $encontrado = true;
    $ubicacion = $fila['ubicacion'];
    $descripcion = $fila['descripcion'];
    $imagen = $fila['imagen'];
    $dc = $fila['dc'];
}


$costos = [];

if ($encontrado) {
    $sqlCostos = "SELECT * FROM costostraslado WHERE ubicacion = ?";
    $stmtCostos = $conexion->prepare($sqlCostos);
    $stmtCostos->bind_param("s", $nombre);
    $stmtCostos->execute();
    $resultadoCostos = $stmtCostos->get_result();

    while ($row = $resultadoCostos->fetch_assoc()) {
        $costos[] = $row;
    }
}

$costosDis = [];

if ($encontrado) {
    $sqlDis = "SELECT * FROM costostrasladosdis WHERE destino = ?";
    $stmtDis = $conexion->prepare($sqlDis);
    $stmtDis->bind_param("s", $nombre);
    $stmtDis->execute();
    $resultadoDis = $stmtDis->get_result();

    while ($row = $resultadoDis->fetch_assoc()) {
        $costosDis[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $encontrado ? $nombre . " | Felcor" : "Destino no encontrado"; ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Open+Sans&family=Poppins:wght@600&display=swap" rel="stylesheet">

   <style>
    

    html, body {
        margin: 0;
        padding: 0;
        font-family: 'Open Sans', sans-serif;
        background: #ffffff; /* fondo blanco */
        color: #1e3a8a;       /* azul institucional */
        font-family: Arial, sans-serif;
        margin: 0;
        text-align: center;
    }


    main, .contenido, #catalogo-container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
    }

    h1, h2 {
        color: #7c3aed; /* morado para títulos */
    }

    .contenido {
        max-width: 900px;
        margin: auto;
    }

    .contenido img {
        width: 100%;
        max-width: 500px;
        border-radius: 12px;
        margin: 20px 0;
    }

    .boton {
        display: inline-block;
        background-color: #7c3aed; /* morado */
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 8px;
        margin-top: 20px;
        transition: background 0.3s;
    }

    .boton:hover {
        background-color: #5b21b6; /* morado oscuro */
    }

    .mensaje-error {
        color: #e11d48; /* rojo para errores */
        font-size: 18px;
        margin-top: 40px;
    }

    table {
        margin: 20px auto;
        background: #f9f9f9;
        border-collapse: collapse;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    th, td {
        border: 1px solid #e5e7eb;
        padding: 10px;
        text-align: center;
    }

    th {
        background: #7c3aed;
        color: white;
    }

    td {
        color: #333;
    }

    a {
        color: #1e3a8a;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    @media (max-width: 480px) {
    body {
        padding: 10px;
    }

    h1, h2 {
        font-size: 20px;
    }

    table, th, td {
        font-size: 12px;
    }

    .boton {
        padding: 8px 16px;
        font-size: 14px;
    }
}

</style>

</head>
<body>

<header>
    <div class="logo">
    <img src="imagenes/Logo.jpg" alt="Felcor">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="destinos.html">Destinos</a></li>
            <li><a href="frontend.html">Vehículos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</header>
<br>
<div class="contenido">
    <?php if ($encontrado): ?>
        <h1><?php echo $nombre; ?></h1><br>
        <p><h3><strong>Ubicación:</strong> <?php echo $ubicacion; ?></h3></p><br>
        <h2><strong>Descripción:</strong></h2> <p> <?php echo $dc; ?></p><br>
        
        <img src="<?php echo $imagen; ?>" alt="<?php echo $nombre; ?>"><br>

        <a href="contacto.php" class="boton">Cotizar este destino</a><br><br>

        <h2>💰 Costos de traslado sencillo en <?php echo $nombre; ?></h2>

        <?php if (count($costos) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Vehículo</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($costos as $c): ?>
                        <tr>
                            <td><?php echo $c['vehiculo']; ?></td>
                            <td>$<?php echo number_format($c['costo'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="color:#aaa;">No hay tarifas registradas para esta ubicación.</p>
        <?php endif; ?>

        <h2>📍 Costos de traslados a disposicion <?php echo $nombre; ?></h2>

        <?php if (count($costosDis) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Vehículo</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($costosDis as $c): ?>
                        <tr>
                            <td><?php echo $c['vehiculos']; ?></td>
                            <td>$<?php echo number_format($c['costos'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="color:#aaa;">No hay traslados registrados en esta sección.</p>
        <?php endif; ?>


    <?php else: ?>
        <h2>Destino no encontrado</h2>
        <p class="mensaje-error">Lo sentimos, no pudimos encontrar información sobre este destino.</p>
        <a href="destinos.html" class="boton">Volver al catálogo</a>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 Felcor Transportes. Todos los derechos reservados.</p>
    <p><a href="#">Política de privacidad</a> | <a href="#">Términos y condiciones</a></p>
</footer>

</body>
</html>
