<?php
session_start();
ob_start();
$correo = $_SESSION['username'];

if (!isset($correo)) {
    header("location: login");
}
?>