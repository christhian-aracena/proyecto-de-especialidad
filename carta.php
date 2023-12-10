<?php
include('Datos/conexion.php');
    $identificador_notificacion = $_GET['id_notificacion'];
    echo $identificador_notificacion;


    $result = $conexion->query("SELECT 
    n.id_notificacion,
    n.descripcion_notificacion,
    n.user_id,
    n.gmail_id,
    n.numer_notificaciones,
    n.solicitud_id,
    s.id_solicitud,
    s.solicitante_user_id,
    s.solicitante_gmail_id,
    s.destinatario_user_id,
    s.destinatario_gmail_id,
    raz.razon AS razon,
    vet.disposicion AS veterinario_disposicion,
    viv.vivienda AS vivienda,
    sol.tiempo AS solo_tiempo,
    s.carta,
    s.otros_animales,
    u_sender.id AS sender_id,
    u_sender.user AS sender_user,
    u_sender.last_name AS sender_last_name,
    u_sender.email AS sender_email,
    u_sender.pass_user AS sender_pass_user,
    u_sender.avatar AS sender_avatar,
    u_receiver.id AS receiver_id,
    u_receiver.user AS receiver_user,
    u_receiver.last_name AS receiver_last_name,
    u_receiver.email AS receiver_email,
    u_receiver.pass_user AS receiver_pass_user,
    u_receiver.avatar AS receiver_avatar
FROM notificaciones n
INNER JOIN solicitud s ON n.solicitud_id = s.id_solicitud
LEFT JOIN users u_sender ON s.solicitante_user_id = u_sender.id
LEFT JOIN users u_receiver ON s.destinatario_user_id = u_receiver.id
LEFT JOIN razones raz ON s.razones_id = raz.idRazones
LEFT JOIN veterinario vet ON s.veterinario_id = vet.id
LEFT JOIN vivienda viv ON s.vivienda_id = viv.id_vivienda
LEFT JOIN solo sol ON s.solo_id = sol.id_solo 
WHERE n.id_notificacion = $identificador_notificacion");



$publicacion = $result->fetch_array(MYSQLI_ASSOC);
$sender = $publicacion['sender_id'];
$razones = $publicacion['razon'];
$veterinario = $publicacion['veterinario_disposicion'];
$vivienda = $publicacion['vivienda'];
echo $razones;
echo '<br>';
echo $vivienda;
echo '<br>';
echo $veterinario;
echo '<br>';
echo 'SOLICITUD_ID '.$identificador_notificacion;
$result4 = $conexion->query("UPDATE `notificaciones` SET `numer_notificaciones`= 0 WHERE id_notificacion = $identificador_notificacion");
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
            <i class="fa-solid fa-bell cursor-pointer bell" onclick="toggleDropdown()">
                <div id="bellnoti" class="bellnoti" style="font-size: 1.4rem; padding-top: 0.5rem; font-weight: 100;">
                    <?php include('get-numero-notificaciones.php'); ?>
                </div>
            </i>
            <div id="dropdown" class="dropdown-content">
                <?php  include('Negocio/get-datos-notificacion.php'); ?>
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

           ?>



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
    <script src="Negocio/js/ajax-main.js"></script>
    <script src="Negocio/js/faq.js"></script>

</body>

</html>