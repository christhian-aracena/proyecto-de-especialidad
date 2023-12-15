<?php
include('Datos/conexion.php');
$identificador_notificacion = $_GET['id_notificacion'];

// if(empty($identificador_notificacion)){
//     header('Location: error.php');
// }

// IMPORTANTE ACTIVAR EN PRODUCCION
// ini_set('display_errors', 0);


// echo uniqid();
require_once 'vendor/autoload.php';
require_once 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("Datos/tipo-sesion.php");
// include('get-numero-notificaciones.php');
// if(!isset($_SESSION['socialemail'])){
//     header("Location: login.php");
// }

$result4 = $conexion->query("UPDATE `notificaciones` SET `numer_notificaciones`= 0 WHERE id_notificacion = $identificador_notificacion");
?>














<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Presentacion/main.css">
    <script src="Negocio/js/faq.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://kit.fontawesome.com/58b7154440.js" crossorigin="anonymous"></script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Roboto:wght@300&display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Raleway&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Principal</title>
</head>

<body>
    <header class="header-landing">
        <div class="flex-row logomain">

            <p><a class="title sombra cursor-pointer" href="main">Rescatamigos</a></p>
            <a href="main">
                <img class="logo cursor-pointer" src="img/logo1_v2-removebg-preview.png" alt="" srcset="">
            </a>

        </div>

        <div class="flex-row noty">
            <i id="bell" class="fa-solid fa-bell cursor-pointer bell" onclick="toggleDropdown()">
                <div id="bellnoti" class="bellnoti" style="font-size: 1.4rem; padding-top: 0.5rem; font-weight: 100;">
                    <?php include('get-numero-notificaciones.php'); ?>
                </div>
            </i>
            <div id="dropdown" class="dropdown-content">
                <?php include('get-datos-notificacion.php'); ?>
            </div>
            <div id="dropdown2" class="dropdown-content2 aa" style="display: none;">

                <a href="logout.php">Salir</a>
            </div>

            <p class="nombre seleccionar">Hola, <?php echo $nombreCorto ?></p>

            <?php
            if (isset($_SESSION['email'])) {
                if (!empty($filaAvatar)) {
                    // Si hay una imagen de perfil, mostrarla
                    echo '<div  class="avatar cursor-pointer" onclick="toggleDropdown2()"><img id="avatar" src="data:image/jpeg;base64,' . $filaAvatar . '" alt="imagen de perfil"></div>';
                } else {
                    // Si no hay imagen de perfil, mostrar las iniciales del nombre
                    include("Negocio/get-nombre-app.php");
                    echo '<div id="avatar" class="inicial cursor-pointer" onclick="toggleDropdown2()">' . strtoupper(substr($consulta['user'], 0, 1)) . '</div>';
                }
            } else {
                // Si es una sesión de Google, mostrar la imagen directamente
                echo '<div id="avatar" class="avatar cursor-pointer" onclick="toggleDropdown2()"><img id="avatar" src="' . $profileImage . '" alt="" srcset=""></div>';
            }
            ?>



    </header>
    <div class="hamburguesa" id="hamburguesa">
        <div class="barra"></div>
        <div class="barra"></div>
        <div class="barra"></div>
    </div>
    <main class="contenedor flex-row main">




        <div>
            <div class="menu flex-col">

                <div class="flex-col as">
                    <a href="main">
                        <div class="publicar flex-nowrap "><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
                    </a>
                    <a href="mis-publicaciones">
                        <div class="publicar flex-nowrap "><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div>
                    </a>
                    <a href="en-adopcion">
                        <div class="publicar flex-nowrap "><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div>
                    </a>
                    <a href="perdidos">
                        <div class="publicar flex-nowrap "><img src="img/perdidos.png" alt="" srcset="">Perdidos</div>
                    </a>
                    <a href="encontrados">
                        <div class="publicar flex-nowrap "><img src="img/encontrados.png" alt="" srcset="">Encontrados</div>
                    </a>
                    <a href="donar">
                        <div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div>
                    </a>
                </div>




            </div>
        </div>


        <hr class="hr">

        <div class="principal " id="contenedor-ajax-main">


            <?php

            include('Negocio/get-carta.php');




            ?>

            <div class="container ajuste ajuste2">


                <h3 class="sombra centrar-texto"> <?php echo $nombre_solicitante . ' quiere adoptar a ' . $nombre_mascota  ?> </h3>

                <div class="details">

                    <?php echo '<div class="flex-row raza"><h3>Motivo: </h3><p>  ' . $razones . '   </p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Tipo de vivienda: </h3><p>   ' . $vivienda . '  </p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Atención veterinaria: </h3><p>  ' . $veterinario . '   </p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Tiempo que pasará solo: </h3><p> ' . $solo_tiempo . '    </p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Otros animales: </h3><p>  ' . $otros_animales . '   </p></div>' ?>



                    <?php echo '<div class="sombra descripcion flex-row raza"><p>     </p></div>' ?>


                </div>
                <br>
                <br>
                <hr>
                <br>
                <?php
                $ejecutarConsulta22 = $conexion->query("SELECT * FROM `notificaciones` 
                                        INNER JOIN solicitud ON solicitud.id_solicitud = notificaciones.solicitud_id
                                        INNER JOIN estado_solicitud ON estado_solicitud.id_estado_solicitud = solicitud.estado_solicitud_id WHERE id_notificacion = $identificador_notificacion");
                $publicacion33 = $ejecutarConsulta22->fetch_array(MYSQLI_ASSOC);
                $display_aceptar = 'flex';
                $display_espera = 'flex';
                $display_rechazar = 'flex';

                $estado_solicitud = $publicacion33['estado_solicitud'];

                if ($estado_solicitud == 'Solicitud aceptada.') {
                    $display_aceptar = 'none';
                    $display_espera = 'flex';
                    $display_rechazar = 'flex';
                } elseif ($estado_solicitud == 'Solicitud Rechazada.') {
                    $display_aceptar = 'flex';
                    $display_espera = 'flex';
                    $display_rechazar = 'none';
                } elseif ($estado_solicitud == 'Solicitud en espera de confirmación.') {
                    $display_aceptar = 'flex';
                    $display_espera = 'none';
                    $display_rechazar = 'flex';
                }

                echo "Estado Solicitud: $estado_solicitud<br>";
                echo "Display Aceptar: $display_aceptar<br>";
                echo "Display Espera: $display_espera<br>";
                echo "Display Rechazar: $display_rechazar<br>";

                ?>

                <div class="flex-form-adopt">


                    <div class="register2 container-options" id="solicitud-ajax">
                        <div id="spinner-container" style="display: none;">
                            <div class="spinner"></div>
                        </div>
                        <form method="POST">
                            <div class="form-group">

                                <h3 class="margen-b">Carta de solicitud</h3>
                                <hr>
                                <?php echo '<div class="flex-row raza carta"><p>   ' . $carta . '  </p></div>' ?>
                                <hr style="margin-top: 1rem;">

                                <h2 style="background: aliceblue; padding: 1.5rem 0;"><?php echo 'Estado: ' . $estado_solicitud ?></h2>
                                <hr>
                                <h3 class="h3-ask">¿Qué desea hacer con esta solicitud?</h3>

                                <div class="flex-row flex-centrar-item flex-wrap contenedor-botones">





                                    <button style="display: <?= $display_aceptar ?>;" type="button" class="btn_solicitud_aceptar cursor-pointer" id="btn_solicitud_aceptar" data-sender="<?= htmlspecialchars($sender); ?>" data-razones="<?= htmlspecialchars($razones); ?>" data-identificador="<?= htmlspecialchars($identificador_notificacion); ?>" data-veterinario="<?= htmlspecialchars($veterinario); ?>" data-vivienda="<?= htmlspecialchars($vivienda); ?>" data-solo-tiempo="<?= htmlspecialchars($solo_tiempo); ?>" data-otros-animales="<?= htmlspecialchars($otros_animales); ?>" data-id-sender-app="<?= htmlspecialchars($id_sender_app); ?>" data-id-sender-gmail="<?= htmlspecialchars($id_sender_gmail); ?>" data-receiver-avatar="<?= htmlspecialchars($receiver_avatar); ?>" data-carta="<?= htmlspecialchars($carta); ?>">
                                        Aceptar
                                    </button>


                                    <button style="display: <?= $display_espera ?>;" type="button" class="btn_solicitud_espera cursor-pointer" id="btn_solicitud_espera" data-sender="<?= htmlspecialchars($sender); ?>" data-razones="<?= htmlspecialchars($razones); ?>" data-identificador="<?= htmlspecialchars($identificador_notificacion); ?>" data-veterinario="<?= htmlspecialchars($veterinario); ?>" data-vivienda="<?= htmlspecialchars($vivienda); ?>" data-solo-tiempo="<?= htmlspecialchars($solo_tiempo); ?>" data-otros-animales="<?= htmlspecialchars($otros_animales); ?>" data-id-sender-app="<?= htmlspecialchars($id_sender_app); ?>" data-id-sender-gmail="<?= htmlspecialchars($id_sender_gmail); ?>" data-receiver-avatar="<?= htmlspecialchars($receiver_avatar); ?>" data-carta="<?= htmlspecialchars($carta); ?>">
                                        En espera
                                    </button>
                                    <button style="display: <?= $display_rechazar ?>;" type="button" class="btn_solicitud_rechazar cursor-pointer" id="btn_solicitud_rechazar" data-sender="<?= htmlspecialchars($sender); ?>" data-razones="<?= htmlspecialchars($razones); ?>" data-identificador="<?= htmlspecialchars($identificador_notificacion); ?>" data-veterinario="<?= htmlspecialchars($veterinario); ?>" data-vivienda="<?= htmlspecialchars($vivienda); ?>" data-solo-tiempo="<?= htmlspecialchars($solo_tiempo); ?>" data-otros-animales="<?= htmlspecialchars($otros_animales); ?>" data-id-sender-app="<?= htmlspecialchars($id_sender_app); ?>" data-id-sender-gmail="<?= htmlspecialchars($id_sender_gmail); ?>" data-receiver-avatar="<?= htmlspecialchars($receiver_avatar); ?>" data-carta="<?= htmlspecialchars($carta); ?>">
                                        Rechazar
                                    </button>

                                </div>
                                <br><br>

                                <small style="color: red;"> <span style="font-weight: 600;">Importante.</span> <br> Aceptar: Si acepta, su mascota se quitara del apartado "En adopcion". <br> Rechazar: Si rechaza, le notificaremos al solicitante para que no tenga que esperar. <br>Si desea esperar a mas solicitudes, no haga nada.</small>
                        </form>
                    </div>
                </div>


            </div>

        </div>




    </main>



    <div class="footer flex-wrap">
        <p id="privacidad" class="cursor-pointer hov"><a class="cursor-pointer hov">Privacidad</a> </p>
        <p id="preguntas" class="cursor-pointer hov"><a class="cursor-pointer hov">Preguntas</a> </p>
        <p id="nosotros" class="cursor-pointer hov"><a class="cursor-pointer hov">Nosotros</a> </p>
        <p id="terminos" class="cursor-pointer hov"><a class="cursor-pointer hov">Términos</a> </p>
    </div>




    <script src="Negocio/js/count1.js"></script>

    </div>
    <!-- Menú desplegable -->
    <div class="menu-desplegable as" id="menu-desplegable">
        <a href="main">
            <div class="publicar flex-nowrap "><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
        </a>
        <a href="mis-publicaciones">
            <div class="publicar flex-nowrap"><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div>
        </a>
        <a href="en-adopcion">
            <div class="publicar flex-nowrap"><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div>
        </a>
        <a href="perdidos">
            <div class="publicar flex-nowrap"><img src="img/perdidos.png" alt="" srcset="">Perdidos</div>
        </a>
        <a href="encontrados">
            <div class="publicar flex-nowrap"><img src="img/encontrados.png" alt="" srcset="">Encontrados</div>
        </a>
        <a href="donar">
            <div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div>
        </a>
    </div>

    <script src="Negocio/js/carta.js"></script>

    <script src="Negocio/js/ajax-main.js"></script>
    <script src="Negocio/js/faq.js"></script>


</body>

</html>