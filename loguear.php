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
    $response = array('success' => true, 'message' => 'Bienvenido');
// Eliminar cookies de Gmail si existen
if (isset($_COOKIE['G_AUTHUSER_H'])) {
    setcookie('G_AUTHUSER_H', '', time() - 3600, '/');
}

if (isset($_COOKIE['GAPS'])) {
    setcookie('GAPS', '', time() - 3600, '/');
}

// Puedes agregar más cookies de Gmail si es necesario

// Asegurarse de que las cookies se eliminen para el dominio y el path adecuados
setcookie('G_AUTHUSER_H', '', time() - 3600, '/', '.google.com');
setcookie('GAPS', '', time() - 3600, '/', '.google.com');
} else {
    $response = array('success' => false, 'message' => 'Correo o contraseña incorrectas, vuelve a intentar.');
}

// Devuelve la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

?>
