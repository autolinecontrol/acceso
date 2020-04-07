<?php
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
    <title>Registro</title>
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
    echo '<h1>No tinenes el Perfil para Activar Funcionarios </h1>';
    echo '<a href="index.php">Inicio</a>';
}
include 'banner.php';
?>
<header class="header-two-bars">
    <div class="header-second-bar">
    <br>
    <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
        <input id="busca" name="ingreso" type="search" placeholder="Oficina Numero" autofocus >
        <input type="submit" name="consulta" class="btn btn-success" aceptar" value="buscar">                        
    </form>                   
    <?php
    if(isset($_GET['guarda']))
    {
        
        $nombre    = $_GET['nombreoficina'];
        $ubicacion = $_GET['ubicacion'];
        $numero    = $_GET['numero'];
        $cupos     = $_GET['cuposcarro'];
        $cuposmotos= $_GET['cuposmoto'];

        $cupoactual    = $_GET["cupoactual"];
        $cupoamotos    = $_GET["cupoactualmotos"];
       
        $sqlinsert="REPLACE 
        INTO oficinas (Nombre,Ubicacion,Numero,Cupo,CupoMotos,CupoActual,CupoActualMotos) 
        VALUES ('$nombre','$ubicacion','$numero','$cupos','$cuposmotos','$cupoactual','$cupoamotos')";
        //echo $sqlinsert;
        $resultado = mysqli_query($con,$sqlinsert);
       
    }
    if(isset($_GET['consulta']))
    {
        $numero = $_GET['ingreso'];
        $sqlconsulta="select Nombre,Ubicacion,Numero,Cupo,CupoMotos,
        CupoActual,CupoActualMotos"
        . " from oficinas"
        . " where Numero = '$numero'";
        $resultado = mysqli_query($con,$sqlconsulta);
        //echo $sqlconsulta;
        $Datoss = mysqli_fetch_array($resultado);  
        $numero        = $Datoss["Numero"];   
        $nombreoficina = $Datoss["Nombre"];   
        $ubicacion     = $Datoss["Ubicacion"];
        $cupos         = $Datoss["Cupo"];
        $cuposmotos    = $Datoss["CupoMotos"];
        $cupoactual    = $Datoss["CupoActual"];
        $cupoamotos    = $Datoss["CupoActualMotos"];          
    }
    ?>
    <div class = "container">
        <form method="get" class="contact_form"> 
            <ul>
                <li>
                    <h2>Usuarios</h2>
                    <br><br><br><br>
                    <span class="required_notification">* Datos requeridos</span>
                </li>
                <li>
                    <label for="name">*Oficina No:</label>
                    <input type="text" name="numero" placeholder="Numero" id ="nuevaIdentificacionID" value="<?php echo $numero; ?>" required />
                </li>
                <li>
                    <label for="name">*Nombre:</label>
                    <input type="text" name="nombreoficina" placeholder="Nombre Oficina" id ="nuevoUsuarioID" value="<?php echo $nombreoficina; ?>" required />
                </li>
                
                <li>
                    <label for="ubica">*Ubicacion:</label>
                    <input type="text" name="ubicacion" placeholder="ubicacion" id ="nuevoUbicacion" value="<?php echo $ubicacion; ?>" required />
                </li>
                <li>
                    <label for="cupos">*Cupos Carros:</label>
                    <input type="text" name="cuposcarro" placeholder="50" id ="nuevoUbicacion" value="<?php echo $cupos; ?>" required />
                </li>
                <li>
                    <label for="cupos">*Cupos Motos:</label>
                    <input type="text" name="cuposmoto" placeholder="50" id ="nuevoUbicacion" value="<?php echo $cuposmotos; ?>" required />
                </li>
                
                
                <li>                    
                    <input type="hidden" name="cupoactual"  value="<?php echo $cupoactual; ?>">
                </li>
                <li>
                    
                    <input type="hidden" name="cupoactualmotos"  value="<?php echo $cupoamotos; ?>">
                </li>
                <li>
                    <label for="Fecha">      </label>
                    <input type="submit" name="guarda" class="btn btn-success" value= "Guardar">
                </li>
            </ul>

<?
}
?>
</div>
