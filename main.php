<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

$client = new Google_Client();
$client->setClientId($ClientID);
$client->setClientSecret($ClientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope("email");
$client->addScope("profile");

session_start();

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (isset($token['access_token'])) {
        $client->setAccessToken($token);

        // Verifica el estado de la sesión
        if (isset($_SESSION['state']) && $_SESSION['state'] == $_GET['state']) {
            // Obtener información del perfil
            $google_oauth = new Google\Service\Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email = $google_account_info->email;
            $name = $google_account_info->name;
            $profileImage = $google_account_info->picture;

            // Imprimir información
            echo $email . '<br>';
            echo $name;
            echo '<img src="' . $profileImage . '" alt="" srcset="">';
        } else {
            echo "Error en la verificación del estado de la sesión.";
        }
    } else {
        echo "Error al obtener el token de acceso.";
        var_dump($token);
    }
} else {
    // echo "Código de autorización no presente en la URL.";
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

            <p class="title sombra">Rescatamigos</p>
            <img class="logo" src="img/logo1_v2-removebg-preview.png" alt="" srcset="">

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





    <!-- ESTE BOTON SE RENDERIZA EN LA SECCION DONACIONES -->
    <!-- <div id="donate-button-container">
        <div id="donate-button"></div>
        <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
        <script>
            PayPal.Donation.Button({
                env: 'production',
                hosted_button_id: '83V9N2D7YRQRC',
                image: {
                    src: 'https://pics.paypal.com/00/s/ZWY5ZTI4OTYtMWQ2Yy00NmQ5LWI5MTMtZDc0YjFjM2RiMzYy/file.PNG',
                    alt: 'Donate with PayPal button',
                    title: 'PayPal - The safer, easier way to pay online!',
                }
            }).render('#donate-button');
        </script>
    </div> -->

    <!-- <div id="donate-button-container">
        <div id="donate-button"></div> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        PayPal.Donation.Button({
            env: 'sandbox',
            hosted_button_id: 'PQSBRD4C3EGHA',
            image: {
                src: 'https://pics-v2.sandbox.paypal.com/00/s/NmM3MzU3MzgtNTFkZi00NWUxLWFiOTUtYmM5ZjUyNDgwYTk5/file.PNG',
                alt: 'Donate with PayPal button',
                title: 'PayPal - The safer, easier way to pay online!',
            },
            onComplete: function() {


                // Redirige al usuario a la página de agradecimiento después de completar la donación
                window.location.href = 'https://noxious-slit.000webhostapp.com/charity-complete.php';
            },
            onCancelled: function() {
                // Redirige al usuario a la página de cancelación si cancela la donación
                window.location.href = 'https://noxious-slit.000webhostapp.com/cancel.php';
            }
        }).render('#donate-button');
    </script>





    </div>


</body>

</html>