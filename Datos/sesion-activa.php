<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
// echo $_SESSION['email'];
// echo $_SESSION['socialemail'];
// echo $socialmedia ;

if (!isset($_SESSION['email']) ) {
    header("Location: index");  // Corregí la URL de redirección
    exit();
}

?>