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
        $ejecutarConsulta = $conexion->query("UPDATE `solicitud` SET estado_solicitud_id = 1 WHERE solicitante_gmail_id= $solicitante_gmail");
    }
    else{
        $ejecutarConsulta = $conexion->query("UPDATE `solicitud` SET estado_solicitud_id = 1 WHERE solicitante_user_id= $solicitante_user");
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

<?php


                $ejecutarConsulta22 = $conexion->query("SELECT * FROM `notificaciones` 
                                        INNER JOIN solicitud ON solicitud.id_solicitud = notificaciones.solicitud_id
                                        INNER JOIN estado_solicitud ON estado_solicitud.id_estado_solicitud = solicitud.estado_solicitud_id WHERE id_notificacion = $identificador");
                $publicacion33 = $ejecutarConsulta22->fetch_array(MYSQLI_ASSOC);
                $display_aceptar = 'flex';
                $display_espera = 'flex';
                $display_rechazar = 'flex';

                $estado_solicitud = $publicacion33['estado_solicitud'];

                if ($estado_solicitud == 'Solicitud aceptada.') {
                    $display_aceptar = 'none';
                    $display_espera = 'flex';
                    $display_rechazar = 'flex';
                } elseif ($estado_solicitud == 'Solicitud Rechazada.') {
                    $display_aceptar = 'flex';
                    $display_espera = 'flex';
                    $display_rechazar = 'none';
                } elseif ($estado_solicitud == 'Solicitud en espera de confirmación.') {
                    $display_aceptar = 'flex';
                    $display_espera = 'none';
                    $display_rechazar = 'flex';
                }

                ?>



                        <form method="POST">
                            <div class="form-group">

                                <h3 class="margen-b">Carta de solicitud</h3>
                                <hr>
                                <?php echo '<div class="flex-row raza carta"><p>   ' . $carta . '  </p></div>' ?>
                                <hr style="margin-top: 1rem;">

                                <h2 style="background: aliceblue; padding: 1.5rem 0;"><?php echo 'Estado: ' . $estado_solicitud ?></h2>
                                <hr>
                                <h3 class="h3-ask">¿Qué desea hacer con esta solicitud?</h3>

                                <div class="flex-row flex-centrar-item flex-wrap contenedor-botones">





                                    <button style="display: <?= $display_aceptar ?>;" type="button" class="btn_solicitud_aceptar cursor-pointer" id="btn_solicitud_aceptar" data-sender="<?= htmlspecialchars($sender); ?>" data-razones="<?= htmlspecialchars($razones); ?>" data-identificador="<?= htmlspecialchars($identificador_notificacion); ?>" data-veterinario="<?= htmlspecialchars($veterinario); ?>" data-vivienda="<?= htmlspecialchars($vivienda); ?>" data-solo-tiempo="<?= htmlspecialchars($solo_tiempo); ?>" data-otros-animales="<?= htmlspecialchars($otros_animales); ?>" data-id-sender-app="<?= htmlspecialchars($id_sender_app); ?>" data-id-sender-gmail="<?= htmlspecialchars($id_sender_gmail); ?>" data-receiver-avatar="<?= htmlspecialchars($receiver_avatar); ?>" data-carta="<?= htmlspecialchars($carta); ?>">
                                        Aceptar
                                    </button>


                                    <button style="display: <?= $display_espera ?>;" type="button" class="btn_solicitud_espera cursor-pointer" id="btn_solicitud_espera" data-sender="<?= htmlspecialchars($sender); ?>" data-razones="<?= htmlspecialchars($razones); ?>" data-identificador="<?= htmlspecialchars($identificador_notificacion); ?>" data-veterinario="<?= htmlspecialchars($veterinario); ?>" data-vivienda="<?= htmlspecialchars($vivienda); ?>" data-solo-tiempo="<?= htmlspecialchars($solo_tiempo); ?>" data-otros-animales="<?= htmlspecialchars($otros_animales); ?>" data-id-sender-app="<?= htmlspecialchars($id_sender_app); ?>" data-id-sender-gmail="<?= htmlspecialchars($id_sender_gmail); ?>" data-receiver-avatar="<?= htmlspecialchars($receiver_avatar); ?>" data-carta="<?= htmlspecialchars($carta); ?>">
                                        En espera
                                    </button>
                                    <button style="display: <?= $display_rechazar ?>;" type="button" class="btn_solicitud_rechazar cursor-pointer" id="btn_solicitud_rechazar" data-sender="<?= htmlspecialchars($sender); ?>" data-razones="<?= htmlspecialchars($razones); ?>" data-identificador="<?= htmlspecialchars($identificador_notificacion); ?>" data-veterinario="<?= htmlspecialchars($veterinario); ?>" data-vivienda="<?= htmlspecialchars($vivienda); ?>" data-solo-tiempo="<?= htmlspecialchars($solo_tiempo); ?>" data-otros-animales="<?= htmlspecialchars($otros_animales); ?>" data-id-sender-app="<?= htmlspecialchars($id_sender_app); ?>" data-id-sender-gmail="<?= htmlspecialchars($id_sender_gmail); ?>" data-receiver-avatar="<?= htmlspecialchars($receiver_avatar); ?>" data-carta="<?= htmlspecialchars($carta); ?>">
                                        Rechazar
                                    </button>

                                </div>
                                <br><br>

                                <small style="color: red;"> <span style="font-weight: 600;">Importante.</span> <br> Aceptar: Si acepta, su mascota se quitara del apartado "En adopcion". <br> Rechazar: Si rechaza, le notificaremos al solicitante para que no tenga que esperar. <br>Si desea esperar a mas solicitudes, no haga nada.</small>
                        </form>