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

// Insertar nuevo usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password_plano = $_POST['password'];
    $password_hash = password_hash($password_plano, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password_hash);
    $stmt->execute();
}

// Eliminar usuario
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM usuarios WHERE id = $id");
}

// Obtener todos los usuarios
$resultado = $conexion->query("SELECT id, username FROM usuarios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios | Felcor</title>
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




    <h1>👥 Gestión de Usuarios</h1>

    <form method="post">
        <h3>Agregar nuevo usuario</h3>
        <input type="text" name="username" placeholder="Nombre de usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" class="btn">Crear usuario</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td>
                        <?php if ($row['username'] !== $_SESSION['usuario']): ?>
                            <a href="?eliminar=<?php echo $row['id']; ?>">❌</a>
                        <?php else: ?>
                            <span style="color:gray;">(Tú)</span>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php
    // Cambiar contraseña del usuario actual
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cambiar_password'])) {
        $nuevo_pass = $_POST['nuevo_password'];
        $hash = password_hash($nuevo_pass, PASSWORD_DEFAULT);

        $stmt = $conexion->prepare("UPDATE usuarios SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hash, $_SESSION['usuario']);
        $stmt->execute();

        echo "<p style='color:#0f0;'>✅ Contraseña actualizada con éxito.</p>";
    }
    ?>
    <form method="post" style="background:#e3e3e3; padding:20px; border-radius:10px; width:300px; margin:30px auto;">
        <h3>Cambiar tu contraseña</h3>
        <input type="password" name="nuevo_password" placeholder="Nueva contraseña" required>
        <input type="hidden" name="cambiar_password" value="1">
        <button type="submit" class="btn">Actualizar contraseña</button>
    </form>


    <p><a href="admin.php" style="color:#ccc;">⬅️ Volver al panel</a></p>

</body>
</html>
