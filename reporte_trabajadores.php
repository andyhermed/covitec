<?php
date_default_timezone_set("America/Mexico_City");
//realizar conexion
require_once ("conexion.php");
$mensaje = "";
$fecha = Date("Y-m-d");
$fecha_sig = date("Y-m-d", strtotime("+1 day", strtotime($fecha)));
//revisar datos a insertar 
if (isset($_POST["u_no_checador"]) and isset($_POST["u_resp1"]) and isset($_POST["u_resp2"]) and isset($_POST["u_resp3"]) and isset($_POST["u_hr_cuestionario"]) and isset($_POST["u_hr_ingreso"]) and isset($_POST["u_fecha"])){
    //procedemos a insertar
    $sql = "insert into trabajadores (no_checador, resp1, resp2, resp3, hr_cuestionario, hr_ingreso, fecha) values('".$_POST["u_no_checador"]."','".$_POST["u_resp1"]."','".$_POST["u_resp2"]."','".$_POST["u_resp3"]."','".$_POST["u_hr_cuestionario"]."','".$_POST["u_hr_ingreso"]."','".$_POST["u_hr_fecha"]."')";
        
    if ($conn->query($sql)) {
            $mensaje = "";
    }else {
        $mensaje = "<p class='msg err-msg'>Error al insertar datos</p>";
    }
    
}

//realizar consulta de registros y guardarlos en variable
if(isset($_POST['search'])){
    $nchecador = $_POST['nchecador'];
    $h_desde = $_POST['desde'];
    $h_hasta = $_POST['hasta'];
    $sql = "(select * from trabajadores where fecha >= '".$fecha."' and fecha < '".$fecha_sig."' and no_checador like '%".$nchecador."%' and hr_ingreso between '".$h_desde."' and '".$h_hasta."')";
    $resultado = $conn->query($sql);
    if ($h_desde == "") {
        if ($h_hasta == "") {
            $sql = "(select * from trabajadores where fecha >= '".$fecha."' and fecha < '".$fecha_sig."' and no_checador like '%".$nchecador."%')";
            $resultado = $conn->query($sql);
        }
    }
    if ($nchecador == "") {
        $sql = "(select * from trabajadores where fecha >= '".$fecha."' and fecha < '".$fecha_sig."' and hr_ingreso between '".$h_desde."' and '".$h_hasta."')";
            $resultado = $conn->query($sql);
    }
    if ($nchecador == ""){
        if ($h_desde == "") {
            if ($h_hasta == "") {
                $sql = "(select * from trabajadores where fecha >= '".$fecha."' and fecha < '".$fecha_sig."')";
                $resultado = $conn->query($sql);
            }
        }
    }
}else {
    $sql = "(select * from trabajadores where fecha >= '".$fecha."' and fecha < '".$fecha_sig."')";
    $resultado = $conn->query($sql);
}
if (isset ($_POST['mostrar'])) {
    $sql = "(select * from trabajadores where fecha >= '".$fecha."' and fecha < '".$fecha_sig."')";
    $resultado = $conn->query($sql);
}
$nchecador = "";
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
                <a href="reporte_trabajadores.php">Reporte diario trabajadores</a>
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
            <div class = "filtro">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="buscar">
                <span>
                <p>Número de checador</p>
                <input type="text" name="nchecador" placeholder="Número de checador"/>
                </span>
                <span>
                <p>Hora de ingreso</p>
                <p>Desde</p>
                <input type="time" name="desde"> 
                <p>Hasta</p>
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
                                <th>No de checador</th>
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
                                         echo "<td>".$registro['no_checador']."</td>";
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