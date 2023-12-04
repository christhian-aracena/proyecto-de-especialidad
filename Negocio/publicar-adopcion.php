<?php
include("../Datos/conexion.php");
session_start();
// Datos del formulario
$nombre = $_POST['nombre'];
$raza = $_POST['raza'];
$vacunas = $_POST['vacunas'];
$especie = $_POST['especieMascota'];
$salud = $_POST['salud'];
$sexo = $_POST['sexo'];
$dimension = $_POST['dimension'];
$edad = $_POST['edad'];
$descripcion = $_POST['descripcion'];



// Omitir el campo de imagen si no se proporciona
if (isset($_FILES['imagen_mascota']['tmp_name']) && !empty($_FILES['imagen_mascota']['tmp_name'])) {
    $imagen = addslashes(file_get_contents($_FILES['imagen_mascota']['tmp_name']));
} else {
    $imagen = null;
}



// Generar un identificador único
$identificador_mascota = uniqid();

if (isset($_SESSION['email'])) {
    $app_id = $_SESSION['id_app'];
    $gmail_id = 1;
} else {
    $gmail_id = $_SESSION['id_gmail'];
    $app_id = 1;
}

// Insertar datos en la base de datos
$sql = "INSERT INTO `adopcion`(`id`, `nombre`, `raza`, `descripcion`, `fecha_registro`, `vacunas`, `salud_id`, `especie_id`, `sexo_id`, `dimension_id`, `edad_id`, `usuario_id`, `gmail_id`, `imagen_mascota`) VALUES ('$identificador_mascota', '$nombre', '$raza', '$descripcion', NOW(), '$vacunas', '$salud', '$especie', '$sexo', '$dimension', '$edad', '$app_id', '$gmail_id', '$imagen')";

if ($conexion->query($sql) === TRUE) {
    // Redirigir al usuario a la página única de la mascota
    header("Location: ../mascota?id=$identificador_mascota");
    exit;
} else {
    echo "Error al guardar en la base de datos: " . $conexion->errno;
}

