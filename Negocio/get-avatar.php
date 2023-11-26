<?php
    include("Datos/conexion.php");
    $correo = mysqli_real_escape_string($conexion, $_SESSION['email']);
    $query = "SELECT avatar FROM users WHERE email = '$correo'";
    $ejecutar = mysqli_query($conexion, $query);

    if ($fila = mysqli_fetch_array($ejecutar)) {
        // Si se ha obtenido una fila, mostrar la imagen de perfil
        if (!empty($fila['avatar'])) {
            $filaAvatar = base64_encode($fila['avatar']);
        } else {
            include("Negocios/get-iniciales.php");
            echo "<p class= centrar-texto iniciales></p>";
        }
    }
?>