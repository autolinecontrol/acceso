<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'db.php';

ob_start();
session_start();




/*if($_SESSION['logged_in']!== true){
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
        
       
    }
    
}*/
?>
<head>
    <meta http-equiv="refresh" content="5">
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
            
            <div class="form">
            <?php
            if(!$activo){
                echo "<div class = 'alert alert-info'>
                    Tu cuenta fue creada! Te acabamos de enviar un correo, 
                    por favor confirma tu cuenta haciendo click en el link enviado, gracias.
                    </div>";
            }?>
           
            <header class="header-two-bars">

            <div class="header-first-bar">

                <div class="header-limiter">

                <h1><a href="perfil.php">Central<span>Point &nbsp;&nbsp;&nbsp;</span></a></h1>
                    <ul class="nav">
                                
                                  <li class="dropdown">
                                    <a href="perfil.php" class="dropbtn"> Registro</a>
                                  </li>
                              
                            
                     
                           
                   

                    <a href="logout.php" class="logout-button">Logout</a>
                    </ul>
                </div>

            </div>

          

                
                   
                    <br>
<?php 
require 'conexion.php';
date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
echo $fecha;
$sql="select * from usuarios where estado='N'";
$resultado=mysqli_query($con,$sql);
?>

<table class ="table table-triped table-bordered">
<tr>
<th>Identificacion</th>
<th>Fecha Inicio</th>
<th>Fecha Fin</th>
<th>Controladora</th>
<th>Oficina</th> 
<th>Grupo</th>
</tr>
<?php
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr>';
    echo "<td>".$fila['identificacion']."</td>";
    echo "<td>".$fila['fechainicio']."</td>";
    echo "<td>".$fila['fechafin']."</td>";
    echo "<td>".$fila['ncontroladora']."</td>";
    echo "<td>".$fila['oficina']."</td>";
    echo "<td>".$fila['grupo']."</td>";
	
	echo '</tr>';
}
	




