<?php
// Recibe la notificación del Webhook de PayPal
$requestBody = file_get_contents("php://input");

// Decodificar la notificación JSON
$notification = json_decode($requestBody);

// Validar que la notificación provenga de PayPal (implementar seguridad adicional en producción)

if ($notification->event_type === "PAYMENT.CAPTURE.COMPLETED") {
    // Procesar una donación completada
    $amount = $notification->resource->amount->value;
    $transactionId = $notification->resource->id;
    $donorName = $notification->resource->payer->name->given_name;

    
    // Guardar los datos en la base de datos (debes configurar tu conexión a la base de datos)
    $dbHost = "tu_host";
    $dbUser = "tu_usuario";
    $dbPassword = "tu_contrasena";
    $dbName = "tu_base_de_datos";

    $connection = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    
    if ($connection->connect_error) {
        die("Conexión a la base de datos fallida: " . $connection->connect_error);
    }
    
    $query = "INSERT INTO donaciones (monto, id_transaccion) VALUES ('$amount', '$transactionId')";
    
    if ($connection->query($query) === true) {
        // Procesamiento exitoso
        http_response_code(200); // Responde con un código 200 para indicar éxito
    } else {
        // Error en el procesamiento
        http_response_code(500); // Responde con un código 500 para indicar un error interno del servidor
    }
    
    $connection->close();
}
?>
