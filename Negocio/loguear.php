<?php
require '../Datos/conexion.php';
    session_start();

    $correo = $_POST['correo'];
    $pass = $_POST['pass'];

    $query = "SELECT COUNT(*) AS count FROM users WHERE email = '$correo' AND pass = '$pass'";
    $consulta = mysqli_query($conexion, $query);
    $array = mysqli_fetch_array($consulta);

    if($array['contar']>0){
        $_SESSION['email'] = $correo;
        header("location: ../main");
    }
    else{
        header("Location: ../login");
        echo "<div class='alert alert-danger alerta-registrado' role='alert'>
                Correo o contraseña incorrectas, vuelve a intentar.
              </div>" ;
    }
 
        

    
 ?>