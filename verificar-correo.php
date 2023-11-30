<?php
include("Datos/conexion.php");

// Verificar si se ha recibido el parámetro 'correo' por POST
if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];


    $correo = $conexion->real_escape_string($correo);

    // Consulta para verificar si el correo ya existe
    $consulta = "SELECT email FROM users WHERE email = '$correo'";
    $resultado = $conexion->query($consulta);

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // El correo ya está registrado
        $respuesta = array('existe' => true);
    } else {
        // El correo no está registrado
        $respuesta = array('existe' => false);
    }

    // Enviar la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se proporciona el parámetro 'correo', devolver un error
    $respuesta = array('error' => 'Parámetro "correo" no proporcionado');
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}
?>
