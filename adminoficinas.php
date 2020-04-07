<?php
require 'db.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);

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
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <!--<meta http-equiv="refresh" content=".1">-->
	<link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
        
       <title>Admisnitradores</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        
</head>
 <body>
        <form  method="get" name="ingresodep" id="contFrm" action="">    
            <div class="form">
            <?php
            if($activo<5)
            {
                session_start();
                session_unset();
                session_destroy();
                
            echo '<h1>No tienes el Perfil para Activar Funcionarios </h1>';
            echo '<a href="index.php">Inicio</a>';
            }
            if($activo==5){
                
            ?>
           
            <header class="header-two-bars">

            <div class="header-first-bar">

                <div class="header-limiter">

                   <h1><a href="perfil.php">Central<span>Point &nbsp;&nbsp;&nbsp;</span></a></h1>
                    <ul class="nav">
                                
                                  <li class="dropdown">
                                    <a href="perfil.php" class="dropbtn"> Registro</a>
                                  </li>
                                  <li class="dropdown">
                                    <a href="activarfuncionarios.php" class="dropbtn">Administradores</a>
                                  </li>
                              
                            
                        
                           
                   

                    <a href="logout.php" class="logout-button">Logout</a>
                    </ul>

                    
                </div>

            </div>

            <div class="header-second-bar">

                
                    <br>
                   
                

            </div>

        </header>
<?php

require 'conexion.php';

$resultado = mysqli_query($con, "select * from funcionarios order by activo asc");


?>

<div class = "oficinas">
<table class = "table table-striped table-bordered">
<tr>
<th>Identificacion</th>
<th>Nombre</th>
<th>Ubicación</th>
<th>Usuario</th>
<th>Perfil</th>

</tr>
<?
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr>';
    echo '<td>'. $fila['Identificacion']. '</td>';
    echo '<td>'. $fila['nombre']. '</td>';
$ofi=$fila['oficina'];
$sqloficinas="select Nombre from oficinas where Numero=$ofi";
$resultadoofi = mysqli_query($con,$sqloficinas);
while($filaofi = mysqli_fetch_assoc($resultadoofi))
{
 echo '<td>' .$filaofi['Nombre'] . '</td>';
break;
}
    echo '<td>' . $fila['email'] . '</td>';
    echo '<td>' . $fila['activo'] . '</td>';
    
    echo '</tr>';
}


mysqli_close($con);
}
?>
</table>
</div>
