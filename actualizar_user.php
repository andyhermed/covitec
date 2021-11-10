<?php
//actualizar registro
require_once "conexion.php";
require_once "usuarios.php";

if (isset($_POST['save'])) {

    $sql = "update usuarios set nombre='".$_POST['nombre']."', apellido_paterno='".$_POST['apellido_paterno']."', apellido_materno='".$_POST['apellido_materno']."', contrasena='".$_POST['contrasena']."' where id=".$_POST['usuario'];
    if ($conn->query($sql)) {
        header("location: usuarios.php");
    }else {
        header("location: usuarios.php");
        echo "<script>alert('Error al actualizar el registro')</script>";
    }
}else {
    header("location: usuarios.php");
}
?>