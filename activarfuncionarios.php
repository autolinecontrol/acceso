<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//variable para validar si no ha realizado busquedas
$validar=0;
require 'db.php';
require 'conexion.php';
ob_start();
session_start();
if($_SESSION['logged_in']!== true)
{
    header("Location: index.php");
    exit();
}
else
{
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");
}
if($result-> num_rows === 0)
{
    unset($_SESSION['logged_in']);
    $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
    header("Location: error.php");
    exit();
}
else
{
    $user = $result->fetch_assoc();
    $activo = $user['activo'];
    $documento=$user['identificacion'];
}
?>
<head>
    <link href="StyleSheet.css" rel="stylesheet" />
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Modificar Perfiles</title>
	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/header-second-bar.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">    
</head>
<body>
<form  method="post" name="ingresodep" id="contFrm" action="">    
<div class="form">
<?php
if($activo<3)
{
    session_start();
    session_unset();
    session_destroy();
    echo '<h1>No tienes el Perfil para Activar Funcionarios </h1>';
    echo '<a href="index.php">Inicio</a>';
}
include 'banner.php';
?>
<header class="header-two-bars">
    <div class="header-second-bar">                  
<br>
<form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
    <input id="busca" name="ingreso" type="search" placeholder="Entrada" autofocus >
    <input type="submit" name="consulta" class="btn btn-success"  value="buscar">  
</form>
<br><br><br>
<?php
include 'conexion.php';
if(isset($_POST['consulta']))
{
    $identificacion = $_POST['ingreso'];
    $resultado = mysqli_query($con, "select identificacion,nombre,email,password,activo,oficina "
    . " from funcionarios"
    . " where identificacion = '$identificacion'"
    . "order by nombre"
    );
//variable para validar si no ha realizado busquedas
$validar=1;
}
if(isset($_POST['borra']))
{
    $identificacion = $_POST['id'];
    $resultado = mysqli_query($con, "delete "
    . " from funcionarios"
    . " where identificacion = '$identificacion'"
    );
    $accionm="ELIMINADO";
    $fecha=date('Y-m-d H:i:s');
    $resultadolog = mysqli_query($con, "INSERT INTO logregistros(Administrador,idVisitante,idAutoriza,Oficina,Accion) VALUES ('$nombre', '$identificacion', '$documento',$ofice','$accionm' )");
}
?>
<table class = "table table-striped table-bordered">
<tr>
<th>Identificacion</th>
<th>Nombre</th>
<th>Correo</th>
<!--<th>Clave</th>!-->
<th>Perfil</th>
<th>Oficina</th>
<th>Perfil</th>
<th>Oficina</th>
<th>Actualizar</th>
<th>Borrar</th>
<input type="hidden" name="id" value="<?php echo $identificacion; ?>">
</tr>
<?php
if($validar==1)
{
    while($fila = mysqli_fetch_assoc($resultado))
    {
        echo '<tr>';
        echo '<td>'. $fila['identificacion']. '</td>';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo '<td>' . $fila['email'] . '</td>';
        // echo '<td>' . $fila['password'] . '</td>';
        echo '<td>' . $fila['activo'] . '</td>';
        $ofi=$fila['oficina'];
        $sqloficinas="select Nombre from oficinas where Numero=$ofi";
        $resultadoofi = mysqli_query($con,$sqloficinas);
        while($filaofi = mysqli_fetch_assoc($resultadoofi))
        {
            echo '<td>' .$filaofi['Nombre'] . '</td>';
            break;
        }
        echo '<td>  
        <select name="Perfil" id="sel1">
            <option>SuperAdministrador</option>
            <option>administrador</option>
            <option>funcionarios</option>
            <option>visitantes</option>
            <option>desactivar</option>
            <option>borrar</option>
        </select></td>';
        $sqloficina="Select * from oficinas ORDER BY Numero";
        $resultadooficina = mysqli_query($con,$sqloficina);
        echo '<td>  <select name="Ofi" id="sel2">';
        while($fila = mysqli_fetch_assoc($resultadooficina))
        {
            echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
        }
        echo '</select></td>';
        echo '<td> <input name = "Actualizar" type="submit" value = "Actualizar"  class = "btn btn-success"></td>'; //Boton de Actualizar
        echo '<td> <input name = "borra" type="submit" value = "Borra" class = "btn btn-danger"></td>';
        echo '</tr>';
        mysqli_close($con);
    }
}
?>
</table>
</div><br><br>

       

    
