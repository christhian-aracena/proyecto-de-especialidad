<!-- // login.php -->
<?php
session_start();
require_once("vendor/autoload.php");
include("config.php");

$client = new Google_Client();
$client->setClientId($ClientID);
$client->setClientSecret($ClientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope("email");
$client->addScope("profile");

// Establecer el estado de la sesión
$_SESSION['state'] = sha1(openssl_random_pseudo_bytes(1024));
$client->setState($_SESSION['state']);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Presentacion/index.css">


    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://kit.fontawesome.com/58b7154440.js" crossorigin="anonymous"></script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Roboto:wght@300&display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Raleway&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Donación Realizada</title>
</head>

<body>
    <header class="header-landing flex-row flex-wrap">
        <div class="contenedor-header contenedor">

            <p><a class="title sombra cursor-pointer" href="index">Rescatamigos</a></p>
            <a href="index">
                <img class="logo cursor-pointer" src="img/logo1_v2-removebg-preview.png" alt="" srcset="">
            </a>

        </div>

        <div class="contenedor flex-row ">
        <p ><a class="counts cursor-pointer" href="register">Crea tu cuenta</a></p>
            <p><a class="last cursor-pointer" href="login">Iniciar sesion</a></p>
        </div>

    </header>

    <main class="contenedor flex-centrar-item">

        <div class="login-container">
            <h2>Inicia sesion</h2>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar sesión</button>
            </form>
            <div class="forgot-password">¿Olvidaste tu contraseña?</div>
            <div class="or-divider">
                <div class="or-text">o</div>
            </div>
            <!-- <div class="google-button"> -->

                <?php
                    echo "<a class='google-button' href= '".$client->createAuthUrl()."'><img src='https://img.icons8.com/color/48/000000/google-logo.png' alt='Google Icon' class='google-icon'>Iniciar sesión con Google</a>"
                ?>
                <!-- <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Icon" class="google-icon">
                Iniciar sesión con Google
            </div> -->
        </div>





    </main>

    <footer class="footer">
        <div class="footer-container contenedor">
            <div class="content1 sombra">
                <h3>Informate</h3>
                <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="privacy-policy">Politicas de privacidad</a> </p>
                <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="faq">Preguntas frecuentes</a> </p>
                <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="aboutus">Quienes Somos</a> </p>
                <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="terms-conditions">Términos y Condiciones</a> </p>
            </div>

            <div class="content1 sombra">
                <h3>Mantente conectado</h3>
                <p class="cursor-pointer hov fb"><img class="fb-image" src="img/fb-black.png" alt="" srcset="">Facebook</p>
                <p class="cursor-pointer hov insta"> <img class="insta-image" src="img/insta-white.png" alt="" srcset="">Instagram</p>
                <p class="cursor-pointer hov twitter"> <img class="twitter-image" src="img/twitter-white.png" alt="" srcset="">Twitter</p>
                <p class="cursor-pointer hov youtube"> <img class="youtube-image" src="img/youtube-white.png" alt="" srcset="">Youtube</p>

            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="content2 sombra">
                    <h3>Dejanos un mensaje.</h3>
                    <input type="text" placeholder="Nombre" name="nombre" required>
                    <input type="text" placeholder="Correo" name="correo" required>
                    <div>
                        <input type="text" placeholder="Asunto" name="asunto" required>
                    </div>
                    <div class="text">
                        <textarea placeholder="Tu mensaje..." name="mensaje" required></textarea>
                        <button id="sendFooter">Enviar</button>
                    </div>

                </div>

            </form>



        </div>


        <div class="flex-row">
            <small class="contenedor powered sombra">&copy; 2023 Todos los derechos reservados. Powered By Christhian Aracena. <img class="flag" src="img/Flag_of_Chile.svg" alt="" srcset=""></small>

        </div>

    </footer>

    <script src="Negocio/js/count1.js"></script>
    <script src="Negocio/js/ajax.js"></script>




    <div id="successMessage">Mensaje enviado con éxito</div>

</body>

</html>