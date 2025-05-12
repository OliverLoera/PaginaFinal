<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Felcor</title>
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
            <li><a href="index.php">Inicio</a></li>
            <li><a href="destinos.html">Destinos</a></li>
            <li><a href="frontend.html">Vehículos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</header>

<h2 class="titulo-login">Iniciar sesión</h2>

<form action="verificar_login.php" method="post">
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
</form>

<?php if (isset($_GET['error'])): ?>
    <p class="error">Usuario o contraseña incorrectos.</p>
<?php endif; ?>

</body>
</html>
