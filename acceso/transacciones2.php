<?php

require 'conexion.php';

$Identificacion = $_GET['identificacion'];
$Oficina        = $_GET['oficina'];

echo $Identificacion;
echo $Oficina;

$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_cap","root","");
$resultado = mysqli_query($con, "DELETE from parqueadero where identificacion = '$Identificacion'");

?>
