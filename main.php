<?php

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
    <div id="bellnoti" class="bellnoti" style="font-size: 1.5rem;">
        <?php include('get-numero-notificaciones.php'); ?>
    </div>
</i>
 <p class="nombre seleccionar">Hola, <?php echo $nombreCorto ?></p>
            <?php if (isset($_SESSION['email'])) {
                if (!empty($filaAvatar)) {
                    // Si hay una imagen de perfil, mostrarla
                    echo '<div class="avatar cursor-pointer"><img src="data:image/jpeg;base64,' . $filaAvatar . '" alt="imagen de perfil"></div>';

                } else {
                    // Si no hay imagen de perfil, mostrar las iniciales del nombre
                    include("Negocio/get-nombre-app.php");

                    echo '<div class="inicial cursor-pointer">' . strtoupper(substr($consulta['user'], 0, 1)) . '</div>';

                }
            } else {

                // Si es una sesión de Google, mostrar la imagen directamente
                echo '<div class="avatar cursor-pointer"><img src="' . $profileImage . '" alt="" srcset=""></div>';
            } ?>
        </div>

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
                    <a href="main"><div class="publicar flex-nowrap a"><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div></a>
                    <a href="mis-publicaciones"><div class="publicar flex-nowrap "><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div></a>
                    <a href="en-adopcion"><div class="publicar flex-nowrap "><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div></a>
                    <a href="perdidos"><div class="publicar flex-nowrap "><img src="img/perdidos.png" alt="" srcset="">Perdidos</div></a>
                    <a href="encontrados"><div class="publicar flex-nowrap "><img src="img/encontrados.png" alt="" srcset="">Encontrados</div></a>
                    <a href="donar"><div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div></a>
                </div>




            </div>
        </div>


        <hr class="hr">

        <div class="principal " id="contenedor-ajax-main">


            <div class="container-options flex-wrap ">

                <div class="adopt flex-row">
                    <div class="circleAdopt">

                    </div>

                    <div class="info">
                        <h3>Adoptar</h3>
                        <p>Escoge una mascota, rellena  el formulario de solicitud y se pondrán en contacto contigo para informate si calificas.</p>
                        <a href="en-adopcion.php"><button  id="adopta">Adopta</button></a>
                    </div>

                </div>

                <div class="inAdopt ">
                    <div class="info">
                        <h3>En adopcion</h3>
                        <p>Publica una mascota, de este modo la gente podrá enviarte solicitudes de adopcion y podrás aceptar a quién desees.</p>
                        <button id="adopcion">Publicar</button>
                    </div>
                    <div class="circleInAdopt">

                    </div>

                </div>

                <div class="foundIt  flex-row">
                    <div class="circleFoundIt">

                    </div>
                    <div class="info">
                        <h3>Encontrados</h3>
                        <p>Si has encontrado una mascota con collar, identificación o consideras que está perdido, toma fotos y publica.</p>
                        <button>Publicar</button>
                    </div>

                </div>

                <div class="lost">
                    <div class="info">
                        <h3>Perdidos</h3>
                        <p>Si has extraviado a tu mascota, detalla información y realiza una publicación que ayude en su busqueda.</p>
                        <button>Publicar</button>
                    </div>
                    <div class="circleLost">

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
        <a href="main"><div class="publicar flex-nowrap b"><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div></a>
        <a href="mis-publicaciones"><div class="publicar flex-nowrap"><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div></a>
        <a href="en-adopcion"><div class="publicar flex-nowrap"><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div></a>
        <a href="perdidos"><div class="publicar flex-nowrap"><img src="img/perdidos.png" alt="" srcset="">Perdidos</div></a>
        <a href="encontrados"><div class="publicar flex-nowrap"><img src="img/encontrados.png" alt="" srcset="">Encontrados</div></a>
        <a href="donar"><div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div></a>
    </div>
    <script src="Negocio/js/ajax-main.js"></script>
    <script src="Negocio/js/faq.js"></script>

</body>

</html>