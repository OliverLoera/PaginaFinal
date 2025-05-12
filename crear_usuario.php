<?php
$conexion = new mysqli("fdb1030.awardspace.net", "4586180_aeromexico", "JmY%7r@32);9d:vt", "4586180_aeromexico");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$username = "OliverNG";
$password_plano = "Ch@belagart0";
$password_encriptado = password_hash($password_plano, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $username, $password_encriptado);

if ($stmt->execute()) {
    echo "✅ Usuario creado correctamente con contraseña segura.";
} else {
    echo "❌ Error: " . $stmt->error;
}
?>
