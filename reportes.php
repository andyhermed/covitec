<?php
//realizar conexion
require_once ("conexion.php");
$mensaje = "";
//revisar datos a insertar 
if (isset($_POST["u_no_control"]) and isset($_POST["u_contrasena"]) and isset($_POST["u_nombre"]) and isset($_POST["u_apellido_paterno"]) and isset($_POST["u_apellido_materno"]) and isset($_POST["u_carrera"])){
    
    //procedemos a insertar
    $sql = "insert into info_alumnos (no_control, contrasena, nombre, apellido_paterno, apellido_materno, carrera) values('".$_POST["u_no_control"]."','".$_POST["u_contrasena"]."','".$_POST["u_nombre"]."','".$_POST["u_apellido_paterno"]."','".$_POST["u_apellido_materno"]."','".$_POST["u_carrera"]."')";
    
    if ($conn->query($sql)) {
        $mensaje = "";
    }else {
        $mensaje = "<p class='msg err-msg'>Error al insertar datos</p>";
    }
}

//realizar consulta de registros y guardarlos en variable
$sql = "select * from info_alumnos";
$resultado = $conn->query($sql);
//indicar donde poner los registros

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de Control de Acceso</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="container">
            <header class="header">
                <div id="titulo">
                    <img src="img/LogotipoCoviteceEncabezado.png" alt="Logotipo de Covitec">
                    <h1>Sistema de control de Acceso</h1>
                </div>
            <div id="navegacion">
                <div id=reporte>
                <img src="img/reporte1.png" alt="">
                <a href="../covitec/reportes.php">Reportes Generales</a>
                </div>
                <div id=reporte>
                <img src="img/reporte2.png" alt="">
                <a href="#">Lorem, ipsum dolor.</a>
                </div>
                <div id=reporte>
                <img src="img/reporte3.png" alt="">
                <a href="#">Lorem, ipsum dolor.</a>
                </div>
                <div id=reporte>
                <img src="img/reporte4.png" alt="">
                <a href="#">Lorem, ipsum dolor.</a>
                </div>
                <div id=reporte>
                <img src="img/usuario.png" alt="">
                <a href="../covitec/usuarios.php">Usuarios Registrados</a>
                </div>
                <div id=reporte>
                <img src="img/cerrar_sesion.png" alt="">
                <a href="../covitec/index.php">Cerrar Sesión.</a>
                </div>
            </div>
            <div class="user-list">
            <table>
                <caption>Reportes Generales</caption>
                        <tbody>
                            <tr>
                                <th>No de control</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Carrera</th>
                            </tr>
                            <?php //ESTO ES PHP
                                if ($resultado->num_rows>0) {
                                    while ($registro = $resultado->fetch_array()) {
                                         echo "<tr>";
                                         echo "<td>".$registro['no_control']."</td>";
                                         echo "<td>".$registro['nombre']."</td>";
                                         echo "<td>".$registro['apellido_paterno']."</td>";
                                         echo "<td>".$registro['apellido_materno']."</td>";
                                         echo "<td>".$registro['carrera']."</td>";
                                         echo "</tr>";
                                    }
                                }
                            ?> 
                        </tbody>
                        
                    </table>
            </div>
        </div>
    </body>
</html>