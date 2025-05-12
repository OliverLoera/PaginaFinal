<?php
$mensaje_enviado = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];

    $destinatario = "oliverleonelloera@gmail.com"; // <-- tu correo real en AwardSpace
    $asunto = "Nuevo mensaje de $nombre";
    $cuerpo = "Correo del visitante: $correo\n\nMensaje:\n$mensaje";

    $headers = "From: $correo\r\nReply-To: $correo\r\n";

    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        // Correo para confirmar al visitante
        $asuntoConfirmacion = "Felcor - Confirmación de mensaje";
        $mensajeConfirmacion = "Hola $nombre,\n\nGracias por contactarnos. Hemos recibido tu mensaje y te responderemos pronto.\n\nAtentamente,\nFelcor Transportes";
        $headersConfirmacion = "From: $destinatario\r\n";

        mail($correo, $asuntoConfirmacion, $mensajeConfirmacion, $headersConfirmacion);

        $mensaje_enviado = true;
    } else {
        $error = "Error al enviar el mensaje.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto | Felcor</title>
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

    

    form {
        background: #f3f4f6; /* gris claro */
        padding: 20px;
        margin: auto;
        max-width: 500px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    input, textarea {
        width: 90%;
        margin: 10px 0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    button {
        background: #7c3aed; /* morado */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
    }

    button:hover {
        background: #5b21b6; /* morado oscuro */
    }

    .msg {
        margin-top: 20px;
        color: #16a34a; /* verde más estilizado */
    }

    .error {
        color: #e11d48; /* rojo elegante */
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
    </header><br><br>
    <h1>Contáctanos</h1>
    <p>¿Tienes dudas sobre nuestros servicios? Escríbenos, responderemos lo antes posible.</p> <br><br>

    <?php if ($mensaje_enviado): ?>
        <p class="msg">✅ Tu mensaje ha sido enviado correctamente. ¡Gracias!</p>
    <?php elseif ($error): ?>
        <p class="error">❌ <?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="nombre" placeholder="Tu nombre" required>
        <input type="email" name="correo" placeholder="Tu correo electrónico" required>
        <textarea name="mensaje" placeholder="Tu mensaje" rows="5" required></textarea>
        <button type="submit">Enviar mensaje</button>
    </form>

</body>
</html>
