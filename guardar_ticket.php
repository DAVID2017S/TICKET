<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $num_empleado = $_POST['numEmpleado'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $prioridad = $_POST['prioridad'];
    $extension = $_POST['extension'];
    $departamento = $_POST['departamento'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $anydesk = $_POST['anydesk'];

    // Manejar la subida de archivos
    $adjuntos = "";
    if (!empty($_FILES['adjuntos']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES['adjuntos']['name']);
        if (move_uploaded_file($_FILES['adjuntos']['tmp_name'], $target_file)) {
            $adjuntos = $target_file;
        }
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO tickets (num_empleado, nombre, email, prioridad, extension, departamento, asunto, mensaje, anydesk, adjuntos)
            VALUES ('$num_empleado', '$nombre', '$email', '$prioridad', '$extension', '$departamento', '$asunto', '$mensaje', '$anydesk', '$adjuntos')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del ticket recién insertado
        $id_ticket = $conn->insert_id;
        // Devolver una respuesta JSON con el ID del ticket y un mensaje de éxito
        echo json_encode([
            'success' => true,
            'id_ticket' => $id_ticket,
            'message' => 'Ticket enviado correctamente.'
        ]);
    } else {
        // Devolver un mensaje de error si la inserción falla
        echo json_encode([
            'success' => false,
            'message' => 'Error al enviar el ticket: ' . $conn->error
        ]);
    }

    $conn->close();
}
?>