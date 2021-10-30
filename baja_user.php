<?php
//eliminar registro
require_once "conexion.php";
if (isset($_GET['id'])) {
    $sql = "update usuarios set estatus = 0 where id=".$_GET['id'];
    if ($conn->query($sql)) {
        header("location: usuarios.php");
    }else {
        echo'<script>
            alert("Error al dar de baja registro. Intente de nuevo");
            location.href="usuarios.php";
            </script>';
    }  
}else {
    header("location: usuarios.php");
}
?>