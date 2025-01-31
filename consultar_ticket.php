<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_ticket = $_POST['id_ticket'];
    $email = $_POST['email'];

    // Consultar el ticket en la base de datos
    $sql = "SELECT * FROM tickets WHERE id_ticket = '$id_ticket' AND email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $ticket = $result->fetch_assoc();
        // Mostrar la información del ticket
        echo "<h2>Información del Ticket</h2>";
        echo "<p><strong>ID del Ticket:</strong> " . $ticket['id_ticket'] . "</p>";
        echo "<p><strong>Nombre:</strong> " . $ticket['nombre'] . "</p>";
        echo "<p><strong>Email:</strong> " . $ticket['email'] . "</p>";
        echo "<p><strong>Prioridad:</strong> " . $ticket['prioridad'] . "</p>";
        echo "<p><strong>Asunto:</strong> " . $ticket['asunto'] . "</p>";
        echo "<p><strong>Mensaje:</strong> " . $ticket['mensaje'] . "</p>";
        echo "<p><strong>Fecha de Creación:</strong> " . $ticket['fecha_creacion'] . "</p>";
    } else {
        echo "No se encontró ningún ticket con ese ID y correo electrónico.";
    }

    $conn->close();
}
?>