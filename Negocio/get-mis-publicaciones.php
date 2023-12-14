<?php
include('Datos/conexion.php');
$resultado = $conexion->query( "SELECT *
FROM adopcion
INNER JOIN salud ON salud.id = adopcion.salud_id
INNER JOIN sexo ON sexo.id = adopcion.sexo_id
INNER JOIN dimension ON dimension.id = adopcion.dimension_id
INNER JOIN edad ON edad.id = adopcion.edad_id
ORDER BY adopcion.fecha_registro DESC;");





while ($publicacion = $resultado->fetch_array(MYSQLI_ASSOC)) {

    $id = $publicacion['id'];
    $imagen_mascota = base64_encode($publicacion['imagen_mascota']);
    $nombre_mascota = $publicacion['nombre'];
    $raza = $publicacion['raza'];
    $descripcion = $publicacion['descripcion'];
    $fecha_registro = $publicacion['fecha_registro'];
    $vacunas = $publicacion['vacunas'];
    $sexo_mascota = $publicacion['sexo_id'];
    $edad_mascota = $publicacion['edad_mascota'];
    $salud = $publicacion['salud_id'];
    $dimension = $publicacion['dimension_id'];



    $descripcion_recortada = mb_strlen($descripcion, 'UTF-8') > 6 ? mb_substr($descripcion, 0, 70, 'UTF-8') . '...' : $descripcion;
    $salud_recortada = mb_strlen($salud, 'UTF-8') > 6 ? mb_substr($salud, 0, 11, 'UTF-8') . '...' : $salud;
    $raza = mb_strlen($raza, 'UTF-8') > 6 ? mb_substr($raza, 0, 11, 'UTF-8') . '...' : $raza;
    $nombre_mascota = mb_strlen($nombre_mascota, 'UTF-8') > 10 ? mb_substr($nombre_mascota, 0, 15, 'UTF-8') . '...' : $nombre_mascota;

    // $colorRecortado = strlen($color) > 19 ? substr($color, 0, 22) . '...' : $color;

    // Obtener la imagen en formato base64
    // $imagen_base64 = base64_encode($imagen_mascota);
    // $imagen_src = 'data:image/jpeg;base64,' . $imagen_base64;

    echo '<!-- ESTA ES LA PUBLICACION -->

    <div class="contenedor-publicacion sombra ">

        <div class="titulo-publicacion">
            <h3 class="centrar-texto sombra">'.$nombre_mascota.'</h3>
        </div>
   
        <div class="flex-centrar-item">
             <img src="data:image/jpeg;base64,' . $imagen_mascota . '" alt="imagen de perfil">
        </div>
   
        <div class="contenedor-info">
            <div class="flex-row">
                <h4>Sexo:</h4>
                <p>' . $sexo_mascota . '</p>
            </div>
            <div class="flex-row">
                <h4>Raza:</h4>
                <p>' . $raza . '</p>
            </div>
            <div class="flex-row">
                <h4>Salud:</h4>
                <p>' . $salud_recortada . '</p>
            </div>
            <div class="flex-col">
                <h4>Descripcion:</h4>
                <p class="cap">' . $descripcion_recortada . '</p>
            </div>
        </div>
        <a href="mascota?id=' . $id . '" class="centrar-texto btn_postular" id="btnBack">Postular</a>


    </div>';
}
?>

