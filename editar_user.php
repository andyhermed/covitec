<?php
//consultar el registro seleccionado para colocarlo en el formulario 
require_once "conexion.php";
require_once "diseño.html";
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
    <link rel="stylesheet" href="css/styles_log.css">
</head>
<body>
<div class="container">
    
        <?php if ($resultado->num_rows>0) { 
            $row = $resultado->fetch_array();
        ?>
        <div class="form">
        <form method="post" action="actualizar_user.php">
            <div class="fields">
            <span>
            <h2>Nombre(s)</h2>
            <input placeholder="Introduce el nombre(s)" value="<?php echo $row['nombre']?>" type="text" name= "nombre" />
            </span>
            <span>
            <h2>Apellido Paterno</h2>
            <input placeholder="Introduce el apellido paterno" value="<?php echo $row['apellido_paterno']?>"  type="text" name= "apellido_paterno" />
            </span>
            <span>
            <h2>Apellido Materno</h2>
            <input placeholder="Introduce el apellido materno" value="<?php echo $row['apellido_materno']?>" type="text" name= "apellido_materno" />
            </span>
            <span>
            <input placeholder="Introduce el usuario" hidden value="<?php echo $row['id']?>" type="text" name = "usuario" />
            </span>
            <br />
            <span>
            <h2>Contraseña</h2>
            <input placeholder="Introduce la contraseña" value="<?php echo $row['contrasena']?>" type="password" name= "contrasena" />
            </span>
            <br />
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

