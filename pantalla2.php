<?php

require 'conexion.php';

$oficina = $_GET['oficina'];
$id = '1';
echo $oficina;

$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_cap","root","");
$resultado = mysqli_query($con, "REPLACE INTO psalida(idpsalida,oficina) VALUES ('$id','$oficina')");

?>

