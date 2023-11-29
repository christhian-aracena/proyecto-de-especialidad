<?php


require_once 'vendor/autoload.php';
require_once 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Google\Client as Google_Client;
use Google\Service\Oauth2;

// Función para actualizar el token de acceso usando el token de actualización
function refreshAccessToken($client)
{
    $refreshToken = $client->getRefreshToken();
    $client->fetchAccessTokenWithRefreshToken($refreshToken);
}

// Verificar si hay una sesión activa de la aplicación
if (isset($_SESSION['email'])) {

    include("Negocio/get-nombre-app.php");
    // Existe una sesión de la aplicación, puedes incluir el contenido de tu página principal aquí
    $correoSesionApp = $_SESSION['email'];
    $nombreCorto = $nombre;
    // echo "<p>Bienvenido, $nombreCorto (sesión de la aplicación).</p>";
    include("Negocio/get-avatar.php");
    // Puedes incluir el resto de tu contenido aquí...

} else {
    // No hay sesión de la aplicación, proceder con la lógica de Google

    $client = new Google_Client();
    $client->setClientId($ClientID);
    $client->setClientSecret($ClientSecret);
    $client->setRedirectUri($redirectURI);
    $client->addScope("email");
    $client->addScope("profile");
    $client->addScope("https://www.googleapis.com/auth/userinfo.profile");

    // Verificar si hay un token almacenado en la cookie
    if (isset($_COOKIE['google_token'])) {
        $token = json_decode($_COOKIE['google_token'], true);

        if (isset($token['access_token'])) {
            $client->setAccessToken($token);

            // Verificar si el token de acceso ha expirado
            if ($client->isAccessTokenExpired() && $client->getRefreshToken()) {
                foreach ($_COOKIE as $key => $value) {
                    setcookie($key, '', time() - 3600, '/');
                }
                // Actualizar el token de acceso
                refreshAccessToken($client);
                // Guardar el token actualizado en la cookie
                setcookie('google_token', json_encode($client->getAccessToken()), time() + 3600, '/');
            }
        } else {
            echo "Error al obtener el token de acceso.";
            var_dump($token);
            exit;
        }
    } elseif (isset($_GET['code'])) {
        // Si la solicitud incluye el código de autorización, intentar obtener el token de acceso
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        if (isset($token['access_token'])) {
            // Guardar el token en una cookie
            setcookie('google_token', json_encode($token), time() + 3600, '/'); // Caduca en 1 hora

            $_SESSION['access_token'] = $token['access_token'];
            $client->setAccessToken($token);
        } else {
            echo "Error al obtener el token de acceso.";
            var_dump($token);
            exit;
        }
    }

    // Verificar si la sesión es de Google o de la aplicación
    if ($client->getAccessToken()) {
        // Obtener información del perfil de Google
        $google_oauth = new Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;
        $profileImage = $google_account_info->picture;

        $nombre = explode(" ", $name);
        $nombreCorto = implode(" ", array_slice($nombre, 0, 1));

        // Aquí colocas el contenido de tu página principal cuando la sesión es de Google
        // echo "<p>Bienvenido, $nombreCorto (sesión de Google).</p>";


        // Puedes incluir el resto de tu contenido aquí...
    } else {
        // Si no hay un token de acceso, redirigir a la autorización completa de Google
        header('Location: ' . $client->createAuthUrl());
        exit;
    }
}

?>














<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Presentacion/main.css">


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
            <i class="fa-solid fa-comments cursor-pointer"></i>
            <i class="fa-solid fa-bell cursor-pointer"></i>
            <p class="nombre seleccionar">Hola, <?php echo $nombreCorto ?></p>
            <?php if (isset($_SESSION['email'])) {
                echo '<img class="avatar cursor-pointer" src="data:image/jpeg;base64,' . $filaAvatar . '" alt="imagen de perfil">';
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

                <div class="flex-col">
                    <div class="publicar flex-nowrap"><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
                    <div class="publicar flex-nowrap"><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div>
                    <div class="publicar flex-nowrap"><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div>
                    <div class="publicar flex-nowrap"><img src="img/perdidos.png" alt="" srcset="">Perdidos</div>
                    <div class="publicar flex-nowrap"><img src="img/encontrados.png" alt="" srcset="">Encontrados</div>
                    <div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div>
                </div>




            </div>
        </div>


        <hr class="hr">

        <div class="principal" id="contenedor-ajax-main">

            <div class="container-options flex-wrap">

                <div class="adopt flex-row">
                    <div class="circleAdopt">

                    </div>

                    <div class="info">
                        <h3>Adoptar</h3>
                        <p>Rellena y envia el formulario de solicitud de adopción online y se pondrán en contacto contigo para informate si calificas.</p>
                        <button id="adopta">Adopta</button>
                    </div>

                </div>

                <div class="inAdopt ">
                    <div class="info">
                        <h3>En adopcion</h3>
                        <p>Publica una mascota, de este modo la gente podrá enviarte solicitudes de adopcion y podrás aceptar a quién desees.</p>
                        <button>Da en adopcion</button>
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
            <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="privacy-policy">Privacidad</a> </p>
            <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="faq">Preguntas</a> </p>
            <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="aboutus">Nosotros</a> </p>
            <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="terms-conditions">Términos</a> </p>
        </div>




    <script src="Negocio/js/count1.js"></script>

    </div>
    <!-- Menú desplegable -->
    <div class="menu-desplegable" id="menu-desplegable">
        <div class="publicar flex-nowrap"><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
        <div class="publicar flex-nowrap"><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div>
        <div class="publicar flex-nowrap"><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div>
        <div class="publicar flex-nowrap"><img src="img/perdidos.png" alt="" srcset="">Perdidos</div>
        <div class="publicar flex-nowrap"><img src="img/encontrados.png" alt="" srcset="">Encontrados</div>
        <div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div>
    </div>
    <script src="Negocio/js/ajax-main.js"></script>


</body>

</html>