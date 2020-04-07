<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
        
       
    }
    
}
?>
<head>
    <meta http-equiv="refresh" content="1">
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

                     <h1><a href="perfil.php"><img src="assets/logo.png">  Centro de Negocios <span style="color: #efb810"> &nbsp&nbsp &nbsp</span></a></h1>
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
$sql="Select * from log where fechaevento > '$fecha' order by fechaevento desc limit 20";
$resultado=mysqli_query($con,$sql);
?>

<table class ="table table-triped table-bordered">
<tr>
<th>Fecha y Evento</th>
<th>Documento</th>
<th>Nombre</th>
<th>Of.</th>
<th>Tipo</th>
<th>Veh.</th> 
<th>Evento</th>
<th>Motivo</th>
<th>Controladora</th>
</tr>
<?php
while($fila = mysqli_fetch_assoc($resultado))
{
    $documento=$fila['identificacion'];
    
$evento=$fila['evento'];
if($evento=='antipassback')
{
    echo '<tr>';
    echo "<td><font color='red'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='red'>".$fila['identificacion']."</font></td>";
    $sqlmostrardatos="SELECT visitantes.nombre,visitantes.Oficina,visitantes.vehiculo,visitantes.tipo FROM log INNER JOIN visitantes on log.identificacion=visitantes.identificacion WHERE visitantes.identificacion='$documento'";
    $resultadomostrar=mysqli_query($con,$sqlmostrardatos);
    while($filamostrar= mysqli_fetch_assoc($resultadomostrar))
    {
        echo "<td><font color='red'>".$filamostrar['nombre']."</font></td>";
        echo "<td><font color='red'>".$filamostrar['Oficina']."</font></td>";
        echo "<td><font color='red'>".$filamostrar['tipo']."</font></td>";
        echo "<td><font color='red'>".$filamostrar['vehiculo']."</font></td>";
        break;
    }
	
	echo "<td><font color='red'>".$fila['evento']."</font></td>";
	echo "<td><font color='red'>".$fila['motivo']."</font></td>";
    $controladora=$fila['ncontroladora'];
    $sqlnombre="SELECT controladoras.nombrecontroladora FROM log INNER join controladoras on log.ncontroladora=controladoras.idcontroladora WHERE ncontroladora= '$controladora '";

    $resultadonombre=mysqli_query($con,$sqlnombre);
    while($mostrarnombre= mysqli_fetch_assoc($resultadonombre)){
     echo "<td><font color='red'>".$mostrarnombre['nombrecontroladora']."</font></td>"; 
        break;
    }
	
	
	echo '</tr>'; 
}

if($evento=='expirado')
{
	echo '<tr>';
    echo "<td><font color='black'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='black'>".$fila['identificacion']."</font></td>";
    $sqlmostrardatos="SELECT visitantes.nombre,visitantes.Oficina,visitantes.vehiculo,visitantes.tipo FROM log INNER JOIN visitantes on log.identificacion=visitantes.identificacion WHERE visitantes.identificacion='$documento'";
    $resultadomostrar=mysqli_query($con,$sqlmostrardatos);
    while($filamostrar= mysqli_fetch_assoc($resultadomostrar))
    {
        echo "<td><font color='black'>".$filamostrar['nombre']."</font></td>";
        echo "<td><font color='black'>".$filamostrar['Oficina']."</font></td>";
        echo "<td><font color='black'>".$filamostrar['tipo']."</font></td>";
        echo "<td><font color='black'>".$filamostrar['vehiculo']."</font></td>";
        break;
    }
	
	echo "<td><font color='black'>".$fila['evento']."</font></td>";
	echo "<td><font color='black'>".$fila['motivo']."</font></td>";
    $controladora=$fila['ncontroladora'];
    
    $sqlnombre="SELECT controladoras.nombrecontroladora FROM log INNER join controladoras on log.ncontroladora=controladoras.idcontroladora WHERE ncontroladora= '$controladora '";
    $resultadonombre=mysqli_query($con,$sqlnombre);
    while($mostrarnombre= mysqli_fetch_assoc($resultadonombre)){
     echo "<td><font color='black'>".$mostrarnombre['nombrecontroladora']."</font></td>"; 
        break;
    }
	
	echo '</tr>';
}

if($evento=='No Registrado')
{
	echo '<tr>';
	echo "<td><font color='orange'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='orange'>".$fila['identificacion']."</font></td>";
    echo "<td><font color='orange'>NN</font></td>";
    echo "<td><font color='orange'>NN</font></td>";
    echo "<td><font color='orange'>NN</font></td>";
    echo "<td><font color='orange'>NN</font></td>";
	echo "<td><font color='orange'>".$fila['evento']."</font></td>";
	echo "<td><font color='orange'>".$fila['motivo']."</font></td>";
    $controladora=$fila['ncontroladora'];
	$sqlnombre="SELECT controladoras.nombrecontroladora FROM log INNER join controladoras on log.ncontroladora=controladoras.idcontroladora WHERE ncontroladora= '$controladora '";
    $resultadonombre=mysqli_query($con,$sqlnombre);
    while($mostrarnombre= mysqli_fetch_assoc($resultadonombre)){
     echo "<td><font color='orange'>".$mostrarnombre['nombrecontroladora']."</font></td>"; 
        break;
    }
	
	echo '</tr>';
}
    if($evento=='vehiculo')
{
	echo '<tr>';
    echo "<td><font color='blue'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='blue'>".$fila['identificacion']."</font></td>";
    $sqlmostrardatos="SELECT visitantes.nombre,visitantes.Oficina,visitantes.vehiculo,visitantes.tipo FROM log INNER JOIN visitantes on log.identificacion=visitantes.identificacion WHERE visitantes.identificacion='$documento'";
    $resultadomostrar=mysqli_query($con,$sqlmostrardatos);
    while($filamostrar= mysqli_fetch_assoc($resultadomostrar))
    {
        echo "<td><font color='blue'>".$filamostrar['nombre']."</font></td>";
        echo "<td><font color='blue'>".$filamostrar['Oficina']."</font></td>";
        echo "<td><font color='blue'>".$filamostrar['tipo']."</font></td>";
        echo "<td><font color='blue'>".$filamostrar['vehiculo']."</font></td>";
        break;
    }
	
	echo "<td><font color='blue'>".$fila['evento']."</font></td>";
	echo "<td><font color='blue'>".$fila['motivo']."</font></td>";
    $controladora=$fila['ncontroladora'];
    
    $sqlnombre="SELECT controladoras.nombrecontroladora FROM log INNER join controladoras on log.ncontroladora=controladoras.idcontroladora WHERE ncontroladora= '$controladora '";
    $resultadonombre=mysqli_query($con,$sqlnombre);
    while($mostrarnombre= mysqli_fetch_assoc($resultadonombre)){
     echo "<td><font color='blue'>".$mostrarnombre['nombrecontroladora']."</font></td>"; 
        break;
    }
	
	echo '</tr>';
}



}?>



