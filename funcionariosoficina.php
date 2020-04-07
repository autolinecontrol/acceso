<?php
require 'db.php';

ob_start();
session_start();

if($_SESSION['logged_in']!== true){
    header("Location: index.php");
    exit();
}else{
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];
    
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");

    if($result-> num_rows === 0){
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }else{
        $user = $result->fetch_assoc();
        $activo = $user['activo'];
        //echo $activo;
       
    }
    
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
        
       <title>Reporte Salidas</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        
</head>
 <body>
        <form  method="get" name="ingresodep" id="contFrm" action="">    
            <div class="form">
            <?php
            if($activo<2)
            {
                session_start();
                session_unset();
                session_destroy();
                
            echo '<h1>No tienes el Perfil para Activar Funcionarios </h1>';
            echo '<a href="index.php">Inicio</a>';
            }
            if($activo>1){
                
            ?>
           
            <header class="header-two-bars">

            <div class="header-first-bar">

                <div class="header-limiter">

                    <h1><a href="#">Central<span>Point</span></a></h1>
                    

                    <nav>
                        <a href="perfil.php">Registro</a>
                        <a href="importar1.php">Subir</a>
                        
                    </nav>

                    <a href="logout.php" class="logout-button">Logout</a>
                </div>

            </div>

            <div class="header-second-bar">

                
                    <nav>
                        <a href="#"><i class="fa fa-comments-o"></i> Questions</a>
                        <a href="#"><i class="fa fa-file-text"></i> Results</a>
                        <a href="#"><i class="fa fa-group"></i> Participants</a>
                        <a href="#"><i class="fa fa-cogs"></i> Settings</a>
                    </nav>
                    <br>
                    <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                        <? if($oficina<2){?>
                        <label for="sel1">*Oficina :</label>
                        <select name="ofice" id="sel1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                        </select>
                        <?}?>
                        <? if($oficina>1){?>
                        <label for="oficina">*Oficina:</label>
                    
                    <input type="text" placeholder="Oficina" name="ofice" id ="oficina" value="<?php echo $oficina; ?>" readonly />
                    <?}?>
                        
                        <input type="submit" name="consulta" class="btn btn-success" aceptar" value="buscar">
                        
                    </form>
                   
                

            </div>

        </header>
<?php

require 'conexion.php';


if(isset($_GET['admin']))
{
$id = $_GET['id'];
//echo $id;
$nactivo="2";

$Consulta = mysqli_query($con,"UPDATE funcionarios SET activo='3' WHERE identificacion='$id'");

$resultado = mysqli_query($con, "select identificacion,nombre,activo "
        . " from funcionarios"
        . " where identificacion = '$id'"
        . "order by nombre"
        );


}


if(isset($_GET['nuevo']))
{
$id = $_GET['id'];
//echo $id;
$nactivo="2";

$Consulta = mysqli_query($con,"UPDATE funcionarios SET activo='2' WHERE identificacion='$id'");

$resultado = mysqli_query($con, "select identificacion,nombre,activo "
        . " from funcionarios"
        . " where identificacion = '$id'"
        . "order by nombre"
        );


}


if(isset($_GET['inactiva']))
{
$id = $_GET['id'];
//echo $id;

$Consulta = mysqli_query($con,"UPDATE funcionarios SET activo='1' WHERE identificacion='$id'");

$resultado = mysqli_query($con, "select identificacion,nombre,activo "
        . " from funcionarios"
        . " where identificacion = '$id'"
        . "order by nombre"
        );


}

if(isset($_GET['consulta']))
{

$ofice = $_GET['ofice'];
$tipo = 'FUNCIONARIO';
//echo $ofice;

$resultado = mysqli_query($con, "select * from visitantes WHERE Oficina = '$ofice' and tipo='$tipo' ORDER BY vehiculo DESC ");


}
?>


<div class = "container">
<table class = "table table-striped table-bordered">
<tr>
<th>Identificacion</th>
<th>Nombre</th>
<th>Correo</th>
<th>Ingreso</th>
<th>Salida</th>
<th>Estado</th>
<th>Vechiculo</th>
<input type="hidden" name="id" value="<?php echo $identificacion; ?>">
</tr>
<?
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr>';
    echo '<td>'. $fila['identificacion']. '</td>';
    echo '<td>' . $fila['nombre'] . '</td>';
    echo '<td>' . $fila['correo'] . '</td>';
    echo '<td>' . $fila['Ingreso'] . '</td>';
    echo '<td>' . $fila['Salida'] . '</td>';
    echo '<td>' . $fila['estado'] . '</td>';
    echo '<td>' . $fila['vehiculo'] . '</td>';
 
    echo '</tr>';
}


mysqli_close($con);
}
?>
</table>
</div>

