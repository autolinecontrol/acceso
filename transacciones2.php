<?php

require 'conexion.php';

$Identificacion = $_GET['identificacion'];
$Oficina        = $_GET['oficina'];

echo $Identificacion;
echo $Oficina;


$resultado = mysqli_query($con, "DELETE from parqueadero where identificacion = '$Identificacion'");

?>
