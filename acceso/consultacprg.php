<?php
$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_cap","root","");
require_once '../dbconfig.php';
//$fecha =  $_GET['fecha'];
$ncontroladora = $_GET['ncontroladora'];
$estado = $_GET['estado'];
$grupo = $_GET['grupo'];


$query = "select identificacion,Ingreso,Salida,estado,Oficina,vehiculo,grupo from visitantes  where  estado != '$estado' AND ncontroladora= '$ncontroladora'AND grupo = '$grupo'";
 
$stmt = $DBcon->prepare($query);
$stmt->execute();
 
$userData = array();
 
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $userData['AllUsers'][]= $row;
}
 
echo json_encode($userData);


