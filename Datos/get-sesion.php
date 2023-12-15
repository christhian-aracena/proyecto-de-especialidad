<?php
    // Inicializar las variables con un valor predeterminado
    // $app_id = 1;
    // $gmail_id = 1;

    // // Verificar si $_SESSION está definido y tiene la clave 'email'
    // if (isset($_SESSION['email'])) {
    //     $app_id = $_SESSION['id_app'] ?? 1;
    //     $gmail_id = 1;
    // } else {
    //     // Verificar si $_SESSION está definido y tiene la clave 'id_gmail'
    //     $gmail_id = $_SESSION['id_gmail'] ?? 1;
    //     $app_id = 1;
    // }
?>


<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    if (isset($_SESSION['email'])) {
        $app_id = $_SESSION['id_app'];
        $gmail_id = 1;
    } else {
        $gmail_id = $_SESSION['id_gmail'];
        $app_id = 1;
    }
?>
