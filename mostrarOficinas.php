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
    <!--<meta http-equiv="refresh" content=".1">-->
	<link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
        
       <title>Mostrar Oficinas</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        
</head>
 <body>
        <!--<form  method="get" name="ingresodep" id="contFrm" action="">    !-->h
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
            if($activo==3){
                
            ?>
           
            <header class="header-two-bars">

            <div class="header-first-bar">

                <div class="header-limiter">

                    <h1><a href="#">Centro<span>Andino</span></a></h1>
                    

                    <nav>
                        <a href="perfil.php">Registro</a>
                        <a href="ofice.php">Oficinas</a>
                        
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
                   
                

            </div>

        </header>
<?php

require 'conexion.php';

$resultado = mysqli_query($con, "select * from oficinas ");


?>

<div class = "oficinas">
<table class = "table table-striped table-bordered">
<tr>
<th>Nombre</th>
<th>Ubicacon</th>
<th>Numero</th>
<th>Cupos</th>

</tr>
<?
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr>';
    echo '<td>'. $fila['Nombre']. '</td>';
    echo '<td>' . $fila['Ubicacion'] . '</td>';
    echo '<td>' . $fila['Numero'] . '</td>';
    echo '<td>' . $fila['Cupos'] . '</td>';
    
    echo '</tr>';
}


mysqli_close($con);
}
?>
</table>
</div>
