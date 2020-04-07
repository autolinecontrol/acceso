<?php
require_once 'dbconfig.php';
//$fecha =  $_GET['fecha'];
$ncontroladora = $_GET['ncontroladora'];
$estado = $_GET['estado'];

$query = "select identificacion,Ingreso,Salida,estado,Oficina,vehiculo from visitantes  where  estado != '$Estado' AND ncontroladora= '$ncontroladora'";
 
$stmt = $DBcon->prepare($query);
$stmt->execute();
 
$userData = array();
 
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  
  $userData['AllUsers'][]= $row;
}
 
echo json_encode($userData);
