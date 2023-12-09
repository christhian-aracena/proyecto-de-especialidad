<?php
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
    include("Datos/sesion-activa.php");
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
        // $_SESSION['socialemail'] = $email;
        $nombre = explode(" ", $name);
        $_SESSION['nombre_gmail']= $name;
        $nombreCorto = implode(" ", array_slice($nombre, 0, 1));


        include("Datos/conexion.php");

        $query = "SELECT COUNT(*) AS count FROM social_media WHERE email = '$email'";
        $consulta = mysqli_query($conexion, $query);
        $array = mysqli_fetch_array($consulta);



        $query2 = "SELECT COUNT(*) AS count2 FROM users WHERE email = '$email'";
        $consulta2 = mysqli_query($conexion, $query2);
        $array2 = mysqli_fetch_array($consulta2);


        if (!$array2['count2']) {

            if (!$array['count']) {

                $query = "INSERT INTO social_media (email, username, picture) VALUES ('$email', '$name', '$profileImage');";
                mysqli_query($conexion, $query);

                $_SESSION['socialemail'] = $email;


                $resultados = mysqli_query($conexion, "SELECT idSocialMedia FROM social_media WHERE email = '$email'");
                if ($consulta = mysqli_fetch_array($resultados)) {
                    $_SESSION['id_gmail'] = $consulta['idSocialMedia'];
                }

                $_SESSION['name'] = $name;

            } else {

                $resultados = mysqli_query($conexion, "SELECT idSocialMedia FROM social_media WHERE email = '$email'");
                if ($consulta = mysqli_fetch_array($resultados)) {
                    $_SESSION['id_gmail'] = $consulta['idSocialMedia'];
                }
                $_SESSION['socialemail'] = $email;
                $_SESSION['name'] = $name;
            }
        } else {
            $_SESSION['registration_error'] = 'Su correo ya se encuentra en nuestra base de datos, si olvido sus credenciales haga click <a href="#"> Aqui</a>.';
            header('Location: login');
            exit;
        }





        // Puedes incluir el resto de tu contenido aquí...
    } else {
        // Si no hay un token de acceso, redirigir a la autorización completa de Google
        header('Location: ' . $client->createAuthUrl());
        exit;
    }
}
