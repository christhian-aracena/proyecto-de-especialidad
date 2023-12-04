<?php
include('Datos/conexion.php');
$resultado = $conexion->query( "SELECT * FROM adopcion
INNER JOIN salud ON salud.id = adopcion.salud_id
INNER JOIN sexo ON sexo.id = adopcion.sexo_id
INNER JOIN dimension ON dimension.id = adopcion.dimension_id
INNER JOIN edad ON edad.id = adopcion.edad_id ORDER BY fecha_registro DESC;");





while ($publicacion = $resultado->fetch_array(MYSQLI_ASSOC)) {


    $imagen_mascota = base64_encode($publicacion['imagen_mascota']);
    $nombre_mascota = $publicacion['nombre'];
    $raza = $publicacion['raza'];
    $descripcion = $publicacion['descripcion'];
    $fecha_registro = $publicacion['fecha_registro'];
    $vacunas = $publicacion['vacunas'];
    $sexo_mascota = $publicacion['sexo_mascota'];
    $edad_mascota = $publicacion['edad_mascota'];
    $salud = $publicacion['estado_salud'];
    $dimension = $publicacion['dimension_mascota'];



    $descripcion_cortada = strlen($descripcion) > 50 ? substr($descripcion, 0, 120) . '...' : $descripcion;
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
                <h4>Nombre:</h4>
                <p>' . $nombre_mascota . '</p>
            </div>
            <div class="flex-row">
                <h4>Raza:</h4>
                <p>' . $raza . '</p>
            </div>
            <div class="flex-row">
                <h4>Color:</h4>
                <p>' . $salud . '</p>
            </div>
            <div class="flex-col">
                <h4>Descripcion:</h4>
                <p class="cap">' . $descripcion_cortada . '</p>
            </div>
        </div>
        <a href="formulario_publicacion.php" class="centrar-texto btn_postular" id="btnBack">Postular</a>

    </div>';
}
?>

