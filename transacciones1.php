<?php
require 'conexion.php';

$Identificacion = $_GET['identificacion'];
$Oficina        = $_GET['oficina'];
$tipov          = $_GET['tipov'];

echo $Identificacion;
echo $Oficina;
echo $tipov;


$resultado = mysqli_query($con, "REPLACE INTO parqueadero(Identificacion,Oficina,tipov) 
VALUES ('$Identificacion','$Oficina','$tipov')");

?>
