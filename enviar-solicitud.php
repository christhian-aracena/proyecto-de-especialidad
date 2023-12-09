<?php










$identificador_mascota = isset($_POST['identificador_mascota']) ? $_POST['identificador_mascota'] : null;

$solo = $_POST['solo'];
$otros_animales = $_POST['otherpets'];
$vivienda = $_POST['vivienda'];
$veterinario = $_POST['veterinario'];
$carta = $_POST['descripcion'];
$razones = $_POST['razones'];

include('Datos/conexion.php');
session_start();
$id_solicitante = isset($_SESSION['id_app']) ? $_SESSION['id_app'] : 1;
$id_solicitante_gmail = isset($_SESSION['id_gmail']) ? $_SESSION['id_gmail'] : 1;
if(!$id_solicitante_gmail){
    $id_solicitante_gmail=1;
}


if($id_solicitante_gmail==1){
    // $nombre_soli = $conexion->query('SELECT * FROM users WHERE id = "'.$id_solicitante.'"');
    // $fila2 = mysqli_fetch_assoc($nombre_soli);

    // $nombre_solicitante = $fila2['user'];
    $nombre = $_SESSION['nombre_app'];
}
else{
    $nombre = $_SESSION['nombre_gmail'];
}


$nombre1 = explode(" ", $nombre);
$nombreCorto = implode(" ", array_slice($nombre1, 0, 1));


echo   $identificador_mascota;


$user_id = $conexion->query('SELECT * FROM adopcion WHERE id = "'.$identificador_mascota.'"');

$fila = mysqli_fetch_assoc($user_id);
$usuario_id = $fila['usuario_id'];
$gmail_id = $fila['gmail_id'];

echo '<br>';
echo 'SOLICITANTE ID APP'.$id_solicitante;
echo '<br>';
echo 'SOLICITANTE ID GMAIL'.$id_solicitante_gmail;
echo '<br>';
echo 'CUENTA DESDE GMAIL DESTINATARIO '. $gmail_id;
echo '<br>';
echo 'CUENTA DESDE APP DESTINATARIO' .$usuario_id;
echo '<br>';
echo $solo;
echo '<br>';
echo $vivienda;
echo '<br>';
echo $veterinario;
echo '<br>';
echo $razones;
echo '<br>';
echo $nombreCorto;
echo '<br>';
// echo $suma_final;

$ejecutarConsulta = $conexion->query("INSERT INTO `solicitud`(`solicitante_user_id`, `solicitante_gmail_id`, `destinatario_user_id`, `destinatario_gmail_id`, `razones_id`, `veterinario_id`, `vivienda_id`, `solo_id`, `carta`, `otros_animales`) VALUES ('$id_solicitante','$id_solicitante_gmail','$usuario_id','$gmail_id','$razones','$veterinario','$vivienda','$solo','$carta','$otros_animales')");

$ejecutarConsulta2 = $conexion->query("INSERT INTO `notificaciones`(`descripcion_notificacion`, `user_id`, `gmail_id`, `numer_notificaciones`) VALUES ('".$nombreCorto." Te ha enviado una solicitud de adopción','$usuario_id','$gmail_id', 1)");




$response = array('success' => true);


echo json_encode($response);
?>
