<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'db.php';
require 'conexion.php';
$validar=0;
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
    
	<link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
        
       <title>Buscar Log</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style type="text/css">
                            input[type="checkbox"]  {
                                display:inline-block;
                                width:19px;
                                height:19px;
                                margin:-2px 10px 0 0;
                                vertical-align:middle;
                                cursor:pointer;
                            }
                        </style>
        
</head>
 <body>
 <?php
if($activo<2)
{
    session_start();
    session_unset();
    session_destroy();
    $_SESSION['message']="Ocurrio un Error";
    header("Location: error.php");
    exit();
}
if($activo>1)
{
    include 'banner.php';
}
?>     
<header class="header-two-bars">
<div class="header-second-bar">
                <?php $sqloficina="Select * from oficinas ORDER BY Numero";
                    $resultadooficina = mysqli_query($con,$sqloficina);?>
                   
                    <br>
                    <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                    <ul>
                        <li></li><br>
                        1- Escoja una Fecha: <br><br>
                        Fecha y Hora de Inicio <br><Input id="busca" name="ingreso" type="datetime-local" placeholder="Entrada"  value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>" autofocus ><br><br>
                        Fecha y Hora de Inicio Fin : <br><input id="busca" name="salida" type="datetime-local" placeholder="Salida"  value="<?php echo date('Y-m-d').'T'.date('23:59'); ?>" autofocus ><br><br>
                        2- Parametros: <br><br>
                        
                        <input id="busca" name="id" type="search" placeholder="Cedula" autofocus ><br><br>
                        
                        Oficina:<br><br>
                        <select id="busca" name="oficina" >
                    <?php
                     while($fila = mysqli_fetch_assoc($resultadooficina))
                        {
                             echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
                        }?>
                    </select>
                        <br><br>
                        Tipo:<br><br>
                        <select name="tip" form="buscador">
                            <option value="FUNCIONARIO">FUNCIONARIO</option>
                            <option value="VISITANTE">VISITANTE</option>
                            <option value="CONTRATISTA">CONTRATISTA</option>
                        </select>
                        <br><br>
                        
                        3- Seleccione una Opcion adicional: <br> 
                    
                        
                         <li>
                         <input type="checkbox" name="Documento" id="Documento" value="1">Cedula<br></li>
                         <li>
                             
                         <input type="checkbox"  name="Oficina" id="Oficina" value="1">Oficina </li>
                         <li>
                         <input type="checkbox"  name="Perfil" id="Perfil" value="1"> Perfil</li><br>
                         
                    </ul>
                        <input type="submit" name="buscador" class="btn btn-success" aceptar" value="buscar">
                       
</form>
<form method="post" action="reportelogexcel.php">
<input type="submit" name="exportar" class="btn btn-success" aceptar" value="Exportar">

                   
               

            </div>

        </header>
<?php


$nuevoIngreso = $_POST['ingreso'];
$nuevoSalida = $_POST['salida'];
$nuevooficina=$_POST['oficina'];
$nuevotipo=$_POST['tip'];
$nuevoid = $_POST['id'];
$tipo  = $_POST['perfil'];
if(isset($_POST['buscador'])){
$sql="SELECT T1.fechaevento,T1.identificacion,T2.nombre,T4.Nombre,T2.vehiculo,T2.tipo,T1.evento,T1.motivo,T3.nombrecontroladora FROM log as T1
INNER JOIN visitantes as T2 on T1.identificacion=T2.identificacion 
INNER JOIN controladoras as T3 on T1.ncontroladora=T3.idcontroladora
INNER JOIN oficinas as T4 on T2.Oficina=T4.Numero where fechaevento>= '$nuevoIngreso' and fechaevento <= '$nuevoSalida'";
 $vacio=0;
    if(isset($_POST['Documento']) && $_POST['Documento'] == '1')
    {        
        $sql=$sql.=" and T1.identificacion = '$nuevoid'  ";}
        if(isset($_POST['Oficina']) && $_POST['Oficina'] == '1')
        { 
 
            $sql=$sql." and T2.oficina = '$nuevooficina'";
        }
        
        if(isset($_POST['Perfil']) && $_POST['Perfil'] == '1')
        {
            $sql=$sql." and T2.tipo = '$nuevotipo' ";
}
    
    
    
$validar=1;
   
}

$sql =$sql." order by T1.fechaevento desc";

$resultado = mysqli_query($con,$sql);
//echo $sql;

?>
<input type="hidden" name="sql" value="<?php echo $sql; ?>">
                    </form>
                </div>
<?php 
                

$resultado=mysqli_query($con,$sql);
                //echo $sql;

if($validar==1){?>
<table class ="table table-triped table-bordered">
<tr>
<th>Fecha y Hora</th>
<th>Documento</th>
<th>Nombre</th>
<th>Oficina</th>
<th>Tipo</th>
<th>Veh.</th> 
<th>Evento</th>
<th>Motivo</th>
<th>Controladora</th>
</tr>
<?php
while($fila = mysqli_fetch_assoc($resultado))
{
  $evento=$fila['evento'];
    
if($evento=='antipassback')
{
    echo '<tr>';
    echo "<td><font color='red'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='red'>".$fila['identificacion']."</font></td>";
    echo "<td><font color='red'>".$fila['nombre']."</font></td>";                             echo "<td><font color='red'>".$fila['Nombre']."</font></td>";
    echo "<td><font color='red'>".$fila['tipo']."</font></td>";
    echo "<td><font color='red'>".$fila['vehiculo']."</font></td>";
	echo "<td><font color='red'>".$fila['evento']."</font></td>";
	echo "<td><font color='red'>".$fila['motivo']."</font></td>";
    echo "<td><font color='red'>".$fila['nombrecontroladora']."</font></td>"; 
    echo '</tr>';
} 


if($evento=='expirado')
{
	echo '<tr>';
    echo "<td><font color='black'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='black'>".$fila['identificacion']."</font></td>";
    echo "<td><font color='black'>".$fila['nombre']."</font></td>";
    echo "<td><font color='black'>".$fila['Nombre']."</font></td>";
    echo "<td><font color='black'>".$fila['tipo']."</font></td>";
    echo "<td><font color='black'>".$fila['vehiculo']."</font></td>";        
	echo "<td><font color='black'>".$fila['evento']."</font></td>";
	echo "<td><font color='black'>".$fila['motivo']."</font></td>";
    echo "<td><font color='black'>".$fila['nombrecontroladora']."</font></td>";
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
    echo "<td><font color='orange'>".$mostrarnombre['nombrecontroladora']."</font></td>"; 
    echo '</tr>';
}
    if($evento=='vehiculo')
{
	echo '<tr>';
    echo "<td><font color='blue'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='blue'>".$fila['identificacion']."</font></td>";
    echo "<td><font color='blue'>".$fila['nombre']."</font></td>";
    echo "<td><font color='blue'>".$fila['Nombre']."</font></td>";
    echo "<td><font color='blue'>".$fila['tipo']."</font></td>";
    echo "<td><font color='blue'>".$fila['vehiculo']."</font></td>";
    echo "<td><font color='blue'>".$fila['evento']."</font></td>";
	echo "<td><font color='blue'>".$fila['motivo']."</font></td>";
    echo "<td><font color='blue'>".$fila['nombrecontroladora']."</font></td>"; 
	echo '</tr>';
}
}}
?>
