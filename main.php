<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use Google\Client as Google_Client;
use Google\Service\Oauth2;

$client = new Google_Client();
$client->setClientId($ClientID);
$client->setClientSecret($ClientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope("email");
$client->addScope("profile");
$client->addScope("https://www.googleapis.com/auth/userinfo.profile"); // Añadir el alcance necesario

session_start();

// Revocar el token si existe y se recibe un parámetro en la URL indicando la revocación
if (isset($_GET['revoke']) && isset($_SESSION['access_token'])) {
    $client->revokeToken($_SESSION['access_token']);
    unset($_SESSION['access_token']);
    header('Location: ' . $redirectURI);
    exit;
}

// Obtener un nuevo token de acceso o utilizar el existente
if (isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);
} elseif (isset($_GET['code'])) {
    // Obtener un nuevo token de acceso
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (isset($token['access_token'])) {
        // Almacenar el token en la sesión
        $_SESSION['access_token'] = $token['access_token'];
        $client->setAccessToken($token);
    } else {
        echo "Error al obtener el token de acceso.";
        var_dump($token);
        exit;
    }
} else {
    // Redirigir a la autorización completa si no hay token de acceso ni código presente
    header('Location: ' . $client->createAuthUrl());
    exit;
}

// Obtener información del perfil
$google_oauth = new Oauth2($client);
$google_account_info = $google_oauth->userinfo->get();
$email = $google_account_info->email;
$name = $google_account_info->name;
$profileImage = $google_account_info->picture;

// Imprimir información
echo $email . '<br>';
echo $name;

// Verificar si la imagen del perfil está presente y mostrarla
if (!empty($profileImage)) {
    echo '<img src="' . $profileImage . '" alt="" srcset="">';
} else {
    echo 'Imagen de perfil no disponible.';
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
    <title>Document</title>
</head>

<body>
    <header class="header-landing">
        <div class="flex-row logomain">

            <p><a class="title sombra cursor-pointer" href="main">Rescatamigos</a></p>
            <a href="main">
                <img class="logo cursor-pointer" src="img/logo1_v2-removebg-preview.png" alt="" srcset="">
            </a>
            <a href="logout.php">Salir</a>
        </div>

        <div class="flex-row noty">
            <i class="fa-solid fa-comments"></i>
            <i class="fa-solid fa-bell"></i>
        </div>

    </header>

    <main class="contenedor">





    </main>


    <footer class="footer">


    </footer>

    <script src="Negocio/js/count1.js"></script>

    </div>


</body>

</html>