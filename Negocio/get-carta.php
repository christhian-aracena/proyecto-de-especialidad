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
    raz.razon AS razon,
    vet.disposicion AS veterinario_disposicion,
    viv.vivienda AS vivienda,
    sol.tiempo AS solo_tiempo,
    s.carta,
    s.otros_animales,
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
    u_receiver.avatar AS receiver_avatar
    FROM notificaciones n
    INNER JOIN solicitud s ON n.solicitud_id = s.id_solicitud
    LEFT JOIN users u_sender ON s.solicitante_user_id = u_sender.id
    LEFT JOIN users u_receiver ON s.destinatario_user_id = u_receiver.id
    LEFT JOIN razones raz ON s.razones_id = raz.idRazones
    LEFT JOIN veterinario vet ON s.veterinario_id = vet.id
    LEFT JOIN vivienda viv ON s.vivienda_id = viv.id_vivienda
    LEFT JOIN solo sol ON s.solo_id = sol.id_solo 
    WHERE n.id_notificacion = $identificador_notificacion");
    
    
    $publicacion = $result->fetch_array(MYSQLI_ASSOC);
    $sender = $publicacion['sender_id'];
    $razones = $publicacion['razon'];
    $veterinario = $publicacion['veterinario_disposicion'];
    $vivienda = $publicacion['vivienda'];
    $carta = $publicacion['carta'];
    echo $razones;
    echo '<br>';
    echo $vivienda;
    echo '<br>';
    echo $veterinario;
    echo '<br>';
    echo "ESTA ES LA CARTA".$carta;
    
    echo '<br>';
    echo 'SOLICITUD_ID '.$identificador_notificacion;
?>