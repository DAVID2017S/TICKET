<?php
include 'conexion.php';

$tipoTicket = $_GET['tipo'];

// Consultar las opciones de asunto para el tipo de ticket seleccionado
$sql = "SELECT asunto FROM opciones_asunto WHERE tipo_ticket = '$tipoTicket'";
$result = $conn->query($sql);

$asuntos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $asuntos[] = $row['asunto'];
    }
}

echo json_encode($asuntos);

$conn->close();
?>