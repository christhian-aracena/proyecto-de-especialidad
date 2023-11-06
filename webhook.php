<?php
    include("Datos/conexion.php");
    $sql = "INSERT INTO charity (mail) VALUES ('a')";
    $result = $conexion->query($sql);
    
    if ($result) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . $conexion->error;
    }
?>
