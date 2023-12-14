<?php



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
s.razones_id,
s.veterinario_id,
s.vivienda_id,
s.solo_id,
s.carta,
s.otros_animales,
s.adopcion_id,
raz.razon AS razon,
vet.disposicion AS veterinario_disposicion,
viv.vivienda AS vivienda,
sol.tiempo AS solo_tiempo,
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
u_receiver.avatar AS receiver_avatar,
a.nombre AS mascota_nombre,
a.raza AS mascota_raza,
a.imagen_mascota AS mascota_imagen
FROM notificaciones n
INNER JOIN solicitud s ON n.solicitud_id = s.id_solicitud
LEFT JOIN users u_sender ON s.solicitante_user_id = u_sender.id
LEFT JOIN users u_receiver ON s.destinatario_user_id = u_receiver.id
LEFT JOIN razones raz ON s.razones_id = raz.idRazones
LEFT JOIN veterinario vet ON s.veterinario_id = vet.id
LEFT JOIN vivienda viv ON s.vivienda_id = viv.id_vivienda
LEFT JOIN solo sol ON s.solo_id = sol.id_solo
LEFT JOIN adopcion a ON s.adopcion_id = a.id
WHERE n.id_notificacion = $identificador_notificacion");


include('Datos/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    echo $sender = $_POST["sender"];
    echo $razones = $_POST["razones"];
    echo $veterinario = $_POST["veterinario"];
    echo $identificador = $_POST["identificador"];
    echo $solicitante_user = $_POST["id-sender-app"];
    $solicitante_gmail = $_POST["id-sender-gmail"];
    $carta = $_POST["data-carta"];
    



    if($solicitante_user==1){
        $ejecutarConsulta = $conexion->query("UPDATE `solicitud` SET estado_solicitud_id = 2 WHERE solicitante_gmail_id= $solicitante_gmail");
        $ejecutarConsultanombre = $conexion->query("SELECT username FROM social_media WHERE idSocialMedia = $solicitante_gmail");
    }
    else{
        $ejecutarConsulta = $conexion->query("UPDATE `solicitud` SET estado_solicitud_id = 2 WHERE solicitante_user_id= $solicitante_user");
        $ejecutarConsultanombre = $conexion->query("SELECT user FROM users WHERE id= $solicitante_user");
    }


    $fila_nombre = mysqli_fetch_assoc($ejecutarConsultanombre);

    $nombre_solicitante = $fila_nombre['user'];

    echo '<h3>Solicitud aceptada, con exito, ya puedes contactarte con'.$nombre_solicitante.'</h3>';

    // echo "Datos recibidos correctamente";

} else {
    echo "Error: Método de solicitud incorrecto";
}
?>