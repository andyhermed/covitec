<?php
require_once 'credenciales.php';

$conn = new mysqli($db_servidor, $db_usuario, $db_password, $db_basededatos);

if($conn->connect_error){
    die("Error: No es posible conectarse a la base de datos" . $conn->conect_error);
}else{
    //echo("Conexión exitosa");
}

?>