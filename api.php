<?php

// Forzar mostrar errores por si hay alguno escondido
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Encabezado JSON
header('Content-Type: application/json');

// Conexión
$servername = "fdb1030.awardspace.net";
$username = "4586180_aeromexico";
$password = "JmY%7r@32);9d:vt";
$dbname = "4586180_aeromexico";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Conexión fallida: " . $conn->connect_error]);
    exit;
}

// Consulta
$sql = "SELECT * FROM vehiculos";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
    echo json_encode($datos, JSON_PRETTY_PRINT);
} else {
    echo json_encode([]);
}

$conn->close();
?>
