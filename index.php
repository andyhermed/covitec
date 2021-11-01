<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Control de acceso</title>
    <link rel="stylesheet" href="css/styles_log.css">
</head>
<body>
    <div class="container">
        <div id="encabezado">
            <img src="img/encabezado.png" alt="">
            <h1>¡Bienvenido!</h1>
        </div>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="fields">
        <span>
        <h2>Usuario</h2>
        <input placeholder="Introduce tu name" type="text" name = "usuario" />
        </span>
        <br />
        <span>
        <h2>Contraseña</h2>
        <input placeholder="Introduce tu contraseña" type="password" name= "contrasena" />
        </span>
        </div>
        <div id="login">
        <input name="login" value="Ingresar" type="submit" />
        </div>
    </form>
    </div>
</body>

</html>
<?php
require_once "conexion.php";

if(isset($_POST['login'])){

    $u = $_POST['usuario'];
    $c = $_POST['contrasena']; 

    if($u == "" || $c == null){ 
        echo "<script>alert('Usuario o contraseña vacíos')</script>";
    }else{

        $sql = "SELECT * FROM usuarios WHERE id = '$u' AND contrasena = '$c' AND estatus = 1";

        if(!$consulta = $conn->query($sql)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        }else{

            // Cuento registros obtenidos del select. 
            $filas = mysqli_num_rows($consulta);

            // Comparo cantidad de registros encontrados
            if($filas == 0){
                echo "<script>alert('Usuario o contraseña incorrectos')</script>";
            }else{
                header('location:reporte_alumnos.php'); // Si está todo correcto redirigimos a otra página
            }

        }
    }
}
?>
