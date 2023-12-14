<?php
include('Datos/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $sender = $_POST["sender"];
    $razones = $_POST["razones"];
    $veterinario = $_POST["veterinario"];
    $identificador = $_POST["identificador"];
    $solicitante_user = $_POST["id-sender-app"];
    $solicitante_gmail = $_POST["id-sender-gmail"];
    $carta = $_POST["data-carta"];
    
    
    // echo '<br>';
    // echo $solicitante_user;

    // echo '<br>';
    // echo $solicitante_gmail;
    // echo '<br>';

    if($solicitante_user==1){
        $ejecutarConsulta = $conexion->query("UPDATE `solicitud` SET estado_solicitud_id = 3 WHERE solicitante_gmail_id= $solicitante_gmail");
    }
    else{
        $ejecutarConsulta = $conexion->query("UPDATE `solicitud` SET estado_solicitud_id = 3 WHERE solicitante_user_id= $solicitante_user");
    }





    // Obtener el id generado
    // $generar_id = $conexion->insert_id;




    $ejecutarConsulta2 = $conexion->query("SELECT * FROM `notificaciones` 
    INNER JOIN solicitud ON solicitud.id_solicitud = notificaciones.solicitud_id
    INNER JOIN estado_solicitud ON estado_solicitud.id_estado_solicitud = solicitud.estado_solicitud_id WHERE id_notificacion = $identificador");


    $publicacion3 = $ejecutarConsulta2->fetch_array(MYSQLI_ASSOC);

    $estado_solicitud = $publicacion3['estado_solicitud'];



    // echo "Datos recibidos correctamente";

} else {
    echo "Error: Método de solicitud incorrecto";
}
?>

<form method="POST">
                            <div class="form-group">

                                <h3 class="margen-b">Carta de solicitud</h3>

                                <?php echo '<div class="flex-row raza carta"><p>   ' . $carta . '  </p></div>' ?>
                                                                <h2><?php echo $estado_solicitud ?></h2>
                                <h3 class="h3-ask">¿Qué desea hacer con esta solicitud?</h3>

                                <div class="flex-row flex-centrar-item flex-wrap contenedor-botones">





                                <button type="button" class="btn_solicitud_aceptar cursor-pointer" id="btn_solicitud_aceptar"
    data-sender="<?php echo htmlspecialchars($sender); ?>"
    data-razones="<?php echo htmlspecialchars($razones); ?>"
    data-identificador="<?php echo htmlspecialchars($identificador_notificacion); ?>"
    data-veterinario="<?php echo htmlspecialchars($veterinario); ?>"
    data-vivienda="<?php echo htmlspecialchars($vivienda); ?>"
    data-solo-tiempo="<?php echo htmlspecialchars($solo_tiempo); ?>"
    data-otros-animales="<?php echo htmlspecialchars($otros_animales); ?>"
    data-id-sender-app="<?php echo htmlspecialchars($id_sender_app); ?>"
    data-id-sender-gmail="<?php echo htmlspecialchars($id_sender_gmail); ?>"
    data-receiver-avatar="<?php echo htmlspecialchars($receiver_avatar); ?>"
    data-carta="<?php echo htmlspecialchars($carta); ?>"

>
    Aceptar
</button>

<button type="button" class="btn_solicitud_espera cursor-pointer" id="btn_solicitud_espera"
    data-sender="<?php echo htmlspecialchars($sender); ?>"
    data-razones="<?php echo htmlspecialchars($razones); ?>"
    data-identificador="<?php echo htmlspecialchars($identificador_notificacion); ?>"
    data-veterinario="<?php echo htmlspecialchars($veterinario); ?>"
    data-vivienda="<?php echo htmlspecialchars($vivienda); ?>"
    data-solo-tiempo="<?php echo htmlspecialchars($solo_tiempo); ?>"
    data-otros-animales="<?php echo htmlspecialchars($otros_animales); ?>"
    data-id-sender-app="<?php echo htmlspecialchars($id_sender_app); ?>"
    data-id-sender-gmail="<?php echo htmlspecialchars($id_sender_gmail); ?>"
    data-receiver-avatar="<?php echo htmlspecialchars($receiver_avatar); ?>"
    data-carta="<?php echo htmlspecialchars($carta); ?>"

>
    En espera


                                </div>
                                <br><br>
                                
                                <small style="color: red;"> <span style="font-weight: 600;">Importante.</span>  <br> Aceptar: Si acepta, su mascota se quitara del apartado "En adopcion". <br> Rechazar: Si rechaza, le notificaremos al solicitante para que no tenga que esperar. <br>Si desea esperar a mas solicitudes, no haga nada.</small>
                        </form>