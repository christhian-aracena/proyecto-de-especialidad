<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("Datos/conexion.php");
$correo = mysqli_real_escape_string($conexion, $_SESSION['email']);
$resultados = mysqli_query($conexion, "SELECT user FROM users WHERE email = '$correo'");
if ($consulta = mysqli_fetch_array($resultados)) {


    $nombre  = $consulta['user'];
    $_SESSION['nombre_app'] = $nombre;



}


?>