<?php

require 'Datos/conexion.php';
session_start();

$correo = $_POST['correo'];
$password = $_POST['password'];

$query = "SELECT COUNT(*) AS count FROM users WHERE email = '$correo' AND pass_user = '$password'";
$consulta = mysqli_query($conexion, $query);
$array = mysqli_fetch_array($consulta);

if ($array['count'] > 0) {
    $_SESSION['email'] = $correo;

    $mail_app = mysqli_real_escape_string($conexion, $_SESSION['email']);

    $resultados = mysqli_query($conexion, "SELECT id FROM users WHERE email = '$mail_app'");

    if ($consulta = mysqli_fetch_array($resultados)) {
        $_SESSION['id_app'] = $consulta['id'];
    }
    $response = array('success' => true, 'message' => 'Bienvenido');
} else {
    $response = array('success' => false, 'message' => 'Correo o contraseña incorrectas, vuelve a intentar.');
}

// Devuelve la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

?>
