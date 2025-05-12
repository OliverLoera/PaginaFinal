<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo | Felcor</title>
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


    <h1 class="titulo-login">Panel Administrativo</h1> 
    <p class="bienvenida-admin">Bienvenido, <strong><?php echo $_SESSION['usuario']; ?></strong></p>


    <div class="panel-grid">
        <div class="card">
            <a href="crud_vehiculos.php">🚐 Gestionar Vehículos</a>
        </div>
        <div class="card">
            <a href="crud_destinos.php">🏖️ Gestionar Destinos</a>
        </div>
        <div class="card">
            <a href="crud_costos.php">💰 Gestionar Costos</a>
        </div>
        <div class="card">
            <a href="usuarios.php">👥 Gestionar Usuarios</a>
        </div>
    </div>

    <div class="logout">
        <a href="logout.php">Cerrar sesión</a>
    </div>

</body>
</html>
