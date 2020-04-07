<?php
require '../conexion.php';

$nombre  = $_GET['nombre']; 
$codigo = filter_input ( INPUT_GET , 'codigo' , FILTER_SANITIZE_ENCODED ); 
$identificacion  = filter_input ( INPUT_GET , 'identificacion' , FILTER_SANITIZE_ENCODED ); 
$ingreso = $_GET['ingreso'];
$salida = $_GET['salida'];
$controladora = '1';
$estado = 'N';
$oficina = $_GET['oficina'];
$correo = $_GET['correo'];
$tipo = $_GET['tipo'];
$vehiculo = $_GET['vehiculo'];

echo $tipo;

$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_cap","root","");
$resultado = mysqli_query($con, "REPLACE INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,ncontroladora,estado,tipo,vehiculo) VALUES ('', '$nombre', '$identificacion', '$codigo','$oficina','$correo','$ingreso','$salida','$controladora','$estado','$tipo','$vehiculo')");

?>
