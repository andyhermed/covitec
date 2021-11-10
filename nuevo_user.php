<?php
require_once "diseño.php";
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
<div class="container">
    
    <div class="form">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="fields">
            <span>
                <ul>
            <li><label>Nombre(s)</label><input placeholder="Introduce el nombre(s)" type="text" name= "nombre" /></li>
            </span>
            <br />
            <span>
            <li><label>Apellido Paterno</label><input placeholder="Introduce el apellido paterno" type="text" name= "apellido_paterno" /></li>
            </span>
            <br />
            <span>
            <li><label>Apellido Materno</label><input placeholder="Introduce el apellido materno" type="text" name= "apellido_materno" /></li>
            </span>
            <br />
            <span>
            <li><label>Usuario</label><input placeholder="Introduce el usuario" type="text" name = "usuario" /></li>
            </span>
            <br />
            <span>
            <li><label>Contraseña</label><input placeholder="Introduce la contraseña" type="password" name= "contrasena" /></li>
            </span>
            <br />
</ul>
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
    $n = $_POST['nombre'];
    $a_p = $_POST['apellido_paterno'];
    $a_m = $_POST['apellido_materno'];

    if($u == "" || $c == null || $n ==""){ // Validamos que ningún campo quede vacío
        echo "<script>alert('Ningún campo puede quedar vacío. Por favor, rellena los campos faltantes')</script>";
    }else{
 
        $sql = "SELECT * FROM usuarios WHERE id = '$u'";

        if(!$consulta = $conn->query($sql)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        }else{

            $filas = mysqli_num_rows($consulta);

            if($filas == 1){
                echo "<script>alert('Este usuario ya existe. Por favor, escribe uno diferente')</script>";
            }else{
                $sql = "insert into usuarios values('".$u."','".$c."','".$n."','".$a_p."','".$a_m."', 1, null, null)";
    
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