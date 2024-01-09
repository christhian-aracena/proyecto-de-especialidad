<?php
include("Datos/conexion.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_app = isset($_SESSION['id_app']) ? $_SESSION['id_app'] : 1;
$id_gmail = isset($_SESSION['id_gmail']) ? $_SESSION['id_gmail'] : 1;

if ($id_app == 1) {
    $id = $id_gmail;
    $result = $conexion->query("SELECT COALESCE(SUM(numer_notificaciones), 0) AS total_suma FROM notificaciones WHERE gmail_id = $id;");
} else {
    $id = $id_app;
    $result = $conexion->query("SELECT COALESCE(SUM(numer_notificaciones), 0) AS total_suma FROM notificaciones WHERE user_id = $id;");
}



if ($result) {
    $fila = mysqli_fetch_assoc($result);
    $suma_final = $fila['total_suma'];
    echo $suma_final;

} else {

    echo "Error en la consulta: " . $conexion->error;
}
?>
