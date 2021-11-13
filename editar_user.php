<?php
//consultar el registro seleccionado para colocarlo en el formulario 
require_once "conexion.php";
require_once "diseño.php";
if (isset($_GET['id'])) {
    $sql = "select * from usuarios where id=".$_GET['id'];
    $resultado = $conn->query($sql);
}else {
    header("location: usuarios.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="useretiqueta">
        <div class="us">
    <img src="img/editar.png" alt="Editar Usuario">
</div>
        <h2>Editar Usuario</h2>
        </div>
<div class="container">
        <?php if ($resultado->num_rows>0) { 
            $row = $resultado->fetch_array();
        ?>
        <div class="form">
        <form method="post" action="actualizar_user.php">
            <div class="fields">
            <span>
            <ul>
            <li><label>Nombre(s)</label> <input placeholder="Introduce el nombre(s)" value="<?php echo $row['nombre']?>" type="text" name= "nombre" /></li>
            </span>
            <span>
            <li><label>Apellido Paterno</label> <input placeholder="Introduce el apellido paterno" value="<?php echo $row['apellido_paterno']?>"  type="text" name= "apellido_paterno" /></li>
            </span>
            <span>
            <li><label>Apellido Materno</label> <input placeholder="Introduce el apellido materno" value="<?php echo $row['apellido_materno']?>" type="text" name= "apellido_materno" /></li>
            </span>
            <span>
            <input placeholder="Introduce el usuario" hidden value="<?php echo $row['id']?>" type="text" name = "usuario" />
            </span>
            <span>
            <li><label>Contraseña</label><input placeholder="Introduce la contraseña" value="<?php echo $row['contrasena']?>" type="password" name= "contrasena" /></li>
            </span>
            </ul>
            </div>
            <div id="save">
            <input name="save" value="Guardar" type="submit" />
            </div>
        <?php }else {
            echo "<script>alert('Este usuario no existe')</script>";
        } ?>
    </div>

</body>
</html>

