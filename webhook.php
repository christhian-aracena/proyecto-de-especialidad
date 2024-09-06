<?php
    require "PHPMailer/Exception.php";
    require "PHPMailer/SMTP.php";
    require "PHPMailer/PHPMailer.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    $oEmail = new PHPMailer();

    $oEmail->isSMTP();
    $oEmail->Host="smtp.gmail.com";
    $oEmail->Port="587";
    $oEmail->SMTPSecure="tls";
    $oEmail->SMTPAuth=true;

    $oEmail->Subject="Tu solicitud de adopcion ha sido aceptada, felicitaciones!";
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
    background-color: #FF5733;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
  }

  h1 {
    background-color: #FF5733; /* Fondo de color */
    color: #fff; /* Color del texto */
    font-size: 24px;
    margin-bottom: 20px;
  }

  p {
    font-size: 16px;
    line-height: 1.6;
    color: #666;
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
  <h1>Felicidades, ya has adotado/h1>
  <p>Hola [Nombre del Destinatario],</p>
  <p>Gracias por tu mensaje. Aquí está la respuesta que has recibido.</p>
  <p>Este es un correo de ejemplo con formato HTML y CSS incrustado.</p>
  <a href="https://tusitio.com" class="button">Ver más</a>
</div>
</body>
</html>
');

    
    
    


    if(!$oEmail->send()){
        echo $oEmail->ErrorInfo;
    }
?>
