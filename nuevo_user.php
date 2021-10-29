<?php
require_once ("conexion.php");

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
            <header class="header">
                <div id="titulo">
                    <img src="img/LogotipoCoviteceEncabezado.png" alt="Logotipo de Covitec">
                    <h1>Sistema de control de Acceso</h1>
                </div>
            <div id="navegacion">
                <div id=reporte>
                <img src="img/reporte1.png" alt="">
                <a href="#">Lorem, ipsum dolor.</a>
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
    </div>
    <div class="form">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="fields">
            <span>
            <h2>Usuario</h2>
            <input placeholder="Introduce el usuario" type="text" name = "usuario" />
            </span>
            <br />
            <span>
            <h2>Contraseña</h2>
            <input placeholder="Introduce la contraseña" type="password" name= "contrasena" />
            </span>
            <br />
            <span>
            <h2>Nombre Completo</h2>
            <input placeholder="Introduce el nombre completo" type="text" name= "nombre_comp" />
            </span>
            </div>
            <div id="save">
            <input name="save" value="Guardar" type="submit" />
            </div>
        </div>
</body>
</html>

<?php
//realizar conexion
require_once ("conexion.php");
$mensaje = "";
//revisar datos a insertar 
if(isset($_POST['save'])){

    $u = $_POST['usuario'];
    $c = $_POST['contrasena']; 
    $n = $_POST['nombre_comp'];

    if($u == "" || $c == null || $n ==""){ // Validamos que ningún campo quede vacío
        echo "<script>alert('Ningún campo puede quedar vacío. Por favor, rellena los campos faltantes')</script>";
    }else{
 
        $sql = "SELECT * FROM usuarios WHERE usuario = '$u'";

        if(!$consulta = $conn->query($sql)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        }else{

            $filas = mysqli_num_rows($consulta);

            if($filas == 1){
                echo "<script>alert('Este usuario ya existe. Por favor, escribe uno diferente')</script>";
            }else{
                $sql = "insert into usuarios values('".$u."','".$c."','".$n."')";
    
                if ($conn->query($sql)) {
                    $mensaje = "";
                    header('location:usuarios.php'); // Si está todo correcto redirigimos a otra página
                }else {
                    $mensaje = "<p class='msg err-msg'>Error al insertar datos</p>";
                }    
            }
        }
    }
}

?>