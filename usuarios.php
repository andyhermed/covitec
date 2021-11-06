<?php
//realizar conexion
require_once ("conexion.php");
require_once "diseño.html";
$mensaje = "";
//revisar datos a insertar 
if (isset($_POST["u_id"]) and isset($_POST["u_contrasena"]) and isset($_POST["u_nombre"]) and isset($_POST["u_apellido_paterno"]) and isset($_POST["u_apellido_materno"])){
    
    //procedemos a insertar
    $sql = "insert into usuarios values('".$_POST["u_id"]."','".$_POST["u_contrasena"]."','".$_POST["u_nombre"]."','".$_POST["u_apellido_paterno"]."','".$_POST["u_apellido_materno"]."')";
    
    if ($conn->query($sql)) {
        $mensaje = "";
    }else {
        $mensaje = "<p class='msg err-msg'>Error al insertar datos</p>";
    }
}

//realizar consulta de registros y guardarlos en variable
$sql = "select * from usuarios where estatus = 1";
$resultado = $conn->query($sql);
//indicar donde poner los registros

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de Control de Acceso </title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="etiqueta">
        <img src="img/usuario.png" alt="Usuario Nuevo">
        <h2>Usuarios Registrados</h2>
        </div>
    <div id="new-user">
                <a href="nuevo_user.php" class = "nuevo">Añadir nuevo usuario</a>
            </div>
        <div class="container">
        <div id="new-user">
                <a href="nuevo_user.php" class = "nuevo">Añadir nuevo usuario</a>
            </div>
            <div class="user-list">
            <table>
                        <tbody>
                            <tr>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th></th>
                            </tr>
                            <?php //ESTO ES PHP
                                if ($resultado->num_rows>0) {
                                    while ($registro = $resultado->fetch_array()) {
                                         echo "<tr>";
                                         echo "<td>".$registro['id']."</td>";
                                         echo "<td>".$registro['contrasena']."</td>";
                                         echo "<td>".$registro['nombre']."</td>";
                                         echo "<td>".$registro['apellido_paterno']."</td>";
                                         echo "<td>".$registro['apellido_materno']."</td>";
                                         echo "<td>";
                                         echo "<a href='editar_user.php?id=".$registro['id']."' class='edit'>Editar</a>&nbsp;";
                                         echo "<a href='baja_user.php?id=".$registro['id']."' class='delete delete-action'>Dar de baja</a>";
                                         echo "</td>";
                                         echo "</tr>";
                                    }
                                }
                            ?> 
                        </tbody>
                        
                    </table>
            </div>
        </div>
        <script>
        var delteAction = document.querySelectorAll('.delete-action');
        delteAction.forEach((el) => {
            el.onclick = function(e) {
                e.preventDefault();
                if (confirm('¿Estás seguro que quieres dar de baja a este usaurio? Esta acción no se puede deshacer')) {
                    window.location.href = e.target.href;
                }
            }
        });
    </script>
    </body>
</html>