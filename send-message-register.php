<?php

use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
include("Datos/conexion.php");
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
// $avatar = $_POST['avatar'];

 // Omitir el campo de imagen si no se proporciona
 if (isset($_FILES['avatar']['tmp_name']) && !empty($_FILES['avatar']['tmp_name'])) {
  $imagen = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
} else {
  $imagen = null;
}
$validar= $conexion->query("INSERT INTO users (user, last_name, email, pass_user, avatar) VALUES ('$nombre', '$apellido', '$correo', '$contrasena', '$imagen')");

if($validar){

    require "PHPMailer/Exception.php";
    require "PHPMailer/SMTP.php";
    require "PHPMailer/PHPMailer.php";



    $oEmail = new PHPMailer();

    $oEmail->isSMTP();
    $oEmail->Host="smtp.gmail.com";
    $oEmail->Port="587";
    $oEmail->SMTPSecure="tls";
    $oEmail->SMTPAuth=true;
    $oEmail->Username="nevermind.tian@gmail.com";
    $oEmail->Password="ubiv cvbr ekei lvob";
    $oEmail->setFrom("nevermind.tian@gmail.com","Rescatamigos.cl");
    $oEmail->addAddress($correo);
    $oEmail->Subject="Mensaje Enviado, Rescatamigos.cl";
    $oEmail->CharSet = "UTF-8"; // Configurar la codificación de caracteres de PHPMailer
$oEmail->Encoding = "base64"; // Opción de codificación

$oEmail->msgHTML('
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  *{
    background: linear-gradient(to left, #c63671, #9d3a7b, #864089, #75428f, #684595);
  }
body {
    font-family: "Helvetica Neue", Arial, sans-serif;
    background: linear-gradient(to left, #c63671, #9d3a7b, #864089, #75428f, #684595);
    margin: 10px;
    padding: 50px;
  
  }
  
  .container {
    max-width: 900px;
    height: 300px;
    margin: 0 auto;
    background: linear-gradient(to left, #c63671, #9d3a7b, #864089, #75428f, #684595); /* Fondo de color */
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 15px;
    margin-top: 50px;
    margin-bottom: 50px;
  }
  
  h1 {
    background: transparent; /* Fondo de color */
    color: #fff; /* Color del texto */
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  p {
    font-size: 16px;
    line-height: 1.6;
    color: #ffffff;
  }
  
  .button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007BFF;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
  }
  small{
    color: #e0e0e0;
    text-align: center;
  }
  a{
    font-style: none;
    color: #e0e0e0;
    text-decoration: none;
    background: green;
    padding: 15px;
    margin: 20px;
  }
</style>
</head>
<body>
<div class="container">
<h1>Tu cuenta ha sido creada satisfactoriamente.</h1>

<p>Gracias por confiar en nosotros. Recuerda que también puedes iniciar sesión con tu cuenta de gmail.</p>
<a href="http://www.rescatamigos.cl/login">Iniciar Sesión</a>
<small>Atentamente, Equipo de Desarrollo de Rescatamigos</small>
</div>
</body>
</html>
');

    
    
    

if (!$oEmail->send()) {
  // Puedes manejar el error de envío del correo aquí si es necesario
  echo json_encode(['success' => false, 'message' => 'Error al enviar el correo']);
} else {
  echo json_encode(['success' => true, 'message' => 'Correo enviado con éxito']);
}
} else {
echo json_encode(['success' => false, 'message' => 'Error al insertar en la base de datos']);
}

    


?>