<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}   
foreach ($_COOKIE as $key => $value) {
    setcookie($key, '', time() - 3600, '/');
}
// Obtenerr el token de acceso de la sesión
$googleAccessToken = isset($_SESSION['access_token']) ? $_SESSION['access_token'] : null;

// Si hay un token de acceso, revocarlo
if ($googleAccessToken) {
    // Configurar los datos para la solicitud de revocación
    $revocationUrl = 'https://accounts.google.com/o/oauth2/revoke';
    $params = [
        'token' => $googleAccessToken,
    ];

    // Usa cURL para realizar la solicitud de revocación
    $ch = curl_init($revocationUrl . '?' . http_build_query($params));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    // Borra la variable de sesión de acceso a Google
    unset($_SESSION['access_token']);
}

// Cerrar todas las variables de sesión de PHP
$_SESSION = array();
session_destroy();

// Borrar la cookie de sesión, si existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}




?>
