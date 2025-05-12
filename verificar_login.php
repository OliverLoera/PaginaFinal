<?php
session_start();
$conexion = new mysqli("fdb1030.awardspace.net", "4586180_aeromexico", "JmY%7r@32);9d:vt", "4586180_aeromexico");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE username = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$resultado = $stmt->get_result();

if ($usuario = $resultado->fetch_assoc()) {
    if (password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = $username;
        header("Location: admin.php");
        exit;
    }
}

header("Location: login.php?error=1");
exit;

