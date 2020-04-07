<?php
require '../conexion.php';

$Identificacion = $_GET['identificacion'];
$Ingreso        = $_GET['ingreso'];
$Estado         = $_GET['estado'];
$Controladora   = $_GET['controladora'];
$Oficina        = $_GET['oficina'];

echo $Identificacion;
echo $Ingreso;
echo $Estado;
echo $Controladora; 
echo $Oficina;

$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_cap","root","");
$resultado = mysqli_query($con, "INSERT INTO transacciones(idtransaccion,identificacion,Ingreso,Estado,controladora,oficina) VALUES (NULL,'$Identificacion','$Ingreso','$Estado','$Controladora','$Oficina')");
?>
