<?php
date_default_timezone_set("America/Mexico_City");
//realizar conexion
require_once ("conexion.php");
require_once "diseño.php";
$mensaje = "";
$fecha = Date("Y-m-d");
$fecha_sig = date("Y-m-d", strtotime("+1 day", strtotime($fecha)));
//revisar datos a insertar 
if (isset($_POST["u_no_control"]) and isset($_POST["u_resp1"]) and isset($_POST["u_resp2"]) and isset($_POST["u_resp3"]) and isset($_POST["u_hr_cuestionario"]) and isset($_POST["u_hr_ingreso"]) and isset($_POST["u_fecha"])){
    //procedemos a insertar
    $sql = "insert into alumnos (no_control, resp1, resp2, resp3, hr_cuestionario, hr_ingreso, fecha) values('".$_POST["u_no_control"]."','".$_POST["u_resp1"]."','".$_POST["u_resp2"]."','".$_POST["u_resp3"]."','".$_POST["u_hr_cuestionario"]."','".$_POST["u_hr_ingreso"]."','".$_POST["u_hr_fecha"]."')";
        
    if ($conn->query($sql)) {
            $mensaje = "";
    }else {
        $mensaje = "<p class='msg err-msg'>Error al insertar datos</p>";
    }
    
}

//realizar consulta de registros y guardarlos en variable
if(isset($_POST['search'])){
    $ncontrol = $_POST['ncontrol'];
    $h_desde = $_POST['desde'];
    $h_hasta = $_POST['hasta'];
    $sql = "(select * from alumnos where fecha >= '".$fecha."' and fecha < '".$fecha_sig."' and no_control like '%".$ncontrol."%' and hr_ingreso between '".$h_desde."' and '".$h_hasta."')";
    $resultado = $conn->query($sql);
    if ($h_desde == "") {
        if ($h_hasta == "") {
            $sql = "(select * from alumnos where fecha >= '".$fecha."' and fecha < '".$fecha_sig."' and no_control like '%".$ncontrol."%')";
            $resultado = $conn->query($sql);
        }
    }
    if ($ncontrol == "") {
        $sql = "(select * from alumnos where fecha >= '".$fecha."' and fecha < '".$fecha_sig."' and hr_ingreso between '".$h_desde."' and '".$h_hasta."')";
            $resultado = $conn->query($sql);
    }
    if ($ncontrol == ""){
        if ($h_desde == "") {
            if ($h_hasta == "") {
                $sql = "(select * from alumnos where fecha >= '".$fecha."' and fecha < '".$fecha_sig."')";
                $resultado = $conn->query($sql);
            }
        }
    }
}else {
    $sql = "(select * from alumnos where fecha >= '".$fecha."' and fecha < '".$fecha_sig."')";
    $resultado = $conn->query($sql);
}
if (isset ($_POST['mostrar'])) {
    $sql = "(select * from alumnos where fecha >= '".$fecha."' and fecha < '".$fecha_sig."')";
    $resultado = $conn->query($sql);
}
$ncontrol = "";
$h_desde = "";
$h_hasta = "";
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
    <div class="alumnoetiqueta">
        <div class="c">
        <img src="img/lista-de-verificacion.png" alt="">
        </div>
        <h2>Reporte Diario Alumnos</h2>
        </div>
        <div class="container">
            <div class= "filtro">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="buscar">
                <span>
                <p>Número de control</p>
                <input type="text" name="ncontrol" placeholder="Número de control"/>
                </span>
                <span>
                <h2>Hora de ingreso</h2>
                <h3>Desde</h3>
                <input type="time" name="desde"> 
                <h3>Hasta</h3>
                <input type="time" name="hasta"> 
                <input type="submit" name="search" value="Buscar">
                </span>
                <br>
                <span>
                <input type="submit" name="mostrar" value="Mostrar todos">
                </span>
                </div>
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
                            <?php 
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
                            ?> 
                        </tbody>
                    </table>
            </div>
        </div>
    </body>
</html>
