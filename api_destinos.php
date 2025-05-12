<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("fdb1030.awardspace.net", "4586180_aeromexico", "JmY%7r@32);9d:vt", "4586180_aeromexico");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Conexión fallida"]);
    exit;
}

$sql = "SELECT * FROM destinos";
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
