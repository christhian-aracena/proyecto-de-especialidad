<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_app = isset($_SESSION['id_app']) ? $_SESSION['id_app'] : 1;
$id_gmail = isset($_SESSION['id_gmail']) ? $_SESSION['id_gmail'] : 1;

if ($id_app == 1) {
    $id = $id_gmail;
    $result = $conexion->query("SELECT * FROM `notificaciones` 
    INNER JOIN solicitud ON solicitud.id_solicitud = notificaciones.solicitud_id WHERE gmail_id = $id ORDER BY id_notificacion DESC");
} else {
    $id = $id_app;
    $result = $conexion->query("SELECT * FROM `notificaciones` 
    INNER JOIN solicitud ON solicitud.id_solicitud = notificaciones.solicitud_id WHERE user_id = $id ORDER BY id_notificacion DESC");
}

if ($result) {


    while ($publicacion = $result->fetch_array(MYSQLI_ASSOC)) {
        $id_notificacion = $publicacion['id_notificacion']; // Reemplaza 'id_notificacion' con el nombre real de tu columna de ID
    
        $isNotiOn = $publicacion['numer_notificaciones'];
        $carta = $publicacion['carta'];
        $carta = mb_strlen($carta, 'UTF-8') > 6 ? mb_substr($carta, 0, 29, 'UTF-8') . '...' : $carta;
    
        if($isNotiOn == 0){
            $color = 'white';
            $fuente = 'normal';
        }
        else{
            $color = '#f0f5ff';
            $fuente = 'bold';
        }
    
        echo '<div class="flex-col">';
        $descripcion = $publicacion['descripcion_notificacion'];
    
        // Agrega un enlace alrededor del contenido con el ID de la notificación como parámetro
        echo '<a href="carta.php?id_notificacion=' . $id_notificacion . '" class="cursor-pointer contenedor-data-noti" style="background: ' . $color . '; font-weight: ' . $fuente . ';">';
        echo '<p style="margin-bottom: 2rem;">' . $descripcion . '</p><div>' . $carta . '</div>';
        echo '</a>';
    
        echo '</div>';
        echo '<br>';
    }
    
} else {
    echo "Error en la consulta: " . $conexion->error;
}
