<?php
require 'conexion.php';

$Oficina = $_GET['oficina'];
//$nuevoSalida = $_POST['salida'];

$result = mysqli_query($con, "select count(*) from parqueadero where oficina = '$Oficina'" );
//echo $resultado[0];
$count = mysqli_fetch_array($result); 
$num = "$count[0]";

echo $num;

$resultado = mysqli_query($con, "update oficinas set Cupoactual='$num' where Numero = '$Oficina'");
?>

