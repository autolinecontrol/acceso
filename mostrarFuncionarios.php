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
    if($result-> num_rows === 0)
    {
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }else
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
    <title>Mostrar Funcionarios Oficina</title>
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
    if($activo>1)
    {
        require_once 'banner.php'; 
    } 
    ?>
    <header class="header-two-bars">
        <div class="header-second-bar">
        <br>
        <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
        <?php
            $sqlmostraroficina="Select * from oficinas";
            $resultadooficina = mysqli_query($con,$sqlmostraroficina); 
            echo "<label for='oficina'>*Oficina:</label>";
            echo "<select name='ofice' class='form-control' id='sel1'>";
            while($fila = mysqli_fetch_assoc($resultadooficina))
            {
                echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
            }
            echo "</select><br>";
            echo "<input type='submit' name='consulta' class='btn btn-success' value='buscar'>";
        echo "</form>";
        echo "</div>";
    echo "</header>";
if(isset($_GET['consulta']))
{
    $ofice = $_GET['ofice'];
    $tipo = 'FUNCIONARIO';
    //echo $ofice;
    $resultado = mysqli_query($con, "select * from visitantes WHERE Oficina = '$ofice' and tipo='$tipo' ORDER BY grupo ");  
    $validar=1;
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
<th>Vehiculo</th>
<th>Grupo</th>
<input type="hidden" name="id" value="<?php echo $identificacion; ?>">
</tr>
<?php
if($validar!=0){
    while($fila = mysqli_fetch_assoc($resultado))
    {
        echo '<tr>';
        echo '<td>'. $fila['identificacion']. '</td>';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo '<td>' . $fila['correo'] . '</td>';
        echo '<td>' . $fila['Ingreso'] . '</td>';
        echo '<td>' . $fila['Salida'] . '</td>';
        echo '<td>' . $fila['vehiculo'] . '</td>';
        echo '<td>' . $fila['grupo'] . '</td>';
        
        echo '</tr>';
    }
}
mysqli_close($con);
?>
</table>
</div>

