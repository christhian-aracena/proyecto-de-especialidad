<?php

use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
include("Datos/conexion.php");
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$validar= $conexion->query("INSERT INTO feedback (username, email, message_subject, message_index) VALUES ('$nombre', '$correo', '$asunto', '$mensaje')");

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
body {
    font-family: "Helvetica Neue", Arial, sans-serif;
    background: linear-gradient(to left, #c63671, #9d3a7b, #864089, #75428f, #684595);
    margin: 100px;
    padding: 50px;
  
  }
  
  .container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #3385ff; /* Fondo de color */
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 15px;
    margin-top: 50px;
    margin-bottom: 50px;
  }
  
  h1 {
    background-color: #3385ff; /* Fondo de color */
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
</style>
</head>
<body>
<div class="container">
<h1>Tu mensaje ha sido enviado con exito.</h1>
<p>Hola '.$nombre.',</p>
<p>Gracias por tu mensaje. Pronto nos pondremos en contacto contigo.</p>
<p>No respondas a este correo.</p>
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