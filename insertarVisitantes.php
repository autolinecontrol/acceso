<?php
$Nombre = $_GET['nombre'];
$Identificacion = $_GET['identificacion'];
$Codigo = $_GET['codigo'];
$Oficina = $_GET['oficina'];
$Correo = $_GET['correo'];
$Ingreso = $_GET['ingreso'];
$Salida = $_GET['salida'];
$Estado = $_GET['estado'];
$Controladora = $_GET['controladora'];
$estado = $_GET['estado'];
$tipo = $_GET['tipo'];
$autorizo = $_GET['autorizo'];

$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_cap","root","");
//$res=$cnx->query("insert into transacciones values (null,'$Nombre','$Identificacion','$Codigo','$Oficina','Correo','$Ingreso','$Salida','$Estado','$Controladora','$estado','$tipo','$autorizo')");
$res=$cnx->query("insert into transacciones values (null,'$Nombre','$Identificacion')");
echo($res);

?>
