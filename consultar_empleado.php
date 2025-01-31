<?php
include 'conexion.php';

$num_empleado = $_GET['num_empleado'];

$sql = "SELECT nombre, email, extension, departamento, anydesk FROM empleados WHERE num_empleado = '$num_empleado'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(array("error" => "Empleado no encontrado"));
}

$conn->close();
?>