<?php
//realizar conexion
require_once ("conexion.php");
$mensaje = "";
//revisar datos a insertar 
if (isset($_POST["u_no_control"]) and isset($_POST["u_resp1"]) and isset($_POST["u_resp2"]) and isset($_POST["u_resp3"]) and isset($_POST["u_hr_cuestionario"]) and isset($_POST["u_hr_ingreso"]) and isset($_POST["u_fecha"])){
    //procedemos a insertar
    $sql = "insert into alumnos_copia (no_control, resp1, resp2, resp3, hr_cuestionario, hr_ingreso, fecha) values('".$_POST["u_no_control"]."','".$_POST["u_resp1"]."','".$_POST["u_resp2"]."','".$_POST["u_resp3"]."','".$_POST["u_hr_cuestionario"]."','".$_POST["u_hr_ingreso"]."','".$_POST["u_hr_fecha"]."')";
        
    if ($conn->query($sql)) {
            $mensaje = "";
    }else {
        $mensaje = "<p class='msg err-msg'>Error al insertar datos</p>";
    }
    
}

//realizar consulta de registros y guardarlos en variable
$fecha = Date("Y-m-d");
$fecha_sig = date("Y-m-d", strtotime("+1 day", strtotime($fecha)));
$sql = "(select * from alumnos_copia where fecha >= '".$fecha."' and fecha < '".$fecha_sig."')";
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
                <a href="../covitec/reporte_alumnos.php">Reporte diario alumnos</a>
                </div>
                <div id=reporte>
                <img src="img/reporte2.png" alt="">
                <a href="#">Reporte diario trabajadores</a>
                </div>
                <div id=reporte>
                <img src="img/reporte3.png" alt="">
                <a href="#">Reporte de alertas</a>
                </div>
                <div id=reporte>
                <img src="img/reporte4.png" alt="">
                <a href="#">Reporte semanal</a>
                </div>
                <div id=reporte>
                <img src="img/reporte4.png" alt="">
                <a href="#">Reporte Mensual</a>
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
            <div class = "Seleccion">
                <p>Buscar </p>
                <input type="search" id="search" placeholder="Número de control"/>

            </div>
            <div class="user-list">
            <table>
                        <tbody>
                            <tr>
                                <th>No de control</th>
                                <th>Pregunta 1</th>
                                <th>Pregunta 2</th>
                                <th>Pregunta 3</th>
                                <th>Hora Cuestionario</th>
                                <th>Hora Ingreso</th>
                                <th>Fecha</th>
                            </tr>
                            <?php //ESTO ES PHP
                                if ($resultado->num_rows>0) {
                                    while ($registro = $resultado->fetch_array()) {
                                         echo "<tr>";
                                         echo "<td>".$registro['no_control']."</td>";
                                         echo "<td>".$registro['resp1']."</td>";
                                         echo "<td>".$registro['resp2']."</td>";
                                         echo "<td>".$registro['resp3']."</td>";
                                         echo "<td>".$registro['hr_cuestionario']."</td>";
                                         echo "<td>".$registro['hr_ingreso']."</td>";
                                         echo "<td>".$registro['fecha']."</td>";
                                         echo "</tr>";
                                    }
                                }
                                echo "<h1>".$fecha."</h1>";
                                echo "<h1>".$fecha_sig."</h1>";
                            ?> 
                        </tbody>
                    </table>
            </div>
        </div>
    </body>
</html>